<?php

namespace App\Http\Controllers;

use App\Models\Provincies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinciesController extends Controller
{
    public function getProvincesByDepartment($id) {
        $provinces = DB::table("provincies")->where("country_abbreviation", $id)->orderBy('name', 'asc')->pluck("id", "name");

        return json_encode($provinces);
    }
}
