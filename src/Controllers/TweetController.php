<?php

namespace Nicolasfoco\ApiTwitter\Controllers;

use Nicolasfoco\ApiTwitter\Services\Twitter;
use Nicolasfoco\ApiTwitter\Utils\HTTPResponseCodes;

class TweetController
{
    public function new (): void
    {
        $twitter = new Twitter();
        $response = $twitter->getMe();

        if (isset($response['error'])) {
            response([
                'error' => true,
                'message' => $response['message'],
            ], HTTPResponseCodes::ServerError);
        }

        $newPost = $twitter->tweet('Tuitando via PHP e OAuth API!');

        if (isset($newPost['success'])) {
            response($newPost, HTTPResponseCodes::Ok);
        }

        response([
            'error' => true,
            'message' => $newPost['message'],
        ], HTTPResponseCodes::ServerError);
    }
}