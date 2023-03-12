<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2023~20226 http://wheakerd.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: wheakerd <wheakerd@gmail.com> <wheakerd@qq.com>
// +----------------------------------------------------------------------
declare(strict_types=1);

namespace wheakerd;

/**
 * 前后端分离式开发，例如uni—app项目编写方式
 */
class Vue
{
    private array $config = [
        'with_more_app' => true,    //  是否启用多应用模式
        'more_app' => 'index',    //  默认使用index
        'view_path' => '',          //  项目路径
        'view_suffix' => 'vue',     //  默认解析模板后缀文件，其他文件原样返回
        'view_type' => 'option',   //  支持使用选项式 API (Options API) 和 组合式 API (Composition API)    options|composition
    ];

    public function __construct(array $config = [])
    {
        $this->config = array_merge($this->config, $config);
    }

    public function config(array $config): static
    {
        $this->config = array_merge($this->config, $config);
        return $this;
    }

    public function fetch(): string
    {
        return '';
    }
}