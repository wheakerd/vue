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

use wheakerd\vue\exception\NpmException;
use wheakerd\vue\interface\InterfaceNpm;

final class Npm implements InterfaceNpm
{
    /**
     * @var array|string[]
     */
    public array $config = [
        'npm_modules'   => '',              //  npm所在目录
        'package'       => 'package.json',  //  默认npm配置文件
        'modules'       => 'node_modules',  //  node模块目录
        'dependencies'  => 'dependencies',  //  npm依赖
    ];

    /**
     * @var array
     */
    public array $json = [];

    /**
     * @var array
     */
    public array $lib = [];

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        empty($config) or $this->config(config: $config);
    }

    /**
     * @param array $config
     * @return $this
     */
    public function config(array $config): Npm
    {
        $this->config = array_merge(arrays: $this->config, array: $config);
        $this->config['npm_modules'] = rtrim(string: $this->config['npm_modules'], characters: '/') . '/';
        $this->json = $this->getJson(pack: $this->config['package']) [$this->config['dependencies']];
        return $this;
    }

    /**
     * @param string $pack
     * @return mixed
     */
    public function getJson(string $pack = ''): mixed
    {
        $positionPath = realpath(path: $this->config['npm_modules'] . $pack);
        if (!$positionPath) throw  new NpmException(message: 'File does not exist:' . $this->config['package']);
        if (!str_starts_with(haystack: $positionPath, needle: realpath(path: $this->config['npm_modules']))) throw new NpmException(message: 'Load templates from outside the view directory!');
        $json = file_get_contents(filename: $positionPath);
        json_decode(json: $json, associative: true);
        if (json_last_error() != JSON_ERROR_NONE) throw new NpmException(message: 'An error occurred while parsing the configuration file!');
        return json_decode(json: $json, associative: true);
    }

    /**
     * @return $this
     */
    public function convert(): Npm
    {
        foreach ($this->json as $key => $value) $this->pollingSeek(libName: $key);
        return $this;
    }

    /**
     * @param string $libName
     * @return void
     */
    public function pollingSeek(string $libName): void
    {
        $subLibPath = $this->config['modules'] . '/' . $libName . '/' . $this->config['package'];
        $json = $this->getJson($subLibPath);
        $sub_path = $json ['module'] ?? $json ['exports'] ['.'] ['import'] ?? $json ['main'];
        $sub_path = ltrim(string: $sub_path, characters: '.');
        $sub_path = ltrim(string: $sub_path, characters: '/');
        $this->lib [$libName] = '/' . rtrim(string: $subLibPath, characters: $this->config['package']) . $sub_path;
    }

    /**
     * @param string $subLibName
     * @return mixed
     */
    public function getLibrary(string $subLibName): mixed
    {
        if (isset($this->lib[$subLibName])) return $this->lib[$subLibName];
        throw new NpmException(message: 'Component does not exist！');
    }

    /**
     * @return string
     */
    public function importMap(): string
    {
        return json_encode($this->lib);
    }
}