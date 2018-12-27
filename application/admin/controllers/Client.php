<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends My_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Client_model');
    }

    /**
     * 用户首页
     */
    public function index()
    {
        $this->loadView('admin/index');
//            ,[
//            'clients' => $this->Client_model->getValidClients()
//        ]);
    }

    /**
     * 检查密钥可用
     *
     * @param string $privateKey
     * @return mixed
     */
    private function checkPrivateKey($privateKey = '')
    {
        return $this->Client_model->getClientByPrivateKey($privateKey);
    }

    /**
     * 执行创建客户端
     */
    public function doClientAdd()
    {
        $retData = [
            'errorCode' => 1,
            'message' => '创建失败'
        ];

        $createClient = $this->input->post([
            'clientName', 'clientKey', 'clientUrl', 'clientState'
        ], true);

        foreach ($createClient as $k => $v) {
            if (!isset($v[0])) {
                $retData['message'] = "$k 不能为空,请返回修改";
                $this->jsonOut($retData);
            }
        }

        if (false !== $this->checkPrivateKey($createClient['clientKey'])) {
            $retData['message'] = "签名密钥已被占用，请返回修改";
            $this->jsonOut($retData);
        }

        if ($this->Client_model->addClientWithParams($createClient['clientName'], $createClient['clientKey'], $createClient['clientUrl'], $createClient['clientState'])) {
            $retData = [
                'errorCode' => 0,
                'message' => '创建完成',
                'redirectUrl' => site_url('Admin/ClientManager/index')
            ];
        }
        $this->jsonOut($retData);
    }


}
