<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\TdLabel2;
use App\Models\TdLabel3;
use App\Models\TdLabel4;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Label4Action extends ResponceBaseController
{
    function add(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l3_id' => 'required|integer',
                'batch_no' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = TdLabel4::create([
                "create_by" => auth()->user()->id,
                "l3_id" => $r->l3_id,
                "batch_no" => $r->batch_no,
                "update_by" => auth()->user()->id
            ]);
            //$data2=TdLabel4::where("update_by",auth()->user()->id)->where("l2_stock","A")->where("l2_flag","A")->update(["l2_stock"=>"B","l2_flag"=>"B"]);
            return $this->sendResponse($data, "Add Label 3 successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function list_l1(Request $r): JsonResponse
    {
        try {
            $data = TdLabel2::where("update_by", auth()->user()->id)->where("l1_stock", "A")->where("l1_flag", "A")->get();

            return $this->sendResponse($data, "Edit Wrok item successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }



    function edit(Request $r): JsonResponse
    {
        try {
            $rules = [
                'label4_id' => 'required|integer',
                'l3_id' => 'required|integer',
                'batch_no' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }

            $data = TdLabel4::where("label4_id", $r->label4_id)->where("update_by", auth()->user()->id)->update([
                "create_by" => auth()->user()->id,
                "l3_id" => $r->l3_id,
               // "qty" => $r->l4_qty,
                "batch_no" => $r->batch_no
            ]);

            return $this->sendResponse($data, "Edit Wrok item successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function list_l4(Request $r): JsonResponse
    {
        try {
            $data = TdLabel4::where("update_by", auth()->user()->id)->get();


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

    function work_list(Request $r): JsonResponse
    {
        try {
            // $data = TdLabel3::join("md_product as a", 'a.product_id', '=', 'td_label3.product_mastar_id')
            //     ->join("md_unit as b", 'b.unit_id', '=', 'a.unit_id')
            //     ->where("td_label3.update_by", auth()->user()->id)
            //     ->where("td_label3.l3_stock", "A")->where("td_label3.l3_flag", "A")
            //     ->select("td_label3.*", "a.product_name", "a.qty", "b.*")->get();
            $data = TdLabel3::where("l3_stock", "A")->where("l3_flag", "A")
            ->get();

            return $this->sendResponse($data, " ");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}
