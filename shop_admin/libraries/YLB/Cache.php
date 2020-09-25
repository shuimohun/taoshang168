<?php
/**
 * Cache 管理者类
 * 
 * 负责初始化并存放所有的Cache类。
 * 
 * @category   Framework
 * @package    Cache
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo       
 */
final class YLB_Cache
{
    /**
     * 存储已经实例后的Cache对象
     *
     * @staticvar YLB_Cache_Memcache|Cache_Lite
     */
    public static $cache = array();

    /**
     * 获得配置的Cache实例
     *
     * @param string $name 缓存配置key
     * @return YLB_Cache_Memcache|Cache_Lite
     */
    static public function create($name)
    {
        $config_cache = YLB_Registry::get('config_cache');

        if (!isset($config_cache[$name]))
        {
            $name = 'default';
        }


		if (!file_exists(APP_PATH . '/data/cache/'))
		{
			mkdir(APP_PATH . '/data/cache/');
		}

        if (!isset(self::$cache[$name]))
        {
            if (2 == $config_cache[$name]['cacheType'])
            {
                //单例模式，无论如何设置，都是唯一的一个memcache
                YLB_Cache_Memcache::$expire = $config_cache[$name]['lifeTime'];

                //为了调用多例模式
                if ('base' == $name)
                {
                    if (!isset(self::$cache['_memcache_base']))
                    {
                        self::$cache['_memcache_base'] = YLB_Cache_Memcache::getInstance($name);
                    }

                    return self::$cache['_memcache_base'];
                }
                elseif ('data' == $name)
                {
                    if (!isset(self::$cache['_memcache_data']))
                    {
                        self::$cache['_memcache_data'] = YLB_Cache_Memcache::getInstance($name);
                    }

                    return self::$cache['_memcache_data'];
                }
                else
                {
                    if (!isset(self::$cache['_memcache_']))
                    {
                        self::$cache['_memcache_'] = YLB_Cache_Memcache::getInstance('data');
                    }

                    return self::$cache['_memcache_'];
                }
            }
            elseif (3 == $config_cache[$name]['cacheType'])
            {
                //单例模式，无论如何设置，都是唯一的一个memcache
                YLB_Cache_Redis::$expire = $config_cache[$name]['lifeTime'];


                //为了调用多例模式
                if ('queue' == $name)
                {
                    if (!isset(self::$cache['_redis_queue']))
                    {
                        self::$cache['_redis_queue'] = YLB_Cache_Redis::getInstance($name);
                    }
                    
                    //是否设置db了 
                    if (isset($config_cache[$name]['dbName']))
                    {
                        self::$cache['_redis_queue']->select($config_cache[$name]['dbName']);
                    }

                    return self::$cache['_redis_queue'];
                }
                else
                {
                    if (!isset(self::$cache['_redis_']))
                    {
                        self::$cache['_redis_'] = YLB_Cache_Redis::getInstance($name);
                    }

                    //是否设置db了 
                    if (isset($config_cache[$name]['dbName']))
                    {
                        self::$cache['_redis_']->select($config_cache[$name]['dbName']);
                    }

                    return self::$cache['_redis_'];
                }
            }
            else
            {
                self::$cache[$name] = new Cache_Lite_Output($config_cache[$name]);

				if (!file_exists($config_cache[$name]["cacheDir"]))
				{
					mkdir($config_cache[$name]["cacheDir"]);
				}
            }
        }

        return self::$cache[$name];
    }

    private function __construct()
    {
    }
}
?>