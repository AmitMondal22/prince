<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\TdLabel2;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Label2Action extends ResponceBaseController
{
    function add(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l2_qty' => 'required|integer',
                'product_mastar_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }




            $data = TdLabel2::create(["create_by" => auth()->user()->id,
                                        "l2_qty"=>$r->l2_qty,
                                        "product_mastar_id"=>$r->product_mastar_id,
                                        "l3_stock"=>"A",
                                        "l3_flag"=>"A",
                                        "update_by"=>auth()->user()->id]);

            return $this->sendResponse($data, "Add Label 2 successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}