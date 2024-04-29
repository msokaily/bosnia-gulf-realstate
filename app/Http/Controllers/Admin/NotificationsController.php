<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notifications;
use App\Models\PushTokens;

class NotificationsController extends Controller
{
    public static $images_dir = 'public/uploads/notifications/';
    public function __construct()
    {
        view()->share([
            'locales' => Language::all(),
            'setting' => Settings::query()->first(),
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.notifications.send_notification');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function sendnotif(Request $request)
    {
        $notification = new Notifications();
        $notification->title = [
            'en' => request('title_en'),
            'ar' => request('title_ar')
        ];

        $notification->details = [
            'en' => request('body_en'),
            'ar' => request('body_ar')
        ];
        $notification->save();

        $heading = array(
            "en" => $notification->getTranslation('title', "en"),
            "ar" => $notification->getTranslation('title', "ar")
        );


        $content = array(
            "en" => $notification->getTranslation('details', "en"),
            "ar" => $notification->getTranslation('details', "ar")
        );
        
        $tokens = PushTokens::all()->pluck('push_token');

        $fields = array(
            'app_id' => "6cae4663-31ba-4931-a753-c9a31c65597b",
            'data' => array("type" => "notification"),
            // 'include_player_ids' => $tokens,
            'contents' => $content,
            'headings' => $heading,
            'included_segments' => ["All"],            
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
        
        return redirect()->back()->with('status', __('common.notify_sent'));
    }

}
