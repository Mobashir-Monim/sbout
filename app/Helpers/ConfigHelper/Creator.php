<?php

namespace App\Helpers\ConfigHelper;

use App\Helpers\Helper;
use App\Models\Config;

class Creator extends Helper
{
    protected $config;

    public function __construct($request)
    {
        $this->stripConfigValues($request);
        $this->createConfig();
    }

    public function stripConfigValues($request)
    {
        $this->config = [
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
            'variable' => json_decode($request->variable, true)
        ];
    }

    public function createConfig()
    {
        $this->config = Config::create($this->config);
    }

    public function getConfig()
    {
        return $this->config;
    }
}