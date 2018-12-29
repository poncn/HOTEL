<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends MY_Controller
{
    public $tableName = 'book';

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Public_model');
    }

    public function table()
    {
        $result = $this->Public_model->getUsers($this->tableName);

        $this->loadView('admin/table/book_table', [
            'books' => $result
        ]);
    }

    public function create($id = '')
    {
        if (!($data = $this->Public_model->getUserById($this->tableName, $id))) {
            $this->loadView('admin/create/book_create');
        } else {
            $this->loadView('admin/create/book_create', [
                'data' => $data
            ]);
        }
    }

    public function verify()
    {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'user_id',
                'label' => 'user_id',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '用户ID为必填项',
                    'numeric' => '用户ID只能由数字组成',
                ),
            ),
            array(
                'field' => 'room_number',
                'label' => 'room_number',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '房间号为必填项',
                    'numeric' => '房间号只能由数字组成',
                ),
            ),
            array(
                'field' => 'day',
                'label' => 'day',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '入住天数为必填项',
                    'numeric' => '入住天数只能由数字组成',
                ),
            ),
            array(
                'field' => 'total_money',
                'label' => 'total_money',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '支付金额为必填项',
                    'numeric' => '支付金额只能由数字组成',
                ),
            ),
            array(
                'field' => 'check_in_time',
                'label' => 'check_in_time',
                'rules' => 'required',
                'errors' => array(
                    'required' => '入住时间为必填项',
                ),
            ),
            array(
                'field' => 'check_out_time',
                'label' => 'check_out_time',
                'rules' => 'required',
                'errors' => array(
                    'required' => '退房时间为必填项',
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
            'user_id', 'room_number', 'day', 'total_money', 'check_in_time', 'check_out_time'
        ]);
        $data['start_time'] = strtotime($data['check_in_time']);
        $data['end_time'] = strtotime($data['check_out_time']);
        $data['check_in_time'] = date('Y-m-d', $data['start_time']);
        $data['check_out_time'] = date('Y-m-d', $data['end_time']);
        if ($this->verify() !== true) {
            $alert['message'] = $this->verify();
        } else {

            $result = $this->Public_model->addUser($this->tableName, $data);
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
        $this->loadView('admin/create/book_create', [
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
            'user_id', 'room_number', 'day', 'total_money', 'check_in_time', 'check_out_time'
        ]);
        $data['id']=$id;
        $data['start_time'] = strtotime($data['check_in_time']);
        $data['end_time'] = strtotime($data['check_out_time']);
        $data['check_in_time'] = date('Y-m-d', $data['start_time']);
        $data['check_out_time'] = date('Y-m-d', $data['end_time']);
        if ($this->verify() !== true) {
            $alert['message'] = $this->verify();
        } else {

            $result = $this->Public_model->editUserByUserId($this->tableName, $id,$data);
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
        $this->loadView('admin/create/book_create', [
            'alert' => $alert
        ]);

    }

    public function delete()
    {
        $retArr = [
            'errorCode' => 1
        ];

        $Id = (int)$this->input->post('Id');

        if ($this->Public_model->deleteUserById($this->tableName, $Id)) {
            $retArr['errorCode'] = 0;
        }

        $this->jsonOut($retArr);

    }
}
