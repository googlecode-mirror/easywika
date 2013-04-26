<?php
use EasyWika\Mapper\SentenceMapper;
use EasyWika\Db\Database;

spl_autoload_extensions('.php');
spl_autoload_register();

define('DATABASE_PREFIX', 'ew');
define('APP_PATH', dirname(__FILE__));

$render = 'view/search.phtml';

if (isset($_POST['pattern'])) {

    $sentence = new SentenceMapper(Database::getInstance());
    $sentence->language = 'de_de';
    $sentence->translation = 'tl_ph';
    $result = $sentence->findByPattern($_POST['pattern']);

    if (!empty($result)) {
        $render = 'view/result.phtml';
    }
}

include $render;