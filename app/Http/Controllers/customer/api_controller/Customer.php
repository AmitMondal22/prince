<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\Md_customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Customer extends ResponceBaseController
{
    function add(Request $r)
    {
        try {
            $rules = [
                'customer_name' => 'required|string',
                'company_name' => 'required|string',
                'mobile_no' => 'required|integer',
                'address' => 'required|string',

            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }

            $data = Md_customer::create([
                "customer_name" => $r->customer_name,
                "company_name"=>$r->company_name,
                "mobile_no" => $r->mobile_no,
                "address" => $r->address,
                //"create_by" => auth()->user()->id,
                //"update_by" => auth()->user()->id
            ]);

            return $this->sendResponse($data, "Add customer successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}
