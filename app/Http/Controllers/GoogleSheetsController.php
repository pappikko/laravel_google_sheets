<?php

namespace App\Http\Controllers;


use App\Models\GoogleSheets;
use Illuminate\Http\Request;

class GoogleSheetsController extends Controller
{
    public function index(GoogleSheets $googleSheets)
    {
        $sheets = $googleSheets->instance();

        $sheet_id = env('LARAVEL_GOOGLE_SHEETS');
        $range = 'A1:H1';
        $response = $sheets->spreadsheets_values->get($sheet_id, $range);
        $values = $response->getValues();
        dd($values);
    }
}
