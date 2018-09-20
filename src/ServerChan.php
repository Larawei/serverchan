<?php

namespace Larawei\Serverchan;

use GuzzleHttp\Client;

class ServerChan
{
    protected $sckey;
    protected $guzzleOptions = [];

    public function __construct(string $sckey)
    {
        if (empty($sckey)) throw new \Exception('sckey格式有误');
        $this->sckey = $sckey;
    }

    public function send(string $text, string $desp = null)
    {
        $url = 'https://sc.ftqq.com/'. $this->sckey .'.send';

        $query = array_filter([
            'text' => $text,
            'desp' => $desp
        ]);

        $response = $this->getHttpClient()->post($url, [
            'form_params' => $query
        ])->getBody()->getContents();

        return json_decode($response, true);

    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }
}
