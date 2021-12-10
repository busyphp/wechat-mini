<?php

namespace BusyPHP\wechat\mini\event;

/**
 * 用户在客服会话中发送图片消息事件
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/12/9 下午12:47 ImageEvent.php $
 * @property int    $CreateTime 消息创建时间(整型）
 * @property string $PicUrl 图片链接（由系统生成）
 * @property string $MediaId 图片消息媒体id，可以调用[获取临时素材]((getTempMedia)接口拉取数据。
 * @property string $MsgId 消息id，64位整型
 */
class ImageEvent extends BaseEvent
{
}