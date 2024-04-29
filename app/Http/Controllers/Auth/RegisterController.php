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
use Carbon\Carbon;
use Illuminate\Support\Str;

class RegisterController extends Controller
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

    public function pay_boncard(Request $request)
    {
        $card_number = '6299120018655434';
        // dd($amount);
        // $amount = number_format((float)$amount, 2, '.', '');
        // $amount = str_replace(".",'',$amount);
        $trx = Str::random(9);
        
        $amount = 100;
        $cDate = Carbon::now()->format('Ymd');
        $cTime = Carbon::now()->format('his');

        $params = "PAYMENT+".$trx."+".$cDate."+".$cTime."+UM000001+".$card_number."+".$amount."+3r5@5t&56z";
        // $params = "PAYMENT+hWmh407Up+20210901+021546+UM000001+6299120018655434+150+3r5@5t&56z";
        $hash = hash_hmac('sha256', $params, "3r5@5t&56z", true);
        // dd($params);
        $signature = base64_encode($hash);

        $fields = array(
            "userId" => "unmeat",
            "trxReferenceNr" => $trx,
            "dateYYYYMMDD" => $cDate,
            "timeHHMMSS" => $cTime,
            "merchantName" => "UNMEAT RESTAURANT",
            "merchantId" => "unmeat",
            'terminalId' => "UM000001",
            'cardNumber' => $card_number,
            "cvc" => 317,
            "amount" => 1.00,
            "partialApproval" => false,
            "currency" => "CHF",
            'signature' => $signature
        );

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://paymentservice.boncard.ch/api/v1/payment");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-product: application/json; charset=utf-8',
                                        'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

        $response = curl_exec($ch);
        $response = json_decode($response, true);
        dd($response);
        return $response;
    
    }

    public function register(Request $request)
    {
        // Here the request is validated. The validator method is located
        // inside the RegisterController, and makes sure the name, email
        // password and password_confirmation fields are required.
        
        $messages = array(
            'email.unique' => __('validation.email_unique'),
            'password.min' => __('validation.password_6_min')
        );

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:60',
            'last_name' => 'required|string|max:60',
            'email' => 'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|string|min:6|confirmed',
            'mobile' => 'required',
            'gender' => 'required'
        ], $messages);

        if ($validator->fails())
            return response()->json([
                'status' => False,
                'code' => 422,
                'message' => 'error',
                'data' => ["errors" => $validator->errors()],
            ], 422);
            

        // A Registered event is created and will trigger any relevant
        // observers, such as sending a confirmation email or any 
        // code that needs to be run as soon as the user is created.
        event(new Registered($user = $this->create($request->all())));
        
        // After the user is created, he's logged in.
        $this->guard()->login($user);

        // And finally this is the hook that we want. If there is no
        // registered() method or it returns null, redirect him to
        // some other URL. In our case, we just need to implement
        // that method to return the correct response.
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        $user->generateToken();
        $user->generateActivationToken();
        $user->notify(new SignupActivate($user));
        // $user->sendEmailVerificationNotification();

        $userr = User::where('email',$user->email)->withAll()->first();
        return response()->json([
            'status' => True,
            'code' => 200,
            'message' => 'success',
            'data' => ['user' => $userr],
        ], 200);
    }

    protected function create(array $data)
    {
        if(isset($data['email'])){

            $password = Hash::make($data['password']);

            return User::create([
                'role' => 3,
                'password' => $password,
                'activation_token' => Str::random(60),
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'mobile' => $data['mobile'],
                'gender' => $data['gender'],
                // 'birth_day' => Carbon::parse($data['birth_day'])->format("Y-m-d"),
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
            return ('<h1>Invalid activation token!</h1><script type="text/javascript">setTimeout("window.close();", 3000);</script>');
        }
        $user->status = 1;
        $user->activation_token = '';
        $user->email_verified_at = Carbon::now();
        $user->save();

        if($user != Null){
            $email = $user->email;

            if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
                $tmp = explode('@', $email);
                $domain = end($tmp);
                $corprate = \App\Models\Corporates::where('domain',$domain)->first();
                if($corprate != Null){
                    $user->corporate_id = $corprate->id;
                    $user->save();
                }
            }
            self::sendNotification($user);
        }
        if($lang == 'de'){
            return ('<h1>Thank you for verifying your account!</h1><script type="text/javascript">setTimeout("window.close();", 3000);</script>');
        }else if($lang == 'en'){
            return ('<h1>Thank you for verifying your account!</h1><script type="text/javascript">setTimeout("window.close();", 3000);</script>');
        }
    }

    public static function sendNotification($user)
    {

        $content = array(
            "de" => 'Account Confirmation',
            "en" => 'Account Confirmation',
        );

        $heading = array(
            "en" => "UNMEAT",
            "de" => "UNMEAT",
        );

        $tokens = [$user->push_token];
        $fields = array(
        'app_id' => "61998553-843b-4766-9694-37990eeb8872",
        'data' => array("type" => "user_verified", "user" => $user),
        'include_player_ids' => $tokens,
        'contents' => $content,
        'headings' => $heading,
        "web_push_topic" => 'Account Confirmation'.rand(111,999),
        // 'large_icon' => "https://lh5.googleusercontent.com/JQrYiampwHlKEn7wqorT2vh3ovrBy1PZquv5ycgz0zmscpqrfJmVfCXYxbvnwpW0wW41P11W0wbzxLQZHR5-=w1366-h625-rw",
        // 'small_icon' => "https://lh5.googleusercontent.com/JQrYiampwHlKEn7wqorT2vh3ovrBy1PZquv5ycgz0zmscpqrfJmVfCXYxbvnwpW0wW41P11W0wbzxLQZHR5-=w1366-h625-rw",
        );


        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-product: application/json; charset=utf-8',
                                        'Content-Type: application/json',
                                        'Authorization: Basic NjU0NWY3ZjQtMTgwZS00MTNiLThhZmEtNTJjMmIwZDdjZTk1'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

        $response = curl_exec($ch);
        curl_close($ch);
        // dd($response);
    }
}
