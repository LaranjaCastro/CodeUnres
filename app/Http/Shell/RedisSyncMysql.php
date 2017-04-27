<?php

namespace App\Http\Shell;

require_once __DIR__ . '/../../../shell.php';

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Web\Weibo;

class RedisSyncMysql extends Controller
{
    private  $redisData;
    private $tableWeiBo;

    public function __construct()
    {
        parent::__construct();
        $this->tableWeiBo = new Weibo();
    }

    public function index()
    {
        echo '|----------------------RedisSyncMysql----------------------'. PHP_EOL;
        echo sprintf('| 开始处理任务 / 日期：%s / %s', date('Y-m-d H:i:s'), PHP_EOL);

        while (true) {
            try {
                $this->redisData = $this->redis->rpop('mongo');
                if (is_null($this->redisData)) {break;}

                $data = json_decode($this->redisData, true);
                $insert['user_id'] = 1;
                $insert['title'] = $data['title'];
                $insert['content'] = $data['content'];
                $insert['url'] = $data['url'];
                $insert['category'] = 2;
                $insert['create_time'] = date('Y-m-d H:i:s');

                if ($this->tableWeiBo->insertBook($insert)) {
                    echo sprintf('| 状态：Redis同步数据到Mysql成功 / ID：%s / 日期：%s / %s', $data['id']['$id'], date('Y-m-d H:i:s'), PHP_EOL);
                }
            } catch (Excetion $e) {
                echo sprintf('| 状态：Redis同步数据到Mysql失败 / ID：%s / 日期：%s / %s', $data['id']['$id'], date('Y-m-d H:i:s'), PHP_EOL);
            }
        }

        echo sprintf('| 本批次处理完成 / 日期：%s / %s', date('Y-m-d H:i:s'), PHP_EOL);
        echo '|--------------------------------------------'. PHP_EOL;
    }
}

$c = new RedisSyncMysql();
$c->index();
