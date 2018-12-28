<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Public_model extends MY_Model
{
    //用户名session标记项
    const USER_SESSION_SIGN = 'username';
    const USER_PASSWORD_SALT = 'this_is_my_hotel';

    /**
     * 生成哈希密码字符串
     * @param string $username
     * @param string $password
     * @return string
     */
    public function createHashedPassword($username = '', $password = '')
    {
        return md5($password . $username . self::USER_PASSWORD_SALT);
    }

    /**
     * 校验登录亲求
     *
     * @param string $username
     * @param string $password
     * @return bool|mixed
     */
    public function verifyLogin($tableName='',$username = '', $password = '')
    {
        if (($user = $this->getUser($tableName,'username', [
            'username' => $username,
            'password' => $this->createHashedPassword($username, $password)
        ]))) {
            return $this->setLogin($user->username);
        }
        return false;
    }

    /**
     * 设置登录SESSION记录
     *
     * @param string $username
     * @return bool
     */
    public function setLogin($username = '')
    {
        $_SESSION[self::USER_SESSION_SIGN] = $username;
        return true;
    }

    /**
     * 销毁当前登录SESSION记录
     * @return bool
     */
    public function setLogout()
    {
        unset($_SESSION[self::USER_SESSION_SIGN]);
        return true;
    }

    /**
     * 获取当前登录用户名
     *
     * @return bool
     */
    public function getCurrentLogin()
    {
        return (isset($_SESSION[self::USER_SESSION_SIGN])) ? $_SESSION[self::USER_SESSION_SIGN] : false;
    }


    /**
     * 获取当前登录用户信息
     *
     * @return bool
     */
    public function getCurrentUser($tableName='')
    {
        if (false != ($currentUsername = $this->getCurrentLogin())) {
            return $this->getUserByUserName($tableName,$currentUsername);
        }
        return false;
    }

    /**
     * 获取单个用户
     *
     * @param string $select
     * @param array $where
     * @param array $like
     * @return bool|mixed
     */
    public function getUser($tableName='',$select = '*', $where = [], $like = [])
    {
        return parent::get($this->db, $tableName, $select, $where, $like);
    }

    /**
     * 通过用户名获取用户信息
     *
     * @param string $username
     * @param string $select
     * @return bool|mixed
     */
    public function getUserByUserName($tableName='',$username = '', $select = '*')
    {
        return $this->getUser($tableName,$select, [
            'username' => trim($username)
        ]);
    }

    /**
     * 通过用户ID获取用户信息
     *
     * @param int $userId
     * @param string $select
     * @return bool|mixed
     */
    public function getUserById($tableName='',$Id = 0, $select = '*')
    {
        return $this->getUser($tableName,$select, ['id' => (int)$Id]);
    }

    /**
     * 批量获取用户
     *
     * @param string $select
     * @param array $where
     * @param array $whereIn
     * @param array $whereNotIn
     * @param array $like
     * @param array $order
     * @param int $limit
     * @param int $offset
     * @param bool $isOnlyReturnCountNum
     * @param bool $returnAsArray
     * @return mixed|bool
     */
    public function getUsers($tableName='',$select = '*', $where = [],
                             $whereIn = [], $whereNotIn = [], $like = [], $order = [], $limit = 0, $offset = 0, $isOnlyReturnCountNum = false, $returnAsArray = false)
    {
        return parent::gets($this->db, $tableName, $select, $where, $whereIn, $whereNotIn, $like, $order, $limit, $offset, $isOnlyReturnCountNum, $returnAsArray);
    }

    /**
     * 新增用户
     *
     * @param array $set
     * @return bool
     */
    public function addUser($tableName='',$set = [])
    {
        if (isset($set['password'])) {
            $set['password'] = $this->createHashedPassword($set['username'], $set['password']);
        }
        return parent::add($this->db, $tableName, $set);
    }

    /**
     * 使用传参方式新增用户
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function addUserWithParams($tableName='',$username = '', $password = '')
    {
        return $this->addUser($tableName,[
            'username' => $username,
            'password' => $password
        ]);
    }

    /**
     * 设置新用户
     *
     * @param array $where
     * @param array $set
     * @param int $limit
     * @return bool
     */
    public function setUser($tableName='',$where = [], $set = [], $limit = 1)
    {
        if(isset($set['password'])){
            if(!($user=$this->getUser($tableName,'username',$where))){
                return false;
            }

            $set['password']=$this->createHashedPassword($user->username,$set['password']);

        }
        return parent::set($this->db,$tableName,$where,$set,$limit);
    }

    /**
     * 通过用户名编辑用户信息
     *
     * @param string $username
     * @param array $set
     * @return bool
     */
    public function editUserByUserName($tableName='',$username='',$set=[])
    {
        if(isset($set['username'])){
            unset($set['username']);
        }

        return $this->setUser($tableName,[
            'username'=>trim($username)
        ],$set);
    }

    public function editUserByUserId($tableName='',$id=0,$set=[],$limit = 1){

        if(isset($set['password'])){
            if(!($this->getUserById($tableName,$id))){
                return false;
            }

            $set['password']=$this->createHashedPassword($set['username'],$set['password']);

        }
        return $this->db->limit($limit)
            ->replace($tableName,$set);
    }

    /**
     * 修改用户密码
     *
     * @param string $username
     * @param array $password
     * @return bool
     */
    public function changeUserPassword($tableName='',$username='',$password='')
    {
        return $this->editUserByUserName($tableName,$username,[
            'password'=>trim($password)
        ]);
    }

    /**
     * 删除用户
     *
     * @param array $where
     * @param int $limit
     * @return mixed
     */
    public function deleteUser($tableName='',$where=[],$limit=1)
    {
        return parent::delete($this->db,$tableName,$where,$limit);
    }

    /**
     * 通过用户ID删除用户
     *
     * @param int $userId
     * @return mixed
     */
    public function deleteUserById($tableName='',$Id=0)
    {
        return $this->deleteUser($tableName,['id'=>(int)$Id]);
    }

}
