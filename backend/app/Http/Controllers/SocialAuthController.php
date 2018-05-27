<?php

namespace App\Http\Controllers;
session_start();

use Facebook\Exceptions\FacebookAuthenticationException;
use Facebook\Exceptions\FacebookClientException;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Exceptions\FacebookServerException;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;


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

//        //echo "<a href='{$loginUrl}'>Link</a>";
//        return response()->json([
//            'status' => true,
//            'data' => [
//                'login_url' => $loginUrl
//            ]
//        ]);
        return redirect()->away($loginUrl);

    }

    public function callback()
    {

        //var_dump($_GET['state']);

        if (isset($_GET['state'])) {

         //  dd( $this->helper->getPersistentDataHandler());
            $this->helper->getPersistentDataHandler()->set('state', $_GET['state']);
            //$this->helper->getPersistentDataHandler();
        }
        //dd($this->token = $this->helper->getPersistentDataHandler()->set('state', $_GET['state']), $this->token = $this->helper->getPersistentDataHandler()->get('state'), $this->helper->getAccessToken());
        try{
            $this->token = $this->helper->getAccessToken();

        }catch (FacebookSDKException $e) {
           // dd($this->helper->getPersistentDataHandler());
            dd('message', $e->getMessage());
        }catch (FacebookServerException $e){
            dd($e->getMessage());
        }catch (FacebookServerException $e) {
            dd($e->getMessage());
        }catch (FacebookAuthenticationException $e) {
            dd($e->getMessage());
        }catch (FacebookResponseException $e) {
            dd($e->getMessage());
        }



        echo $this->token;

        //return Redirect::to('http://localhost:4200/login?callback=test_function');
        //return redirect()->away('http://localhost:4200/login?callback=test_function');

    }

    public function logout() {
        $logoutUrl = $this->helper->getLogoutUrl($this->token);

        dd($logoutUrl);
    }

}
