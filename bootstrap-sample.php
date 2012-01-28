<?php
//Init Doctrine and Namespace
require_once('doctrine2/lib/vendor/doctrine-common/lib/Doctrine/Common/ClassLoader.php');
function registerNamespace($namespace, $path){
    $classloader=new \Doctrine\Common\ClassLoader($namespace, realpath(__DIR__.$path));
    $classloader->register();
}
//Namespace autoloader :
registerNamespace('Models','/');
registerNamespace('MultiAuth','/../../../');
registerNamespace('Doctrine\ORM','/doctrine2/lib/');
registerNamespace('Doctrine\DBAL','/doctrine2/lib/vendor/doctrine-dbal/lib/');
registerNamespace('Doctrine\Common','/doctrine2/lib/vendor/doctrine-common/lib/');
registerNamespace('Symfony','/doctrine2/lib/vendor/');

$config = new \Doctrine\ORM\Configuration;
//$config->setSQLLogger(new \Doctrine\DBAL\Logging\EchoSQLLogger);
$confArray = array('Models');
$driver = $config->newDefaultAnnotationDriver($confArray);
$config->setMetadataDriverImpl($driver);
$config->setProxyDir('/proxy/');
$config->setProxyNamespace('proxy');
$conn = \Doctrine\DBAL\DriverManager::getConnection(
    array(
        'driver' => 'pdo_sqlite',
        'path'=>__DIR__.'/datas/tmp.db',
    ),
    $config,
    new \Doctrine\Common\EventManager()
);

$em=\Doctrine\ORM\EntityManager::create(
    $conn,
    $config,
    $conn->getEventManager()
);


class App{
    public static $em;
    public static function getEm(){
        return self::$em;
    }
    public static function setEm($em){
        self::$em = $em;
    }
}
App::setEm($em);
require_once('../../lib/hybridauth/hybridauth/Hybrid/Auth.php');
$hybridAuthConfigs = array(
    "base_url" => "", 

    "providers" => array ( 
        // openid providers
        "OpenID" => array (
            "enabled" => true
        ),

        "Yahoo" => array ( 
            "enabled" => true 
        ),

        "AOL"  => array ( 
            "enabled" => true 
        ),

        "Google" => array ( 
            "enabled" => true,
            "keys"    => array ( "id" => "", "secret" => "" ),
            "scope"   => ""
        ),

        "Facebook" => array ( 
            "enabled" => true,
            "keys"    => array ( "id" => "", "secret" => "" ),
            "scope"   => ""
        ),

        "Twitter" => array ( 
            "enabled" => true,
            "keys"    => array ( "key" => "", "secret" => "" ) 
        ),

        // windows live
        "Live" => array ( 
            "enabled" => true,
            "keys"    => array ( "id" => "", "secret" => "" ) 
        ),

        "MySpace" => array ( 
            "enabled" => true,
            "keys"    => array ( "key" => "", "secret" => "" ) 
        ),

        "LinkedIn" => array ( 
            "enabled" => true,
            "keys"    => array ( "key" => "", "secret" => "" ) 
        ),

        "Foursquare" => array (
            "enabled" => true,
            "keys"    => array ( "id" => "", "secret" => "" ) 
        ),
    ),

    // if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
    "debug_mode" => true,

    "debug_file" => "/home/ombr/debug.txt",
);
?>
