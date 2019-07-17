<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Post;
use App\Models\User;
use App\Models\GoogleSheets;
use Illuminate\Http\Request;
use App\Models\Category;

class DbManageController extends Controller
{
    protected $googleClient;

    public function __construct(GoogleSheets $googleSheets)
    {
        $this->googleClient = $googleSheets->instance();
    }

    /**
     * テーブル定義を更新
     *
     * @return void
     */
    public function updateTableDef()
    {
    }

    private function fetchTableDefFromSheet(string $range): array
    {
        $service = $this->googleClient;
        // [START sheets_get_values]
        $result = $service->spreadsheets_values->get(env('LARAVEL_GOOGLE_SHEETS'), $range);
        $result = $result->getValues();
        // [END sheets_get_values]
        return $result;
    }

    /**
     * DBからテーブル定義を取得
     *
     * @param Post $post
     * @param User $user
     * @param Category $category
     * @return void
     */
    public function fetchTableDefFromDb(Post $post, User $user, Category $category)
    {
        $TableDef['posts'] = DB::select('SHOW FULL COLUMNS FROM ' . $post->getTable());
        $TableDef['users'] = DB::select('SHOW FULL COLUMNS FROM ' . $user->getTable());
        $TableDef['categories'] = DB::select('SHOW FULL COLUMNS FROM ' . $category->getTable());
        dd($TableDef);
    }

    /**
     * テーブル定義を上書き
     *
     * @return void
     */
    public function wright()
    {
        $service = $this->googleClient;
        // [START sheets_update_values]
        $values = [
            ["Sheet API Append TEST", "登録できていますか？"]
        ];
        // [START_EXCLUDE silent]
        // $values = $_values;
        // [END_EXCLUDE]
        $body = new \Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $result = $service->spreadsheets_values->update(
            '1d7IENb076lJdcwVOtxfALjbkS8kPPE9A8PIpJSvxbVo',
            'シート2',
            $body,
            $params
        );
        printf("%d cells updated.", $result->getUpdatedCells());
        // [END sheets_update_values]
        dd($result);
        return $result;
    }

    /**
     * SQLを発行する
     *
     * @return void
     */
    public function createDiffSql()
    {
        # code...
    }

}
