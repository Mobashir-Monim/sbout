<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;
use App\Helpers\ConfigHelper\Creator;
use App\Helpers\ConfigHelper\Updator;

class ConfigController extends Controller
{
    public function index()
    {
        return view('config.index', [
            'configs' => Config::paginate(10)
        ]);

    }

    public function create()
    {
        return view('config.create');
    }

    public function store(Request $request)
    {
        $helper = new Creator($request);

        return redirect()->route('config.edit', ['config' => $helper->getConfig()]);
    }

    public function edit(Config $config, Request $request)
    {
        return view('config.edit', [
            'config' => $config
        ]);
    }

    public function update(Config $config, Request $request)
    {
        $helper = new Updator($config, $request);

        return redirect()->route('config.edit', ['config' => $helper->getConfig()]);
    }
}
