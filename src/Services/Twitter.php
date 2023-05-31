<?php

namespace Nicolasfoco\ApiTwitter\Services;

class Twitter
{
    private string $baseUri = 'https://api.twitter.com';

    private string $apiVersion = '2';

    private OAuthClient $httpClient;

    public function __construct()
    {
        $this->httpClient = new OAuthClient(
            $_ENV['ENVIRONMENT']['CONSUMER_KEY'],
            $_ENV['ENVIRONMENT']['CONSUMER_SECRET'],
            $_ENV['ENVIRONMENT']['TOKEN_IDENTIFIER'],
            $_ENV['ENVIRONMENT']['TOKEN_SECRET']
        );
    }

    public function getMe(): array
    {
        try {
            $response = json_decode($this->httpClient->fetch(
                $this->baseUri . '/' . $this->apiVersion . '/users/me',
                [],
                'GET'
            ), true);

            if (! isset($response['data']['id'])) {
                return [
                    'error' => true,
                    'message' => 'ocorreu um erro ao tentar capturar os metadados do usuário!'
                ];
            }

            return [
                'success' => true,
                'data' => $response['data']
            ];
        } catch (\Throwable $exception) {
            return [
                'error' => true,
                'message' => $exception->getMessage()
            ];
        }
    }

    public function tweet (string $text): array
    {
        try {
            $body = [
                'text' => $text
            ];
            $response = json_decode($this->httpClient->fetch(
                $this->baseUri . '/' . $this->apiVersion . '/tweets',
                $body,
            ), true);

            if (! isset($response['data']['id'])) {
                 return [
                    'error' => true,
                    'message' => 'ocorreu um erro ao tentar realizar um tweet!'
                ];
            }

            return [
                'success' => true,
                'data' => json_decode($response)
            ];
        } catch (\Throwable $exception) {

            return [
                'error' => true,
                'message' => $exception->getMessage()
            ];
        }
    }
}