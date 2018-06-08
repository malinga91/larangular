<?php

namespace App\Http\Controllers;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Facebook;
use Illuminate\Http\Request;

class FacebookRequestsController extends Controller
{
    private $fb;

    public function __construct(Facebook $fb)
    {
        $this->fb = $fb;
        //return response()->json($user = auth()->user());

    }

    public function textPost() {

        try{
                $response = $this->fb->post('/202040763726221/feed', ['message' => 'Foo message'], 'EAAZAEO6CDrY0BAL6mMQ2QJLoFx0AddsYoOPsll3qDlWsLK1a6yeZAcQfZAKUuRf0SYOZBezwrcRAqtC5quQOoyeJHaYnfIctEX0rzISvzFtMDvoEZBHllZADw68AwFgyNZClNfVb1ZC0wN6pCRcaeeP6ejUirMxE9ZAqTf3Dp7mkdtr9s6BPxVEyzZCr5U772YWwCxjC2dzHWHNQZDZD');

        }catch (FacebookResponseException $exception) {
            return response()->json(['message' => $exception->getMessage()]);
        }

        return response()->json(['response' => $user = auth()->user()] );

    }

    public function videoPost() {


        $data = [
            'title' => 'My awesome video',
            'description' => 'More info about my awesome video.',
            'file_url' => 'https://www.sample-videos.com/video/mp4/720/big_buck_bunny_720p_20mb.mp4'
        ];

        //'source' => $this->fb->videoToUpload('https://www.sample-videos.com/video/mp4/720/big_buck_bunny_720p_20mb.mp4'),

        try{
            $response = $this->fb->post("/202040763726221/videos", $data, 'EAAZAEO6CDrY0BAL6mMQ2QJLoFx0AddsYoOPsll3qDlWsLK1a6yeZAcQfZAKUuRf0SYOZBezwrcRAqtC5quQOoyeJHaYnfIctEX0rzISvzFtMDvoEZBHllZADw68AwFgyNZClNfVb1ZC0wN6pCRcaeeP6ejUirMxE9ZAqTf3Dp7mkdtr9s6BPxVEyzZCr5U772YWwCxjC2dzHWHNQZDZD');

        }catch (FacebookResponseException $e) {
            return response()->json($e->getMessage());
        }

        return response()->json(['graphNode' => $response->getGraphNode()]);
    }
}
