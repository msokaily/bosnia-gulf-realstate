<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product as TableName;
use App\Models\Realstate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;


class ProductsController extends Controller
{
    static $name = 'products';

    public function index(Request $request)
    {
        $items = TableName::query();

        $routeName = Route::currentRouteName();
        if($request->has('reset') AND request('reset') == 'true'){
            return redirect()->route($routeName);
        }

        $realstate = $request->input('realstate');
        if ($realstate) {
            $items->where('realstate_id', $realstate);
        }
        
        $items = $items->orderBy('sort', 'asc');

        return view("admin.".self::$name.".home", [
            'items' => $items->get(),
            'realstate' => Realstate::find($realstate)
        ]);

    }

    public function sort(Request $request)
    {
        $sortList = $request->input('sort', []);
        foreach($sortList as $i => $id)
        {
            $item = TableName::where('id', $id)->first();
            if ($item) {
                $item->sort = $i;
                $item->save();
            }
        }
        return redirect()->back()->with('status', __('common.sort_success'));
    }

    public function destroy($id)
    {
        TableName::query()->findOrFail($id)->delete();
        return 'success';
    }

    public function create()
    {
        return view("admin.".self::$name.".create");
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
            'realstate_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $table = new TableName();
        $table->name = request('name');
        $table->realstate_id = request('realstate_id');
        $table->status = request('status', 1);
        $table->save();
        
        return redirect(route("admin.".self::$name.".index").'?realstate='.$table->realstate_id)->with('status', __('common.create'));
    }

    public function edit($id)
    {
        $data['item'] = TableName::findOrFail($id);
        $data['realstate'] = $data['item']->realstate_id;
        return view("admin.".self::$name.".edit", $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $table = TableName::query()->findOrFail($id);
        $table->name = request('name');
        $table->status = request('status');
        $table->save();

        return redirect(route("admin.".self::$name.".index").'?realstate='.$table->realstate_id)->with('status', __('common.update'));
    }

}

