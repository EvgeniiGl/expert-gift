<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GuzzleClientHelper
{

    public function request(string $url = '', array $options = [], string $method = 'get')
    {
        $client = new Client();
//        dd($options);
        try {
            $response = $client->request(
                $method,
                $url,
                $options
            )->getBody()->getContents();
//            if (($decoded = json_decode($response, true)) === false) {
////                throw new InvalidApiResponse('Invalid json format', 500);
//            }
//            return $decoded;
            return $response;
        } catch (RequestException $exception) {
//            Log::error('GuzzleClientHelper->request Invalid api response - '. $exception->getMessage());
//            throw new InvalidApiResponse('Invalid api response', $exception->getCode(), $exception->getResponse());
        }
    }


}