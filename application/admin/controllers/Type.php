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
        if (!($data = $this->Public_model->getUserById($this->tableName, $id))) {
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
            )
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
        if ($this->verify($data) !== true) {
            $alert['message'] = $this->verify($data);
            $this->loadView('admin/create/type_create', ['alert' => $alert]);
        } else {
            $config = $this->upFile();
            //循环处理上传文件
            foreach ($_FILES as $key => $v) {
                if (empty($key['name'])) {
                    static $i = 1;
                    if ($this->upload->do_upload($key)) {
                        //上传成功
                        $data["pic_" . $i] = $config['upload_path'] . $this->upload->data('file_name');
                        $i++;
                    } else {
                        //上传失败
                        $alert['message'] = $this->upload->display_errors('', '');
                        break;
                    }
                }
            }
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
            $this->loadView('admin/create/type_create', ['alert' => $alert]);
        }
    }

    public function update($id = 0)
    {
        $alert = [
            'errorCode' => 0,
            'message' => '修改失败'
        ];

        $data = $this->input->post([
            'type', 'unit_price', 'bedroom', 'bed', 'toilet', 'num_people'
        ]);
        $data['id'] = $id;
        if ($this->verify($data) !== true) {
            $alert['message'] = $this->verify($data);
            $this->loadView('admin/create/type_create', ['alert' => $alert]);
        } else {
            $config = $this->upFile();
            //循环处理上传文件
            foreach ($_FILES as $key => $v) {
                if (empty($key['name'])) {
                    static $i = 1;
                    if ($this->upload->do_upload($key)) {
                        //上传成功
                        $data["pic_" . $i] = $config['upload_path'] . $this->upload->data('file_name');
                        $i++;
                    } else {
                        //上传失败
                        $alert['message'] = $this->upload->display_errors('', '');
                        break;
                    }
                }
            }
            $result = $this->Public_model->editUserByUserId($this->tableName,$id,$data);

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
            $this->loadView('admin/create/type_create', ['alert' => $alert]);
        }
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