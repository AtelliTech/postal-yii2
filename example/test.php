<?php

namespace Example;

use AtelliTech\Yii2\Postal;
use Yii;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/vendor/yiisoft/yii2/Yii.php';

$host = 'xxx';
$key = 'xxxx';
$message = [
    'subject' => 'Test from postal yii2',
    'to' => ['xxxx@abc.com'],
    'from' => 'Service <no-reply@abc.com>',
    'html_body' => '<h3>Hello</h3><p>Test Message</p>'
];

$postal = Yii::createObject([
        'class' => 'AtelliTech\\Yii2\\Postal',
        'host' => $host,
        'key' => $key
    ]);

$result = $postal->send($message);
var_dump($result);