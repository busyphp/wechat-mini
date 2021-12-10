<?php

namespace BusyPHP\wechat\mini;

use BusyPHP\Service as BaseService;
use BusyPHP\wechat\mini\app\controller\ServiceController;
use think\Route;

class Service extends \think\Service
{
    public function boot()
    {
        $this->registerRoutes(function(Route $route) {
            // 注册事件通知路由
            $route->rule("service/plugins/wechat_mini/index", ServiceController::class . "@index")->append([
                BaseService::ROUTE_VAR_TYPE    => 'plugin',
                BaseService::ROUTE_VAR_CONTROL => 'service',
                BaseService::ROUTE_VAR_ACTION  => 'index',
            ]);
        });
    }
}