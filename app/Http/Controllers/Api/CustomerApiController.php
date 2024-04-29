<?php

namespace App\Http\Controllers\Api;

use App\Models\Activities;
use App\Models\ActivityUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Transactions;
use App\Models\Contactus;
use App\Models\CreditCard;
use App\Models\Notifications;
use App\Models\UsersRequests;
use App\Models\PushTokens;
use App\Models\Wallets;
use App\Models\ActivityUsersItems;
use App\Models\Log;
use App\Models\Settings;
use App\Password_resets;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ResetPasswordForApi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class CustomerApiController
{

    private $user;

    public function __construct()
    {
        if(Auth::guard('api')->check()){
            $this->user = auth()->guard('api')->user();
        }
    }

    public function ResetPasswordApi(Request $request)
    {
        $request->validate([
            'value' => 'required',
            'type' => 'required|in:email,phone',
            'lang' => 'required|in:en,ar',
        ]);

        $value = $request->input('value');
        $type = $request->input('type');
        $lang = $request->input('lang');

        $field = $type === 'email' ? 'email' : 'phone';
        $user = User::where($field, $value)->first();

        $user_whats = User::where('whatsapp', $value)->first();
        if($type == 'phone' AND $user_whats != Null){

            $pasRes = new Password_resets;
            $pasRes->email = $user->whatsapp;
            $random = rand(10000, 99999); 
            $pasRes->token = Hash::make($random);
            $pasRes->save();

            $client = new Client();

            $response = $client->post('https://graph.facebook.com/v17.0/105954558954427/messages', [
                'headers' => [
                    'Authorization' => 'Bearer EAAEiGYLZBBWoBOzRc5eI9XYoHwMie1uerzwO1ZCsAAdINgNdQrYjgyNZCusneZCwDELoiyeeMofa70S0qqZCmTpdtfOZAxvhZAJWvbiDYAVNmkxKXS61vqQhi5vYhQ6SLZClg4HLnTzOsgAfVnZCkPdaxiIfVaVaeCjZCSzz6CnNsfh7OQAex2csqgEwZAZCU92fHQsjXOmZCVWvjoZBa1TfV2kMEK7SkwZCMBvi1B0QwKZAp7TPjDJI', // Replace with your access token
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'messaging_product' => 'whatsapp',
                    'to' => $user->whatsapp,
                    'type' => 'template',
                    'template' => [
                        'name' => 'hello_world',
                        'language' => [
                            'code' => 'en_US',
                        ],
                    ],
                ],
            ]);
            
            $responseBody = $response->getBody()->getContents();
            dd($responseBody);
        }else{
            if ($user) {
                $user->notify(new ResetPasswordForApi($user, $lang));
                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => 'success',
                    'data' => null,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => 422,
                    'message' => __('common.email_phone_not_exist'),
                    'data' => null,
                ], 422);
            }
        }
    }

    public function check_token(Request $request)
    {
        $email = request('value');
        $token = request('token');

        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'value' => 'required'     
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => False,
                'code' => 422,
                'message' => 'error',
                'data' => ['errors'=>$validator->errors()],
            ], 422);
        }

        $pasRes = Password_resets::where('email',$email)->where('created_at', '>', Carbon::now()->subMinutes(5)->toDateTimeString())->orderBy('id','desc')->first();
        if($pasRes != Null){
            if(Hash::check($token, $pasRes->token)){
                return response()->json([
                    'status' => True,
                    'code' => 200,
                    'message' => 'success',
                    'data' => ['message' => 'correct token'],
                ], 200);
                   
            }else{
                return response()->json([
                    'status' => False,
                    'code' => 422,
                    'message' => __('common.invalid_token'),
                    'data' => null,
                ], 422);
            }
        }else{
            return response()->json([
                'status' => False,
                'code' => 422,
                'message' => __('common.invalid_token'),
                'data' => null,
            ], 422);
        }      
    }

    public function changePassword(Request $request){
        $oldPassword = request('old_password');
        $user = User::where('id',$this->user->id)->first();

        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:6',
            'newPassword' => 'min:6|required_with:confirm_password|same:PasswordConfirm',
            'PasswordConfirm' => 'min:6'      
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => False,
                'code' => 422,
                'message' => 'error',
                'data' => ['errors'=>$validator->errors()],
            ], 422); 
        }

        if(Hash::check($oldPassword,$user->password) ){
            $user->password = Hash::make(request('newPassword'));
            $user->last_login = Carbon::now();
            $user->save();
            return response()->json([
                'status' => True,
                'code' => 200,
                'user' => $user,
                'data' => null,
            ], 200);        
        }

        return response()->json([
            'status' => False,
            'code' => 422,
            'message' => 'error',
            'data' => ['errors'=>__('website.old_password_wrong')],
        ], 422); 

    }

    
    public function ChangePasswordApi(Request $request)
    {
        $email = request('value');
        $token = request('token');
        $password = request('password');
        $passwordConfirm = request('passwordConfirm');

        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'value' => 'required',
            'password' => 'required|min:6',
            'passwordConfirm' => 'required|min:6',        
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => False,
                'code' => 422,
                'message' => 'error',
                'data' => ['errors'=>$validator->errors()],
            ], 422);
        }

        $pasRes = Password_resets::where('email',$email)->where('created_at', '>', Carbon::now()->subMinutes(5)->toDateTimeString())->orderBy('id','desc')->first();
        if($pasRes != Null){
            if(Hash::check($token, $pasRes->token)){
                if($password == $passwordConfirm){
                    $user = User::where('email',$email)->first();
                    $user->password = Hash::make($password);
                    $user->last_login = Carbon::now();
                    $user->generateToken();
                    $user->save();
                    Password_resets::where('email',$email)->delete();
                    return response()->json([
                        'status' => True,
                        'code' => 200,
                        'message' => 'success',
                        'data' => ['user' => $user],
                    ], 200);
                }else{
                    return response()->json([
                        'status' => False,
                        'code' => 422,
                        'message' => __('common.confirmation_failed'),
                        'data' => null,
                    ], 422);
                } 
                   
            }else{
                return response()->json([
                    'status' => False,
                    'code' => 422,
                    'message' => __('common.invalid_token'),
                    'data' => null,
                ], 422);
            }
        }else{
            return response()->json([
                'status' => False,
                'code' => 422,
                'message' => __('common.invalid_token'),
                'data' => null,
            ], 422);
        }      
    }  

    public function profile()
    {
        $user_transactions = Transactions::where('sender_id',$this->user->id)->orWhere('receiver_id',$this->user->id)->orderBy('id','desc')->paginate(30);

        if(request('transactions_order') == 'older'){
            $user_transactions = Transactions::where('sender_id',$this->user->id)->orWhere('receiver_id',$this->user->id)->orderBy('id','asc')->paginate(30);
        }
        $user = User::where('id', $this->user->id)->first();

        $cards = CreditCard::where('user_id', $user->id)->get();
        $cards->each(function ($card) {
            $card->makeHidden('password');
        });
        $user->cards = $cards;

        return response()->json([
            'status' => True,
            'code' => 200,
            'message' => 'success',
            'data' => ['user' => $user, 'user_transactions' => $user_transactions, 'cards' => $cards],
        ], 200);
    }

    

    public function transactions(Request $request)
    {
        $transactions = Transactions::where(function ($query) {
            $query->where('sender_id', $this->user->id)
                ->orWhere('receiver_id', $this->user->id);
        });
        
        if (request('transactions_order') == 'older') {
            $transactions = $transactions->orderBy('id', 'asc');
        } else {
            $transactions = $transactions->orderBy('id', 'desc');
        }
        
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
        
            $transactions->where(function ($query) use ($searchTerm) {
                $query->whereHas('sender', function ($query) use ($searchTerm) {
                    $query->where('first_name', 'LIKE', $searchTerm)
                        ->orWhere('last_name', 'LIKE', $searchTerm);
                })->orWhereHas('receiver', function ($query) use ($searchTerm) {
                    $query->where('first_name', 'LIKE', $searchTerm)
                        ->orWhere('last_name', 'LIKE', $searchTerm);
                });
            });
        }
        
        $transactions = $transactions->with([
            'sender' => function ($query) {
                $query->select('id', 'first_name', 'father_name', 'last_name', 'phone', 'id_number', 'email');
            },
            'receiver' => function ($query) {
                $query->select('id', 'first_name', 'father_name', 'last_name', 'phone', 'id_number', 'email');
            },
        ])->paginate(30);
        
        $transactions->getCollection()->map(function ($transaction) {
            $transaction->sender->makeHidden(['wallet', 'details']);
            $transaction->receiver->makeHidden(['wallet', 'details']);
            return $transaction;
        });
        
        
            
        return response()->json([
            'status' => True,
            'code' => 200,
            'message' => 'success',
            'data' => ['transactions' => $transactions],
        ], 200);
    }

    public function notifications()
    {
        $notifications = Notifications::orderBy('id','desc')->paginate(30);

        return response()->json([
            'status' => True,
            'code' => 200,
            'message' => 'success',
            'data' => ['notifications' => $notifications],
        ], 200);
    }

    public function company_customers()
    {
        $users = User::where('user_type', 'Employee')->where('status', 1)->where('id', '!=', $this->user->id)->where('company_id', $this->user->company_id)->paginate(30);

        return response()->json([
            'status' => True,
            'code' => 200,
            'message' => 'success',
            'data' => [
                'users' => $users
            ],
        ], 200);
    }

    
        
    public function check_user(Request $request)
    {
        $request->validate([
            'id_number' => 'required'
        ]);

        $receiverId = $request->id_number;
        $id = $request->id;
        $companyId = $this->user->company_id;

        // $receiver = User::where('id_number', $receiverId)->where('company_id', $companyId)->where('status', 1)->first();
        $receiver = User::where(function ($query) use ($receiverId, $id) {
            $query->where('id_number', $receiverId)
                  ->orWhere('id', $id);
        })
        ->where('company_id', $companyId)
        ->where('status', 1)
        ->first();

        
        if (!$receiver) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => 'The receiver does not exist',
                'data' => null,
            ], 422);
        }else{
            return response()->json([
                'status' => True,
                'code' => 200,
                'message' => 'success',
                'data' => [
                    'user' => $receiver
                ],
            ], 200); 
        }
    }

    public function send_transaction(Request $request)
    {
        $request->validate([
            'id_number' => 'required',
            'currency' => 'required|in:USD,TRY,SYP',
            'amount' => 'required|numeric|min:0',
        ]);

        $receiverId = $request->id_number;
        $currency = $request->currency;
        $amount = $request->amount;
        
        $companyId = $this->user->company_id;
        $receiver = User::where('id_number', $receiverId)->where('company_id', $companyId)->where('status', 1)->first();

        if($request->has('company')){
            $receiver = User::where('id', $companyId)->first();
        }
        
        if (!$receiver) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => 'The receiver does not exist',
                'data' => null,
            ], 422);
        }
        
        
        $senderWallet = Wallets::where('user_id', $this->user->id)->first();

        switch ($currency) {
            case 'USD':
                if ($senderWallet->usd < $amount) {
                    return response()->json([
                        'status' => false,
                        'code' => 422,
                        'message' => "insufficient_balance",
                        'data' => null,
                    ], 422);
                }
                $senderWallet->usd -= $amount;
                break;
            case 'SYP':
                if ($senderWallet->syp < $amount) {
                    return response()->json([
                        'status' => false,
                        'code' => 422,
                        'message' => "insufficient_balance",
                        'data' => null,
                    ], 422);
                }
                $senderWallet->syp -= $amount;
                break;
            case 'TRY':
                if ($senderWallet->try < $amount) {
                    return response()->json([
                        'status' => false,
                        'code' => 422,
                        'message' => "insufficient_balance",
                        'data' => null,
                    ], 422);
                }
                $senderWallet->try -= $amount;
                break;
            default:
                return response()->json([
                    'status' => false,
                    'code' => 422,
                    'message' => "invalid_currency",
                    'data' => null,
                ], 422);
        }

        $senderWallet->save();

        $latestOrder = Transactions::orderBy('id', 'DESC')->withTrashed()->first();
        $latestOrder = $latestOrder ? $latestOrder->id : 0;

        $transaction = new Transactions();
        $transaction->currency = $currency;
        $transaction->amount = $amount;
        $transaction->company_id = $this->user->company_id;
        $transaction->sender_id = $this->user->id;
        $transaction->invoice_number = '#' . str_pad($latestOrder + 1, 6, "0", STR_PAD_LEFT);
        $transaction->receiver_id = $receiver->id;
        $transaction->save();

        $receiverWallet = Wallets::where('user_id', $receiver->id)->first();
        switch ($currency) {
            case 'USD':
                $receiverWallet->usd += $amount;
                break;
            case 'SYP':
                $receiverWallet->syp += $amount;
                break;
            case 'TRY':
                $receiverWallet->try += $amount;
                break;
        }
        $receiverWallet->save();

        try{
            sendnotif($receiver, $currency, $amount);
        }catch(\Exception $e){
            Log::create([
                'title' => 'Notification Error',
                'details' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'success',
            'data' => ['transaction' => $transaction],
        ], 200);
    }

    public function contact_us(Request $request)
    {

        $normal_validations = [
            'full_name' => 'required|string',
            'email' => 'email',
            'message' => 'required|string',
            'subject' => 'required|string',
            'type' => 'required|in:Problem,Suggestion'
        ];

        $validator = Validator::make($request->all(), $normal_validations);

        if ($validator->fails()) {
            return response()->json([
                'status' => False,
                'code' => 422,
                'message' => 'error',
                'data' => ['errors'=>$validator->errors()],
            ], 422); 
        }

        $new_message = new Contactus();
        $new_message->user_id = $this->user->id;
        $new_message->title = request('subject');
        $new_message->details = request('message');
        $new_message->full_name = request('full_name');
        $new_message->email = request('email');
        $new_message->mobile = request('mobile');
        $new_message->type = request('type');
        $new_message->save();

        // $to_email = "theo.favetto@gmail.com";
        // $data = array('new_message'=>$new_message);

        // try{
        //     Mail::send('emails.contact_us', $data, function($message) use ($to_email, $title) {
        //         $message->to($to_email)->bcc("hareth141@gmail.com")->subject("UNMEAT Inbox: ".$title);
        //         $message->from('ava@unmeat.com', 'UNMEAT');
        //     });
        // }catch(\Exception $e){
        // }
        
        return response()->json([
            'status' => True,
            'code' => 200,
            'message' => "sent",
            'data' => null,
        ], 200);  

    } 
    
    public function user_request(Request $request)
    {

        $normal_validations = [
            'first_name' => 'required|string',
            'father_name' => 'required|string',
            'last_name' => 'required|string',
            'id_number' => 'required|string',
            'whatsapp' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $normal_validations);

        if ($validator->fails()) {
            return response()->json([
                'status' => False,
                'code' => 422,
                'message' => 'error',
                'data' => ['errors'=>$validator->errors()],
            ], 422); 
        }

        $new_message = new UsersRequests();
        $new_message->first_name = request('first_name');
        $new_message->father_name = request('father_name');
        $new_message->last_name = request('last_name');
        $new_message->id_number = request('id_number');
        $new_message->whatsapp = request('whatsapp');
        $new_message->details = request('details');
        $new_message->save();
        
        return response()->json([
            'status' => True,
            'code' => 200,
            'message' => "success",
            'data' => null,
        ], 200);  

    }

    public function activities(Request $request)
    {
        $activities = ActivityUsers::where('user_id', $this->user->id);

        if (request('activities_order') == 'older') {
            $activities = $activities->orderBy('id', 'asc');
        } else {
            $activities = $activities->orderBy('id', 'desc');
        }

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';

            $activities->where(function ($query) use ($searchTerm) {
                $query->whereHas('activity', function ($query) use ($searchTerm) {
                    $query->where('title', 'LIKE', $searchTerm);
                });
            });
        }

        $activities = $activities->whereHas('activity', function ($query) {
            $query->where('activated', 1)
                ->where('publish_date', '<=', now());
        })->with(['activity' => function ($query) {
            $query->select('id', 'title', 'type');
        }])->with(['service_provider' => function ($query) {
            $query->select('id', 'first_name');
        }])->paginate(30);


        return response()->json([
            'status' => True,
            'code' => 200,
            'message' => "success",
            'data' => ['activities' => $activities],
        ], 200);  
    }

    
    public function activity_user_print_items(Request $request)
    {
        $normal_validations = [
            'activity_user_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $normal_validations);

        if ($validator->fails()) {
            return response()->json([
                'status' => False,
                'code' => 422,
                'message' => 'error',
                'data' => ['errors'=>$validator->errors()],
            ], 422); 
        }

        $activity_user = ActivityUsers::where('id', $request->activity_user_id)->where('user_id', $this->user->id)->first();
        
        if($activity_user == Null){
            return response()->json([
                'status' => False,
                'code' => 422,
                'message' => 'error',
                'data' => ['errors'=>"Not Found"],
            ], 422); 
        }

        $activity = Activities::where('id', $activity_user->activity_id)->first();

        $activityId = $activity->id;
        $providerId = $activity_user->provider_id;

        $activity_items = ActivityUsersItems::where('activity_id', $activityId)
        ->where('provider_id', $providerId)
        ->where('user_id', $activity_user->user_id)
        ->get();

        $page_name = "Items Invoice";
        
        $provider = User::where('id', $activity_user->provider_id)->first();
        $totalPricesSum = 0;

        return view('admin.documents.it_invoice', 
            compact('activity', 'activity_user', 'page_name', 'provider', 'activity_items', 'totalPricesSum')
        );
    } 

    public function activity_user_print_salary(Request $request)
    {
        $normal_validations = [
            'activity_user_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $normal_validations);

        if ($validator->fails()) {
            return response()->json([
                'status' => False,
                'code' => 422,
                'message' => 'error',
                'data' => ['errors'=>$validator->errors()],
            ], 422); 
        }

        $activity_user = ActivityUsers::where('id', $request->activity_user_id)->where('user_id', $this->user->id)->first();
        
        if($activity_user == Null){
            return response()->json([
                'status' => False,
                'code' => 422,
                'message' => 'error',
                'data' => ['errors'=>"Not Found"],
            ], 422); 
        }

        $activity = Activities::where('id', $activity_user->activity_id)->first();
        $activityId = $activity->id;
        $providerId = $activity_user->provider_id;

        $activity_items = ActivityUsersItems::where('activity_id', $activityId)
        ->where('provider_id', $providerId)
        ->where('user_id', $activity_user->user_id)
        ->get();

        $page_name = "Salary Receipt";
        
        $provider = User::where('id', $activity_user->provider_id)->first();
        $totalPricesSum = 0;

        return view('admin.documents.sal_receipt', 
            compact('activity', 'activity_user', 'page_name', 'provider', 'activity_items', 'totalPricesSum')
        );
    } 

    public function transaction(Request $request)
    {
        $normal_validations = [
            'transaction_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $normal_validations);

        if ($validator->fails()) {
            return response()->json([
                'status' => False,
                'code' => 422,
                'message' => 'error',
                'data' => ['errors'=>$validator->errors()],
            ], 422); 
        }

        $transaction = Transactions::where('id', request('transaction_id'))
        ->where(function ($query) {
            $query->where('sender_id', $this->user->id)
                  ->orWhere('receiver_id', $this->user->id);
        })
        ->first();

        
        if($transaction == Null){
            return response()->json([
                'status' => False,
                'code' => 422,
                'message' => 'error',
                'data' => ['errors'=>"Not Found"],
            ], 422); 
        }

        return view('admin.transactions.invoice', ['transaction' => $transaction]);
    }

    public function save_push_token(Request $request)
    {
        if($request->push_token != Null){
            $user_push_tokens = PushTokens::where('user_id', $this->user->id)->where('push_token', $request->push_token)->first();
            if($user_push_tokens == Null){
                $user_push_tokens = new PushTokens;
            }
            $user_push_tokens->user_id = $this->user->id;
            $user_push_tokens->push_token = $request->push_token;
            $user_push_tokens->save();
        }
        

        return response()->json([
            'status' => True,
            'code' => 200,
            'message' => "success",
            'data' => Null,
        ], 200);  
    }

    public function about_us()
    {
        $settings = Settings::first();
        
        return response()->json([
            'status' => True,
            'code' => 200,
            'message' => "success",
            'data' => $settings,
        ], 200);  
    }

}

function sendnotif($receiver, $currency, $amount)
{
    $notification = new Notifications();
    $notification->title = [
        'en' => 'New Transaction',
        'ar' => 'حوالة جديدة'
    ];
    
    $notification->details = [
        'en' => 'You have received a new transaction of ' . $amount . ' ' . $currency,
        'ar' => 'لقد تلقيت حوالة جديدة بقيمة ' . $amount . ' ' . $currency
    ];        
    $notification->save();

    $heading = array(
        "en" => 'New Transaction',
        "ar" => 'حوالة جديدة'
    );


    $content = array(
        "en" => 'You have received a new transaction of ' . $amount . ' ' . $currency,
        "ar" => 'لقد تلقيت حوالة جديدة بقيمة ' . $amount . ' ' . $currency
    );
    
    $tokens = PushTokens::where('user_id', $receiver->id)->pluck('push_token');

    $fields = array(
        'app_id' => "6cae4663-31ba-4931-a753-c9a31c65597b",
        'data' => array("type" => "transaction"),
        'include_player_ids' => $tokens,
        'contents' => $content,
        'headings' => $heading,
        // 'included_segments' => ["All"],            
        "web_push_topic" => 'New Notification'.rand(111,999)
    );


    $fields = json_encode($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                    'Authorization: Basic MTRhY2I1YTgtY2U3MS00Y2M3LTk1OWEtZjMwNjJhMjA0N2I2'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

    $response = curl_exec($ch);
    
    // return redirect()->back()->with('status', __('common.notify_sent'));
}

?>