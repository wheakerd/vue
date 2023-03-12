<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2023~20226 http://wheakerd.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: wheakerd <wheakerd@gmail.com> <wheakerd@qq.com>
// +----------------------------------------------------------------------
declare(strict_types=1);

namespace wheakerd\vue\exception;

use Exception;

class VueTemplateNotFoundException extends Exception
{
    /**
     * 构架函数
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message, int $code = 11602)
    {
        parent::__construct();
        $this->message = $message;
        $this->code = $code;
    }
}
