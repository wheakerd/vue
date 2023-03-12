<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2023~20226 http://wheakerd.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: wheakerd <wheakerd@gmail.com> <wheakerd@qq.com>
// +----------------------------------------------------------------------
namespace wheakerd\vue\interface;

interface InterfaceVueTemplate
{
    /**
     * @param array $config
     */
    function __construct(array $config = []);

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    function __set(string $name, mixed $value): void;

    /**
     * @param string $name
     * @return mixed
     */
    function __get(string $name): mixed;

    /**
     * @param string $name
     * @return mixed
     */
    function getConfig(string $name): mixed;

    /**
     * @param string $url
     * @return mixed
     */
    function unpack(string $url): mixed;
}