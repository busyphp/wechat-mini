<?php

namespace BusyPHP\wechat\mini;

use BusyPHP\helper\LogHelper;
use BusyPHP\wechat\WeChatConfig;
use think\App;

/**
 * 微信小程序基本类
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/12/10 下午2:55 WeChatMiniBase.php $
 */
class WeChatMiniBase
{
    use WeChatConfig;
    
    /**
     * 公众号appId
     * @var string
     */
    protected $appId;
    
    /**
     * 公众号密钥
     * @var string
     */
    protected $appSecret;
    
    /**
     * 服务器token 长度为3-32字符
     * @var string
     */
    protected $token;
    
    /**
     * 服务器加密密钥 长度为3-32字符
     * @var string
     */
    protected $encodingAESKey;
    
    /**
     * @var App
     */
    protected $app;
    
    /**
     * 小程序名称
     * @var string
     */
    protected $name;
    
    
    /**
     * Base constructor.
     * @param string $type 小程序标识
     */
    public function __construct(string $type = '')
    {
        $this->app = App::getInstance();
        
        if (!$type) {
            $this->name           = $this->getConfig('mini.name', '');
            $this->appId          = $this->getConfig('mini.app_id', '');
            $this->appSecret      = $this->getConfig('mini.app_secret', '');
            $this->token          = $this->getConfig('mini.token', '');
            $this->encodingAESKey = $this->getConfig('mini.encodingAESKey', '');
        } else {
            $this->name           = $this->getConfig("mini.multi.{$type}.name", '');
            $this->appId          = $this->getConfig("mini.multi.{$type}.app_id", '');
            $this->appSecret      = $this->getConfig("mini.multi.{$type}.app_secret", '');
            $this->token          = $this->getConfig("mini.multi.{$type}.token", '');
            $this->encodingAESKey = $this->getConfig("mini.multi.{$type}.encodingAESKey", '');
        }
    }
    
    
    /**
     * 日志驱动
     * @return LogHelper
     */
    public static function log() : LogHelper
    {
        return LogHelper::use('wechat_mini');
    }
}