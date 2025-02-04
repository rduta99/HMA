<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = [];

    public function __construct() {
        $this->data['menu'] = Menu::all();
        $this->data['logo'] = Storage::url(Setting::where('name', 'logo')->first()->value);
        $this->data['background'] = Storage::url(Setting::where('name', 'background')->first()->value);
    }
}
