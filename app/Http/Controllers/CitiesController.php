<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitiesController extends Controller
{
    public function getCitiesByDepartment($id) {
        $cities = DB::table("cities")->where("province", $id)->orderBy('name', 'asc')->pluck("id", "name");

        return json_encode($cities);
    }
}
