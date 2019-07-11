<?php

namespace App\Http\Controllers;


use App\Models\GoogleSheets;
use Illuminate\Http\Request;

class GoogleSheetsController extends Controller
{
    protected $googleClient;

    public function __construct(GoogleSheets $googleSheets)
    {
        $this->googleClient = $googleSheets->instance();
    }

    public function index()
    {
        $spreadsheetId = env('LARAVEL_GOOGLE_SHEETS');
        $range = 'A:H';
        dd($this->getValues($spreadsheetId, $range)->getValues());
    }

    public function getValues($spreadsheetId, $range)
    {
        $service = $this->googleClient;
        // [START sheets_get_values]
        $result = $service->spreadsheets_values->get($spreadsheetId, $range);
        $numRows = $result->getValues() != null ? count($result->getValues()) : 0;
        printf("%d rows retrieved.", $numRows);
        // [END sheets_get_values]
        return $result;
    }
}
