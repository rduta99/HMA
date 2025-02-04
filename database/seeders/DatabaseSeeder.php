<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Menu;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'user_email' => 'admin@admin.com',
            'user_fullname' => 'admin',
            'password' => Hash::make('admin')
        ]);

        Menu::create([
            'name' => 'Dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'order' => 1,
            'url' => route('dashboard')
        ]);

        Menu::create([
            'name' => 'Master User',
            'icon' => 'fas fa-user',
            'order' => 2,
            'url' => route('master.user')
        ]);

        Menu::create([
            'name' => 'Setting',
            'icon' => 'fas fa-cog',
            'order' => 3,
            'url' => route('setting')
        ]);

        Setting::create(['name' => 'logo', 'value' => '/dist/img/AdminLTELogo.png']);
        Setting::create(['name' => 'background', 'value' => '#FEFEFE']);
    }
}
