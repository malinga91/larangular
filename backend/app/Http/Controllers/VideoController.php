<?php

namespace App\Http\Controllers;

use Picovico\Lib3 as Picovico;

class VideoController extends Controller
{
    private $app_id;
    private $app_secret;
    private $device_id;
    private $pv;

     function __construct()
     {
         # initialize and authenticate
         $this->app_id =  '7db3a17dd768d51a22729c684b5aa4668a83f9d5e11ff81fe1181bab2c4872de';
         $this->app_secret =  'e17615810516a56f844ce53fbab1a922e552ae26033b18032b34af26d486bc79';
         $this->device_id = "com.malinga.deve";

         $this->pv = new Picovico($this->app_id, $this->app_secret, $this->device_id);
         $this->pv->authenticate();


     }

     public function getVideos() {

         //$pv->authenticated_api("POST", "me/videos", $payload, ["Content-Type"=>"application/json"]);

         dd( $this->pv->authenticated_api("GET", "me/videos", ["Content-Type"=>"application/json"]));

     }

     public function startVideo() {
         # build the video JSON
         $payload = [
             "style" => "vanilla_frameless",
             "quality" => 360,
             "name" => "Suraj Malinga Video",
             "aspect_ratio" => "16:9",
             "assets" => [
                 [
                     "music" => [
                         "id" => "aud_6j44J9zjbSQe54ZTTSqUj2"
                         # "url" => ".... some url ..."
                     ],
                     "frames" => [
                         $this->pv->text_slide("I love you", "my father"),
                         $this->pv->text_slide("Its a great thing....", "CSS to my HTML"),
                         $this->pv->image_slide("https://images.unsplash.com/photo-1481326086332-e77dd61a4ea1"),
                         $this->pv->text_slide("You", "make me complete")
                     ]
                 ]
             ]
         ];

         list($status, $code, $response) = $this->pv->authenticated_api("POST", "me/videos", $payload, ["Content-Type"=>"application/json"]);
         if($status){
             $video_id = $response['data'][0]['id'];
             # preview
             // $pv->authenticated_api("PUT", "me/videos/{$video_id}", ["preview"=>1]);
             # render
             $responses = $this->pv->authenticated_api("PUT", "me/videos/{$video_id}");
             dd($video_id, $responses);
         }else{
             dd($response);
         }
     }
}
