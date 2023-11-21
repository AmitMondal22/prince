<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\MdProduct;
use App\Models\MdUnit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class Assets extends ResponceBaseController
{

    function unit_add(Request $r): JsonResponse
    {
        try {
            $rules = [
                'unit_name' => 'required|string',
                'unit_size' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = MdUnit::create([
                'unit_name' => $r->unit_name,
                'unit_size' => $r->unit_size
            ]);
            return $this->sendResponse($data, "Add Unit successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function unit_edit(Request $r): JsonResponse
    {
        try {
            $rules = [
                'unit_name' => 'required|string',
                'unit_size' => 'required|integer',
                'unit_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = MdUnit::where("unit_id",$r->unit_id)->update([
                'unit_name' => $r->unit_name,
                'unit_size' => $r->unit_size
            ]);
            return $this->sendResponse($data, "Unit Edit successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }



    function product_add(Request $r): JsonResponse
    {
        try {
            $rules = [
                'product_name' => 'required|string',
                'user_type' => 'required|string',
                'qty' => 'required|integer',
                'unit_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = MdProduct::create([
                'product_name' => $r->product_name,
                'unit_id' => $r->unit_id,
                'user_type' => $r->user_type,
                'qty' => $r->qty
            ]);
            return $this->sendResponse($data, "new product add successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function product_edit(Request $r): JsonResponse
    {
        try {
            $rules = [
                'product_name' => 'required|string',
                'user_type' => 'required|string',
                'qty' => 'required|integer',
                'unit_id' => 'required|integer',
                'product_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = MdProduct::where("product_id",$r->product_id)->create([
                'product_name' => $r->product_name,
                'unit_id' => $r->unit_id,
                'user_type' => $r->user_type,
                'qty' => $r->qty
            ]);
            return $this->sendResponse($data, "Product edit successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }

    function list_product_mastar():JsonResponse{
        try{
            $data=MdProduct::join("md_unit as a","a.unit_id","=","md_product.unit_id")
                            ->select("md_product.*","a.unit_name","a.unit_size")->get();
            return $this->sendResponse($data, "Unit List");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
    function list_unit():JsonResponse{
        try{
            $data=MdUnit::all();
            return $this->sendResponse($data, "Unit List");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }

}
