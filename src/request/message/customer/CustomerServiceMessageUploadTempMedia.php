<?php

namespace BusyPHP\wechat\mini\request\message\customer;

use BusyPHP\wechat\mini\WeChatMiniBaseRequest;

/**
 * 把媒体文件上传到微信服务器。目前仅支持图片。用于发送客服消息或被动回复用户消息。
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/12/9 下午1:52 CustomerServiceMessageUploadTempMedia.php $
 * @see https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/customer-message/customerServiceMessage.uploadTempMedia.html
 */
class CustomerServiceMessageUploadTempMedia extends WeChatMiniBaseRequest
{
    protected $method = 'post';
    
    protected $path   = 'cgi-bin/media/upload?access_token=';
    
    
    /**
     * 设置上传的图片
     * @param string $filename
     * @return CustomerServiceMessageUploadTempMedia
     */
    public function setImage(string $filename) : self
    {
        $this->params['type'] = 'image';
        $this->files['media'] = $filename;
        
        return $this;
    }
    
    
    /**
     * 执行上传
     * @return CustomerServiceMessageUploadTempMediaResult
     */
    public function upload() : CustomerServiceMessageUploadTempMediaResult
    {
        $result = $this->request();
        
        return CustomerServiceMessageUploadTempMediaResult::init($result);
    }
}