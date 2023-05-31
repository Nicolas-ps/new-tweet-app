<?php

namespace Nicolasfoco\ApiTwitter\Services;

use OAuthException;

class OAuthClient
{
    private string $consumerKey;

    private string $consumerSecret;

    private string $tokenID;

    private string $tokenSecret;


    /**
     * @param string $consumerKey
     * @param string $consumerSecret
     * @param string $tokenID
     * @param string $tokenSecret
     */
    public function __construct(string $consumerKey, string $consumerSecret, string $tokenID, string $tokenSecret)
    {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->tokenID = $tokenID;
        $this->tokenSecret = $tokenSecret;
    }


    /**
     * @param string $uri
     * @param array $body
     * @param string $method
     * @return string
     * @throws OAuthException
     */
    public function fetch(string $uri, array $body = [], string $method = 'POST'): string
    {
        $oauth = new \OAuth($this->consumerKey, $this->consumerSecret);
        $oauth->setToken($this->tokenID, $this->tokenSecret);
        $oauth->setNonce(md5(mt_rand()));
        $oauth->setTimestamp(time());

        $fetchInput['uri'] = $uri;

        if (! empty($body)) {
            $fetchInput['body'] = json_encode($body);
            $fetchInput['method'] = $method;
            $fetchInput['headers'] = [
                'Content-Type' => 'application/json'
            ];
        }

        $oauth->fetch(...array_values($fetchInput));
        return $oauth->getLastResponse();
    }
}