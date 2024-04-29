<?php
namespace App\Http\Controllers\Divota;

use App\Http\Controllers\Controller;
use App\Models\Contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function index()
    {
        $page_name = 'Contact Us';

        return view('divota.contact', [
            'page_name' => $page_name,
        ]);

    }

    public function send(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'full_name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191',
            'mobile' => 'required|string|max:191',
            'title' => 'required|string|max:191',
            'details' => 'required|string|max:3500'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        $data = $request->only(['full_name', 'email', 'mobile', 'title', 'details']);
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }
        Contactus::create($data);
        return redirect()->back()->with('status', 'We received your message and we will reply as soon as possible.');
    }
}

