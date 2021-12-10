<?php

namespace BusyPHP\wechat\mini\request\message\customer;

use BusyPHP\wechat\mini\WeChatMiniBaseRequest;

/**
 * 发送客服消息给用户
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/12/9 下午1:37 CustomerServiceMessageSend.php $
 * @link https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/customer-message/customerServiceMessage.send.html
 */
class CustomerServiceMessageSend extends WeChatMiniBaseRequest
{
    protected $path = 'cgi-bin/message/custom/send?access_token=';
    
    
    /**
     * 设置接收的用户OpenID
     * @param string $toUser
     * @return CustomerServiceMessageSend
     */
    public function setToUser(string $toUser) : self
    {
        $this->params['touser'] = $toUser;
        
        return $this;
    }
    
    
    /**
     * 设置发送文本消息
     * @param string $text
     * @return CustomerServiceMessageSend
     */
    public function setText(string $text) : self
    {
        $this->params['msgtype'] = 'text';
        $this->params['text']    = ['content' => $text];
        
        return $this;
    }
    
    
    /**
     * 设置发送连接消息
     * @param string $link 连接
     * @param string $title 标题
     * @param string $description 描述
     * @param string $imageUrl 图片
     * @return $this
     */
    public function setLink(string $link, string $title, string $description, string $imageUrl) : self
    {
        $this->params['msgtype'] = 'link';
        $this->params['link']    = [
            'title'       => $title,
            'description' => $description,
            'url'         => $link,
            'thumb_url'   => $imageUrl,
        ];
        
        return $this;
    }
    
    
    /**
     * 设置发送图片
     * @param string $mediaId 发送的图片的媒体ID，通过 新增素材接口 上传图片文件获得。
     * @return $this
     */
    public function setImage(string $mediaId) : self
    {
        $this->params['msgtype'] = 'image';
        $this->params['image']   = [
            'media_id' => $mediaId
        ];
        
        return $this;
    }
    
    
    /**
     * 设置发送小程序卡片
     * @param string $title 消息标题
     * @param string $pagePath 小程序的页面路径，跟app.json对齐，支持参数，比如pages/index/index?foo=bar
     * @param string $thumbMediaId 小程序消息卡片的封面， image 类型的 media_id，通过 新增素材接口 上传图片文件获得，建议大小为 520*416
     * @return $this
     */
    public function setMiniProgramPage(string $title, string $pagePath, string $thumbMediaId) : self
    {
        $this->params['msgtype']         = 'miniprogrampage';
        $this->params['miniprogrampage'] = [
            'title'          => $title,
            'pagepath'       => $pagePath,
            'thumb_media_id' => $thumbMediaId,
        ];
        
        return $this;
    }
    
    
    /**
     * 发送消息
     */
    public function send()
    {
        $this->request();
    }
}