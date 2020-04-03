<?php

namespace App\Http\Controllers;

use App\Models\Stage;

class StageController extends Controller
{
    public function listStages()
    {
        $stages = Stage::all();
        return successResponse(['data' => $stages]);
    }
}
