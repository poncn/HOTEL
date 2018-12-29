<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends MY_Controller
{
    public $tableName = 'type';

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Public_model');
    }

    public function table()
    {
        $result = $this->Public_model->getUsers($this->tableName);

        $this->loadView('admin/table/type_table', [
            'types' => $result
        ]);
    }

    public function create($id = '')
    {
        if (!($data = $this->Public_model->getUserById($this->tableName,$id))) {
            $this->loadView('admin/create/type_create');
        } else {
            $this->loadView('admin/create/type_create', [
                'data' => $data
            ]);
        }
    }

    public function verify($data = [])
    {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'type',
                'label' => 'type',
                'rules' => 'required',
                'errors' => array(
                    'required' => '用户名为必填项',
                ),
            ),
            array(
                'field' => 'unit_price',
                'label' => 'unit_price',
                'rules' => 'required',
                'errors' => array(
                    'required' => '房间单价为必填项',
                ),
            ),
            array(
                'field' => 'bedroom',
                'label' => 'bedroom',
                'rules' => 'required',
                'errors' => array(
                    'required' => '卧室数为必填项',
                ),
            ),
            array(
                'field' => 'bed',
                'label' => 'bed',
                'rules' => 'required',
                'errors' => array(
                    'required' => '床铺数为必填项',
                ),
            ),
            array(
                'field' => 'toilet',
                'label' => 'toilet',
                'rules' => 'required',
                'errors' => array(
                    'required' => '洗手间数为必填项',
                ),
            ),
            array(
                'field' => 'num_people',
                'label' => 'num_people',
                'rules' => 'required',
                'errors' => array(
                    'required' => '可住人数为必填项',
                ),
            ),
            array(
                'field' => 'pic_1',
                'label' => 'pic_1',
                'rules' => 'required',
                'errors' => array(
                    'required' => '介绍图1为必填项',
                ),
            ),
            array(
                'field' => 'pic_2',
                'label' => 'pic_2',
                'rules' => 'required',
                'errors' => array(
                    'required' => '介绍图2为必填项',
                ),
            ),
            array(
                'field' => 'pic_3',
                'label' => 'pic_3',
                'rules' => 'required',
                'errors' => array(
                    'required' => '介绍图3为必填项',
                ),
            ),
            array(
                'field' => 'pic_4',
                'label' => 'pic_4',
                'rules' => 'required',
                'errors' => array(
                    'required' => '介绍图4为必填项',
                ),
            ),
            array(
                'field' => 'pic_5',
                'label' => 'pic_5',
                'rules' => 'required',
                'errors' => array(
                    'required' => '介绍图5为必填项',
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

    public function upFile()
    {
        $config['upload_path'] = 'public/uploads/type/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] = date('Ymdhim') . rand(1, 9999999) . time();
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);

        return $config;
    }

    public function insert()
    {
        $alert = [
            'errorCode' => 0,
            'message' => '创建失败'
        ];

        $data = $this->input->post([
            'type', 'unit_price', 'bedroom', 'bed', 'toilet', 'num_people'
        ]);

        $config = $this->upFile();

        if ($this->verify() !== true) {
            $alert['message'] = $this->verify();
        } else if (!($this->upload->do_upload(['pic_1', 'pic_2', 'pic_3', 'pic_4', 'pic_5']))) {
            $alert['message'] = $this->upload->display_errors('', '');
        } else {

            $path = $config['upload_path'] . $this->upload->data('file_name');

            $result = $this->Public_model->addUser($this->tableName,[
                'type' => $data['type'],
                'unit_price' => $data['unit_price'],
                'bedroom' => $data['bedroom'],
                'bed' => $data['bed'],
                'toilet' => $data['toilet'],
                'num_people' => $data['num_people'],
                'pic_1' => $path,
                'pic_2' => $path,
                'pic_3' => $path,
                'pic_4' => $path,
                'pic_5' => $path,
            ]);
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
        $this->loadView('admin/create/type_create', [
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
            'username', 'password', 'rePassword'
        ]);

        $config = $this->upFile();

        if ($this->verify() !== true) {
            $alert['message'] = $this->verify();
        } else if (!($this->upload->do_upload('head_portrait'))) {
            $alert['message'] = $this->upload->display_errors('', '');
        } else {

            $path = $config['upload_path'] . $this->upload->data('file_name');

            $result = $this->Public_model->editUserByUserId($this->tableName,$id, [
                'id' => $id,
                'username' => $data['username'],
                'password' => $data['password'],
                'head_portrait' => $path
            ]);
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
        $this->loadView('admin/create/type_create', [
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