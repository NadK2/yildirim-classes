<?php

namespace Yildirim\Classes;

use Yildirim\Traits\HasAttributes;

class Server
{

    use HasAttributes;

    /**
     *
     */
    protected $attributes = [];

    /**
     * __construct
     *
     * @param  mixed $attributes
     * @return void
     */
    public function __construct($attributes = [])
    {
        foreach ($attributes ?: $_SERVER as $key => $val) {
            $this->{$key} = $val;
        }

    }

}
