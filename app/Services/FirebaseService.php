<?php

namespace App\Services;

use Google\Client;
use Google\Service\FirebaseCloudMessaging;

use Google\Client as GoogleClient;
use Exception;

class FirebaseService
{
    protected $client;

    public function __construct()
    {
        // $this->client = new Client();
        // $this->client->setAuthConfig(storage_path('app/tharbricks-802905ab2015.json'));
        // $this->client->addScope(FirebaseCloudMessaging::CLOUD_PLATFORM);

        $this->client = new GoogleClient();
        $this->client->setAuthConfig(storage_path('app/tharbricks-802905ab2015.json'));
        $this->client->setScopes([
            'https://www.googleapis.com/auth/cloud-platform',
            'https://www.googleapis.com/auth/firebase.messaging',
        ]);
    }

    // public function getAccessToken()
    // {
    //     $token = $this->client->fetchAccessTokenWithAssertion();
    //     return $token['access_token'];
    // }

    public function getAccessToken()
    {
        $token = $this->client->fetchAccessTokenWithAssertion();
        if (isset($token['access_token'])) {
            return $token['access_token'];
        } else {
            throw new Exception('Unable to fetch access token');
        }
    }
}
