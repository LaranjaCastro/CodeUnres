<?php

namespace App\Http\Shell;

require_once __DIR__ . '/../../../shell.php';

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Flysystem\Exception;
use MongoClient;

class MongoSyncRedis extends Controller
{
    private $mongod;

    public function __construct()
    {
        parent::__construct();
        $this->mongod = new MongoClient();
    }

    // 同步MongoDB数据到Redis
    public function index()
    {
        echo '|---------------------MongoSyncRedis-----------------------'. PHP_EOL;
        echo sprintf('| 开始处理任务 / 日期：%s / %s', date('Y-m-d H:i:s'), PHP_EOL);

        while (true) {
            try {
                $mongoData = $this->mongod->leon->weibo->find()->limit(10);

                $signal = false;
                foreach ($mongoData as $k => $v) {
                    $signal = true;
                    $syncRedis['id'] = $v['_id'];
                    $syncRedis['title'] = $v['title'];
                    $syncRedis['content'] = $v['content'];
                    $syncRedis['url'] = $v['url'];

                    if ($this->redis->lpush('mongo', json_encode($syncRedis))) {
                        // 删除MongoDB中的数据
                        $this->mongod->leon->weibo->remove(array('_id' => $v['_id']), array('_id'));

                        echo sprintf('| 状态：加入队列成功 / ID：%s / 日期：%s / %s', $v['_id'], date('Y-m-d H:i:s'), PHP_EOL);
                    }
                }
            } catch (Exception $e) {
                echo sprintf('| 状态：加入队列失败 / ID：%s / 日期：%s / %s', $v['_id'], date('Y-m-d H:i:s'), PHP_EOL);
            }

            if (empty($signal)) {break;}
        }

        echo sprintf('| 本批次处理完成 / 日期：%s / %s', date('Y-m-d H:i:s'), PHP_EOL);
        echo '|--------------------------------------------'. PHP_EOL;
    }
}

$c = new MongoSyncRedis();
$c->index();
