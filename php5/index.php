<?php
/*//
////class MeF
////{
////    const NAME = 'leon';
////
////    public static $age = 20;
////}
////
////
////print MeF::NAME;
////
////print MeF::$age;
//
//
//
////class AB
////{
////    static private $app;
////
////    static public function getInstance()
////    {
////        if (is_null(self::$app)) {
////            self::$app = new static();
////        }
////        return self::$app;
////    }
////}
//
//
////abstract class MyHeart
////{
////    abstract function getName();
////
////}
////
////class N extends MyHeart
////{
////    public function getName()
////    {
////        // TODO: Implement getName() method.
////    }
////}
////
////$c = new N();
////
////$dom = new domDocument;
////$dom->loadXML('<note><from>John</from></note>');
////
////$xml = simplexml_import_dom($dom);
////dom_import_simplexml()
////print_r($xml);
//
//
//#echo 'ssss';
//
////$a = 5;
////
////function num($n) {
////    echo 'sssss';
////    static $a = 8;
////}
////
////num(7);
////echo $a;
//
////class A {
////    public $name;
////
////    public static $id = 0;
////
////    public function __construct($name)
////    {
////        self::$id++;
////        $this->name = $name;
////    }
////
////    public function getName()
////    {
////        print_r(self::$id);
////        return $this->name;
////    }
////}
////
////$c = new A('kee');
////$d = new A('leon');
////
////echo $c->getName();
////echo $d->getName();
//
//
////class A {
////    const NAME = 'kee';
////
////    public function __construct()
////    {
////        print self::NAME .'this is name';
////    }
////}
//
////class C extends A{
////    const NAME  = 'leon';
////
////    public function __construct()
////    {
////        parent::__construct();
////        print self::NAME .'this is name';
////    }
////}
////
////$c = new C();
//
////
////class NS {
////    public $name = __CLASS__;
////
////}
////
////
////$c = new NS();
////print $c->name;
////
////
//
//
////interface MoK {
////    /**
////     * 获取名字
////     * @return mixed
////     */
////    function getName();
////}
////
////
////class B implements MoK {
////    public function getName()
////    {
////        // TODO: Implement getName() method.
////    }
////}
//
////$c = new MongoClient();
//
////
////abstract class Na {
////
////   public function getAges(){}
////   public function getName(){}
////
////}
////
////class B extends Na {
////
////}
////
////$bs = new B();
//
//
//abstract class Me {
//
//    abstract public function getWork();
//
//}
//
//class Gs extends Me {
//     public function getWork() {}
//}
//
//$c = new Gs();
//
//
//
//abstract class Signal {
//    abstract public function getName();
//}
//
//interface MyDB {
//    /**
//     *  host
//     */
//    function host($host);
//
//    /**
//     * passwd
//     */
//    function passwd($pwd);
//}
//
//class GDB implements MyDB {
//    public function host($host) {
//    }
//
//    public function passwd($pwd) {
//    }
//}
//
//
// class C {
//    final public function gets(){}
//}
//
//class M extends C {
//     public function gets() {}
//}
//
//
//abstract class Ms {
//    abstract protected function getName();
//\
//    private function see() {}
//}
//
//interface MC {
//    function getWork();
//}
//
//class Works implements MC {
//    public function getWork()
//    {
//        // TODO: Implement getWork() method.
//    }
//}
//
////final class MyDB {
////    private function getMin() {}
////
////    public function getPasswd() {}
////}
////$c = new MyDB();
////
////
////// 以下示例会报错
////// Fatal error: Cannot override final method Book::getSee()
////class Book {
////    final private function getSee() {}
////}
////class CL extends Book {
////    public function getSee() {}
////}
//
//try {
//    $a = 1;
//    if ($a < 2) {
//        throw new Exception('错误了');
//    }
//} catch (Error $e) {
//    print $e->getLine();
//    print $e->getMessage();
//    print $e->getFile();
//    print $e->getCode();
//}
//
//class B {
//
//}
//
//class A {
//    public function __construct($obj)
//    {
//        if ($obj instanceof B) {
//            echo '这是B的实例';
//        } else {
//            echo '这不是';
//        }
//    }
//}
//
//class MS {
//
//}
//
//
//$c = new A(new DateTime());
//
//class GW {
//
//    public function __get($name)
//    {
//        print $name .'该属性不存在';
//    }
//
//    public function __toString()
//    {
//        // TODO: Implement __toString() method.
//        echo 'sss';
//    }
//
//    public function __call($name, $arguments)
//    {
//        // TODO: Implement __call() method.
//        print_r($name);
//        print_r($arguments);
//    }
//
//}
//
//$c = new GW();
//
//$c->min('kee');
//
//
//class MS {
//    public $name = 'leon';
//    public $age = 20;
//
//    public function getName()
//    {
//
//    }
//}
//
//$obj = new MS();
//
//foreach ($obj as $k => $v) {
////    print_r($v);
//}
//
//class Ms {
//    static public $app;
//
//    private function __construct(){}
//    private function __clone(){}
//
//    static public function getInstance()
//    {
//        if (! (self::$app instanceof self)) {
//            self::$app = new static();
//        }
//
//        return self::$app;
//    }
//
//    public function getName()
//    {
//        print 'okko';
//    }
//}
//
//$c = new Ms();
//MS::getInstance()->getName();
//
//class Ms {
//
//    public $name;
//    protected $age;
//
//    public function getName()
//    {
//
//    }
//    public function getAge($de)
//    {
//
//    }
//
//}
//
//
//PEAR::Cr
//
// 散列算法
//
//
///**
// * @brief 使用HMAC-SHA1算法生成oauth_signature签名值
// *
// * @param $key  密钥
// * @param $str  源串
// *
// * @return 签名值
// */
//
//function get_signature($str, $key)
//{
//    $signature = "";
//    if (function_exists('hash_hmac'))
//    {
//        $signature = base64_encode(hash_hmac("sha1", $str, $key, true));
//    }
//    else
//    {
//        $blocksize    = 64;
//        $hashfunc    = 'sha1';
//        if (strlen($key) > $blocksize)
//        {
//            $key = pack('H*', $hashfunc($key));
//        }
//        $key    = str_pad($key,$blocksize,chr(0x00));
//        $ipad    = str_repeat(chr(0x36),$blocksize);
//        $opad    = str_repeat(chr(0x5c),$blocksize);
//        $hmac     = pack(
//            'H*',$hashfunc(
//                ($key^$opad).pack(
//                    'H*',$hashfunc(
//                        ($key^$ipad).$str
//                    )
//                )
//            )
//        );
//        $signature = base64_encode($hmac);
//    }
//
//    return $signature;
//}
//
//function _hash_hmac($algo, $data, $key, $raw_output = false) {
//    $packs = array('md5' => 'H32', 'sha1' => 'H40');
//
//    if ( !isset($packs[$algo]) )
//        return false;
//
//    $pack = $packs[$algo];
//
//    if (strlen($key) > 64)
//        $key = pack($pack, $algo($key));
//
//    $key = str_pad($key, 64, chr(0));
//
//    $ipad = (substr($key, 0, 64) ^ str_repeat(chr(0x36), 64));
//    $opad = (substr($key, 0, 64) ^ str_repeat(chr(0x5C), 64));
//
//    $hmac = $algo($opad . pack($pack, $algo($ipad . $data)));
//
//    if ( $raw_output )
//        return pack( $pack, $hmac );
//    return $hmac;
//}
//
//
//$str = hash_hmac('sha1', 'youtobe', 'leon', false);
//
//
//print $str;
//
//echo '<br/>';
//
//print _hash_hmac('sha1', 'youtobe', 'leon');
//
//
//$c = array('a', 2, 4);
//foreach (directory in 'method/') {
//
//}
//*/

$db = new SQLite3("test2.db");

$create_query = "
    create table doc (
    id,
    title
    )
";

$db->query($create_query);




















































