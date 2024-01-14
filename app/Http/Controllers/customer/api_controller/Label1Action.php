<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\TdLabel1;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Label1Action extends ResponceBaseController
{
    function add(Request $r): JsonResponse
    {
        // try {
            $rules = [
                'master_product' => 'required',
                'product_list' => 'required',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }

            $batch_no = TdLabel1::getLastBatchNoValue();

            $product_list = $r->product_list;
            $master_product = $r->master_product;
            $product_list['id_master_product'];
            foreach ($product_list as $item) {
                $productData = $item['product'];
                $data = TdLabel1::create([
                    "create_by" => auth()->user()->id,
                    "l1_qty" => $item['qty'],
                    "product_mastar_id" => $master_product->id_master_product,
                    "product_id" => $productDa0ta["product_id"],
                    "l1_stock" => "A",
                    "l1_flag" => "A",
                    "batch_no" => $batch_no + 1,
                    "update_by" => auth()->user()->id
                ]);
            }




            return $this->sendResponse($data, "Add work item successfully");
        // } catch (\Throwable $th) {
        //     return $this->sendError("exception handler error", $th, 400);
        // }
    }


    function edit(Request $r): JsonResponse
    {
        try {
            $rules = [
                'data' => 'required',
                //'l1_qty' => 'required|integer',
                'label1_id' => 'required|integer',
                'product_mastar_id' => 'required|integer',
                //"product_id"=>"required|integer",
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $batch_no = TdLabel1::getLastBatchNoValue();

            foreach ($r->data as $rd) {
                $data = TdLabel1::where("label1_id", $r->label1_id)->where("update_by", auth()->user()->id)->where("l1_stock", "A")->where("l1_flag", "A")->update([
                    "create_by" => auth()->user()->id,
                    "l1_qty" => $rd['l1_qty'],
                    "product_mastar_id" => $r->product_mastar_id,
                    "batch_no" => $batch_no + 1,
                    "product_id" => $rd['product_id'],
                ]);
            }
            /*$data = TdLabel1::where("label1_id", $r->label1_id)->where("update_by", auth()->user()->id)->where("l1_stock", "A")->where("l1_flag", "A")->update([
                "create_by" => auth()->user()->id,
                "l1_qty" => $r->l1_qty,
                "product_mastar_id" => $r->product_mastar_id,
                "batch_no" => $batch_no + 1,
                "product_id"=>$r->product_id,
            ]);*/

            return $this->sendResponse($data, "Edit Wrok item successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function list_l1(Request $r): JsonResponse
    {
        try {
            $data = TdLabel1::join("md_product as a", 'a.product_id', '=', 'td_label1.product_mastar_id')
            ->join("md_unit as b", 'b.unit_id', '=', 'a.unit_id')
            ->join("md_master_product as c", 'td_label1.product_mastar_id', '=', 'c.id_master_product')
            ->where("td_label1.update_by", auth()->user()->id)
            ->where("td_label1.l1_stock", "A")->where("td_label1.l1_flag", "A")
            ->select(
                "td_label1.batch_no",
                DB::raw("MAX(td_label1.label1_id) as label1_id"),
                DB::raw("MAX(td_label1.l1_qty) as l1_qty"),
                "td_label1.product_mastar_id",
                "td_label1.product_id",
                DB::raw("MAX(td_label1.l1_stock) as l1_stock"),
                DB::raw("MAX(td_label1.l1_flag) as l1_flag"),
                DB::raw("MAX(td_label1.type) as type"),
                "b.unit_id",
                "b.unit_name",
                "b.unit_size",
                "a.product_name",
                DB::raw("MAX(a.qty) as qty"),
                "c.product_name as mastar_product_name"
            )
            ->groupBy("td_label1.batch_no", "td_label1.product_mastar_id", "td_label1.product_id", "b.unit_id", "b.unit_name", "b.unit_size", "a.product_name","c.product_name")
            ->get();

            return $this->sendResponse($data, " ");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}
