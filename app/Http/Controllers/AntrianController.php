<?php

namespace App\Http\Controllers;

use App\Models\AntrianUsaha;
use App\Models\User;
use CreateAntrianUsahasTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AntrianController extends Controller
{
    public function antrian($id)
    {
        $user = User::find($id);
        if (is_null(DB::table('antrian_usahas')->join('users', 'users.id', '=', 'antrian_usahas.user_id')->where('antrian_usahas.user_id', $id)->value('antrian_usahas.namaantrian'))) {
            return view('setupAntrian', compact('user'));
        }else{
            return redirect('/daftarantrian');
        }
    }

    public function addAntrian(Request $request, $id)
    {


        $antrian_usaha_id = DB::table('antrian_usahas')->join('users', 'users.id', '=', 'antrian_usahas.user_id')->where('antrian_usahas.user_id', $id)->value('antrian_usahas.id');
        $AntrianUsaha = AntrianUsaha::find($antrian_usaha_id);
        $AntrianUsaha->namaantrian = $request->nama_antrian;
        $AntrianUsaha->time = $request->alokasi_waktu;
        $AntrianUsaha->pertanyaan1 = $request->pertanyaan1;
        $AntrianUsaha->pertanyaan2 = $request->pertanyaan2;
        $AntrianUsaha->pertanyaan3 = $request->pertanyaan3;
        $AntrianUsaha->lokasiusaha = $request->lokasi;
        $AntrianUsaha->save();

        // $nama_antrian = $request->nama_antrian;
        // $AntrianUsaha = AntrianUsaha::find(User::find($id),['user_id']);
        // $AntrianUsaha->$alokasi_waktu = $request->alokasi_waktu;
        // $AntrianUsaha->$pertanyaan1 = $request->pertanyaan1;
        // $AntrianUsaha->$pertanyaan2 = $request->pertanyaan2;
        // $AntrianUsaha->$pertanyaan3 = $request->pertanyaan3;
        // $AntrianUsaha->$lokasi = $request->lokasi;


        // DB::table('antrian_usahas')->where('user_id', '=', User::find($id))->insert([
        //     'nama_antrian' => $nama_antrian,
        //     'alokasi_waktu ' => $alokasi_waktu ,
        //     'pertanyaan1' => $pertanyaan1,
        //     'pertanyaan2' => $pertanyaan2,
        //     'pertanyaan3' => $pertanyaan3,
        //     'lokasi' => $lokasi,
        // ]);

        return redirect('/downloadQR');
    }

    public function CekAntrian($id){
        $user = User::find($id);
            return view('CekAntrian', compact('user'));
    }

}
