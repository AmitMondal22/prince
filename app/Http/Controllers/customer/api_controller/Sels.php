<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\Td_sels;
use App\Models\Td_transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Sels extends ResponceBaseController
{
    function addSels(Request $r): JsonResponse
    {
        try {
            $rules = [
                "data" => 'required',
                "total_bill_amt"=>'required|integer',
                "customer_id"=>'required|integer',
                "paid_status"=>'required',
                /* "product_id" => "required|integer",
                "qty" => "required|integer",
                "mrp" => "required|integer",
                "discount" => "required|integer",

                "cgst" => "required|integer",
                "sgst" => "required|integer",
                "amount" => "required|integer",
                "customer_id" => "required|integer",
                "hsncode" => "required|integer",*/
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }


            $databar = Td_sels::latest()->first();
            $bill_id = $databar ? $databar->billing_id : 0;

            $pymentStatus = ($r->paid_status == "Paid"||$r->paid_status == "paid"||$r->paid_status == "p"||$r->paid_status == "P") ? 'P' : 'D';
            foreach ($r->data as $billdata) {
                $data = Td_sels::create([
                    "customer_id" => $r->customer_id,
                    "mrp" => $billdata["mrp"],
                    "discount" => $billdata["discount"],
                    "cgst" => $billdata["cgst"],
                    "sgst" => $billdata["sgst"],
                    "amount" => $billdata["amount"],
                    "qty" => $billdata["qty"],
                    "hsncode" => $billdata["hsncode"],
                    "payment_flag"=>$pymentStatus,
                    "product_id" => $billdata["product_id"],
                    "billing_id" => $bill_id + 1,
                    "create_by" => auth()->user()->id,
                    "update_by" => auth()->user()->id
                ]);
            }

            Td_transaction::create([
                "customer_id" => $r->customer_id,
                "amount" => $r->total_bill_amt,
                "billing_id" => $bill_id + 1,
                "payment_flag"=>$pymentStatus,
                "transaction_date"=>date("Y-m-d H:i:s"),
                "created_by" => auth()->user()->id,
                "updated_by" => auth()->user()->id
            ]);
            return $this->sendResponse($data, "Add sels successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }

    function listSels($id): JsonResponse
    {
        try {
            $result = DB::table('td_sels')
            ->join('md_customer', 'td_sels.customer_id', '=', 'md_customer.customer_id')
            ->join('md_product', 'td_sels.product_id', '=', 'md_product.product_id')
            ->where('td_sels.billing_id', '=', $id)
            ->select(
                'td_sels.*',
                'md_customer.customer_name',
                'md_customer.company_name',
                'md_customer.mobile_no',
                'md_customer.address',
                'md_product.product_name',
                'md_product.unit_id',
                'md_product.user_type',
                'md_product.qty as product_qty'
            )
            ->get();
            return $this->sendResponse($result, "List sels successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}
