<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Epresence;
use App\Http\Resources\EpresenceResource;
use App\User;
use Auth;

class EpresenceController extends Controller
{
    public function in(Request $request){
        $in = Epresence::create([
            'id_users' => auth()->user()->id,
            'type' => 'IN',
            'date' => now()
        ]);

        return response()->json([
            'type' => $in->type,
            'waktu' => date("Y-m-d H:i:s", strtotime($in->date)),
        ], 200);
    }

    public function out(Request $request){
        $out = Epresence::create([
            'id_users' => auth()->user()->id,
            'type' => 'OUT',
            'date' => now()
        ]);

        return response()->json([
            'type' => $out->type,
            'waktu' => date("Y-m-d H:i:s", strtotime($out->date)),
        ], 200);
    }

    public function checkin(Request $request, $id){

        try {
            $data = Epresence::find($id);
            $data->is_approve = $request->is_approved;
            $data->save();

            $user = User::where('id', $data->id_users)->first();
            $user->npp_supervisor = auth()->user()->npp;
            $user->save();
    
            return response()->json([
                'is_approve' => $data->is_approve == 1 ? 'APPROVED' : 'REJECT',
                'waktu' => date("Y-m-d H:i:s", strtotime(now())),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
            ], 200);
        }
    }

    public function userData(Request $request, $id){
        $data = User::with('epresence')->find($id);

        $newData = new EpresenceResource($data);
        

        return response()->json([
            'message' => "sukses get data",
            'data' => $newData
        ], 200);
    }

}
