<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoogleSheets extends Model
{
    public static function instance()
    {
        $credentials_path = env('CREDENCIALS_PATH');
        $client = new \Google_Client();
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAuthConfig($credentials_path);
        return new \Google_Service_Sheets($client);
    }
}
