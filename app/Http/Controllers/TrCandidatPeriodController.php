<?php

namespace App\Http\Controllers;

use App\TrCandidatPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class TrCandidatPeriodController extends Controller
{
    public function candidat($id)
    {
        $data = TrCandidatPeriod::with('candidat')
                                ->with('period')
                                ->where('period_id',$id)
                                ->paginate(15)
                                ->onEachSide(5);
        
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function index()
    {
        $data = TrCandidatPeriod::paginate(15)->onEachSide(5);
        
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'period_id' => 'required',
            'candidat_id' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'error',
                'data' => $v->errors()
            ], 422);
        }   

        $id = Uuid::uuid4()->toString();
        
        $data = new TrCandidatPeriod();
        $data->id =  Uuid::uuid4()->toString();
        $data->period_id = $request->period_id;
        $data->candidat_id = $request->candidat_id;
        $data->save();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        $data = TrCandidatPeriod::find($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function update(Request $request, $id)
    {      
        $v = Validator::make($request->all(), [
            'period_id' => 'required',
            'candidat_id' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'error',
                'data' => $v->errors()
            ], 422);
        } 
        
        $data = TrCandidatPeriod::find($id);

        if(!$data)
        {
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => null
            ], 404);
        }

        $data->period_id = $request->period_id;
        $data->candidat_id = $request->candidat_id;    
            
        $data->update();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $data = TrCandidatPeriod::find($id);

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
        $data = TrCandidatPeriod::get();
        
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }
}
