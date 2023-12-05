<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\TdLabel7;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Label7Action extends ResponceBaseController
{
    function add(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l7_qty' => 'required|integer',
                'product_mastar_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = TdLabel7::create(["create_by" => auth()->user()->id,
                                        "l7_qty"=>$r->l7_qty,
                                        "product_mastar_id"=>$r->product_mastar_id,
                                        "l7_stock"=>"A",
                                        "l7_flag"=>"A",
                                        "update_by"=>auth()->user()->id]);
            //$data2=TdLabel4::where("update_by",auth()->user()->id)->where("l2_stock","A")->where("l2_flag","A")->update(["l2_stock"=>"B","l2_flag"=>"B"]);
            return $this->sendResponse($data, "Add Label 7 successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function edit(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l7_qty' => 'required|integer',
                'product_mastar_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }

            $data = TdLabel7::where("update_by",auth()->user()->id)->where("l7_stock","A")->where("l7_flag","A")->update(["create_by" => auth()->user()->id,
                                        "l7_qty"=>$r->l7_qty,
                                        "product_mastar_id"=>$r->product_mastar_id]);

            return $this->sendResponse($data, "Edit Wrok item successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }



    function list_l7(Request $r): JsonResponse
    {
        try {
            $data = TdLabel7::join("md_product as a",'a.product_id','=','td_label7.product_mastar_id')
                            ->join("md_unit as b",'b.unit_id','=','a.unit_id')
                            ->where("td_label7.update_by",auth()->user()->id)
                            ->where("td_label7.l7_stock","A")->where("td_label7.l7_flag","A")
                            ->select("td_label7.*","a.product_name","a.qty","b.*")->get();

            return $this->sendResponse($data, " ");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}
