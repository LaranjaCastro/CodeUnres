<?php

namespace App\Http\Model\Web\Page;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $timestamps = false;

    /**
     * 实例化模型
     * @var
     */
    private $_model;

    /**
     * 要取出的字段
     * @var
     */
    private $_field = 'id';

    /**
     * 当前页
     * @var
     */
    private $_page_now;

    /**
     * 分页大小
     * @var
     */
    private $_page_size;

    /**
     * 参数条件
     * @var
     */
    private $_condtion;

    /**
     * 排序方式
     * @var
     */
    private $_sort = array();

    /**
     * 获取总数方法
     * @var
     */
    private $_count_method;

    /**
     * 获取数据方法
     * @var
     */
    private $_data_method;

    public function setModel($model)
    {
        $this->_model = $model;
        return $this;
    }

    public function setField($field = false)
    {
        if (is_array($field)) {
            $this->_field = $field;
        } elseif (empty($field)) {
            $this->_field = '*';
        } elseif ($newField = explode(', ', $field)) {
            $this->_field = $newField;
        }
        return $this;
    }

    public function setPage($page)
    {
        $this->_page_now = (int)$page ?: 1;
        return $this;
    }

    public function setPageSize($size)
    {
        $this->_page_size = (int)$size ?: 1;
        return $this;
    }

    public function setCondtion($cond)
    {
        $this->_condtion = $cond;
        return $this;
    }

    public function setSort(array $sort)
    {
        foreach ($sort as $k => $v) {
            if (strtoupper($v) == 'ASC' || strtoupper($v) == 'DESC') {
                $this->_sort[$k] = $v;
            }
        }
        return $this;
    }

    public function setCountMethod($method)
    {
        $this->_count_method = $method;
        return $this;
    }

    public function setListMethod($method)
    {
        $this->_data_method = $method;
        return $this;
    }

    final public function getData()
    {
        $pageInfo = array(
            'pre_page' => $this->_page_size,
            'current_page' => $this->_page_now,
            'last_page' => 0,
            'up_page' => $this->_page_now - 1,
            'next_page' => $this->_page_now + 1,
            'total' => 0,
            'list' => [],
        );

        if ($count = (int) call_user_func_array(array($this->_model, $this->_count_method), array($this->_condtion))) {
            $pageInfo['total'] = $count;
            $pageInfo['last_page'] = ceil($count/$this->_page_size);

            $currPage = $this->_page_now == 1 ? 0 : ceil(($this->_page_now*$this->_page_size) - $this->_page_size);

            $list = call_user_func_array(array($this->_model, $this->_data_method), array(
                    $this->_condtion,
                    $currPage,
                    $this->_page_size,
                    $this->_field, $this->_sort,)
            );
            if ($list) {
                $pageInfo['list'] = $list->toArray();
            }
        }

        return $pageInfo;
    }
}



















