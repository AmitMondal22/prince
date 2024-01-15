<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\TdLabel1;
use App\Models\TdLabel2;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Label2Action extends ResponceBaseController
{
    function add(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l2_qty' => 'required|integer',
                'batch_no' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }




            $data = TdLabel2::create([
                "create_by" => auth()->user()->id,
                "l2_qty" => $r->l2_qty,
                "batch_no" => $r->batch_no,
                "l2_stock" => "A",
                "l2_flag" => "A",
                "update_by" => auth()->user()->id
            ]);

            return $this->sendResponse($data, "Add Label 2 successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }



    function edit(Request $r): JsonResponse
    {
        try {
            $rules = [
                'l2_qty' => 'required|integer',
                'batch_no' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }

            $data = TdLabel2::where("label2_id", $r->label2_id)->where("update_by", auth()->user()->id)->where("l2_stock", "A")->where("l2_flag", "A")->update([
                "create_by" => auth()->user()->id,
                "l2_qty" => $r->l2_qty,
                //"qty" => $r->l2_qty,
                "batch_no" => $r->batch_no
            ]);

            return $this->sendResponse($data, "Edit Wrok item successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function list_l2(Request $r): JsonResponse
    {
        try {
            // $data = TdLabel2::join("md_product as a", 'a.product_id', '=', 'td_label2.product_mastar_id')
            //     ->join("md_unit as b", 'b.unit_id', '=', 'a.unit_id')
            //     ->where("td_label2.update_by", auth()->user()->id)
            //     ->where("td_label2.l2_stock", "A")->where("td_label2.l2_flag", "A")
            //     ->select("td_label2.*", "a.product_name", "a.qty", "b.*")->get();
            $data = TdLabel2::where("update_by", auth()->user()->id)
            ->where("l2_stock", "A")->where("l2_flag", "A")
            ->get();

            return $this->sendResponse($data, " ");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }

    function work_list():JsonResponse
    {
        // try {
        //     $data = TdLabel1::join("md_master_product as a", 'a.product_id', '=', 'td_label1.product_mastar_id')
        //         ->join("md_unit as b", 'b.unit_id', '=', 'a.unit_id')
        //         ->where("td_label1.update_by", auth()->user()->id)
        //         ->where("td_label1.l1_stock", "A")
        //         ->where("td_label1.l1_flag", "A")
        //         ->select("td_label1.*", "a.product_name", "b.*")
        //         ->groupBy("td_label1.batch_no","td_label1.product_mastar_id")
        //         ->get();

        //     return $this->sendResponse($data, " ");
        // } catch (\Throwable $th) {
        //     return $this->sendError("exception handler error", $th, 400);
        // }


        try {
            $data = TdLabel1::join("md_product as a", 'a.product_id', '=', 'td_label1.product_id')
            ->join("md_unit as b", 'b.unit_id', '=', 'a.unit_id')
            ->join("md_master_product as c", 'td_label1.product_mastar_id', '=', 'c.id_master_product')
            // ->where("td_label1.update_by", auth()->user()->id)
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
