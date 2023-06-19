<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class KaamelottQuotes
{

    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    public function fetchQuote():array
    {
        $response = $this->client->request(
            'GET',
            'https://kaamelott.chaudie.re/api/random'
        );

        $content = $response->toArray();

        return $content;
    }

}