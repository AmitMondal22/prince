<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\Td_sels;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Sels extends ResponceBaseController
{
    function addSels(Request $r): JsonResponse
    {
        try {
            $rules = [
                "data" => 'required',
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
            $bill_id = $databar ? $databar->billint_id : 0;


            foreach ($r->data as $billdata) {
                $data = Td_sels::create([
                    "customer_id" => $billdata["customer_id"],
                    "mrp" => $billdata["mrp"],
                    "discount" => $billdata["discount"],
                    "cgst" => $billdata["cgst"],
                    "sgst" => $billdata["sgst"],
                    "amount" => $billdata["amount"],
                    "qty" => $billdata["qty"],
                    "hsncode" => $billdata["hsncode"],
                    "product_id" => $billdata["product_id"],
                    "billint_id" => $bill_id + 1,
                    "create_by" => auth()->user()->id,
                    "update_by" => auth()->user()->id
                ]);
            }
            return $this->sendResponse($data, "Add sels successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}
