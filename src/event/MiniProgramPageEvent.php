<?php

namespace BusyPHP\wechat\mini\event;

/**
 * 用户在客服会话中发送小程序卡片消息事件
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/12/9 下午12:40 MiniProgramPageEvent.php $
 * @property string $MsgId 消息id，64位整型
 * @property string $Title 标题
 * @property string $AppId 小程序appid
 * @property string $PagePath 小程序页面路径
 * @property string $ThumbUrl 封面图片的临时cdn链接
 * @property string $ThumbMediaId 封面图片的临时素材id
 * @property int    $CreateTime 消息创建时间(整型）
 */
class MiniProgramPageEvent extends BaseEvent
{
}