<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.users.home');
    }

    public function create()
    {
        $data['mode'] = 'add';
        return view('admin.users.home', $data);
    }

    public function edit($id, Request $request)
    {
        return view('admin.users.home', compact('id'));
    }

    public function destroy($id)
    {
    }

    public function store(Request $request)
    {
    }


    public function update(Request $request, $id)
    {
    }

    public function show($id)
    {
        return response()->json(User::find($id));
    }

}
