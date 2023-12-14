<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\TdLabel9;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Label9Action extends  ResponceBaseController
{
    function add(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l9_qty' => 'required|integer',
                'product_mastar_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = TdLabel9::create([
                "create_by" => auth()->user()->id,
                "l9_qty" => $r->l9_qty,
                "product_mastar_id" => $r->product_mastar_id,
                "l9_stock" => "A",
                "l9_flag" => "A",
                "update_by" => auth()->user()->id
            ]);
            //$data2=TdLabel4::where("update_by",auth()->user()->id)->where("l2_stock","A")->where("l2_flag","A")->update(["l2_stock"=>"B","l2_flag"=>"B"]);
            return $this->sendResponse($data, "Add Label 9 successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function edit(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l9_qty' => 'required|integer',
                'label9_id' => 'required|integer',
                'product_mastar_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }

            $data = TdLabel9::where("label9_id", $r->label9_id)->where("update_by", auth()->user()->id)->where("l9_stock", "A")->where("l9_flag", "A")->update([
                "create_by" => auth()->user()->id,
                "l9_qty" => $r->l9_qty,
                "qty" => $r->l9_qty,
                "product_mastar_id" => $r->product_mastar_id
            ]);

            return $this->sendResponse($data, "Edit Wrok item successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }



    function list_l9(Request $r): JsonResponse
    {
        try {
            $data = TdLabel9::join("md_product as a", 'a.product_id', '=', 'td_label9.product_mastar_id')
                ->join("md_unit as b", 'b.unit_id', '=', 'a.unit_id')
                ->where("td_label9.update_by", auth()->user()->id)
                ->where("td_label9.l9_stock", "A")->where("td_label9.l9_flag", "A")
                ->select("td_label9.*", "a.product_name", "a.qty", "b.*")->get();

            return $this->sendResponse($data, " ");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}
