<?php

namespace App\Http\Controllers;

use App\MaCandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class MaCandidatController extends Controller
{
    public function index()
    {
        $data = MaCandidat::paginate(15)->onEachSide(5);
        
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'warga_negara' => 'required',
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
        
        // $path = new \stdClass();
        // $path->pas_foto = $this->prsoesUpload($request->file('pas_foto'), 'pas_foto/', 'pas_foto_'.$id);
        // $path->ktp = $this->prsoesUpload($request->file('ktp'), 'ktp/', 'ktp_'.$id);

        $data = new MaCandidat();
        $data->id =  $id;
        $data->nama_lengkap = $request->nama_lengkap;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->alamat = $request->alamat;
        $data->agama = $request->agama;
        $data->pekerjaan = $request->pekerjaan;
        $data->warga_negara = $request->warga_negara;
        $data->no_ktp = $request->no_ktp;
        // $data->pas_foto = $path->pas_foto;
        // $data->ktp = $path->ktp;
        $data->save();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        $data = MaCandidat::find($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function update(Request $request, $id)
    {        
        $data = MaCandidat::find($id);

        if(!$data)
        {
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => null
            ], 404);
        }

        if($request->nama_lengkap !== "" || $request->nama_lengkap !== null)
            $data->nama_lengkap = $request->nama_lengkap;
        
        if($request->tempat_lahir !== "" || $request->tempat_lahir !== null)
            $data->tempat_lahir = $request->tempat_lahir;
        
        if($request->tgl_lahir !== "" || $request->tgl_lahir !== null)
            $data->tgl_lahir = $request->tgl_lahir;    
        
        if($request->alamat !== "" || $request->alamat !== null)
            $data->alamat = $request->alamat;               

        if($request->agama !== "" || $request->agama !== null)
            $data->agama = $request->agama;              

        if($request->pekerjaan !== "" || $request->pekerjaan !== null)
            $data->pekerjaan = $request->pekerjaan;   
            
        if($request->warga_negara !== "" || $request->warga_negara !== null)
            $data->warga_negara = $request->warga_negara;     
            
        $data->update();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $data = MaCandidat::find($id);

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
        $data = MaCandidat::get();
        
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function uploadKTP(Request $request, $id)
    {
        $data = MaCandidat::find($id);

        if(!$data)
        {
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => null
            ], 404);
        }

        $ktp = $this->prsoesUpload($request->file('ktp'), 'ktp/', 'ktp_'.$id);

        $data->ktp = $ktp;
            
        $data->update();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function uploadPasFoto(Request $request, $id)
    {
        $data = MaCandidat::find($id);

        if(!$data)
        {
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => null
            ], 404);
        }

        $pas_foto = $this->prsoesUpload($request->file('pas_foto'), 'pas_foto/', 'pas_foto_'.$id);

        $data->pas_foto = $pas_foto;
            
        $data->update();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    private function prsoesUpload($file, $tujuan_upload, $nama_file)
    {
        
		$file->move('uploads/'.$tujuan_upload,$nama_file.'.'.$file->getClientOriginalExtension());

        return $tujuan_upload.$nama_file.'.'.$file->getClientOriginalExtension();
	}
}
