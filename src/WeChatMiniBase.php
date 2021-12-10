<?php

namespace BusyPHP\wechat\mini;

use BusyPHP\helper\LogHelper;
use BusyPHP\wechat\WeChatConfig;
use RuntimeException;
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
     * 小程序appId
     * @var string
     */
    protected $appId;
    
    /**
     * 小程序秘钥
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
    protected $programName;
    
    /**
     * 小程序ID，用于区分多个个小程序
     * @var string
     */
    protected $programId;
    
    
    /**
     * Base constructor.
     * @param string $programId 小程序ID，用于区分多个个小程序
     */
    public function __construct(string $programId = '')
    {
        $this->app = App::getInstance();
        
        if (!$programId) {
            $this->programId      = '';
            $this->programName    = $this->getConfig('mini.name', '');
            $this->appId          = $this->getConfig('mini.app_id', '');
            $this->appSecret      = $this->getConfig('mini.app_secret', '');
            $this->token          = $this->getConfig('mini.token', '');
            $this->encodingAESKey = $this->getConfig('mini.encodingAESKey', '');
        } else {
            $this->programId      = $programId;
            $this->programName    = $this->getConfig("mini.multi.{$programId}.name", '');
            $this->appId          = $this->getConfig("mini.multi.{$programId}.app_id", '');
            $this->appSecret      = $this->getConfig("mini.multi.{$programId}.app_secret", '');
            $this->token          = $this->getConfig("mini.multi.{$programId}.token", '');
            $this->encodingAESKey = $this->getConfig("mini.multi.{$programId}.encodingAESKey", '');
        }
        
        if (!$this->appId) {
            throw new RuntimeException('请到config/extend/wechat.php下配置mini.app_id');
        }
        if (!$this->appSecret) {
            throw new RuntimeException('请到config/extend/wechat.php下配置mini.app_secret');
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
    
    
    /**
     * 小程序appId
     * @return string
     */
    public function getAppId() : string
    {
        return $this->appId;
    }
    
    
    /**
     * 小程序密钥
     * @return string
     */
    public function getAppSecret() : string
    {
        return $this->appSecret;
    }
    
    
    /**
     * 服务器token 长度为3-32字符
     * @return string
     */
    public function getToken() : string
    {
        return $this->token;
    }
    
    
    /**
     * 服务器加密密钥 长度为3-32字符
     * @return string
     */
    public function getEncodingAESKey() : string
    {
        return $this->encodingAESKey;
    }
    
    
    /**
     * 小程序名称
     * @return string
     */
    public function getProgramName() : string
    {
        return $this->programName;
    }
    
    
    /**
     * 获取小程序标识
     * @return string
     */
    public function getProgramId() : string
    {
        return $this->programId;
    }
}