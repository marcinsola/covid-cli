<?php

namespace Covid;

use Symfony\Component\HttpClient\ScopingHttpClient;
use Symfony\Component\HttpClient\HttpClient;
use Webmozart\Assert\Assert;

class ApiClient
{
    private const BASE_URI = 'https://coronavirus-19-api.herokuapp.com/countries/';
    private const COUNTRY_NOT_FOUND = 'Country not found';

    /** @var ScopingHttpClient */
    private $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client::createForBaseUri(self::BASE_URI);
    }

    public function getData(string $country): array
    {
        $response = $this->client->request('GET', $country);
        Assert::notEq($response->getContent(), self::COUNTRY_NOT_FOUND, "No such country: $country");

        return $response->toArray();
    }
}
