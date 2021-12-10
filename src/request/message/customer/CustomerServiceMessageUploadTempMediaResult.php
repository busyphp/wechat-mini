<?php

namespace BusyPHP\wechat\mini\request\message\customer;

use BusyPHP\model\ArrayOption;

/**
 * @see CustomerServiceMessageUploadTempMedia
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/12/9 下午1:57 CustomerServiceMessageUploadTempMediaResult.php $
 * @property string $type 文件类型
 * @property string $media_id 媒体文件上传后，获取标识，3天内有效。
 * @property string $created_at 媒体文件上传时间戳
 */
class CustomerServiceMessageUploadTempMediaResult extends ArrayOption
{
}