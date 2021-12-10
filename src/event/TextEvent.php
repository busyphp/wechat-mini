<?php

namespace BusyPHP\wechat\mini\event;

use BusyPHP\wechat\mini\WeChatMiniBaseEvent;

/**
 * 用户在客服会话中发送文本消息事件
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/12/9 下午12:50 TextEvent.php $
 * @property string $Content 文本消息内容
 * @property int    $CreateTime 消息创建时间(整型）
 * @property string $MsgId 消息id，64位整型
 */
class TextEvent extends WeChatMiniBaseEvent
{
}