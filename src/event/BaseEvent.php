<?php

namespace BusyPHP\wechat\mini\event;

/**
 * 基本事件
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/12/9 下午12:48 BaseEvent.php $
 * @property string $ToUserName 小程序的原始ID
 * @property string $FromUserName 发送者的openid
 */
class BaseEvent
{
    /**
     * @var array
     */
    protected $data;
    
    
    /**
     * BaseEvent constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    
    /**
     * 魔术方法获取变量值
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }
}