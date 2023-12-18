<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\TdLabel8;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Label8Action extends ResponceBaseController
{
    function add(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l8_qty' => 'required|integer',
                'product_mastar_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = TdLabel8::create([
                "create_by" => auth()->user()->id,
                "l8_qty" => $r->l8_qty,
                "product_mastar_id" => $r->product_mastar_id,
                "l8_stock" => "A",
                "l8_flag" => "A",
                "update_by" => auth()->user()->id
            ]);
            //$data2=TdLabel4::where("update_by",auth()->user()->id)->where("l2_stock","A")->where("l2_flag","A")->update(["l2_stock"=>"B","l2_flag"=>"B"]);
            return $this->sendResponse($data, "Add Label 8 successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function edit(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l8_qty' => 'required|integer',
                'label8_id' => 'required|integer',
                'product_mastar_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }

            $data = TdLabel8::where("label8_id", $r->label8_id)->where("update_by", auth()->user()->id)->where("l8_stock", "A")->where("l8_flag", "A")->update([
                "create_by" => auth()->user()->id,
                "l8_qty" => $r->l8_qty,
                //"qty" => $r->l8_qty,
                "product_mastar_id" => $r->product_mastar_id
            ]);

            return $this->sendResponse($data, "Edit Wrok item successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }



    function list_l8(Request $r): JsonResponse
    {
        try {
            $data = TdLabel8::join("md_product as a", 'a.product_id', '=', 'td_label8.product_mastar_id')
                ->join("md_unit as b", 'b.unit_id', '=', 'a.unit_id')
                ->where("td_label8.update_by", auth()->user()->id)
                ->where("td_label8.l8_stock", "A")->where("td_label8.l8_flag", "A")
                ->select("td_label8.*", "a.product_name", "a.qty", "b.*")->get();

            return $this->sendResponse($data, " ");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}
