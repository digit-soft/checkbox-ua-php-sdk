<?php

namespace DigitSoft\Checkbox\RouteGroups;

use DigitSoft\Checkbox\Config;
use DigitSoft\Checkbox\Routes;
use DigitSoft\Checkbox\CheckboxJsonApi;

abstract class RouteGroup
{
    protected CheckboxJsonApi $api;
    protected Config $config;
    protected Routes $routes;

    public function __construct(CheckboxJsonApi $api)
    {
        $this->api = $api;
        $this->config = $api->config();
        $this->routes = $api->routeBuilder();
    }
}
