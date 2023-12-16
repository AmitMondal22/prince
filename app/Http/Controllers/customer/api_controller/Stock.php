<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\Td_stock;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Stock extends ResponceBaseController
{
    function addStock(Request $request): JsonResponse
    {
        try {
            $rules = [
                'product_id' => 'required|integer',
                'qty' => 'required|integer',
                'user_id' => 'required|integer',
                'unit_id' => 'required|integer',
            ];
            $valaditor = Validator::make($request->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = Td_stock::create([
                'product_id' => $request->product_id,
                'qty' => $request->qty,
                'user_id' => $request->user_id,
                'unit_id' => $request->unit_id,
                'create_by' => $request->user_id
            ]);
            return $this->sendResponse($data, "Add Stock successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function editStock(Request $request): JsonResponse
    {
        try {
            $rules = [
                'product_id' => 'required|integer',
                'qty' => 'required|integer',
                'user_id' => 'required|integer',
                'unit_id' => 'required|integer',
                'stock_id' => 'required|integer',
            ];
            $valaditor = Validator::make($request->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = Td_stock::where("stock_id", $request->stock_id)->update([
                'product_id' => $request->product_id,
                'qty' => $request->qty,
                'user_id' => $request->user_id,
                'unit_id' => $request->unit_id,
                'create_by' => $request->user_id
            ]);
            return $this->sendResponse($data, "Edit Stock successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function listStock():JsonResponse{
        try{
            $result = DB::table('td_stock')
            ->join('md_product', 'td_stock.product_id', '=', 'md_product.product_id')
            ->join('md_unit', 'td_stock.unit_id', '=', 'md_unit.unit_id')
            ->select('td_stock.*', 'md_product.product_name', 'md_product.unit_id as product_unit_id', 'md_product.user_type', 'md_product.qty as product_qty', 'md_unit.unit_name', 'md_unit.unit_size')
            ->get();
            return $this->sendResponse($result, "Stock List");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }
}
