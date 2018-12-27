<?php

/**
 * 扩展模型
 */
class MY_Model extends CI_Model
{
    protected $lastQuerySql = null;

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取最近一次查询语句
     * @return string
     */
    public function lastQuery()
    {
        return $this->lastQuerySql;
    }

    /**
     * 新增项目
     * @param resource $db
     * @param string $tableName
     * @param array $set
     * @return bool
     */
    protected function add($db = null, $tableName = '', $set = [])
    {
        $db->insert($tableName, $set);
        if ($db->affected_rows() > 0) {
            if ($db->insert_id()) {
                return $db->insert_id();
            }
            return true;
        }
        return false;
    }

    /**
     * 获取单项
     *
     * @param object $db 数据库连接资源
     * @param string $tableName 操作表名
     * @param string $select 字段限制
     * @param array $where 获取的where条件，关联数组['字段名'=>'值'，...]
     * @param array $like 获取的like条件[['字段名'，'匹配值','通配符位置',...],通配符位置可选before|after|both,默认both]
     * @return boolean|mixed
     */
    protected function get($db = null, $tableName = '', $select = '*', $where = [], $like = [])
    {
        if (!is_object($db) || !isset($tableName[0])) {
            return false;
        }

        if (!isset($select[0]) || (null === $select)) {
            $select = '*';
        }
        $db->select($select);

        if (is_array($where) && count($where)) {
            $db->where($where);
        }

        if (is_array($like) && count($like)) {
            foreach ($like as $v) {
                if (3 === count($v)) {
                    $db->like($v[0], $v[1], $v[2]);
                } else {
                    $db->like($v[0], $v[1]);
                }
            }
        }

        $db->limit(1);

        $result = $db->get($tableName);

        $this->setLastQuery($db->last_query());

        if ($result->num_rows() > 0) {
            return $result->row();
        }
        return false;
    }

    /**
     * 设置最近一次查询语句
     * @param string $sql
     */
    public function setLastQuery($sql = '')
    {
        $this->lastQuerySql = $sql;
    }

    /**
     * 获取多项
     * @param object $db 数据库连接资源
     * @param string $tableName 操作表名
     * @param string $select 字段限制
     * @param array $where 获取的where,关联数组['字段名'=>'值'，...]
     * @param array $whereIn 获取的whereIn条件，关联数组['字段名'=>'值1，值2，值3，...',...]
     * @param array $whereNotIn 获取的whereNotIn条件，关联数组['字段名'=>'值1，值2，值3，...',...]
     * @param array $like 获取的like条件,[['字段名','匹配值','通配符位置'],...],通配符位置可选before|after|both,默认both
     * @param array $order 排列规则,['字段名'=>'排列规则',...],排列规则可选ASC|DESC
     * @param int $limit 数量限制
     * @param int $offset 偏移量
     * @param bool $isOnlyReturnCountNum 是否仅返回数据数量
     * @param bool $returnAsArray 默认以[对象1，对象2,...]形式返回结果，可设置本参数true[数组1，数组2，...]形式返回结果
     * @return boolean|mixed
     */
    protected function gets($db = null, $tableName = '', $select = '*', $where = [], $whereIn = [], $whereNotIn = [], $like = [], $order = [], $limit = 0, $offset = 0, $isOnlyReturnCountNum = false, $returnAsArray = false)
    {
        if (!is_object($db) || !isset($tableName[0])) {
            return false;
        }

        if (!isset($select[0]) || (null === $select)) {
            $select = '*';
        }
        $db->select($select);

        if (is_array($where) && count($where)) {
            $db->where($where);
        }

        if (is_array($whereIn) && count($whereIn)) {
            foreach ($whereIn as $k => $v) {
                $db->where_not_in($k, $v);
            }
        }

        if (is_array($whereNotIn) && count($whereNotIn)) {
            foreach ($whereNotIn as $k => $v) {
                $db->where_not_in($k, $v);
            }
        }

        if (is_array($like) && count($like)) {
            foreach ($like as $v) {
                if (3 === count($v)) {
                    $db->like($v[0], $v[1], $v[2]);
                } else {
                    $db->like($v[0], $v[1]);
                }
            }
        }

        if (is_array($order) && count($order)) {
            foreach ($order as $k => $v) {
                $db->order_by($k, $v);
            }
        }

        if (is_numeric($limit) && ($limit > 0)) {
            $db->limit($limit);

        }

        if (is_numeric($offset) && ($offset > 0)) {
            $db->limit($offset);

        }

        if ($isOnlyReturnCountNum) {
            return $db->count_all_result($tableName);
        }

        $result = $db->get($tableName);

        $this->setLastQuery($db->last_query());

        if ($result->num_rows() > 0) {
            if ($returnAsArray) {
                return $result->result_array();
            }
            return $result->result();
        }
        return false;
    }

    /**
     * 设置
     *
     * @param resource $db
     * @param string $tableName
     * @param array $where
     * @param array $set
     * @param int $limit
     * @return bool
     */
    protected function set($db = null, $tableName = '', $where = [], $set = [], $limit = 1)
    {
        if ($limit > 0) {
            $db->limit($limit);
        }
        $flag = $db->update($tableName, $set, $where);
        $this->lastQuerySql = $db->last_query();
        if (true === $flag) {
            return true;
        }
        return false;
    }

    /**
     * 移除
     *
     * @param resource $db
     * @param string $tableName
     * @param array $where
     * @param int $limit
     * @return bool
     */
    protected function delete($db = null, $tableName = '', $where = [], $limit = 1)
    {
        if ($limit > 0) {
            $db->limit($limit);
        }
        $db->delete($tableName, $where);
        $this->lastQuerySql = $db->last_query();
        if (($rows = $db->affected_rows()) > 0) {
            return $rows;
        }
        return false;
    }
}

