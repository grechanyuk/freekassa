<?php

namespace Grechanyuk\FreeKassa\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class Api
{
    protected $base_uri = 'https://www.free-kassa.ru/api.php';
    protected $client;
    protected $defaultParams;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => $this->base_uri]);
    }

    protected function get(array $params = [], string $type = 'query')
    {
        $params = array_merge($this->defaultParams, $params);
        try {
            $response = $this->client->get(null, [
                $type => $params
            ]);
        } catch (ClientException $e) {
            \Log::warning('FreeKassa api error', ['message' => $e->getMessage(), 'code' => $e->getCode()]);
            return false;
        }

        return $this->answer($response);
    }

    protected function post(array $params = [], string $type = 'form_params')
    {
        $params = array_merge($this->defaultParams, $params);
        try {
            $response = $this->client->post(null, [
                $type => $params
            ]);
        } catch (ClientException $e) {
            \Log::warning('FreeKassa api error', ['message' => $e->getMessage(), 'code' => $e->getCode()]);
            return false;
        }

        return $this->answer($response);
    }

    private function answer(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 200) {
            $response = $response->getBody()->getContents();
            if (!json_decode($response)) {
                $xml = new \SimpleXMLElement($response);
                if ($xml->answer != 'error') {
                    return $xml;
                }
            } else {
                $json = json_decode($response);
                if ($json->status != 'error') {
                    return $json;
                }
            }
        }

        return false;
    }
}