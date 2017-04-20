<?php

namespace App\Http\Model\Web\Tools;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\Web\Tools\Tools;

class ArticleProcess extends Model
{
    public function processDescription(array $data)
    {
        foreach ($data as $k => &$v) {
            // 计算多久之前发布的
            $v['time']  = Tools::getReleaseDate(time()-strtotime($v['create_time']));

            // 格式化时间
//            $v['create_time'] = date('F d, Y', strtotime($v['create_time']));
            $v['create_time'] = date('F d, Y', strtotime($v['create_time']));
            $v['content'] = strip_tags(mb_substr($v['content'], 0, 400, 'utf-8'));

            // 配置标签
            $v['category_name'] = strtoupper(Tools::getCategoryName($v['category']));

            // 配置url
            $v['url'] = 'http://www.leon.com/t/'. Tools::getCategoryName($v['category']) .'/'. $v['id'];
        }

        return $data;
    }
}
