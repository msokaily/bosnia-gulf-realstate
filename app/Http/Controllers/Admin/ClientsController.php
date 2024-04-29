<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ClientsImport;
use App\Models\Client as TableName;
use App\Models\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

class ClientsController extends Controller
{
    static $name = 'clients';

    public function index(Request $request)
    {
        $items = TableName::query();

        $routeName = Route::currentRouteName();
        if ($request->has('reset') and request('reset') == 'true') {
            return redirect()->route($routeName);
        }

        // $items = $items->orderBy('sort', 'asc');

        return view("admin." . self::$name . ".home", [
            'items' => $items->get()
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
            'name' => 'required|string|max:191',
            'serial' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $table = new TableName();
        $table->name = request('name');
        $table->serial = request('serial');
        $table->mobile = request('mobile', null);
        $table->email = request('email', null);
        $table->status = request('status', 1);
        $table->save();

        return redirect()->back()->with('status', __('common.create'));
    }

    public function edit($id)
    {
        $data['item'] = TableName::findOrFail($id);
        return view("admin." . self::$name . ".edit", $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'serial' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $table = TableName::query()->findOrFail($id);
        $table->name = request('name');
        $table->serial = request('serial');
        $table->mobile = request('mobile', null);
        $table->email = request('email', null);
        $table->status = request('status');
        $table->save();

        return redirect()->back()->with('status', __('common.update'));
    }

    public function clients_import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xls,xlsx,csv'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // try {
            Excel::import(new ClientsImport(), $request->file('file'));
        // } catch (\Exception $e) {
        //     Log::create([
        //         'title' => 'Import Error',
        //         'details' => $e->getMessage(),
        //     ]);

        //     $error = __('common.import_error');
        //     return redirect()->back()->withErrors($error)->withInput();
        // }

        return redirect()->back()->with('status', __('common.users_imported_successfully'));
    }
}
