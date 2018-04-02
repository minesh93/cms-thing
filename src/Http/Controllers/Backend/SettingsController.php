<?php

namespace Claws\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Claws\Http\Controllers\Controller;
use Claws\Models\Admin;
use Claws\Models\Role;
use Auth;
use SettingsRegister;

class SettingsController extends Controller {

    public function getSettings(Request $request, $section) {
        $settings = SettingsRegister::getSection($section);
        return view('claws::admin.settings-edit', ['settings' => $settings]);
    }

    public function updateSettings(Request $request, $section){
        dd($request->settings);
    }
}