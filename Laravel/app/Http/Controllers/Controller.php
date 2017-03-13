<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Markese\Datatables\Datatables;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function datatables(Request $request)
    {
        //$eager = collect($whites->getEagerLoads());//->each(function($e) { $eager[] = $e; });
        //$rel = collect();
        //dd($whites->getEagerLoads());
        /*$eager->each(function($val, $key) use ($whites, $rel) {
            //$rel = $whites->getRelation($key);
            //dd($key);
        } );*/
        //dd($rel);// instanceof \Illuminate\Database\Eloquent\Builder);


        $whites = \App\White::with('blues.cyans', 'magentas');

        return Datatables::response($whites, $request);

    }
}
