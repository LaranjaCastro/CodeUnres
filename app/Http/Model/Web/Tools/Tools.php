<?php

namespace App\Http\Model\Web\Tools;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\Web;

class Tools extends Model
{
    public static function getReleaseDate($time = null)
    {
        if ($time < 0) {
            $msg = '时间有误';
        } else {
            switch (true) {
                case $time<60:
                    $msg = $time .'秒前';
                    break;
                case $time<3600:
                    $msg = floor($time/60) .'分钟前';
                    break;
                case $time<86400:
                    $msg = floor($time/3600) .'小时前';
                    break;
                case $time<2592000:
                    $msg = floor($time/86400) .'天前';
                    break;
                case $time<31104000:
                    $msg = floor($time/2592000) .'月前';
                    break;
                default:
                    $msg= '时间太久了';
            }
        }

        return $msg;
    }

    public static function getCategoryName($categoryId)
    {
        $tableMenu = new Web\Menu();
        $menuName = $tableMenu->get(array('id' => $categoryId), array('name'));
        return strtolower($menuName->name);
    }

    public static function getCategoryId($name)
    {
        $tableMenu = new Web\Menu();
        $menuQueue = $tableMenu->getAll();
        $menuQueue = json_decode(json_encode($menuQueue), true);

        $menuId = null;
        foreach ($menuQueue as $k => $v) {
            if (strtolower($name) == strtolower($v['name'])) {
                $menuId = $v['id']; continue;
            }
        }

        return $menuId;
    }

    public function getParticipleTitle(array $word)
    {
      $weiBo = new Web\Weibo();
       return $weiBo->getAll(array('like_title' => $word));
    }
}
