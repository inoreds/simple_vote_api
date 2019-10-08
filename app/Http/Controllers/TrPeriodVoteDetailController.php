<?php

namespace App\Http\Controllers;

use App\TrPeriodVoteDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class TrPeriodVoteDetailController extends Controller
{
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'period_vote_id' => 'required',
            'candidat_period_id' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'error',
                'data' => $v->errors()
            ], 422);
        }   

        $data = new TrPeriodVoteDetail();
        $data->id =  Uuid::uuid1()->toString();
        $data->period_vote_id = $request->period_vote_id;
        $data->candidat_period_id = $request->candidat_period_id;
        $data->save();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function getResult($id) {
        // $data = TrPeriodVoteDetail::select(DB::raw('candidat_period_id, count(*) as result'))
        //                     ->where('period_vote_id', $id)
        //                     ->groupBy('candidat_period_id')
        //                     ->get();
        
        $data = TrPeriodVoteDetail::select(DB::raw("candidat_period_id, count(*) as result, count(*) / (select count(*) 
                                                    from tr_period_vote_details where period_vote_id='".$id."')  as percentage"))
                            ->where('period_vote_id', $id)
                            ->groupBy('candidat_period_id')
                            ->get();
        
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }
}
