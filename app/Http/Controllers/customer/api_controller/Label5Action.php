<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\TdLabel4;
use App\Models\TdLabel5;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Label5Action extends ResponceBaseController
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
            $data = TdLabel5::create([
                "create_by" => auth()->user()->id,
                "l5_qty" => $r->l5_qty,
                "product_mastar_id" => $r->product_mastar_id,
                "l5_stock" => "A",
                "l5_flag" => "A",
                "update_by" => auth()->user()->id
            ]);
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
                'label5_id' => 'required|integer',
                'product_mastar_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }

            $data = TdLabel5::where("label5_id", $r->label5_id)->where("update_by", auth()->user()->id)->where("l5_stock", "A")->where("l5_flag", "A")->update([
                "create_by" => auth()->user()->id,
                "l5_qty" => $r->l5_qty,
                //"qty" => $r->l5_qty,
                "product_mastar_id" => $r->product_mastar_id
            ]);

            return $this->sendResponse($data, "Edit Wrok item successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }



    function list_l5(Request $r): JsonResponse
    {
        try {
            $data = TdLabel5::join("md_product as a", 'a.product_id', '=', 'td_label5.product_mastar_id')
                ->join("md_unit as b", 'b.unit_id', '=', 'a.unit_id')
                ->where("td_label5.update_by", auth()->user()->id)
                ->where("td_label5.l5_stock", "A")->where("td_label5.l5_flag", "A")
                ->select("td_label5.*", "a.product_name", "a.qty", "b.*")->get();

            return $this->sendResponse($data, " ");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function work_list(Request $r): JsonResponse
    {
        try {
            $data = TdLabel4::get();


                // $data = TdLabel4::join("md_product as a", 'a.product_id', '=', 'td_label4.product_mastar_id')
                // ->join("md_unit as b", 'b.unit_id', '=', 'a.unit_id')
                // ->where("td_label4.update_by", auth()->user()->id)
                // ->where("td_label4.l4_stock", "A")->where("td_label4.l4_flag", "A")
                // ->select("td_label4.*", "a.product_name", "a.qty", "b.*")->get();

            return $this->sendResponse($data, " ");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}
