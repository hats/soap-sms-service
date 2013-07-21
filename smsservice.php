<?php
/**
 * smsservice.php
 */
//header("Content-Type: text/xml; charset=utf-8");
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
 * Путь к конфигурационному файлу
 */
const CONF_NAME = "config.ini";

/**
 ** Функция для автозагрузки необходимых классов
 */
function __autoload($class_name){
    include $class_name.'.class.php';
}

ini_set("soap.wsdl_cache_enabled", "0"); // отключаем кеширование WSDL-файла для тестирования

//Создаем новый SOAP-сервер
$server = new SoapServer("http://{$_SERVER['HTTP_HOST']}/smsservice.wsdl.php");
//Регистрируем класс обработчик
$server->setClass("SoapSmsGateWay");
//Запускаем сервер
$server->handle();
