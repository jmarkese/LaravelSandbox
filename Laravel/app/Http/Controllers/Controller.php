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

    public function usergroups2(Request $request)
    {
        $group = \App\GroupResources\Group::where('name', 'group0_0')->first();
        $users = \App\User::all();

        //dd($group->subset);
        dd(data_get($users,"*.groups.*.subset"));


        //return data_get($users,"user.groups");
        //return Datatables::response($users, $request);
    }

}
