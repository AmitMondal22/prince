<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\TdLabel1;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Label1Action extends ResponceBaseController
{
    function add(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l1_qty' => 'required|integer',
                'product_mastar_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }

            $data = TdLabel1::create(["create_by" => auth()->user()->id,
                                        "l1_qty"=>$r->l1_qty,
                                        "product_mastar_id"=>$r->product_mastar_id,
                                        "l1_stock"=>"A",
                                        "l1_flag"=>"A",
                                        "update_by"=>auth()->user()->id]);

            return $this->sendResponse($data, "Add work item successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function edit(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l1_qty' => 'required|integer',
                'product_mastar_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }

            $data = TdLabel1::where("update_by",auth()->user()->id)->where("l1_stock","A")->where("l2_flag","A")->update(["create_by" => auth()->user()->id,
                                        "l1_qty"=>$r->l1_qty,
                                        "product_mastar_id"=>$r->product_mastar_id]);

            return $this->sendResponse($data, "Edit Wrok item successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function list_l1(Request $r): JsonResponse
    {
        try {
            $data = TdLabel1::join("md_product as a",'a.product_id','=','td_label1.product_mastar_id')->where("update_by",auth()->user()->id)->where("l1_stock","A")->where("l1_flag","A")->get();

            return $this->sendResponse($data, " ");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }

}
