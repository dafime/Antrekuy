<?php

namespace App\Http\Controllers;

use TCPDF;
use App\Events\PostCreated;
use App\Models\AntrianUsaha;
use App\Models\Pembeli;
use App\Models\Pesanan;
use App\Models\User;
use Carbon\Carbon;
use CreateAntrianUsahasTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelQRCode\Facades\QRCode;

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
        $AntrianUsaha->latitude = $request->latitudeInput;
        $AntrianUsaha->longitude = $request->longitudeInput;
        $AntrianUsaha->save();

        return redirect('/downloadQR'.'/'.$antrian_usaha_id);
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
        $AntrianUsaha->latitude = $request->latitudeInput;
        $AntrianUsaha->longitude = $request->longitudeInput;
        $AntrianUsaha->save();

        return redirect()->back()->with('message', "Data Antrian Berhasil Diubah");
    }

    public function CekAntrian($id)
    {
        $user = User::find($id);
        $antrian_usaha_id = DB::table('antrian_usahas')->join('users', 'users.id', '=', 'antrian_usahas.user_id')->where('antrian_usahas.user_id', $id)->value('antrian_usahas.id');
        $pesanan_id = DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', $antrian_usaha_id)->where('SudahDilayani', true)->max('noantrian');
        $AntrianUsaha = AntrianUsaha::find($antrian_usaha_id);
        $pesanan = DB::select('select p.id as id from pesanans p left outer join antrian_usahas a on p.antrian_id = a.id where SudahDilayani = false and antrian_id ='.$antrian_usaha_id);

        return view('CekAntrian', compact('user', 'AntrianUsaha', 'pesanan_id', 'pesanan'));
    }

    public function addPesanan(Request $request, $id){
        if(DB::table('antrian_usahas')->where('id', $id)->value('antrianaktif') == false){
            return redirect()->back();
        }

        $antrian_id = $id;
        $CurrentDateTime =  Carbon::now();
        $currentDay = $CurrentDateTime->format('d/m/y');
        $noantrian = DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', $id)->max('noantrian');
        $CreatedDateTime = DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', $id)->max('CreatedDateTime');
        $CreatedDateTime = Carbon::parse($CreatedDateTime);
        $CreatedDay = $CreatedDateTime->format('d/m/y');
        if(is_null($noantrian) || $currentDay != $CreatedDay){
            $noantrian = 1;
        }else{
            $noantrian++;
        }
        $nama_pembeli = $request->nama;
        $SudahDilayani = false;
        $jawaban1 = $request->jawaban1;
        $jawaban2 = $request->jawaban2;
        $jawaban3 = $request->jawaban3;
        DB::table('pesanans')->insert([
            'antrian_id' => $antrian_id,
            'noantrian' => $noantrian,
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
        if(is_null($pesanan=Pesanan::find($pesanan_id))){
            return redirect('/CekAntrian'.'/'.$id)->with('message', 'Anda Keluar Dari Antrian');
        }
        $pesanan=Pesanan::find($pesanan_id);
        $antrian_usaha = AntrianUsaha::find($id);
        $pesanan_saatini_id = DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', $id)->where('SudahDilayani', true)->max('pesanans.noantrian');
        $semua_pesanan = DB::select('select p.id as id, SudahDilayani from pesanans p left outer join antrian_usahas a on p.antrian_id = a.id where antrian_id ='.$id);
        $pesanan_teratas = DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', $id)->where('SudahDilayani', false)->min('pesanans.noantrian');
        if(DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', $id)->where('SudahDilayani', true)->max('pesanans.noantrian') == $pesanan->noantrian){

            $data = 'Anda sedang dilayani dimohon untuk segera mendatangi tempat';
        }else{
            $data = 'Anda berada diantrian paling atas dimohon untuk mendatangi tempat';
        }

        event(new PostCreated($data));
        return view('InfoAntrian', compact('pesanan','antrian_usaha', 'pesanan_saatini_id', 'semua_pesanan', 'pesanan_teratas'));
    }

    public function daftarAntrian($id){
        $CurrentDateTime =  Carbon::now();
        $currentDay = $CurrentDateTime->format('d/m/y');
        $noantrian = DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', $id)->max('noantrian');
        $CreatedDateTime = DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', $id)->value('CreatedDateTime');
        $CreatedDateTime = Carbon::parse($CreatedDateTime);
        $CreatedDay = $CreatedDateTime->format('d/m/y');
        $listantrian = Db::select('select p.id, noantrian, nama_pembeli, CreatedDateTime, SudahDilayani, Jawaban1, Jawaban2, Jawaban3 from pesanans p left outer join antrian_usahas a on p.antrian_id = a.id where SudahDilayani = false and antrian_id= 0');
        $pesanan_id = DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', '0')->where('SudahDilayani', false)->min('pesanans.id');
        $pesanan_sudahdilayani = Db::select('select max(p.id) as id, max(noantrian) as noantrian, max(nama_pembeli) as nama_pembeli, max(CreatedDateTime) as CreatedDateTime from pesanans p left outer join antrian_usahas a on p.antrian_id = a.id where SudahDilayani = true and antrian_id = 0');
        if($currentDay == $CreatedDay){   
            $listantrian = Db::select('select p.id, noantrian, nama_pembeli, CreatedDateTime, SudahDilayani, Jawaban1, Jawaban2, Jawaban3 from pesanans p left outer join antrian_usahas a on p.antrian_id = a.id where SudahDilayani = false and antrian_id='.$id);
            $pesanan_id = DB::table('pesanans')->join('antrian_usahas', 'antrian_usahas.id', '=', 'pesanans.antrian_id')->where('pesanans.antrian_id', $id)->where('SudahDilayani', false)->min('pesanans.id');
            $pesanan_sudahdilayani = Db::select('select max(p.id) as id, max(noantrian) as noantrian, max(nama_pembeli) as nama_pembeli, max(CreatedDateTime) as CreatedDateTime from pesanans p left outer join antrian_usahas a on p.antrian_id = a.id where SudahDilayani = true and antrian_id ='.$id);
        }
        $antrian_usaha_id = $id;
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

    public function downloadQrcode($id){
        $antrian_usaha = AntrianUsaha::find($id);
        return view('downloadQrcode', compact('id', 'antrian_usaha'));
    }

    public function QRCode($id){
        $file = public_path('Barcode.png');
        QRCode::url('http://127.0.0.1:8000/CekAntrian/'.$id)->setOutfile($file)->setSize(25)->png();
        if (file_exists($file)) {
            return response()->download($file, 'Barcode.png');
        } else {
            abort(404, 'File not found');
        }
    }

    public function laporan()
    {
        return view('generateLaporan');
    }


    public function laporanAntrian($id, $tanggal)
    {

        //data dari DB
        $namaAntrian = DB::table('antrian_usahas')->join('users', 'users.id', '=', 'antrian_usahas.user_id')->where('user_id', $id)->value('antrian_usahas.namaantrian');
        $namaUsaha = DB::table('antrian_usahas')->join('users', 'users.id', '=', 'antrian_usahas.user_id')->where('user_id', $id)->value('users.nama_usaha');
        $alokasiWaktu = DB::table('antrian_usahas')->where('user_id', $id)->value('time')." menit";

        $pertanyaan1 = DB::table('antrian_usahas')->where('user_id', $id)->value('pertanyaan1');

        if (is_null(DB::table('antrian_usahas')->where('user_id', $id)->value('pertanyaan2'))){
            $pertanyaan2 = '-';
        } else {
            $pertanyaan2 = DB::table('antrian_usahas')->where('user_id', $id)->value('pertanyaan2');
        }

        if (is_null(DB::table('antrian_usahas')->where('user_id', $id)->value('pertanyaan3'))){
            $pertanyaan3 = '-';
        } else {
            $pertanyaan3 = DB::table('antrian_usahas')->where('user_id', $id)->value('pertanyaan3');
        }

        $jumlahAntrian = DB::table('antrian_usahas')->join('users', 'users.id', '=', 'antrian_usahas.user_id')->join('pesanans', 'pesanans.antrian_id', '=', 'antrian_usahas.id')->where('users.id', $id)->whereDate('pesanans.CreatedDateTime', '=', $tanggal)->count().' antrean';

        $data = [
            'namaAntrian' => $namaAntrian,
            'namaUsaha' => $namaUsaha,
            'tanggal' => $tanggal,
            'alokasiWaktu' => $alokasiWaktu,
            'pertanyaan1' => $pertanyaan1,
            'pertanyaan2' => $pertanyaan2,
            'pertanyaan3' => $pertanyaan3,
            'jumlahAntrian' => $jumlahAntrian,
            'deskripsi' => 'Jumlah Antrian per Jam (00:00 - 23:59)'

        ];


        // Load the HTML view as a string
        $html = view('templateLaporan', $data)->render();

        // Create a new TCPDF instance
        $pdf = new TCPDF();

        // Set the document title
        $pdf->SetTitle('Laporan Antrian');

        // Add a page
        $pdf->AddPage();

        // Write the HTML content
        $pdf->writeHTML($html);

        // Draw the chart title
        $pdf->SetXY(15, 100); // Adjust XY position as needed
        $pdf->Cell(180, 10, $data['deskripsi'], 0, 1, 'C');

        $dataGrafik = DB::select("WITH Hours AS (
                            SELECT 0 AS Hour
                            UNION ALL
                            SELECT 1 UNION ALL
                            SELECT 2 UNION ALL
                            SELECT 3 UNION ALL
                            SELECT 4 UNION ALL
                            SELECT 5 UNION ALL
                            SELECT 6 UNION ALL
                            SELECT 7 UNION ALL
                            SELECT 8 UNION ALL
                            SELECT 9 UNION ALL
                            SELECT 10 UNION ALL
                            SELECT 11 UNION ALL
                            SELECT 12 UNION ALL
                            SELECT 13 UNION ALL
                            SELECT 14 UNION ALL
                            SELECT 15 UNION ALL
                            SELECT 16 UNION ALL
                            SELECT 17 UNION ALL
                            SELECT 18 UNION ALL
                            SELECT 19 UNION ALL
                            SELECT 20 UNION ALL
                            SELECT 21 UNION ALL
                            SELECT 22 UNION ALL
                            SELECT 23
                        )

                        SELECT
                            H.Hour,
                            COUNT(case when ((au.user_id = '".$id."') and (date(pesanans.CreatedDateTime) = date('".$tanggal."'))) then (pesanans.id) else NULL end) AS order_count
                        FROM Hours H
                        LEFT OUTER JOIN pesanans ON H.Hour = HOUR(pesanans.CreatedDateTime)
                        LEFT OUTER JOIN antrian_usahas au ON pesanans.antrian_id = au.id
                        LEFT OUTER JOIN users on users.id = au.user_id



                        GROUP BY H.Hour
                        ORDER BY H.Hour;
                    ");

        // Prepare the data for the chart
        $dataArray = [];
        foreach ($dataGrafik as $row) {
            $hour = str_pad($row->Hour, 2, '0', STR_PAD_LEFT);
            $dataArray[$hour] = $row->order_count;
        }

        if(max($dataArray) == 0){
            return 'Data antrean belum ada dan tidak bisa unduh laporan. Silahkan kembali pada tampilan sebelumnya.';
        } else{
            $this->generateGrafik($pdf, 15, 165, $dataArray);

            return response()->streamDownload(function() use ($pdf) {
                $pdf->Output();
            }, 'Laporan Harian.pdf');
        }
    }

        // Output the final PDF to the browser


    private function generateGrafik($pdf, $xOffset, $yOffset, $dataArray)
    {
        $maxValue = max($dataArray); //untuk hitung max data

        $chartWidth = 180;
        $chartHeight = 50;
        $xScale = $chartWidth / (count($dataArray) + 1);
        $yScale = $chartHeight / $maxValue;
        $numLines = 5;
        $lineSpacing = $chartHeight / $numLines;

        //frame
        $pdf->Rect($xOffset, $yOffset - $chartHeight, $chartWidth, $chartHeight, 'D');


        //opacity 30%
        $pdf->SetAlpha(0.3);
        for ($i = 0; $i <= $numLines; $i++) {
            $yPos = $yOffset - ($i * $lineSpacing);
            $value = $i * ($maxValue / $numLines);
            $pdf->Line($xOffset, $yPos, $xOffset + $chartWidth, $yPos);
            $pdf->Text($xOffset - 10, $yPos - 2, number_format($value, 0));
        }
        $pdf->SetAlpha(1); //balikin opacity

        // Draw bars and labels
        $barWidth = $xScale / 1.5;
        $x = $xOffset + $xScale / 2;
        foreach ($dataArray as $label => $value) {
            $barHeight = $value * $yScale;

            // Change bar color
            $pdf->SetFillColor(0, 100, 200); // Example: Change to any color you want (R, G, B)

            $pdf->Rect($x, $yOffset - $barHeight, $barWidth, $barHeight, 'DF');

            if($value != 0){
                // Show the data label
                $pdf->Text($x + ($barWidth / 2) - 3, $yOffset - $barHeight - 5, (string)$value);
            }

            // Show the time label
            $pdf->Text($x - 2, $yOffset + 3, $label);
            $x += $xScale;
        }
    }
}
