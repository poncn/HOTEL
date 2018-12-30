<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends My_Controller
{

    private $tableName='clients';

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Public_model');
    }

    /**
     * 用户首页
     */
    public function table()
    {
        $result = $this->Public_model->getUsers($this->tableName);

        $this->loadView('admin/table/clients_table', [
            'clients' => $result
        ]);
    }

    public function create($id = '')
    {
        if (!($data = $this->Public_model->getClientById($this->tableName,$id))) {
            $this->loadView('admin/create/client_create');
        } else {
            $this->loadView('admin/create/client_create', [
                'data' => $data
            ]);
        }
    }

    public function verify()
    {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'client_name',
                'label' => 'client_name',
                'rules' => 'required|regex_match[/[A-Za-z0-9]/]|is_unique[admin.username]|min_length[3]|max_length[9]',
                'errors' => array(
                    'required' => '用户名为必填项',
                    'regex_match' => '用户名必须是英文字母和数字',
                    'is_unique' => '用户名已存在',
                    'min_length' => '用户名最少由3个字母或数字组成',
                    'max_length' => '用户名最多由9个字母或数字组成',
                ),
            ),
            array(
                'field' => 'client_key',
                'label' => 'client_key',
                'rules' => 'required',
                'errors' => array(
                    'required' => '签名为必填项',
                ),
            ),
            array(
                'field' => 'client_url',
                'label' => 'client_url',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'URL为必填项',
                ),
            ),
            array(
                'field' => 'client_state',
                'label' => 'client_state',
                'rules' => 'required',
                'errors' => array(
                    'required' => '状态为必填项',
                ),
            ),
        );

        $this->form_validation->set_rules($config);
        $result = $this->form_validation->run();
        if (!$result) {
            $error = $this->form_validation->error_array();
            foreach ($error as $e => $v) {
                if (isset($v[0])) {
                    return $v;
                }
            }
        }
        return true;
    }

    public function insert()
    {
        $alert = [
            'errorCode' => 0,
            'message' => '创建失败'
        ];

        $data = $this->input->post([
            'client_name', 'client_key', 'client_url', 'client_state'
        ]);

        if ($this->verify() !== true) {
            $alert['message'] = $this->verify();
        } else {

            $result = $this->Public_model->addUser($this->tableName,$data);
            if ($result) {
                $alert = [
                    'errorCode' => 1,
                    'message' => '创建成功'
                ];
            } else {
                $alert = [
                    'errorCode' => 0,
                    'message' => '创建失败'
                ];
            }
        }
        $this->loadView('admin/create/client_create', [
            'alert' => $alert
        ]);

    }

    public function update($id = 0)
    {
        $alert = [
            'errorCode' => 0,
            'message' => '修改失败'
        ];

        $data = $this->input->post([
            'client_name', 'client_key', 'client_url', 'client_state'
        ]);
        if ($this->verify() !== true) {
            $alert['message'] = $this->verify();
        } else {
            $result = $this->Public_model->setUser($this->tableName,['client_id'=>(int)$id], $data);
            if ($result) {
                $alert = [
                    'errorCode' => 1,
                    'message' => '修改成功'
                ];
            } else {
                $alert = [
                    'errorCode' => 0,
                    'message' => '修改失败'
                ];
            }
        }
        $this->loadView('admin/create/client_create', [
            'alert' => $alert
        ]);

    }

    public function delete()
    {
        $retArr = [
            'errorCode' => 1
        ];

        $Id = (int)$this->input->post('client_id');

        if ($this->Public_model->deleteUser($this->tableName,['client_id'=>(int)$Id])) {
            $retArr['errorCode'] = 0;
        }

        $this->jsonOut($retArr);

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
