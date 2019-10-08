<?php

namespace App\Http\Controllers;

use App\MaPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class MaPeriodController extends Controller
{
    public function index()
    {
        $data = MaPeriod::paginate(15)->onEachSide(5);
        
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'period' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'error',
                'data' => $v->errors()
            ], 422);
        }   

        $data = new MaPeriod();
        $data->id =  Uuid::uuid4()->toString();
        $data->period = $request->period;
        $data->start = $request->start;
        $data->end = $request->end;
        $data->status = $request->status;
        $data->save();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        $data = MaPeriod::find($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function update(Request $request, $id)
    {        
        $data = MaPeriod::find($id);

        if(!$data)
        {
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => null
            ], 404);
        }

        if($request->period !== "" || $request->period !== null)
            $data->period = $request->period;
        
        if($request->start !== "" || $request->start !== null)
            $data->start = $request->start;
        
        if($request->end !== "" || $request->end !== null)
            $data->end = $request->end;    
        
        if($request->status !== "" || $request->status !== null)
            $data->status = $request->status;               
        
        $data->update();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $data = MaPeriod::find($id);

        if(!$data)
        {
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => null
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function getDataList()
    {
        $data = MaPeriod::get();
        
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }
}
