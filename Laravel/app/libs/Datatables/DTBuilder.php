<?php

namespace App\Libs\Datatables;
use Illuminate\Http\Request;

interface DTBuilder
{
    public function buildDT(): DatatablesServerSide;
}
