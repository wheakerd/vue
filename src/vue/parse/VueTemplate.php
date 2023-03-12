<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2023~20226 http://wheakerd.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: wheakerd <wheakerd@gmail.com> <wheakerd@qq.com>
// +----------------------------------------------------------------------
declare(strict_types=1);

namespace wheakerd\vue\parse;

use wheakerd\vue\exception\VueTemplateNotFoundException;
use wheakerd\vue\interface\InterfaceVueTemplate;

final class VueTemplate implements InterfaceVueTemplate
{
    /**
     * 解包配置
     * @var array
     */
    private array $config = [
        'app_status' => true,
        'app_host' => 'index',
        'view_path' => '',
        'view_dir_ect' => DIRECTORY_SEPARATOR,
    ];

    /**
     * 模板内容
     * @var string|bool
     */
    private string|bool $view_data = '';

    /**
     * 解包数据
     * @var array
     */
    private array $vue_data = [];

    /**
     * 架构函数
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set(string $name, mixed $value): void
    {
        $this->config [$name] = $value;
    }

    /**
     * 获取配置
     * @param string $name
     * @return mixed
     */
    public function getConfig(string $name): mixed
    {
        return $this->config [$name] ?? null;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name): mixed
    {
        return $this->config [$name] ?? null;
    }

    /**
     * 获取数组递归末尾键值
     * @param array $array
     * @return string
     */
    private function getEndValue(array $array): string
    {
        $arr = end(array: $array);

        return is_array(value: $arr) ? $this->getEndValue(array: $arr) : $arr;
    }

    /**
     * 取值
     * @param string $url
     * @return $this
     * @throws VueTemplateNotFoundException
     */
    public function unpack(string $url): VueTemplate
    {
        $this->config ['view_path'] = rtrim(string: $this->config ['view_path'], characters: '/');

        $url = ltrim(string: $url, characters: '/');

        $view_path [] = $this->config ['view_path'];

        if ($this->config ['app_status']) $view_path [] = $this->config ['app_host'];

        $view_path [] = $url;

        $view_path1 = implode(separator: $this->config ['view_dir_ect'], array: $view_path);

        $this->view_data = @file_get_contents(filename: $view_path1);

        $this->view_data or throw new VueTemplateNotFoundException(message: 'file read error:' . $view_path1, code: 11602);

        return $this;
    }

    /**
     * 模板解析
     * @return $this
     */
    public function handle(): VueTemplate
    {
        preg_match_all(pattern: '/(import.*\*?)/', subject: $this->view_data, matches: $import);

        preg_match_all(pattern: '/export\sdefault\s{\n?([\s\S]*?)}\s*;?\s*\n?<\/script>/', subject: $this->view_data, matches: $script);

        preg_match_all(pattern: '/<template>([\s\S]*?)<\/template>/', subject: $this->view_data, matches: $template);

        $this->vue_data ['import'] = end($import);

        $this->vue_data ['script'] = $this->getEndValue($script);

        $this->vue_data ['template'] = $this->getEndValue($template);

        return $this;
    }

    /**
     * 渲染
     * @return string
     */
    public function fetch(): string
    {
        $content = implode("\n", $this->vue_data ['import']) . "\n\n";
        $content .= 'export default {' . "\r" . "\t" . 'template: `' . $this->vue_data ['template'] . "\t" . '`,' . $this->vue_data ['script'] . "};";

        return $content;
    }
}