<?php

namespace BusyPHP\wechat\mini;

use BusyPHP\wechat\mini\event\ImageEvent;
use BusyPHP\wechat\mini\event\MiniProgramPageEvent;
use BusyPHP\wechat\mini\event\TextEvent;
use BusyPHP\wechat\mini\event\UserEnterTempSessionEvent;
use RuntimeException;
use think\facade\Event;
use think\Response;
use Throwable;

/**
 * 微信小程序服务类
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/12/10 下午2:57 WeChatMiniService.php $
 */
class WeChatMiniService extends WeChatMiniBase
{
    /**
     * WeChatMiniService constructor.
     * @param string $programId 小程序标识
     */
    public function __construct(string $programId = '')
    {
        parent::__construct($programId);
    
        if (!$this->token) {
            throw new RuntimeException('请到config/extend/wechat.php下配置mini.token');
        }
        
        // 监听事件
        $listens = $this->getConfig('mini.listen', []);
        foreach ($listens as $event => $listen) {
            if (!$listen) {
                continue;
            }
            $this->app->event->listen($event, $listen);
        }
    }
    
    
    /**
     * 校验Signature
     */
    protected function checkSignature()
    {
        $request   = $this->app->request;
        $signature = $request->param('signature/s', '', 'trim');
        $timestamp = $request->param('timestamp/s', '', 'trim');
        $nonce     = $request->param('nonce/s', '', 'trim');
        $tempArr   = [$this->token, $timestamp, $nonce];
        sort($tempArr, SORT_STRING);
        if ($signature == sha1(implode('', $tempArr))) {
            return $request->param('echostr/s', '', 'trim');
        }
        
        throw new RuntimeException("signature校验失败");
    }
    
    
    /**
     * 回复成功
     * @param string $message
     * @return Response
     */
    public static function replyMessage($message = 'success')
    {
        return Response::create($message)->contentType('text/plain');
    }
    
    
    /**
     * 服务入口
     */
    public function service() : Response
    {
        self::log()->tag($this->programName)->info("服务通知");
        
        try {
            // 校验签名
            $echoStr = $this->checkSignature();
            
            // 验证服务地址
            if (!$this->app->request->isPost()) {
                return self::replyMessage($echoStr);
            }
            
            // 执行服务调度
            return $this->dispatch();
        } catch (Throwable $e) {
            self::log()->tag($this->programName)->error($e);
            
            return self::replyMessage();
        }
    }
    
    
    /**
     * 消息调度
     * @return Response
     */
    protected function dispatch() : Response
    {
        $data = $this->app->request->getInput();
        $data = json_decode($data, true) ?: [];
        self::log()->tag($this->programName)->info($data);
        
        
        $event = null;
        switch ($data['MsgType'] ?? '') {
            case 'event':
                $event = $data['Event'] ?? '';
                switch ($event) {
                    // 用户在小程序“客服会话按钮”进入客服会话
                    case 'user_enter_tempsession':
                        $event = new UserEnterTempSessionEvent($this, $data);
                    break;
                }
            break;
            
            // 用户在客服会话中发送小程序卡片消息
            case 'miniprogrampage':
                $event = new MiniProgramPageEvent($this, $data);
            break;
            
            // 用户在客服会话中发送图片消息
            case 'image':
                $event = new ImageEvent($this, $data);
            break;
            
            // 用户在客服会话中发送文本消息
            case 'text':
                $event = new TextEvent($this, $data);
            break;
        }
        
        if (!$event) {
            return self::replyMessage();
        }
        
        $eventName = get_class($event);
        self::log()->tag($this->programName)->info("处理事件: {$eventName}");
        $result = Event::trigger($eventName, $event, true);
        if ($result instanceof Response) {
            return $result;
        }
        
        return self::replyMessage();
    }
}