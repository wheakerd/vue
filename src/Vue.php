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

use wheakerd\vue\parse\Npm;
use wheakerd\vue\parse\VueTemplate;

/**
 * 前后端分离式开发，例如uni—app项目编写方式
 * 暂支持选项式开发模式
 */
class Vue
{
    /**
     * @var array
     */
    private array $config = [
        'with_more_app' =>  true,                   //  是否启用多应用模式
        'more_app'      =>  'index',                //  默认使用index
        'view_path'     =>  '',                     //  项目路径
        'view_suffix'   =>  'vue',                  //  默认解析模板后缀文件，其他文件原样返回
        'view_type'     =>  'option',               //  支持使用选项式 API (Options API) 和 组合式 API (Composition API)    options|composition
        'npm_modules'   =>  '',                     //  npm所在目录
        'package'       =>  'package.json',         //  默认npm配置文件
        'modules'       =>  'node_modules',         //  node模块目录
        'cache_npm'     =>  'node_modules.json',    //  缓存解析
        'dependencies'  =>  'dependencies',         //  npm依赖
    ];

    /**
     * 架构函数
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * @param array $config
     * @return $this
     */
    public function config(array $config): static
    {
        $this->config = array_merge($this->config, $config);
        return $this;
    }

    /**
     * 映射表
     * @return string
     */
    public function getImportMap(): string
    {
        return (new Npm($this->config))->convert()->importMap();
    }

    /**
     * 模板渲染
     * @param string $url
     * @return string
     */
    public function fetch(string $url): string
    {
        try {
            return (new VueTemplate($this->config))->unpack(url: $url)->handle()->fetch();
        } catch (vue\exception\VueTemplateNotFoundException $vueTemplateNotFoundException) {
            return $vueTemplateNotFoundException->getMessage();
        }
    }
}