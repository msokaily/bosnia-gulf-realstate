<?php
namespace App\Http\Controllers\Admin;

use App\Models\Contactus;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class ContactController extends Controller

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
        $routeName = Route::currentRouteName();
        if($request->has('reset') AND request('reset') == 'true'){
            session()->forget($routeName);
            return redirect()->route($routeName);
        }

        $items = Contactus::query();
        if ($request->has('email')) {
            if ($request->get('email') != null)
                $items->where('email', 'like', '%' . $request->get('email') . '%');
        }
        
        if ($request->has('mobile')) {
            if ($request->get('mobile') != null)
                $items->where('mobile', 'like', '%' . $request->get('mobile') . '%');
        }

        if ($request->has('type')) {
            $type = $request->input('type');
            if ($type === 'All' OR request('type') == "") {

            }else{
                $items->where('type', $request->get('type'));
            }
        }

        if ($request->get('from_date') && $request->get('to_date')) {
            $from_date = Carbon::createFromFormat('d/m/Y', $request->get('from_date'))->format('m/d/Y');
            $to_date = Carbon::createFromFormat('d/m/Y', $request->get('to_date'))->format('m/d/Y');

            $items->whereDate('created_at', '>=', Carbon::parse($from_date));
            $items->whereDate('created_at', '<=', Carbon::parse($to_date));
        }

        $items = $items->orderBy('id', 'desc')->get();
        
        return view('admin.inbox.home', [
            'items' => $items,
        ]);

    }

    public function send_reply(Request $request)
    {
        $msg = Contactus::where('id',request('msg_id'))->first();
        $subject = "UNMEAT Reply: ".$msg->title;

        $to_name = $msg->full_name;
        $to_email = $msg->email;

        if($to_email != Null){
            $data = array('reply_details'=>request('reply_details'));

            try{
                Mail::send('emails.reply', $data, function($message) use ($to_name, $to_email, $subject) {
                    $message->to($to_email, $to_name)->replyTo('theo@unmeat.com', 'Theo Favetto')->bcc("hareth141@gmail.com")->subject($subject);
                    // $message->to($to_email, $to_name)->cc("hareth141@gmail.com")->replyTo('hareth141@gmail.com', 'Theo Favetto')->subject($subject);
                    $message->from('unmeat0@gmail.com', 'UNMEAT');
                });
                $msg->is_replied = 1;
                $msg->save();
                
                return redirect()->back()->with('status', __('common.sent'));
            }catch(\Exception $e){
                return redirect()->back()->with('status', __('common.error'));
            }
        }
    }





    public function viewMessage($id)
    {
        Contactus::query()->where('id', $id)->update(['is_read' => 1]);
        $item = Contactus::query()->findOrFail($id);
        return view('admin.inbox.message', [
            'item' => $item,
        ]);
    }

    
    public function destroy($id)
    {
        $item = Contactus::query()->findOrFail($id);
        if ($item) {
            Contactus::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }


}

