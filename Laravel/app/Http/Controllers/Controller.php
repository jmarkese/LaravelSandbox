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

    public function politicalTone(Request $request)
    {
        $projectId = 'big-query-test-163402';

        $bigquery = new BigQueryClient([
            'projectId' => $projectId
        ]);
# The name for the new dataset
        $datasetName = 'my_new_dataset';

# Creates the new dataset
        $dataset = $bigquery->createDataset($datasetName);

        return 'Dataset ' . $dataset->id() . ' created.';


        $query = 'SELECT TOP(corpus, 10) as title, COUNT(*) as unique_words ' .
            'FROM [publicdata:samples.shakespeare]';
        $options = ['useLegacySql' => true];
        $queryResults = $bigquery->runQuery($query, $options);

        return $queryResults;

    }


}
