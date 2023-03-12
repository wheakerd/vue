<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2023~20226 http://wheakerd.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: wheakerd <wheakerd@gmail.com> <wheakerd@qq.com>
// +----------------------------------------------------------------------
declare(strict_types=1);

namespace wheakerd\facade;


if (class_exists('wheakerd\Facade')) {
    class Facade extends \wheakerd\Facade
    {}
} else {
    class Facade
    {
        /**
         * 始终创建新的对象实例
         * @var bool
         */
        protected static bool $alwaysNewInstance;

        protected static object $instance;

        /**
         * 获取当前Facade对应类名
         * @access protected
         * @return string
         */
        protected static function getFacadeClass()
        {}

        /**
         * 创建Facade实例
         * @static
         * @access protected
         * @return object
         */
        protected static function createFacade(): object
        {
            $class = static::getFacadeClass() ?: 'wheakerd\Vue';

            if (static::$alwaysNewInstance) return new $class();

            if (!self::$instance) self::$instance = new $class();

            return self::$instance;

        }

        // 调用实际类的方法
        public static function __callStatic($method, $params)
        {
            return call_user_func_array([static::createFacade(), $method], $params);
        }
    }
}

class Vue extends Facade
{
    protected static bool $alwaysNewInstance = true;

    /**
     * 获取当前Facade对应类名（或者已经绑定的容器对象标识）
     * @access protected
     * @return string
     */
    protected static function getFacadeClass(): string
    {
        return 'wheakerd\Vue';
    }
}
