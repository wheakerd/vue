<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2023~20226 http://wheakerd.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: wheakerd <wheakerd@gmail.com> <wheakerd@qq.com>
// +----------------------------------------------------------------------
declare(strict_types=1);

namespace wheakerd\vue\driver;

use wheakerd\vue\interface\InterfaceNpm;

class Npm implements InterfaceNpm
{
    public function __construct()
    {
    }

    public function getFileContent(): null|string
    {
        // TODO: Implement getFileContent() method.
    }

    public function getImport(): null|string
    {
        // TODO: Implement getImport() method.
    }

    public function getScript(): null|string
    {
        // TODO: Implement getScript() method.
    }

    public function getTemplate(): null|string
    {
        // TODO: Implement getTemplate() method.
    }

    public function getStyle(): null|string
    {
        // TODO: Implement getStyle() method.
    }

    public function unpack(): string
    {
        // TODO: Implement unpack() method.
    }
}