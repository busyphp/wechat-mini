<?php

namespace BusyPHP\wechat\mini\request\message\customer;

use BusyPHP\contract\structs\results\UploadResult;
use BusyPHP\file\Upload;
use BusyPHP\file\upload\DataUpload;
use BusyPHP\helper\HttpHelper;
use BusyPHP\wechat\mini\WeChatMiniBaseRequest;
use Exception;
use RuntimeException;

/**
 * 获取客服消息内的临时素材。即下载临时的多媒体文件
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/12/11 下午2:00 CustomerServiceMessageGetTempMedia.php $
 */
class CustomerServiceMessageGetTempMedia extends WeChatMiniBaseRequest
{
    protected $path      = 'cgi-bin/media/get?access_token=';
    
    protected $method    = 'get';
    
    protected $useResult = true;
    
    /**
     * 文件分类
     * @var string
     */
    private $classType = 'image';
    
    /**
     * 文件值
     * @var string
     */
    private $classValue = '';
    
    /**
     * 用户ID
     * @var int
     */
    private $userId = 0;
    
    /**
     * 文件Mime
     * @var string
     */
    private $mimeType = 'image/jpeg';
    
    /**
     * 文件名
     * @var string
     */
    private $name = '';
    
    /**
     * 文件扩展名
     * @var string
     */
    private $extension = 'jpg';
    
    
    /**
     * 设置素材ID
     * @param $mediaId
     * @return CustomerServiceMessageGetTempMedia
     */
    public function setMediaId($mediaId) : self
    {
        $this->params['media_id'] = $mediaId;
        
        return $this;
    }
    
    
    /**
     * 设置文件分类级文件业务参数
     * @param string $type
     * @param string $value
     * @return CustomerServiceMessageGetTempMedia
     */
    public function setClassType(string $type, string $value) : self
    {
        $this->classType  = $type;
        $this->classValue = $value;
        
        return $this;
    }
    
    
    /**
     * 设置用户ID
     * @param $userId
     * @return CustomerServiceMessageGetTempMedia
     */
    public function setUserId($userId) : self
    {
        $this->userId = (int) $userId;
        
        return $this;
    }
    
    
    /**
     * 设置MimeType，获取不到的时候使用该值
     * @param string $mimeType
     * @return CustomerServiceMessageGetTempMedia
     */
    public function setMimeType(string $mimeType) : self
    {
        $this->mimeType = $mimeType;
        
        return $this;
    }
    
    
    /**
     * 设置文件名
     * @param string $name
     * @return CustomerServiceMessageGetTempMedia
     */
    public function setName(string $name) : self
    {
        $this->name = $name;
        
        return $this;
    }
    
    
    /**
     * 设置文件扩展名，获取不到的时候使用该值
     * @param string $extension
     * @return CustomerServiceMessageGetTempMedia
     */
    public function setExtension(string $extension) : self
    {
        $this->extension = $extension;
        
        return $this;
    }
    
    
    /**
     * 下载素材
     * @return UploadResult
     * @throws Exception
     */
    public function download() : UploadResult
    {
        $result = $this->request();
        if (0 === strpos($result, '{')) {
            self::parseResult($result);
            
            throw new RuntimeException("下载失败: {$result}");
        }
        
        $headers  = HttpHelper::parseResponseHeaders($this->http->getResponseHeaders());
        $mimeType = strtolower(trim($headers['content-type'] ?? ''));
        
        // 从响应中获取文件名
        if (!preg_match('/.*filename=(.+)/is', trim($headers['content-disposition'] ?? ''), $match)) {
            throw new RuntimeException('无法获取文件名');
        }
        
        // 通过mimeType解析文件扩展名
        $filename  = trim($match[1], "'");
        $filename  = trim($filename, '"');
        $extension = trim(pathinfo($filename, PATHINFO_EXTENSION));
        if (!$extension && $mimeType) {
            $extension = Upload::IMAGE_MIME_TYPES[$mimeType] ?? '';
        }
        $extension = $extension ?: $this->extension;
        $mimeType  = $mimeType ?: $this->mimeType;
        
        $upload = new DataUpload();
        $upload->setMimeType($mimeType);
        $upload->setExtension($extension);
        $upload->setName($this->name ?: $filename);
        $upload->setClassType($this->classType, $this->classValue);
        $upload->setUserId($this->userId);
        
        return $upload->upload($result);
    }
}