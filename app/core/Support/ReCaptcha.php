<?php
namespace App\Core\Support;

class ReCaptcha
{   
    public static function checkReCaptchaV3($re_captcha)
    {
        $re_captcha_url = env('RECAPTCHA_URL');
        $re_captcha_secret_key = env('RECAPTCHA_SECRET_KEY');
        $re_captcha_site_key = env('RECAPTCHA_SITE_KEY');
        
        $prepare_parameters = [
            'secret' => $re_captcha_secret_key, 
            'response' => $re_captcha
        ];

        $parameters = http_build_query($prepare_parameters);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $re_captcha_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_POST, 1);

        // $headers = [];
        // $headers[] = "Content-Length: " . strlen($parameters);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $response = json_decode($result);
        // response
        // {
            // +"success": true
            // +"challenge_ts": "2023-03-08T23:28:21Z"
            // +"hostname": "localhost"
            // +"score": 0.9
            // +"action": "submit"
        // }

        return $response->success;
    }

}