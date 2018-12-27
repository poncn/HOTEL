<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_model extends MY_Model
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

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 生成请求签名
     * @param string $clientKey
     * @param string $usernmae
     * @param int $requestTime
     * @return bool|string
     */
    public function createSignatureString($clientKey = '', $username = '', $requestTime = 0)
    {
        return md5($clientKey, $username, $requestTime);
    }

    /**
     * 生成请求
     *
     * @param string $username
     * @param int $clientId
     * @return bool|string
     */
    public function createRequest($username = '', $clientId = 0)
    {
        $this->load->model('Client_model');
        if (!($client = $this->Client_model->getClientById($clientId))) {
            return false;
        }

        $requestTime = $_SERVER['REQUEST_TIME'];

        if ($this->addRequest(($requestArr = [
                self::REQUEST_USERNAME_FIELD => $username,
                self::REQUEST_TIME_FIELD => $requestTime,
                self::REQUEST_SIGNATURE_FIELD => $this->createSignatureString($client->client_key, $username, $requestTime),
            ]) + [
                'request_client_id' => $client->client_id,
                'request_state' => true
            ])) {
            return $client->client_url . urldecode(http_build_query($requestArr));
        }
        return false;

    }

    /**
     * 解码来源请求
     *
     * @param string $requestString
     * @return array|bool
     */
    private function decodeRequestString($requestString = '')
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
                //每个参数分隔符之间只会出现一个键值对分隔符，故分割后只会有两个参数，其他值均不正确，直接结束校验
                return false;
            }

            //比对参数顺序
            if (self::VERIFY_REQUEST_PARAMS[$i] !== $tmp[0]) {
                return false;
            }
            $i += 1;

            //分割后结果，0位为键名，1位为指，存储关联数组
            $requestArr[$tmp[0]] = $tmp[1];

        }
        return $requestArr;

    }

    /**
     * 校验求证信息
     * @param string $verifyString
     * @return array
     */
    public function verifyRequest($verifyString = '')
    {
        //解码请求字符串
        if (false === ($verifyArr = $this->decodeRequestString($verifyString))) {
            return [
                'errorCode' => '9000',
                'message' => self::ERROR_CODE['9000']
            ];
        }

        //获取源请求信息
        if (!($sourceRequest = $this->getValidRequestBySignature($verifyString))) {
            return [
                'errorCode' => '9001',
                'message' => self::ERROR_CODE['9001']
            ];
        }

        //通过原请求信息客户端ID获取客户端信息
        $this->load->model('Client_model');
        if (!($client = $this->Client_model->getClientById($sourceRequest->request_client_id))) {
            return [
                'errorCode' => '9002',
                'message' => self::ERROR_CODE['9002']
            ];
        }

        //比对签名值
        if ($this->createSignatureString($client->client_key, $verifyArr[self::REQUEST_USERNAME_FIELD], $verifyArr[self::REQUEST_TIME_FIELD]) !== $verifyArr[self::REQUEST_VERIFY_SIGNATURE_FIELD]) {
            return [
                'errorCode' => '9003',
                'message' => self::ERROR_CODE['9003']
            ];
        }

        //比对请求与验证时间差
        if (self::REQUEST_MAX_TIME_DIFF < ($verifyArr[self::REQUEST_TIME_FIELD] - $sourceRequest->request_time)) {
            return [
                'errorCode' => '9004',
                'message' => self::ERROR_CODE['9004']
            ];
        }

        //设置当次请求已使用
        if ($this->setRequest((array)$sourceRequest, [
            'request_state' => false
        ])) {
            return [
                'errorCode' => '0000',
                'message' => self::ERROR_CODE['0000']
            ];
        }

        return [
            'errorCode' => '9001',
            'message' => self::ERROR_CODE['9001']
        ];
    }


}
