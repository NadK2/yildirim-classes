<?php

$yildirim_container = null;

if (!function_exists('app')) {

    /**
     * app
     *
     * @param  mixed $abstract
     * @param  mixed $concrete
     * @return Yildirim\Classes\Container
     */
    function app($abstract = null, $parameters = [])
    {
        global $yildirim_container;

        if (!$yildirim_container) {
            $yildirim_container = new Yildirim\Classes\Container;
        }

        return ($abstract) ? $yildirim_container->get($abstract, $parameters) : $yildirim_container;
    }
}

if (!function_exists('collect')) {

    /**
     * collect
     *
     * @param  mixed $data
     * @return Yildirim\Classes\Collection
     */
    function collect($data = [])
    {
        if (!app()->has('collection')) {
            app()->set('collection', new Yildirim\Classes\Collection());
        }

        return app('collection', [$data]);
    }
}

if (!function_exists('dd')) {

    /**
     * dd
     *
     * @return void
     */
    function dd(...$vars)
    {
        array_map(function ($x) {
            dump($x);
        }, func_get_args());
        die;
    }
}

if (!function_exists('server')) {

    /**
     * server
     *
     * @param  mixed $key
     * @param  mixed $defualt
     * @return Yildirim\Classes\Server
     */
    function server($key = null, $defualt = null)
    {

        if (!app()->has('server')) {
            app()->setInstance('server', new Yildirim\Classes\Server());
        }

        return $key ? (app('server')->{$key} ?: $defualt): app('server');
    }
}

if (!function_exists('root_path')) {
    /**
     * root_path
     *
     * @return string
     */
    function root_path()
    {
        return server()->document_root();
    }
}

if (!function_exists('throwException')) {

    /**
     * throwException
     *
     * @param  string $type
     * @param  string $message
     * @param  int $code
     * @param  mixed $previous
     * @return Yildirim\Classes\Exception
     */
    function throwException($type = 'Exception', $message = '', $code = 0, $previous = null)
    {
        return new Yildirim\Classes\Exception($type, $message, $code, $previous);
    }
}

if (!function_exists('session')) {
    /**
     * session
     *
     * @return mixed
     */
    function session($key = null, $defualt = null)
    {
        if (!app()->has('session')) {
            app()->setInstance('session', new Yildirim\Classes\Session());
        }

        return $key ? app('session')->get($key, $defualt) : app('session');
    }
}
