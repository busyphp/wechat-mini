微信小程序插件
===============

## 提供默认服务入口地址

### 单小程序服务入口

> http(s)://domain.com/plugins_service/wechat_mini/index.html

### 多小程序服务入口

> http(s)://domain.com/plugins_service/wechat_mini/program/用户自定义标识.html

### 通过方法查看服务入口地址

```php
\BusyPHP\wechat\mini\app\controller\ServiceController::url(string $programId = '');
```

## 配置 `config/extend/wechat.php`

```php
return [
    'mini' => [
        // 小程序名称
        'name' => '',

        // 小程序 App Id
        'app_id'     => '',
        
        // 小程序 App Secret
        'app_secret' => '',
    
        // 服务器token
        'token'      => '',
        
        // todo 暂无意义
        // 消息加解密密钥 (EncodingAESKey)
        'encodingAESKey' => '',

        // 多小程序配置
        'multi'      => [
            '自定义标识' => [
                // 小程序名称
                'name'           => '',
                'app_id'         => '',
                'app_secret'     => '',
                'token'          => '',
                'encodingAESKey' => '',
            ]
        ],
        
        // 配置事件监听
        'listen' => [
            // 事件名称 => 事件类，需要实现handle方法，方法参数为本事件名类对象
            BusyPHP\wechat\mini\event\UserEnterTempSessionEvent::class => '',
            BusyPHP\wechat\mini\event\MiniProgramPageEvent::class      => '',
            BusyPHP\wechat\mini\event\TextEvent::class                 => '',
            BusyPHP\wechat\mini\event\ImageEvent::class                => '',
        ]
    ]
];
```