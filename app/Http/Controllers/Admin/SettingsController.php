<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{

    public function index(Request $request)
    {
        $item = Settings::query()->first();
        return view('admin.settings.edit', [
            'item' => $item,
        ]);

    }


    // public function edit($id)
    // {
    //     $item = Units::findOrFail($id);
    //     return view('admin.units.edit',compact('item'));
    // }


    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'address' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $setting = Settings::query()->first();
        $setting->location = request('location');
        $setting->address = request('address');
        $setting->email = request('email');
        $setting->phone = request('phone');
        $setting->mobile = request('mobile');
        $setting->site_description = request('site_description');
        $setting->home_bg = request('home_bg');
        $setting->menu_bg = request('menu_bg');

        $setting->save();
        return redirect()->back()->with('status', __('common.update'));
    }

   
   

}
