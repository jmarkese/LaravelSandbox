<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Markese\Datatables\Datatables;
use Google\Cloud\BigQuery\BigQueryClient;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function datatables(Request $request)
    {
        $whites = \App\White::query();
        return Datatables::response($whites, $request);
    }

    public function usergroups(Request $request)
    {
        $users = \App\User::with('groups');
        return Datatables::response($users, $request);
    }

    public function usergroups2(Request $request)
    {
        $users = \App\User::query();
        return Datatables::response($users, $request);
    }

    public function partyTone(Request $request)
    {
        return \View::make('partytone');
    }

    public function partyToneData(Request $request)
    {
        $results = [];
        $bigQuery = new BigQueryClient(['projectId' => 'big-query-test-163402']);

        //$milliseconds = 1800000; //last 30 minutes
        $milliseconds = 3600000;  //last 1 hour
        //$milliseconds = 14400000; //last 4 hours
        //$milliseconds = 86400000; //last 24 hours

        $query = 'SELECT party, AvgTone AS tone, ROW_NUMBER() OVER (ORDER BY tone DESC) row_num
            FROM (
                SELECT "r" AS party, LEFT(V2Tone, INSTR(V2Tone, ",")-1) AS AvgTone FROM [gdelt-bq:gdeltv2.gkg@-'.$milliseconds.'-] 
                WHERE Organizations LIKE "%republican%"
                AND Locations LIKE "1#United States%"
            ) ,
            (
                SELECT "d" AS party, LEFT(V2Tone, INSTR(V2Tone, ",")-1) AS AvgTone FROM [gdelt-bq:gdeltv2.gkg@-'.$milliseconds.'-] 
                WHERE Organizations LIKE "%democrat%"
                AND Locations LIKE "1#United States%"
            ) ';

        $queryResults = $bigQuery->runQuery($query, ['useLegacySql' => true]);

        if ($queryResults->isComplete()) {
            foreach ($queryResults->rows() as $row) {
                $results[] = ['0'=>$row['row_num'], '1' => $row['tone'], '2'=>$row['party']];
            }
        } else {
            throw new Exception('The query failed to complete');
        }
        return response()->json( $results );

    }

}
