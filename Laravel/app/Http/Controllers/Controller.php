<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Markese\Datatables\Datatables;


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

}
