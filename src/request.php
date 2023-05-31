<?php

function oauthRequest (string $uri, string $consumerKey, string $consumerSecret, string $tokenID, string $tokenSecret): string
{
    try {
        $oauth = new OAuth($consumerKey, $consumerSecret);
        $oauth->setToken($tokenID, $tokenSecret);
        $oauth->setNonce(md5(mt_rand()));
        $oauth->setTimestamp(time());

        $oauth->fetch($uri);
        return $oauth->getLastResponse();
    } catch (OAuthException|Throwable $exception) {
        dump($exception);

        return $exception->getMessage();
    }
}