<?php

namespace BusyPHP\wechat\mini;

use BusyPHP\model\ArrayOption;

/**
 * 基本事件
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/12/9 下午12:48 WeChatMiniBaseEvent.php $
 * @property string $ToUserName 小程序的原始ID
 * @property string $FromUserName 发送者的openid
 */
class WeChatMiniBaseEvent extends ArrayOption
{
    /**
     * @var WeChatMiniBase
     */
    private $base;
    
    
    /**
     * WeChatMiniBaseEvent constructor.
     * @param WeChatMiniBase $base
     * @param array          $options
     */
    public function __construct(WeChatMiniBase $base, array $options)
    {
        $this->base = $base;
        parent::__construct($options);
    }
    
    
    /**
     * 获取小程序基本类对象
     * @return WeChatMiniBase
     */
    public function getBase() : WeChatMiniBase
    {
        return $this->base;
    }
}