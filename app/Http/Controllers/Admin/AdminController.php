<?php

namespace App\Http\Controllers\Admin;


use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    private $settings = [];

    public function __construct()
    {
        $this->settings = Settings::query()->first();
        view()->share([
            'settings' => $this->settings,
        ]);
    }

    public function index(Request $request)
    {
        $items = User::where('role', 'Admin');
        if ($request->has('email')) {
            if ($request->get('email') != null)
                $items->where('email', 'like', '%' . $request->get('email') . '%');
        }

        $items = $items->orderBy('id', 'desc');
        return view('admin.admins.home', [
            'items' => $items->get(),
        ]);
    }

    public function destroy($id)
    {
        $item = User::query()->findOrFail($id);
        if ($item->id == 1) {
            return "fail";
        }
        // if(can('delete')){
        User::query()->where('id', $id)->delete();
        // }

        return "success";
    }


    public function create()
    {
        $users = User::all();
        return view('admin.admins.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:191',
            // 'last_name' => 'required|string|max:191',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,NULL,id,deleted_at,NULL'],
            'password' => 'required|min:6|max:191',
            'confirm_password' => 'required|same:password|min:6|max:191',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newAdmin = new User();
        $newAdmin->role = 'Admin';
        $newAdmin->activation_token = 'Admin';
        $newAdmin->user_permission = 'Admin';
        $newAdmin->first_name = $request->first_name;
        $newAdmin->last_name = $request->last_name;
        $newAdmin->phone = $request->phone;
        $newAdmin->email = $request->email;
        $newAdmin->password = bcrypt($request->password);

        $newAdmin->save();

        return redirect()->route('admin.admins.index')->with('status', __('common.create'));
    }



    public function edit($id)
    {
        $item = User::findOrFail($id);
        // if ($item->id == 1 and Auth::User()->id != 1) {
        //     abort('404');
        // }

        // if ($item->id != Auth::User()->id) {
        //     abort('404');
        // }
        return view('admin.admins.edit', compact('item'));
    }


    public function update(Request $request, $id)
    {
        $newAdmin = User::findOrFail($id);

        // if ($newAdmin->id == 1 and Auth::User()->id != 1) {
        //     abort('404');
        // }

        // if (Auth::User()->super_admin != 1) {
        //     if ($newAdmin->id != Auth::User()->id) {
        //         abort('404');
        //     }
        // }


        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:191',
            'email' => [
                'required',
                'string',
                'email',
                'max:191',
                Rule::unique('users')->where(function ($query) use ($id) {
                    $query->whereNull('deleted_at')->where('id', '<>', $id);
                }),
            ],  
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $newAdmin->first_name = $request->first_name;
        $newAdmin->last_name = $request->last_name;

        $newAdmin->email = $request->email;
        $newAdmin->phone = $request->phone;
        if (!empty($request->password))
            $newAdmin->password = bcrypt($request->password);

        $newAdmin->save();

        return redirect()->route('admin.admins.index')->with('status', __('common.update'));
    }



    public function edit_password(Request $request, $id)
    {
        $item = User::findOrFail($id);

        // if ($item->id != Auth::User()->id) {
        //     abort('404');
        // }

        return view('admin.admins.edit_password', ['item' => $item]);
    }


    public function update_password(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // if ($user->id != Auth::User()->id) {
        //     abort('404');
        // }

        $users_rules = array(
            'password' => 'required|min:6|max:191',
            'confirm_password' => 'required|same:password|min:6|max:191',
        );
        $users_validation = Validator::make($request->all(), $users_rules);

        if ($users_validation->fails()) {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $user->password = bcrypt($request->password);
        $user->save();
        
        return redirect()->route('admin.admins.index')->with('status', __('common.update'));
    }
}
