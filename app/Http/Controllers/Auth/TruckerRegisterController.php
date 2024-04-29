<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Notifications\SignupActivate;
use App;
use Illuminate\Support\Str;
use App\Models\Truckertrucks;
use App\Models\Notifications;

class TruckerRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    public function truckerRegister(Request $request)
    {

        // Here the request is validated. The validator method is located
        // inside the RegisterController, and makes sure the name, email
        // password and password_confirmation fields are required.
        $this->validator($request->all())->validate();

        // A Registered event is created and will trigger any relevant
        // observers, such as sending a confirmation email or any 
        // code that needs to be run as soon as the user is created.
        event(new Registered($user = $this->create($request->all())));
        
        $trucks = request('trucks');
        $trucks = explode(",",$trucks);
        foreach($trucks as $truck){
            $truckerTruck = new Truckertrucks();
            $truckerTruck->truck_id = $truck;
            $truckerTruck->trucker_id = $user->id;
            $truckerTruck->save();
        }

        $licences = Null;

        if($request->hasfile('licences')){
            foreach($request->file('licences') as $image)
            {
                $name = '/images/licences/'.rand(111111,999999).$image->getClientOriginalName();
                $image->move(public_path().'/images/licences/', $name);  

                // $fileName = $file->getClientOriginalName();
                // Storage::disk('news')->put($fileName, File::get($image));

                $licences[] = $name;  
            }
        }

        $user->licences = json_encode($licences,JSON_UNESCAPED_SLASHES);
        $user->save();

        $notification = new Notifications();
        $notification->user_id = 0;
        $title = (object) [
            'title_en' => 'Trucker <b>'.$user->fullname.'</b> Applied to Work in Makaseb!',
            'title_ar' => 'السائق <b>'.$user->fullname.'</b> قام بالتقدم للعمل في مكاسب !',
        ];
        $title = json_encode($title);
        
        $details = (object) [
            'user_id' => $user->id,
        ];
        $details = json_encode($details);

        $notification->title = $title;
        $notification->details = $details;
        $notification->type = 'Apply';
        $notification->save();
        // $user->notify(new SignupActivate($user));

        $lang = $request->lang;
        App::setLocale($lang);

        return response()->json([
            'errors' => __('common.complete_please_wait_until_approve'),
        ], 200);
        
        // After the user is created, he's logged in.
        // $this->guard()->login($user);

        // And finally this is the hook that we want. If there is no
        // registered() method or it returns null, redirect him to
        // some other URL. In our case, we just need to implement
        // that method to return the correct response.
        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        $user->generateToken();
        $lang = $request->lang;
        // $user->notify(new SignupActivate($user));

        $userr = User::where('email',$user->email)->first();
        // $user = $user->toArray();
        return response()->json(['data' => $userr], 201);
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(isset($data['lang'])){
            if($data['lang'] == 'ar'){
                App::setLocale('ar');
            }else{
                App::setLocale('en');
            }
        }

        $validator = Validator::make($data, [
            'fullname' => 'required|string|max:60',
            'email' => 'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|string|min:6|confirmed',
            'mobile' => 'required|min:6',
            'trucker_type' => 'required|numeric|max:2',
            'trucks' => 'required',
            'licences.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            header("HTTP/1.0 400 Not Found");
            exit(json_encode($errors));
        } else {
            return $validator;
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    public function error($errors)
    {
        return response()->json($errors, 400);
    }

    protected function create(array $data)
    {
        if(isset($data['email'])){
            
            $password = Hash::make($data['password']);

            return User::create([
                'role' => 2,
                'type' => 2,
                'password' => $password,
                'trucker_type' => $data['trucker_type'],
                'activation_token' => Str::random(60),
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'mobile' => $data['mobile'],
            ]);
          
        }   
        
    }

    public function signupActivate($token)
    {
        $tokenn = substr($token, 0, strpos($token, '&lang'));
        $arr = explode('&lang', $token);
        $lang = $arr[1];

        $user = User::where('activation_token', $tokenn)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user->status = 1;
        $user->activation_token = '';
        $user->save();
        if($lang == 'ar'){
            return ('<h1>تم تفعيل حسابك</h1><script type="text/javascript">setTimeout("window.close();", 3000);</script>');
        }else if($lang == 'en'){
            return ('<h1>Your Account is Activated!</h1><script type="text/javascript">setTimeout("window.close();", 3000);</script>');
        }
    }
}
