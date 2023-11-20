<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\MdUnit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Assets extends ResponceBaseController
{

    function unit_add(Request $r): JsonResponse
    {
        try {
            $rules = [
                'unit_name' => 'required|string',
                'unit_size' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
           $data= MdUnit::create([
                'unit_name' => $r->unit_name,
                'unit_size' => $r->unit_size
            ]);
            return $this->sendResponse($data, "Add Unit successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}
