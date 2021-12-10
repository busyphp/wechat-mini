<?php

namespace BusyPHP\wechat\mini\app\controller;

use BusyPHP\Controller;
use BusyPHP\wechat\mini\WeChatMiniService;
use think\Response;

/**
 * 微信公众号事件服务
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/11/11 上午11:59 ServiceController.php $
 */
class ServiceController extends Controller
{
    /**
     * 入口
     * @return Response
     */
    public function index()
    {
        return (new WeChatMiniService())->service();
    }
}