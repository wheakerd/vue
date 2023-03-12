<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2023~20226 http://wheakerd.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: wheakerd <wheakerd@gmail.com> <wheakerd@qq.com>
// +----------------------------------------------------------------------
declare(strict_types=1);

namespace wheakerd\vue\interface;

interface InterfaceNpm
{
    function __construct();

    function getFileContent(): null|string;

    function getImport(): null|string;

    function getTemplate(): null|string;

    function getScript(): null|string;

    function getStyle(): null|string;

    function unpack(): string;
}