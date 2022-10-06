<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FCMService
{ 
    public static function send($token,$data)
    {
        Http::acceptJson()->withToken(config('fcm.token'))->post(
            'https://fcm.googleapis.com/fcm/send',
            [
                'to' => $token,
                "content_available"=>true,
                'data'=>$data,
                // 'notification' => $notification,
            ]
        );
	
}
}