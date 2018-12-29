<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends MY_Controller
{
    public $tableName = 'comment';

    public function __construct()
    {
        parent::__construct();

        $this->load->Model('Public_model');
    }

    public function table()
    {
        $result = $this->Public_model->getUsers($this->tableName);

        $this->loadView('admin/table/comment_table', [
            'comments' => $result
        ]);
    }

    public function create($id = '')
    {
        if (!($data = $this->Public_model->getUserById($this->tableName, $id))) {
            $this->loadView('admin/create/comment_create');
        } else {
            $this->loadView('admin/create/comment_create', [
                'data' => $data
            ]);
        }
    }

    public function verify()
    {
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'content',
                'label' => 'content',
                'rules' => 'required',
                'errors' => array(
                    'required' => '留言内容为必填项'
                ),
            ),
            array(
                'field' => 'positive',
                'label' => 'positive',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '好评数为必填项',
                    'numeric' => '好评数必须由数字组成',
                ),
            ),
            array(
                'field' => 'negative',
                'label' => 'negative',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '差评数为必填项',
                    'numeric' => '差评数必须由数字组成'
                ),
            ),

            array(
                'field' => 'time',
                'label' => 'time',
                'rules' => 'required',
                'errors' => array(
                    'required' => '评论时间为必填项'
                ),
            ),

            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|regex_match[/[A-Za-z0-9]/]|is_unique[users.username]|min_length[3]|max_length[9]',
                'errors' => array(
                    'required' => '用户名为必填项',
                    'regex_match' => '用户名必须是英文字母和数字',
                    'is_unique' => '用户名已存在',
                    'min_length' => '用户名最少由3个字母或数字组成',
                    'max_length' => '用户名最多由9个字母或数字组成',
                ),
            ),
            array(
                'field' => 'room_number',
                'label' => 'room_number',
                'rules' => 'required|numeric|exact_length[4]',
                'errors' => array(
                    'required' => '房间号为必填项',
                    'numeric' => '房间号必须由数字组成',
                    'exact_length' => '房间号必须4位数字组成'
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
            'content', 'positive', 'negative', 'time', 'username', 'room_number'
        ]);

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
        $this->loadView('admin/create/comment_create', [
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
            'content', 'positive', 'negative', 'time', 'username', 'room_number'
        ]);
        $data['id']=$id;
        if ($this->verify() !== true) {
            $alert['message'] = $this->verify();
        } else {
            $result = $this->Public_model->editUserByUserId($this->tableName, $id, $data);
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
        $this->loadView('admin/create/comment_create', [
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
