<?php

namespace App\Http\Model\Web\Tools;

use Illuminate\Database\Eloquent\Model;

class Scws extends Model
{

    public function getScws($text)
    {
        $so = scws_new();
        $so->set_charset('utf8');
// 这里没有调用 set_dict 和 set_rule 系统会自动试调用 ini 中指定路径下的词典和规则文件
        $so->send_text($text);

        $words = array();
        while ($tmp = $so->get_result())
        {
            foreach ($tmp as $val) {
                if(! $this->new_in_array($val, $words,'word')){
                    $words[] = array(
                        'word' => $val['word'],
                        'weight' => $val['idf'],
                    );
                }
            }
        }
        $so->close();

        return $words;
    }

    public function new_in_array($need,$array,$column='')
    {
        $flag = false;
        foreach ($array as $val) {
            if($val[$column] == $need[$column]){
                $flag = true;
                break;
            }
        }
        return $flag;
    }
}
