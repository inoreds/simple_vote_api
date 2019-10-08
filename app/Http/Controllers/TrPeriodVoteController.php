<?php

namespace App\Http\Controllers;

use App\TrPeriodVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class TrPeriodVoteController extends Controller
{
    public function periodVote($id)
    {
        $data = TrPeriodVote::with('period')->where('period_id', $id)->paginate(15)->onEachSide(5);
        
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function index(Request $request)
    {
        if ($request->status){
            $data = TrPeriodVote::with('period')->whereIn('status', $request->status)->paginate(15)->onEachSide(5);
        } else {
            $data = TrPeriodVote::with('period')->paginate(15)->onEachSide(5);
        }
        
        
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
            'name' => 'required',
            'description' => 'required',
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
        
        $data = new TrPeriodVote();
        $data->id =  Uuid::uuid4()->toString();
        $data->period_id = $request->period_id;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->status = 'NEW';
        $data->save();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        $data = TrPeriodVote::with('period')->find($id);

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
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'error',
                'data' => $v->errors()
            ], 422);
        } 
        
        $data = TrPeriodVote::find($id);

        if(!$data)
        {
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => null
            ], 404);
        }

        $data->period_id = $request->period_id;
        $data->name = $request->name;   
        $data->description = $request->description;  
            
        $data->update();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $data = TrPeriodVote::find($id);

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
        $data = TrPeriodVote::get();
        
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function statusVote(Request $request, $id){
        
        $data = TrPeriodVote::find($id);

        if(!$data)
        {
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => null
            ], 404);
        }
        
        $data->status = $request->status;    
            
        $data->update();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }
}
