<?php
namespace App\Http\Controllers\Divota;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Worksheet\Validations;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Accommodation::where('type', 'rooms')->where('status', 1)->orderBy('id', 'desc')->get();
        $apartments = Accommodation::where('type', 'apartments')->where('status', 1)->orderBy('id', 'desc')->get();
        $villas = Accommodation::where('type', 'villas')->where('status', 1)->orderBy('id', 'desc')->get();
        
        $page_name = 'Home';

        return view('divota.home', [
            'rooms' => $rooms,
            'apartments' => $apartments,
            'villas' => $villas,
            'page_name' => $page_name,
        ]);

    }

    public function profile()
    {
        return view('divota.profile', [
            'user' => auth()->user(),
            'page_name' => 'Profile',
        ]);
    }
    
    public function updateProfile(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'oib' => 'sometimes|string|nullable|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.Auth::id(),
            'mobile' => 'sometimes|string|nullable|max:191|unique:users,mobile,'.Auth::id(),
            'country' => 'sometimes|nullable|string|max:191',
            'city' => 'sometimes|string|nullable|max:191',
            'address' => 'sometimes|string|nullable|max:191',
            'postal_code' => 'sometimes|string|nullable|max:191',
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }
        $data = $request->only(['first_name', 'last_name', 'email', 'mobile', 'oib', 'country', 'city', 'address', 'postal_code']);
        Auth::user()->update($data);
        return redirect()->back()->with('status', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return redirect()->back()->withErrors(['wrong_password' => 'Incorrect current password!']);
        }
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }
        $data = $request->only(['first_name', 'last_name', 'email', 'mobile', 'oib', 'country', 'city', 'address', 'postal_code']);
        Auth::user()->update($data);
        return redirect()->back()->with('status', 'Password updated successfully!');
    }

    public function bookings()
    {
        $data['orders'] = Booking::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(20);
        $data['page_name'] = 'Bookings';
        return view('divota.bookings', $data);
    }
    public function changepass()
    {
        return view('divota.changepass', [
            'page_name' => 'Change Password',
        ]);
    }
}

