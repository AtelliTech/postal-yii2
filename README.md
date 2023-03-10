# Postal Yii2
It's yii2 component integrating atellitech/postal-php and provides LogTarget integration.

## Getting Start
### Requirements
- Postal host
- Postal credential key
- php8.0+
### Install
```
$ /lib/path/composer require atellitech/postal-yii2
```
### Add component into config file of yii2 project

```php=
...
"components": [
    "postal" => [
        'class' => 'AtelliTech\\Yii2\\Postal',
        'host' => $host,
        'key' => $key
    ]
]
```

### Usage
```php=
$message = [
    'subject' => 'Hello Test',
    'to' => ['xxx@abc.com',...],
    'from' => 'Test <no-reply@abc.com>',
    'html_body' => '<h3>Hello, Test</h3><p>How are you today?</p>'
];

$result = Yii::$app->postal->send($message);

```

## Log Target Integration
### Install
```
$ /lib/path/composer require atellitech/postal-yii2
```
### Add component into config file of yii2 project

```php=
...
"components": [
    "postal" => [
        'class' => 'AtelliTech\\Yii2\\Postal',
        'host' => $host,
        'key' => $key
    ],
    "log" => [
        'targets' => [
            [
                'class' => 'AtelliTech\Yii2\PostalLogTarget',
                'levels' => ['error', 'warning'],
                'postal' => 'postal',
                'subject' => '[Alert] System log', // anything your want
                'from' => 'SysAdmin <sysadmin@abc.com>',  // anything your want
                'to' => ['xxxx@abc.com']  // any email addresses
            ],
        ]
    ]
]
```

### Usage
Please refer to [Yii2 Logging Document](https://www.yiiframework.com/doc/guide/2.0/en/runtime-logging)
