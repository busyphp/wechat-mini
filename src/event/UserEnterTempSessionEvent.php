<?php

namespace BusyPHP\wechat\mini\event;

use BusyPHP\wechat\mini\WeChatMiniBaseEvent;

/**
 * 用户在小程序“客服会话按钮”进入客服会话事件
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/12/9 下午12:37 UserEnterTempSessionEvent.php $
 * @property string $SessionFrom 开发者在客服会话按钮设置的 session-from 属性
 */
class UserEnterTempSessionEvent extends WeChatMiniBaseEvent
{
}