<?php

namespace App\Http\Controllers;

use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $service;

    public function __construct(SettingService $service) {
        parent::__construct();
        $this->service = $service;
    }

    function index() {
        $this->data['settings'] = $this->service->getAllSettings();

        return view('setting.index', $this->data);
    }

    function update(Request $request) {
        if($this->service->updateSetting($request))
            return redirect()->route('setting')->with('success', "Setting Updated");

        return back()->with('fail', 'Fail to update data');
    }
}
