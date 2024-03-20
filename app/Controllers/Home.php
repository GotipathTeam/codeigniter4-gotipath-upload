<?php

namespace App\Controllers;

use GuzzleHttp\Client;

class Home extends BaseController
{
    public function index(): string
    {
        $this->createVideo();
        return view('welcome_message');
    }


    // video create method
    public function createVideo()
    {
        $LibraryId = "c94deedf-edbc-49aa-8805-8f199c017ff";
        $ClientId = "92f9d000-5051-4339-9b3a-91f1c2a4c07";
        $ApiKey = "y/r2DtLbfjeyrwu4cyZKeJTA/AT1OiuN0v5W+6Ne6jP229LnLVtgAW4OszQgJw5hlU76S";

        $headers = [
            "X-Auth-ClientId" => $ClientId,
            "X-Auth-LibraryId" => $LibraryId,
            "X-Auth-ApiKey" => $ApiKey,
        ];

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://apistream.gotipath.com',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
        $url = sprintf("/v1/libraries/%s/videos", $LibraryId);

        try {
            $response = $client->request('POST', $url, [
                'headers' => $headers,
                'json' => [
                    "name" => "Test Video",
                    "description" => "Test Video Description"
                ]
            ]);

            $data = $response->getBody()->getContents();
            var_dump($data);
            die();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            die();
        }
        return $data;
    }
}
