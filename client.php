<?php
/**
 * /client.php
 */
header("Content-Type: text/html; charset=utf-8");
header('Cache-Control: no-store, no-cache');
header('Expires: '.date('r'));


/**
 * Пути по-умолчанию для поиска файлов
 */
set_include_path(get_include_path()
    .PATH_SEPARATOR.'classes'
    .PATH_SEPARATOR.'objects');

/**
 ** Функция для автозагрузки необходимых классов
 */
function __autoload($class_name){
    include $class_name.'.class.php';
}

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

// Заготовки объектов
class Message{
    public $phone;
    public $text;
    public $date;
    public $type;
}

class MessageList{
    public $message;
}

class Request{
    public $messageList;
}

// создаем объект для отправки на сервер
$req = new Request();

$msg1 = new Message();
$msg1->phone = '79871234567';
$msg1->text = 'Тестовое сообщение 1';
$msg1->date = '2013-07-21T15:00:00.26';
$msg1->type = 15;

$msg2 = new Message();
$msg2->phone = '79871234567';
$msg2->text = 'Тестовое сообщение 2';
$msg2->date = '2014-08-22T16:01:10';
$msg2->type = 16;

$msg3 = new Message();
$msg3->phone = '79871234567';
$msg3->text = 'Тестовое сообщение 3';
$msg3->date = '2014-08-22T16:01:10';
$msg3->type = 17;

$req->messageList[] = $msg1;
$req->messageList[] = $msg2;
$req->messageList[] = $msg3;
$req->messageList = (object)$req->messageList;


var_dump($req);

//var_dump(unserialize('O:8:"stdClass":1:{s:11:"messageList";O:8:"stdClass":1:{s:7:"message";O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 1";s:4:"date";s:22:"2013-07-21T15:00:00.26";s:4:"type";s:2:"15";}}}'));
//var_dump(unserialize('O:8:"stdClass":1:{s:11:"messageList";O:8:"stdClass":1:{s:7:"message";O:8:"stdClass":1:{s:6:"Struct";a:3:{i:0;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 1";s:4:"date";s:22:"2013-07-21T15:00:00.26";s:4:"type";s:2:"15";}i:1;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 2";s:4:"date";s:19:"2014-08-22T16:01:10";s:4:"type";s:2:"16";}i:2;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 3";s:4:"date";s:19:"2014-08-22T16:01:10";s:4:"type";s:2:"17";}}}}}'));
//var_dump(unserialize('O:8:"stdClass":1:{s:11:"messageList";O:8:"stdClass":1:{s:7:"message";O:8:"stdClass":1:{s:5:"BOGUS";a:3:{i:0;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 1";s:4:"date";s:22:"2013-07-21T15:00:00.26";s:4:"type";s:2:"15";}i:1;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 2";s:4:"date";s:19:"2014-08-22T16:01:10";s:4:"type";s:2:"16";}i:2;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 3";s:4:"date";s:19:"2014-08-22T16:01:10";s:4:"type";s:2:"17";}}}}}'));
//var_dump(unserialize('O:8:"stdClass":1:{s:11:"messageList";O:8:"stdClass":1:{s:5:"BOGUS";a:3:{i:0;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 1";s:4:"date";s:22:"2013-07-21T15:00:00.26";s:4:"type";s:2:"15";}i:1;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 2";s:4:"date";s:19:"2014-08-22T16:01:10";s:4:"type";s:2:"16";}i:2;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 3";s:4:"date";s:19:"2014-08-22T16:01:10";s:4:"type";s:2:"17";}}}}'));
//var_dump(unserialize('O:8:"stdClass":1:{s:11:"messageList";O:8:"stdClass":1:{s:5:"BOGUS";O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 1";s:4:"date";s:22:"2013-07-21T15:00:00.26";s:4:"type";s:2:"15";}}}'));
$uri  = "http://{$_SERVER['HTTP_HOST']}/smsservice.wsdl.php";
$client = new SoapClient(   $uri,
                            array( 'soap_version' => SOAP_1_2));

var_dump($client->sendSms($req));
