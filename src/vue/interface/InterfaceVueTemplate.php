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
    function __construct(array $config = []);

    function __set(string $name, mixed $value): void;

    function __get(string $name): mixed;

    function config(array $config): static;

    function getConfig(string $name): mixed;

    function fetch(): string;

}