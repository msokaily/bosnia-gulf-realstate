<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RealstateProduct as TableName;
use App\Models\Realstate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class RealstateProductsController extends Controller
{
    static $name = 'realstate-products';

    public function index(Request $request)
    {
        $items = TableName::query();

        $realstate = $request->input('realstate');
        if ($realstate) {
            $items->where('realstate_id', $realstate);
        } else {
            return redirect(route("admin.realstates.index"));
        }

        $defaultFromDate = Carbon::now()->day(1)->format('Y-m-d');
        $defaultToDate = Carbon::now()->format('Y-m-d');
        
        $sessionFromDate = $request->has('reset') ? $defaultFromDate : $request->session()->get('from_date', $defaultFromDate);
        $sessionToDate = $request->has('reset') ? $defaultToDate : $request->session()->get('to_date', $defaultToDate);

        $from_date = $request->input('from_date', $sessionFromDate);
        $to_date = $request->input('to_date', $sessionToDate);
        $items->whereDate('paid_at', '>=', $from_date)->whereDate('paid_at', '<=', $to_date);
        $items->orderBy('paid_at', 'DESC');
        
        if ($request->input('from_date')) {
            $request->session()->put('from_date', $from_date);
        }
        if ($request->input('to_date')) {
            $request->session()->put('to_date', $to_date);
        }
        
        return view("admin.".self::$name.".home", [
            'items' => $items->get(),
            'realstate' => Realstate::find($realstate),
            'from_date' => $from_date,
            'to_date' => $to_date
        ]);

    }

    public function destroy($id)
    {
        TableName::query()->findOrFail($id)->delete();
        return 'success';
    }

    public function create()
    {
        $data['realstate'] = Realstate::findOrFail(request('realstate'));
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
            'realstate_id' => 'required',
            'product_id' => 'required',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $table = new TableName();
        $table->realstate_id = request('realstate_id');
        $table->product_id = request('product_id');
        $table->amount = request('amount');
        $table->paid_at = request('paid_at', Carbon::now());
        $table->save();
        
        return redirect(route("admin.".self::$name.".index").'?realstate='.$table->realstate_id)->with('status', __('common.create'));
    }

    public function edit($id)
    {
        $data['item'] = TableName::findOrFail($id);
        $data['realstate'] = $data['item']->realstate;
        return view("admin.".self::$name.".edit", $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $table = TableName::query()->findOrFail($id);
        $table->product_id = request('product_id');
        $table->amount = request('amount');
        $table->paid_at = request('paid_at');
        $table->save();

        return redirect(route("admin.".self::$name.".index").'?realstate='.$table->realstate_id)->with('status', __('common.update'));
    }

    public function paymentsPrint($id, Request $request)
    {
        
        $realstate = Realstate::where('id', $id)->first();
        $items = TableName::query();
        if ($realstate) {
            $data['realstate'] = $realstate;
            $items->where('realstate_products.realstate_id', $realstate->id);
        } else {
            return redirect()->back()->withInput()->withErrors(['Unknown real state!']);
        }
        

        $defaultFromDate = $request->session()->get('from_date', Carbon::now()->day(1)->format('Y-m-d'));
        $defaultToDate = $request->session()->get('to_date', Carbon::now()->format('Y-m-d'));
        
        $from_date = $request->input('from_date', $defaultFromDate);
        $to_date = $request->input('to_date', $defaultToDate);
        $items->whereDate('paid_at', '>=', $from_date)->whereDate('paid_at', '<=', $to_date);
        $items->groupBy('product_id');
        $items->orderBy('sort');
        $items->join('products', 'realstate_products.product_id', '=', 'products.id');
        $items->join('realstates', 'realstate_products.realstate_id', '=', 'realstates.id');
        $items->select([
            'product_id',
            'products.name',
            'products.sort',
            DB::raw('SUM(amount) as total'),
        ]);

        $data['products'] = $items->get();
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['year'] = Carbon::parse($from_date)->year;

        return view("admin.".self::$name.".payments-print", $data);
    }

}

