<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\Controller;
use App\Models\TdLabel5;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Label5Action extends Controller
{
    function add(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l5_qty' => 'required|integer',
                'product_mastar_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = TdLabel5::create(["create_by" => auth()->user()->id,
                                        "l5_qty"=>$r->l5_qty,
                                        "product_mastar_id"=>$r->product_mastar_id,
                                        "l5_stock"=>"A",
                                        "l5_flag"=>"A",
                                        "update_by"=>auth()->user()->id]);
            //$data2=TdLabel4::where("update_by",auth()->user()->id)->where("l2_stock","A")->where("l2_flag","A")->update(["l2_stock"=>"B","l2_flag"=>"B"]);
            return $this->sendResponse($data, "Add Label 3 successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function edit(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l5_qty' => 'required|integer',
                'product_mastar_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }

            $data = TdLabel5::where("update_by",auth()->user()->id)->where("l5_stock","A")->where("l5_flag","A")->update(["create_by" => auth()->user()->id,
                                        "l5_qty"=>$r->l5_qty,
                                        "product_mastar_id"=>$r->product_mastar_id]);

            return $this->sendResponse($data, "Edit Wrok item successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}
