<?php

use Yildirim\Classes\Collection;
use Yildirim\Classes\Container;
use Yildirim\Classes\Request;
use Yildirim\Classes\Server;

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
            $yildirim_container = new Container;
        }

        return ($abstract) ? $yildirim_container->get($abstract, $parameters) : $yildirim_container;
    }
}

if (!function_exists('collect')) {
    function collect($data = [])
    {
        if (!app()->has('collection')) {
            app()->set('collection', new Collection());
        }

        return app('collection', [$data]);
    }
}

if (!function_exists('dd')) {
    function dd()
    {
        array_map(function ($x) {
            dump($x);
        }, func_get_args());
        die;
    }
}

if (!function_exists('request')) {
    /**
     * request
     *
     * @param  mixed $key
     * @param  mixed $defualt
     * @return Request
     */
    function request($key = null, $defualt = null)
    {
        if (!app()->has('request')) {
            app()->setInstance('request', new Request());
        }

        return $key ? (app('request')->{$key} ?: $defualt): app('request');
    }
}

if (!function_exists('server')) {
    function server($key = null, $defualt = null)
    {

        if (!app()->has('server')) {
            app()->setInstance('server', new Server());
        }

        return $key ? (app('server')->{$key} ?: $defualt): app('server');
    }
}

if (!function_exists('throwException')) {
    function throwException($type = 'Exception', $message = '', $code = 0, $previous = null)
    {
        return new Yildirim\Classes\Exception($type, $message, $code, $previous);
    }
}
