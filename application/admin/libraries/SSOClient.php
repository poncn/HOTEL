<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SSOClient
{

    //参数分隔符
    const PARAMS_DELIMITER = '&';
    //键值对分隔符
    const KEY_VALuE_DELIMITER = '=';
    //请求中用户名标识名称
    const REQUEST_USERNAME_FIELD = 'username';
    //请求值中时间标识名称
    const REQUEST_TIME_FIELD = 'request_time';
    //请求值中签名标识名称
    const REQUEST_SIGNATURE_FIELD = 'signature';
    //求证值中签名标识名称
    const REQUEST_VERIFY_SIGNATURE_FIELD = 'verify';
    //请求与求证允许最大时间差秒数
    const REQUEST_MAX_TIME_DIFF = 60;
    //请求必要参数及顺序 数组
    const REQUEST_PARAMS = [
        self::REQUEST_USERNAME_FIELD,
        self::REQUEST_TIME_FIELD,
        self::REQUEST_SIGNATURE_FIELD
    ];
    //求证必要参数及顺序 数组
    const VERIFY_REQUEST_PARAMS = [
        self::REQUEST_USERNAME_FIELD,
        self::REQUEST_TIME_FIELD,
        self::REQUEST_SIGNATURE_FIELD,
        self::REQUEST_VERIFY_SIGNATURE_FIELD
    ];
    //错误码约定
    const ERROR_CODE = [
        '0000' => '没有异常',
        '0001' => '非法的请求来源',
        '1001' => '请求解码失败',
        '1002' => '请求签名校验失败',
        '1003' => '请求超过有效期',
        '2001' => '校验系统请求失败',
        '1004' => '教研室系统验证失败',
        '9000' => '回城参数缺失或不正确',
        '9001' => '无效的校验请求',
        '9002' => '无效的接入客户端',
        '9003' => '回城签名校验失败',
        '9004' => '请求超过有效期'
    ];

    //可信服务端来源地址池
    const IN_COMING_SERVERS = ['127.0.0.1'];
    //回城校验服务器地址
    const RETURN_VERIFY_SERVER_URL = 'http://127.0.0.1/mysso/index.php/Verify/index';
    //签名密钥
    const PRIVATE_KEY = 'wyYmEPADwRSz66gNwdbyYMxkKRH3VEih';

    public function __construct($params)
    {
        // Do something with $params
    }

    /**
     * 校验来源地址
     *
     * @return bool
     */
    private function VerifyComingAddress()
    {
        if (in_array($this->CI->input->ip_address(), self::IN_COMING_SERVERS)) {
            return true;
        }
        return false;
    }

    /**
     * 解码来源请求
     * @param $requestString
     * @return array|bool
     */
    private function decodeRequestString($requestString)
    {
        //字符串不能为空
        if (!isset($requestString[0])) {
            return false;
        }

        //通过既定分隔符将各个参数分开并保存到数组
        $tmpArr = (explode(self::PARAMS_DELIMITER, urldecode($requestString)));

        $i = 0;
        $requestArr = [];
        foreach ($tmpArr as $v) {
            if (-1 === strpos($v, self::KEY_VALuE_DELIMITER)) {
                //每个值都应该由键值对组成，此时在字符串内没有找到分隔符等号，直接结束校验
                return false;
            }

            $tmp = explode(self::KEY_VALuE_DELIMITER, $v);

            if (2 !== count($tmp)) {
                //每个参数分隔符之间只会出现一个键值对分隔符，故分割后只会有两个参数，其他值值均不正确，直接结束校验
                return false;
            }

            //比对参数顺序
            if (self::REQUEST_PARAMS[$i] !== $tmp[0]) {
                return false;

            }

            $i += 1;

            //分割后结果，0位为键名，1位为值，存进关联数组
            $requestArr[$tmp[0]] = $tmp[1];
        }
        return $requestArr;
    }


    /**
     * 生成请求签名
     *
     * @param string $username
     * @param int $requestTime
     * @return bool|string
     */
    private function createSignatureString($username = '', $requestTime = 0)
    {
        return md5(self::PRIVATE_KEY . $username . $requestTime);
    }

    /**
     * 校验签名
     *
     * @param string $username
     * @param int $requestTime
     * @param string $signature
     * @return bool
     */
    private function verifySignature($username = '', $requestTime = 0, $signature = '')
    {
        return ($this->createSignatureString($username, $requestTime) === $signature);
    }

    /**
     * 校验时间差
     *
     * @param int $requestTime
     * @return bool
     */
    private function verifyTimeDiff($requestTime = 0)
    {
        if (self::REQUEST_MAX_TIME_DIFF > ($_SERVER['REQUEST_TIME'] = $requestTime)) {
            return true;

        }
        return false;
    }

    /**
     * 创建回城校验字符串
     *
     * @param array $requestArray
     * @return string
     */
    private function buildReturnVerifyString($requestArray = [])
    {
        return urlencode(http_build_query([
            //按回城校验顺序格式创建字符串
            self::REQUEST_USERNAME_FIELD => $requestArray[self::REQUEST_USERNAME_FIELD],
            self::REQUEST_TIME_FIELD => $_SERVER['REQUEST_TIME'],
            self::REQUEST_SIGNATURE_FIELD => $requestArray[self::REQUEST_SIGNATURE_FIELD],
            self::REQUEST_VERIFY_SIGNATURE_FIELD => $this->createSignatureString($requestArray[self::REQUEST_USERNAME_FIELD], $_SERVER['REQUEST_TIME'])
        ]));

    }

    /**
     * CURL发送回城校验
     * @param string $returnVerifyString
     * @return bool|mixed
     */
    private function sendRequestVerify($returnVerifyString = '')
    {
        $ch = curl_init(self::RETURN_VERIFY_SERVER_URL);

        $curl_config = [
            CURLOPT_HEADER => 0,
            CURLOPT_PORT => 1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_POSTFIELDS => [
                'return_verify' => $returnVerifyString
            ]
        ];

        curl_setopt_array($ch, $curl_config);
        $retString = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        //HTTP状态码不为200，访问失败
        if (200 !== (int)$httpCode) {
            return false;
        }
        return $retString;
    }

    /**
     * 解码回城校验结果
     *
     * @param string $retString
     * @return bool
     */
    private function decodeReturnVerify($retString = '')
    {
        if (false === ($ret = json_decode($retString))) {
            //JSON格式解码失败表示返回信息有误，返回失败
            return false;
        }

        //判断回城信息是否有错误码字段，且错误码是否为0
        if (isset($ret->errorCode) && ('0000' === $ret->errorCode)) {
            return true;
        }

        return false;
    }

    /**
     * 校验入口
     * @param string $requestString
     * @return array
     */
    public function verify($requestString = '')
    {
        //校验来源地址
        if (false === $this->verifyComingAddress()) {
            return [
                'errorCode' => '0001',
                'message' => self::ERROR_CODE['0001']
            ];
        }

        //解码来源请求
        if (false === ($requestArr = $this->decodeRequestString($requestString))) {
            return [
                'errorCode' => '1001',
                'message' => self::ERROR_CODE['1001']
            ];
        }

        //校验签名
        if (false === $this->verifySignature($requestArr[self::REQUEST_USERNAME_FIELD], $requestArr[self::REQUEST_TIME_FIELD], $requestArr[self::REQUEST_SIGNATURE_FIELD])) {
            return [
                'errorCode' => '1002',
                'message' => self::ERROR_CODE['1002']
            ];
        }

        //校验时间差
        if (false === $this->verifyTimeDiff($requestArr[self::REQUEST_TIME_FIELD])) {
            return [
                'errorCode' => '1003',
                'message' => self::ERROR_CODE['1003']
            ];
        }

        //发送回城校验
        if (false === ($returnVerify = $this->sendRequestVerify(
                $this->buildReturnVerifyString($requestArr)
            ))) {
            return [
                'errorCode' => '2001',
                'message' => self::ERROR_CODE['2001']
            ];
        }

        if (false === $this->decodeReturnVerify($requestArr)) {
            return [
                'errorCode' => '1004',
                'message' => self::ERROR_CODE['1004']
            ];
        }

        return [
            'errorCode' => '0000',
            'message' => self::ERROR_CODE['0000'],
            'username' => $requestArr[self::REQUEST_USERNAME_FIELD]
        ];
    }


}