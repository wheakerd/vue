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

use wheakerd\vue\interface\InterfaceVueTemplate;

final class VueTemplate implements InterfaceVueTemplate
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function config(array $config): static
    {
        // TODO: Implement config() method.
    }

    public function __set(string $name, mixed $value): void
    {
        // TODO: Implement __set() method.
    }

    public function getConfig(string $name): mixed
    {
        // TODO: Implement getConfig() method.
    }

    public function __get(string $name): mixed
    {
        // TODO: Implement __get() method.
    }

    public function fetch(): string
    {
        // TODO: Implement fetch() method.
    }

}