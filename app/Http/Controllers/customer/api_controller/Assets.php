<?php

namespace App\Http\Controllers\customer\api_controller;

use App\Http\Controllers\assets\ResponceBaseController;
use App\Http\Controllers\Controller;
use App\Models\Md_emplyee;
use App\Models\Md_shift;
use App\Models\MdProduct;
use App\Models\MD_MasterProduct;
use App\Models\MdUnit;
use App\Models\Td_InOutTime;
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
            $data = MdUnit::where("unit_id", $r->unit_id)->update([
                'unit_name' => $r->unit_name,
                'unit_size' => $r->unit_size
            ]);
            return $this->sendResponse($data, "Unit Edit successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function list_unit(): JsonResponse
    {
        try {
            $data = MdUnit::all();
            return $this->sendResponse($data, "Unit List");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function delete_unit(Request $r): JsonResponse
    {
        try {
            $rules = [
                'unit_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = MdUnit::where("unit_id", $r->unit_id)->delete();
            return $this->sendResponse($data, "Unit Delete successfully");
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
            $data = MdProduct::where("product_id", $r->product_id)->update([
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

    function list_product_mastar()
    {
        try {
            return $user_type=auth()->user()->type;
            $data = MdProduct::join("md_unit as a", "a.unit_id", "=", "md_product.unit_id")
                //->join("users as b","b.id","=","md_product.")
                ->where('md_product.user_type',$this->getUserType($user_type))
                ->select("md_product.*", "a.unit_name", "a.unit_size")->get();
            return $this->sendResponse($data, "Unit List");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function delete_product(Request $r): JsonResponse
    {
        try {
            $rules = [
                'product_id' => 'required|integer',
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = MdProduct::where("product_id", $r->product_id)->delete();
            return $this->sendResponse($data, "Product delete successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }



    function addEmplyee(Request $r): JsonResponse
    {
        try {
            $rules = [
                "employee_type" => "required",
                "employee_name" => "required|string",
                "employee_mobile" => "required|string",
                "employee_address" => "required|string"
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = Md_emplyee::create([
                "employee_type" => $r->employee_type,
                "employee_name" => $r->employee_name,
                "employee_mobile" => $r->employee_mobile,
                "employee_address" => $r->employee_address,
                "create_by" => auth()->user()->id,
                "update_by" => auth()->user()->id
            ]);
            return $this->sendResponse($data, "Add Emplyee successfully");
        } catch (\Exception $e) {
            return $this->sendError("exception handler error", $e, 400);
        }
    }


    function editEmplyee(Request $r): JsonResponse
    {
        try {
            $rules = [
                "employee_type" => "required",
                "employee_name" => "required|string",
                "employee_mobile" => "required|string",
                "employee_address" => "required|string",
                "employee_id" => "required|string"
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }
            $data = Md_emplyee::where("employee_id", $r->employee_id)->update([
                "employee_type" => $r->employee_type,
                "employee_name" => $r->employee_name,
                "employee_mobile" => $r->employee_mobile,
                "employee_address" => $r->employee_address,
                "update_by" => auth()->user()->id
            ]);
            return $this->sendResponse($data, "Edit Emplyee successfully");
        } catch (\Exception $e) {
            return $this->sendError("exception handler error", $e, 400);
        }
    }

    function listEmployees(): JsonResponse
    {
        try {
            $data = Md_emplyee::all();
            return $this->sendResponse($data, "List Emplyee successfully");
        } catch (\Exception $e) {
            return $this->sendError("exception handler error", $e, 400);
        }
    }

    function addShift(Request $r): JsonResponse
    {
        try{
            $rules = [
                "employee_type"=>"required",
                "work_time"=>"required",
                "work_rate"=>"required",
                "overtime_type"=>"required",
                "overtime_rate"=>"required"
                ];
                $valaditor = Validator::make($r->all(), $rules);
                if ($valaditor->fails()) {
                    return $this->sendError("request validation error", $valaditor->errors(), 400);
                }
                $data = Md_shift::create([
                    "employee_type"=>$r->employee_type,
                    "work_time"=>$r->work_time,
                    "work_rate"=>$r->work_rate,
                    "overtime_type"=>$r->overtime_type,
                    "overtime_rate"=>$r->overtime_rate,
                    "created_by"=>auth()->user()->id,
                    "updated_by"=>auth()->user()->id
                ]);
                return $this->sendResponse($data, "Add Shift successfully");
        }catch(\Exception $e){
            return $this->sendError("exception handler error", $e, 400);

        }
    }

    function editShift(Request $r): JsonResponse
    {
        try{
            $rules = [
                "employee_type"=>"required",
                "work_time"=>"required",
                "work_rate"=>"required",
                "overtime_type"=>"required",
                "overtime_rate"=>"required",
                "shift_id"=>"required|integer"
                ];
                $valaditor = Validator::make($r->all(), $rules);
                if ($valaditor->fails()) {
                    return $this->sendError("request validation error", $valaditor->errors(), 400);
                }
                $data = Md_shift::where("shift_id",$r->shift_id)->update([
                    "employee_type"=>$r->employee_type,
                    "work_time"=>$r->work_time,
                    "work_rate"=>$r->work_rate,
                    "overtime_type"=>$r->overtime_type,
                    "overtime_rate"=>$r->overtime_rate,
                    "updated_by"=>auth()->user()->id
                ]);
                return $this->sendResponse($data, "Edit Shift successfully");
        }catch(\Exception $e){
            return $this->sendError("exception handler error", $e, 400);
        }
    }

    function listShift(): JsonResponse
    {
        try{
            $data = Md_shift::all();
            return $this->sendResponse($data, "List Shift successfully");
        }catch(\Exception $e){
            return $this->sendError("exception handler error", $e, 400);
        }
    }


    function addInOut(Request $request):JsonResponse
    {
        try{
            $rules = [
                "employee_id"=>"required",
                "shift_id"=>"required",
                "in_time"=>"required",
                "out_time"=>"required",
                "date"=>"required",
                ];
                $valaditor = Validator::make($request->all(), $rules);
                if ($valaditor->fails()) {
                    return $this->sendError("request validation error", $valaditor->errors(), 400);
                }
                $data = Td_InOutTime::create([
                    "employee_id"=>$request->employee_id,
                    "shift_id"=>$request->shift_id,
                    "in_time"=>$request->in_time,
                    "out_time"=>$request->out_time,
                    "date"=>$request->date,
                    "create_by"=>auth()->user()->id,
                    "update_by"=>auth()->user()->id
                ]);
                return $this->sendResponse($data, "Add In Out successfully");
        }catch(\Exception $e){
            return $this->sendError("exception handler error", $e, 400);
        }
    }

    function editInOut(Request $r):JsonResponse
    {
        try{
            $rules = [
                "employee_id"=>"required|integer",
                "shift_id"=>"required|integer",
                "in_time"=>"required",
                "out_time"=>"required",
                "date"=>"required",
                "employee_in_out_id"=>"required|integer"
                ];
                $valaditor = Validator::make($r->all(), $rules);
                if ($valaditor->fails()) {
                    return $this->sendError("request validation error", $valaditor->errors(), 400);
                }
                $data = Td_InOutTime::where("employee_in_out_id",$r->employee_in_out_id)->update([
                    "employee_id"=>$r->employee_id,
                    "shift_id"=>$r->shift_id,
                    "in_time"=>$r->in_time,
                    "out_time"=>$r->out_time,
                    "date"=>$r->date,
                    "update_by"=>auth()->user()->id
                ]);
                return $this->sendResponse($data, "Edit In Out successfully");
        }catch(\Exception $e){
            return $this->sendError("exception handler error", $e, 400);
        }
    }

    function listInOut():JsonResponse
    {
        try{
            $data = Td_InOutTime::all();
            return $this->sendResponse($data, "List In Out successfully");
        }catch(\Exception $e){
            return $this->sendError("exception handler error", $e, 400);
        }
    }

    function add_master_product(Request $r): JsonResponse
    {
        try {
            $rules = [
                'product_name' => 'required|string'
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError("request validation error", $valaditor->errors(), 400);
            }

            $data = MD_MasterProduct::create([
                'product_name' => $r->product_name
            ]);
            return $this->sendResponse($data, "new product add successfully");
        } catch (\Throwable $th) {
            return $this->sendError("exception handler error", $th, 400);
        }
    }


    function edit_master_product(Request $r):JsonResponse
    {
        try{
            $rules = [
                "product_name"=>"required",
                "master_product_id"=>"required|integer"
                ];
                $valaditor = Validator::make($r->all(), $rules);
                if ($valaditor->fails()) {
                    return $this->sendError("request validation error", $valaditor->errors(), 400);
                }
                $data = MD_MasterProduct::where("id_master_product",$r->master_product_id)->update([
                    'product_name' => $r->product_name
                ]);
                return $this->sendResponse($data, "Edit master product successfully");
        }catch(\Exception $e){
            return $this->sendError("exception handler error", $e, 400);
        }
    }



    function list_master_product(Request $r):JsonResponse
    {
        try{
                $data = MD_MasterProduct::all();
                return $this->sendResponse($data, "List master product successfully");
        }catch(\Exception $e){
            return $this->sendError("exception handler error", $e, 400);
        }
    }

}
