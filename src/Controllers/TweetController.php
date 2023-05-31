<?php

namespace Nicolasfoco\ApiTwitter\Controllers;

use Nicolasfoco\ApiTwitter\Services\Twitter;
use Nicolasfoco\ApiTwitter\Utils\HTTPResponseCodes;

class TweetController
{
    public function new (): void
    {
        $twitter = new Twitter();
        $user = $twitter->getMe();

        if (isset($user['error'])) {
            response([
                'error' => true,
                'message' => 'Ocorreu um erro ao tentar realizar um tweet!',
            ], HTTPResponseCodes::ServerError);
        }

        $newPost = $twitter->tweet('Tuitando via PHP e OAuth API!');

        dd($newPost);

        if (isset($newPost['success'])) {
            response($newPost, HTTPResponseCodes::Ok);
        }

        response([
            'error' => true,
            'message' => 'Ocorreu um erro ao tentar realizar um tweet!',
        ], HTTPResponseCodes::ServerError);
    }
}