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

        return redirect('/downloadQR');
    }

    public function editAntrian($id){
        $antrian_usaha = AntrianUsaha::find($id);
        return view('editAntrian', compact('antrian_usaha'));
    }

    public function updateAntrian(Request $request,$id){
   
        $AntrianUsaha = AntrianUsaha::find($id);
        $AntrianUsaha->namaantrian = $request->nama_antrian;
        $AntrianUsaha->time = $request->alokasi_waktu;
        $AntrianUsaha->pertanyaan1 = $request->pertanyaan1;
        $AntrianUsaha->pertanyaan2 = $request->pertanyaan2;
        $AntrianUsaha->pertanyaan3 = $request->pertanyaan3;
        $AntrianUsaha->lokasiusaha = $request->lokasi;
        $AntrianUsaha->save();

        return redirect()->back()->with('message', "Data Antrian Berhasil Diubah");
    }

    public function CekAntrian($id)
    {
        $user = User::find($id);
        $pesanan_id = DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', $id)->where('SudahDilayani', true)->max('pesanans.id');
        $antrian_usaha_id = DB::table('antrian_usahas')->join('users', 'users.id', '=', 'antrian_usahas.user_id')->where('antrian_usahas.user_id', $id)->value('antrian_usahas.id');
        $AntrianUsaha = AntrianUsaha::find($antrian_usaha_id);
        $pesanan = DB::select('select p.id as id from pesanans p left outer join antrian_usahas a on p.antrian_id = a.id where SudahDilayani = false');
        return view('CekAntrian', compact('user', 'AntrianUsaha', 'pesanan_id', 'pesanan'));
    }

    public function addPesanan(Request $request, $id){

        $antrian_id = $id;
        $nama_pembeli = $request->nama;
        $SudahDilayani = false;
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
        $pesanan=Pesanan::find($pesanan_id);
        $antrian_usaha = AntrianUsaha::find($id);
        $pesanan_saatini_id = DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', $id)->where('SudahDilayani', true)->max('pesanans.id');
        $semua_pesanan = DB::select('select p.id as id, SudahDilayani from pesanans p left outer join antrian_usahas a on p.antrian_id = a.id');
        return view('InfoAntrian', compact('pesanan','antrian_usaha', 'pesanan_saatini_id', 'semua_pesanan'));
    }

    public function daftarAntrian($id){
        $listantrian = Db::select('select p.id, nama_pembeli, CreatedDateTime, SudahDilayani, Jawaban1, Jawaban2, Jawaban3 from pesanans p left outer join antrian_usahas a on p.antrian_id = a.id where SudahDilayani = false');
        $pesanan_id = DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', $id)->where('SudahDilayani', false)->min('pesanans.id');
        $pesanan_sudahdilayani = Db::select('select max(p.id) as id, max(nama_pembeli) as nama_pembeli, max(CreatedDateTime) as CreatedDateTime from pesanans p left outer join antrian_usahas a on p.antrian_id = a.id where SudahDilayani = true');
        $antrian_usaha_id = DB::table('antrian_usahas')->join('users', 'users.id', '=', 'antrian_usahas.user_id')->where('antrian_usahas.user_id', $id)->value('antrian_usahas.id');
        $antrian_usaha = AntrianUsaha::find($antrian_usaha_id);
        return view('daftarAntrian', compact('listantrian', 'pesanan_id', 'antrian_usaha_id', 'pesanan_sudahdilayani', 'antrian_usaha'));
    }

    public function panggilAntrian($id, $pesanan_id){
        $pesanan = Pesanan::find($pesanan_id);
        $pesanan->SudahDilayani = true;
        $pesanan->save();
        return redirect('/daftarantrian'.'/'.$id);
    }

    public function pauseAntrian($id){
        $antrian_usaha = AntrianUsaha::find($id);
        $antrian_usaha->antrianaktif = false;
        $antrian_usaha->save();

        return redirect()->back();
    }

    public function startAntrian($id){
        $antrian_usaha = AntrianUsaha::find($id);
        $antrian_usaha->antrianaktif = true;
        $antrian_usaha->save();

        return redirect()->back();
    }

    public function deletePesanan($id){
        DB::table('pesanans')->where('id', $id)->delete();

        return redirect()->back();
    }

    public function detailPesanan($id, $pesanan_id){
        $pesanan=Pesanan::find($pesanan_id);
        $antrian_usaha = AntrianUsaha::find($id);
        return view('detailPesanan', compact('pesanan','antrian_usaha'));
    }

    public function keluarAntrian($id, $pesanan_id){
        if (DB::table('pesanans')->where('id', $pesanan_id)->value('SudahDilayani') == false) {
            DB::table('pesanans')->where('id', $pesanan_id)->delete();

            return redirect('/CekAntrian'.'/'.$id);
        } else {
            return redirect()->back()->with('keluar_failed', 'Antrian Sudah Dilayani Tidak Bisa Keluar Antrian');
        }
    }
}
