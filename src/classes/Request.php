<?php

namespace Yildirim\Classes;

use Yildirim\Interfaces\Arrayable;
use Yildirim\Interfaces\Jsonable;
use Yildirim\Traits\HasAttributes;

class Request implements Jsonable, Arrayable
{

    use HasAttributes;

    /**
     * attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * route
     *
     * @var array
     */
    private $route = [];

    /**
     * __construct
     *
     * @param  mixed $attributes
     * @return void
     */
    public function __construct($attributes = [])
    {
        foreach ($attributes ?: $_REQUEST as $key => $val) {
            $this->{$key} = $val;
        }

    }

    /**
     * server
     *
     * @param  mixed $key
     * @param  mixed $default
     * @return void
     */
    public function server($key = null, $default = null)
    {
        return server($key, $default);
    }

    /**
     * uri
     *
     * @return void
     */
    public function uri()
    {
        return urldecode(
            parse_url(server('REQUEST_URI'), PHP_URL_PATH)
        );
    }

    /**
     *
     */
    public function method()
    {
        return server('REQUEST_METHOD');
    }

    /**
     * route
     *
     * @param  mixed $key
     * @return void
     */
    public function route($key)
    {
        return $this->route[$key] ?? null;
    }

    /**
     * setRouteParameters
     *
     * @param  mixed $data
     * @return void
     */
    public function setRouteParameters(array $data)
    {
        foreach ($data as $key => $val) {
            $this->setRouteParameter($key, $val);
        }
    }

    /**
     * setRouteParameter
     *
     * @param  mixed $key
     * @param  mixed $val
     * @return void
     */
    public function setRouteParameter($key, $val)
    {
        $this->route[$key] = $val;
    }

    /**
     * getRouteParameters
     *
     * @return void
     */
    public function getRouteParameters()
    {
        return $this->route;
    }

}
