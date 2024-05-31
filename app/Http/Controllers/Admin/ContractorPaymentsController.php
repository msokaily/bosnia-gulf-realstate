<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContractorPayment as TableName;
use App\Models\Realstate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class ContractorPaymentsController extends Controller
{
    static $name = 'contractor-payments';

    public function index(Request $request)
    {
        $items = TableName::query();

        $realstate = $request->input('realstate');
        if ($realstate) {
            $items->where('realstate_id', $realstate);
        } else {
            return redirect(route("admin.realestates.index"));
        }

        $items->orderBy('created_at', 'DESC');
        
        return view("admin.".self::$name.".home", [
            'items' => $items->get(),
            'total_sum' => $items->whereNotNull('paid_at')->sum('amount'),
            'realstate' => Realstate::find($realstate),
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
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $table = new TableName();
        $table->realstate_id = request('realstate_id');
        $table->reason = request('reason');
        $table->amount = request('amount');
        $table->note = request('note');
        $table->paid_at = request('paid_at', null);
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
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $table = TableName::query()->findOrFail($id);
        $table->reason = request('reason');
        $table->amount = request('amount');
        $table->note = request('note');
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
            $items->where('realstate_id', $realstate->id);
        } else {
            return redirect()->back()->withInput()->withErrors(['Unknown real estate!']);
        }

        $items->whereNotNull('paid_at');
        $items->orderBy('paid_at', 'ASC');

        $data['items'] = $items->get();
        
        return view("admin.".self::$name.".payments-print", $data);
    }

    public function pay($id, Request $request)
    {
        $item = TableName::where('id', $id)->first();
        if ($item) {
            if ($request->has('unpay')) {
                $item->paid_at = null;
            } else {
                $item->paid_at = Carbon::now();
            }
            $item->save();
        }
        return redirect()->back()->with('status', __('common.update'));
    }

}

