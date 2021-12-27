<?php

namespace App\Helpers\ConfigHelper;

use App\Helpers\Helper;

class Updator extends Helper
{
    protected $config;

    public function __construct($config, $request)
    {
        $this->config = $config;
        $this->updateConfig($request);
    }

    public function updateConfig($request)
    {
        $this->config->name = $request->name;
        $this->config->display_name = $request->display_name;
        $this->config->description = $request->description;
        $this->config->variable = json_decode($request->variable, true);
        $this->config->save();
    }

    public function getConfig()
    {
        return $this->config;
    }
}