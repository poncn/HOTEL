<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends MY_Controller
{
    public $tableName = 'room';

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Public_model');
    }

    public function table()
    {
        $result = $this->Public_model->getUsers($this->tableName);

        $this->loadView('admin/table/room_table', [
            'rooms' => $result
        ]);
    }

    public function create($id = '')
    {
        if (!($data = $this->Public_model->getUserById($this->tableName,$id))) {
            $this->loadView('admin/create/room_create');
        } else {
            $this->loadView('admin/create/room_create', [
                'data' => $data
            ]);
        }
    }

    public function verify()
    {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'id',
                'label' => 'id',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '房间号为必填项',
                    'numeric' => '房间号必须由数字组成',
                ),
            ),
            array(
                'field' => 'introduce',
                'label' => 'introduce',
                'rules' => 'required',
                'errors' => array(
                    'required' => '房间介绍为必填项',
                ),
            ),
            array(
                'field' => 'type_id',
                'label' => 'type_id',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '房间样式ID为必填项',
                    'numeric' => '房间样式ID由数字组成'
                ),
            ),
            array(
                'field' => 'grade',
                'label' => 'grade',
                'rules' => 'required|numeric|less_than_equal_to[5]',
                'errors' => array(
                    'required' => '房间等级为必填项',
                    'numeric' => '房间等级由数字组成',
                    'less_than_equal_to' => '房间等级不能大于5'
                ),
            ),
            array(
                'field' => 'state',
                'label' => 'state',
                'rules' => 'required|numeric|less_than_equal_to[1]',
                'errors' => array(
                    'required' => '房间状态为必填项',
                    'numeric' => '房间状态由数字组成',
                    'less_than_equal_to' => '房间状态不能大于1'
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
            'id', 'introduce', 'type_id','grade', 'state'
        ]);

        if ($this->verify() !== true) {
            $alert['message'] = $this->verify();
        }else {

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
        $this->loadView('admin/create/room_create', [
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
            'id', 'introduce', 'type_id','grade', 'state'
        ]);


        if ($this->verify() !== true) {
            $alert['message'] = $this->verify();
        }else {
            $result = $this->Public_model->editUserByUserId($this->tableName,$id, $data);
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
        $this->loadView('admin/create/room_create', [
            'alert' => $alert
        ]);

    }

    public function delete()
    {
        $retArr = [
            'errorCode' => 1
        ];

        $Id = (int)$this->input->post('Id');

        if ($this->Public_model->deleteUserById($this->tableName,$Id)) {
            $retArr['errorCode'] = 0;
        }

        $this->jsonOut($retArr);

    }
}
