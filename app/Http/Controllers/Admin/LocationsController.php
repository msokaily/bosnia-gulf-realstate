<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Locations;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;

class LocationsController extends Controller
{
    static $name = 'locations';
    public function index(Request $request)
    {
        $routeName = Route::currentRouteName();
        if($request->has('reset') AND request('reset') == 'true'){
            return redirect()->route($routeName);
        }
        
        $items = Locations::orderBy('id', 'desc')->get();
        return view("admin.".self::$name.".home", [
            'items' => $items,
        ]);

    }

    public function destroy($id)
    {
        Locations::query()->findOrFail($id)->delete();
        return 'success';
    }

    public function create(Request $request)
    {
        $data['locations'] = Locations::all();
        
        return view("admin.".self::$name.".create", $data);
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
            'coordinates' => 'required|string|max:191',
            'title' => 'required|string|max:191',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data['status'] = $request->has('status') ? 1 : 0;

        $data = $request->only(['coordinates', 'title', 'description', 'image', 'left_shift', 'top_shift', 'message']);

        Locations::create($data);
        
        return redirect()->back()->with('status', __('common.create'));
    }

    public function edit($id)
    {
        $data['item'] = Locations::findOrFail($id);

        $data['locations'] = Locations::all();

        return view('admin.'.self::$name.'.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'coordinates' => 'required|string|max:191',
            'title' => 'required|string|max:191',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->only(['coordinates', 'title', 'description', 'image', 'left_shift', 'top_shift', 'message']);
        $data['status'] = $request->has('status') ? 1 : 0;

        Locations::findOrFail($id)->update($data);
        
        return redirect()->back()->with('status', __('common.update'));

    }

}
