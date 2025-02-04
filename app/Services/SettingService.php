<?php

namespace App\Services;

use App\Repositories\SettingRepo;
use App\Services\BaseService;
use Illuminate\Http\Request;

class SettingService extends BaseService
{
    protected $settingRepo;

    public function __construct(SettingRepo $settingRepo) {
        parent::__construct();
        $this->settingRepo = $settingRepo;
    }

    function getAllSettings() {
        return $this->settingRepo->get();
    }

    function updateSetting(Request $request) {
        try {
            // Logo
            $logoPath = $request->file('logo')->store('logo');
            $logoData = $this->settingRepo->findWhere([
                'name' => 'logo'
            ]);

            $logoData->value = $logoPath;
            $logoData->save();

            // Background
            $backgroundPath = $request->file('background')->store('background');
            $backgroundData = $this->settingRepo->findWhere([
                'name' => 'background'
            ]);

            $backgroundData->value = 'url(\'' . $backgroundPath . '\')';
            $backgroundData->save();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
