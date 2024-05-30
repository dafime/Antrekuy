<?php

namespace App\Http\Controllers;

use App\Models\AntrianUsaha;
use App\Models\Pembeli;
use App\Models\Pesanan;
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
        } else {
            $antrian_usaha_id = DB::table('antrian_usahas')->join('users', 'users.id', '=', 'antrian_usahas.user_id')->where('antrian_usahas.user_id', $id)->value('antrian_usahas.id');
            return redirect('/daftarantrian'.'/'.$antrian_usaha_id);
        }
    }

    public function addAntrian(Request $request, $id)
    {


        $antrian_usaha_id = DB::table('antrian_usahas')->join('users', 'users.id', '=', 'antrian_usahas.user_id')->where('antrian_usahas.user_id', $id)->value('antrian_usahas.id');
        $AntrianUsaha = AntrianUsaha::find($antrian_usaha_id);
        $AntrianUsaha->namaantrian = $request->nama_antrian;
        $AntrianUsaha->time = $request->alokasi_waktu;
        $AntrianUsaha->antrianaktif = true;
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

    public function CekAntrian($id)
    {
        $user = User::find($id);
        $antrian_usaha_id = DB::table('antrian_usahas')->join('users', 'users.id', '=', 'antrian_usahas.user_id')->where('antrian_usahas.user_id', $id)->value('antrian_usahas.id');
        $AntrianUsaha = AntrianUsaha::find($antrian_usaha_id);
        return view('CekAntrian', compact('user', 'AntrianUsaha'));
    }

    public function addPesanan(Request $request, $id){

        $antrian_id = $id;
        $nama_pembeli = $request->nama;
        $SudahDilayani = true;
        $jawaban1 = $request->jawaban1;
        $jawaban2 = $request->jawaban2;
        $jawaban3 = $request->jawaban3;
        DB::table('pesanans')->insert([
            'antrian_id' => $antrian_id,
            'nama_pembeli' => $nama_pembeli,
            'SudahDilayani' => $SudahDilayani,
            'jawaban1' => $jawaban1,
            'jawaban2' => $jawaban2,
            'jawaban3' => $jawaban3,
        ]);
        $pesanan_id = DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', $id)->max('pesanans.id');
        return redirect('/InfoAntrian'.'/'.$id.'/'.$pesanan_id);
    }

    public function InfoAntrian($id, $pesanan_id){
        $pesanan_id = DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', $id)->value('pesanans.id');
        $pesanan=Pesanan::find($pesanan_id);
        $antrian_usaha = AntrianUsaha::find($id);
        return view('InfoAntrian', compact('pesanan','antrian_usaha'));
    }

    public function daftarAntrian($id){
        $listantrian = Db::select('select p.id, nama_pembeli, CreatedDateTime, SudahDilayani, Jawaban1, Jawaban2, Jawaban3 from pesanans p left outer join antrian_usahas a on p.antrian_id = a.id where SudahDilayani = false');
        return view('daftarAntrian', compact('listantrian'));
    }
}
