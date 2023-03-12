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

use wheakerd\vue\parse\Npm;

interface InterfaceNpm
{
    /**
     * 构架函数
     * @param array $config
     */
    function __construct(array $config = []);

    /**
     * @param array $config
     * @return Npm
     */
    function config(array $config): Npm;

    /**
     * @param string $pack
     * @return mixed
     */
    function getJson(string $pack = ''): mixed;

    /**
     * @return Npm
     */
    function convert(): Npm;

    /**
     * @param string $libName
     * @return void
     */
    function pollingSeek(string $libName): void;

    /**
     * @param string $subLibName
     * @return mixed
     */
    function getLibrary(string $subLibName): mixed;

    /**
     * @return string
     */
    function importMap(): string;
}