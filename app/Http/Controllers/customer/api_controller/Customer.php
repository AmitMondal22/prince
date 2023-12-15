<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\Md_customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Customer extends ResponceBaseController
{
    function add(Request $r): JsonResponse
    {
        try {
            $rules = [
                'customer_name' => 'required|string',
                'company_name' => 'string',
                'mobile_no' => 'required|integer',
                'address' => 'required|string',

            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            if($r->company_name){
                $data = Md_customer::create([
                "customer_name" => $r->customer_name,
                "company_name"=>$r->company_name,
                "mobile_no" => $r->mobile_no,
                "address" => $r->address,
            ]);
            }else{
                $data = Md_customer::create([
                "customer_name" => $r->customer_name,
                "company_name"=>$r->customer_name,
                "mobile_no" => $r->mobile_no,
                "address" => $r->address,
                //"create_by" => auth()->user()->id,
                //"update_by" => auth()->user()->id
            ]);
            }


            return $this->sendResponse($data, "Add customer successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }

    function listCustomer(): JsonResponse
    {
        try {
            $data = Md_customer::get();
            return $this->sendResponse($data, "List customer successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
    function editCustomer(Request $r): JsonResponse
    {
        try {
            $rules = [
                'customer_id' => 'required|integer',
                'customer_name' => 'required|string',
                'company_name' => 'string',
                'mobile_no' => 'required|integer',
                'address' => 'required|string',

            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            if($r->company_name){
                $data = Md_customer::where("customer_id",$r->customer_id)->update([
                "customer_name" => $r->customer_name,
                "company_name"=>$r->company_name,
                "mobile_no" => $r->mobile_no,
                "address" => $r->address,
            ]);
            }else{
                $data = Md_customer::where("customer_id",$r->customer_id)->update([
                "customer_name" => $r->customer_name,
                "company_name"=>$r->customer_name,
                "mobile_no" => $r->mobile_no,
                "address" => $r->address,
                //"create_by" => auth()->user()->id,
                //"update_by" => auth()->user()->id
            ]);
            }
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}
