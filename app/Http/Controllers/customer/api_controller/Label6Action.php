<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\TdLabel6;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Label6Action extends ResponceBaseController
{
    function add(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l6_qty' => 'required|integer',
                'product_mastar_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = TdLabel6::create([
                "create_by" => auth()->user()->id,
                "l6_qty" => $r->l6_qty,
                "product_mastar_id" => $r->product_mastar_id,
                "l6_stock" => "A",
                "l6_flag" => "A",
                "update_by" => auth()->user()->id
            ]);
            //$data2=TdLabel4::where("update_by",auth()->user()->id)->where("l2_stock","A")->where("l2_flag","A")->update(["l2_stock"=>"B","l2_flag"=>"B"]);
            return $this->sendResponse($data, "Add Label 6 successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function edit(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l6_qty' => 'required|integer',
                'label6_id' => 'required|integer',
                'product_mastar_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }

            $data = TdLabel6::where("label6_id", $r->label6_id)->where("update_by", auth()->user()->id)->where("l6_stock", "A")->where("l6_flag", "A")->update([
                "create_by" => auth()->user()->id,
                "l6_qty" => $r->l6_qty,
                "qty" => $r->l6_qty,
                "product_mastar_id" => $r->product_mastar_id
            ]);

            return $this->sendResponse($data, "Edit Wrok item successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }



    function list_l6(Request $r): JsonResponse
    {
        try {
            $data = TdLabel6::join("md_product as a", 'a.product_id', '=', 'td_label6.product_mastar_id')
                ->join("md_unit as b", 'b.unit_id', '=', 'a.unit_id')
                ->where("td_label6.update_by", auth()->user()->id)
                ->where("td_label6.l6_stock", "A")->where("td_label6.l6_flag", "A")
                ->select("td_label6.*", "a.product_name", "a.qty", "b.*")->get();

            return $this->sendResponse($data, " ");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}
