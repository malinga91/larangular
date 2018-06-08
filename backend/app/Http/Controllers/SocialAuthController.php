<?php

namespace App\Http\Controllers;

use App\User;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Http\Request;
use JWTAuth;


class SocialAuthController extends Controller
{
    private $fb;
    private $helper;
    private $token;

    function __construct(Facebook $fb)
    {
        $this->fb = $fb;
        $this->helper = $fb->getRedirectLoginHelper();

    }

    public function login()
    {
        $loginUrl = $this->helper->getLoginUrl(config('facebook.other.redirect_url'), config('facebook.other.scope'));

        return response()->json([
            'status' => true,
            'data' => [
                'login_url' => $loginUrl
            ]
        ]);

    }

//    public function callback()
//    {
//        if (isset($_GET['state'])) {
//            $this->helper->getPersistentDataHandler()->set('state', $_GET['state']);
//        }
//
//        try {
//            $this->token = $this->helper->getAccessToken();
//
//        } catch (FacebookSDKException $e) {
//
//            return response()->json(['status' => false, 'message' => $e->getMessage()]);
//        }
//
//        return redirect()->away('http://localhost:4200/login?code=' . $this->token);
//
//    }

    public function getTokenFromCode(Request $request)
    {

        try {

            $appid = config('facebook.config.app_id');
            $secret = config('facebook.config.app_secret');
            $redirect_url = config('facebook.other.redirect_url');
            $code = $request->input('code');

            $token_url = "https://graph.facebook.com/v3.0/oauth/access_token";
            $token_url .= "?client_id=" . $appid;
            $token_url .= "&redirect_uri=" .$redirect_url;
            $token_url .= "&client_secret=" .$secret;
            $token_url .= "&code=" . $code;


            $response = $this->getAccessTokenFromUrl($token_url);

            $this->token = $response->access_token;

            if($this->token) {
                $fbUser = $this->getFacebookUser($this->token);

                $user = User::where('fb_id', $fbUser['id'])->first();

                if(!$user) {
                    $user = $this->createUserFrom($fbUser);
                }

               $userToken = JWTAuth::fromUser($user);

            }

        } catch (FacebookSDKException $e) {
            return $e->getMessage();
        }

        return response()->json(['status' => true, 'token' => $userToken, 'user' => $user]);

    }

    public function logout()
    {
        $logoutUrl = $this->helper->getLogoutUrl($this->token);

        return $logoutUrl;
    }

    private function getAccessTokenFromUrl($token_url) {
        $ch = curl_init($token_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'H.H\'s PHP CURL script');

        $response_body = curl_exec($ch);
        curl_close($ch);

        return json_decode($response_body);

        //https://stackoverflow.com/questions/43425590/php-read-json-file-from-remote-url

    }

    private function getFacebookUser($token) {
        $response = $this->fb->get('/me?fields=id,name,first_name,last_name,email,picture', $token);

       return $response->getGraphUser()->asArray();

    }

    private function createUserFrom($fbUser) {
        $user = new User();
        $user->fb_id = $fbUser['id'];
        $user->first_name = $fbUser['first_name'];
        $user->last_name = $fbUser['last_name'];
        $user->name = $fbUser['name'];
        $user->email = isset($fbUser['email']) ? $fbUser['email'] : '';
        $user->facebook_token = $this->token;
        $user->profile_pic = 'usrl';

        $user->save();

        return $user;
    }

}
