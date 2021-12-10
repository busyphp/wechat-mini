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
        return (new WeChatMiniService($this->param('busy_wechat_mini_program_id/s')))->service();
    }
    
    
    /**
     * 生成服务地址入口URL
     * @param string $programId
     * @return string
     */
    public static function url(string $programId = '') : string
    {
        if (!$programId) {
            return url('/plugins_service/wechat_mini/index')->domain(true)->build();
        } else {
            return url("/plugins_service/wechat_mini/program/{$programId}")->domain(true)->build();
        }
    }
}