<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Realstate as TableName;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;

class RealstatesController extends Controller
{
    static $name = 'realstates';

    public function index(Request $request)
    {
        $items = TableName::query();

        $client = $request->input('client');
        
        $routeName = Route::currentRouteName();
        if ($request->has('reset') and request('reset') == 'true') {
            return redirect()->route($routeName);
        }

        if ($client) {
            $items->where('client_id', $client);
        }
        
        // $items = $items->orderBy('sort', 'asc');

        return view("admin." . self::$name . ".home", [
            'items' => $items->get(),
            'client' => Client::find($client)
        ]);
    }

    public function destroy($id)
    {
        TableName::query()->findOrFail($id)->delete();
        return 'success';
    }

    public function create()
    {
        return view("admin." . self::$name . ".create");
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
            'opu_ip' => 'required|string|max:191',
            'client_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $table = new TableName();
        $table->opu_ip = request('opu_ip', null);
        $table->address = request('address', null);
        $table->client_id = request('client_id');
        $table->status = request('status', 1);
        $table->save();

        return redirect(route("admin.".self::$name.".index").'?client='.$table->client_id)->with('status', __('common.create'));
    }

    public function edit($id)
    {
        $data['item'] = TableName::findOrFail($id);
        $data['client'] = $data['item']->client_id;
        return view("admin." . self::$name . ".edit", $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'opu_ip' => 'required|string|max:191'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $table = TableName::query()->findOrFail($id);
        $table->opu_ip = request('opu_ip', null);
        $table->address = request('address', null);
        $table->status = request('status');
        $table->save();

        return redirect(route("admin.".self::$name.".index").'?client='.$table->client_id)->with('status', __('common.update'));
    }

}
