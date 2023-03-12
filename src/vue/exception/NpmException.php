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

use RuntimeException;

/**
 * npm解析异常抛出类
 */
class NpmException extends RuntimeException
{
    /**
     * 架构函数
     * @param string $message
     * @param string $code
     */
    public function __construct(string $message, string $code = '')
    {
        parent::__construct();
        $this->message = $message;
        $this->code = $code;
    }
}