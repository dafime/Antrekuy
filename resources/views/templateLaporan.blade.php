<h2 style="text-align:center;">Laporan Harian Antrean</h2>
<h1 style="text-align:center; line-height:10%">{{$namaUsaha}}</h1>
<p style="text-align:center; line-height:80%">(Dibuat menggunakan AntreKuy)</p>

<hr><hr>

<br><br>

<body>

    <table>

        <tr>
            <td width="20%"></td>
            <td width="5%"></td>
            <td></td>
        </tr>
        <tr>
            <td width="20%">Nama Usaha</td>
            <td width="5%">:</td>
            <td>{{$namaUsaha}}</td>
        </tr>
        <tr>
            <td width="20%">Nama Antrian</td>
            <td width="5%">:</td>
            <td>{{$namaAntrian}}</td>
        </tr>
        <tr>
            <td width="20%">Tanggal Laporan</td>
            <td width="5%">:</td>
            <td>{{$tanggal}}</td>
        </tr>

    </table>

    <table>

        <tr>
            <td width="20%"></td>
            <td width="5%"></td>
            <td></td>
        </tr>
        <tr>
            <td width="20%">Waktu per Antrean</td>
            <td width="5%">:</td>
            <td>{{$alokasiWaktu}}</td>
        </tr>
        <tr>
            <td width="20%">Pertanyaan 1</td>
            <td width="5%">:</td>
            <td>{{$pertanyaan1}}</td>
        </tr>
        <tr>
            <td width="20%">Pertanyaan 2</td>
            <td width="5%">:</td>
            <td>{{$pertanyaan2}}</td>
        </tr>
        <tr>
            <td width="20%">Pertanyaan 3</td>
            <td width="5%">:</td>
            <td>{{$pertanyaan3}}</td>
        </tr>

    </table>

    <table>

        <tr>
            <td width="20%"></td>
            <td width="5%"></td>
            <td></td>
        </tr>
        <tr>
            <td width="20%"></td>
            <td width="5%"></td>
            <td></td>
        </tr>
        <tr>
            <td width="20%"><b>Antrean Hari Ini</b></td>
            <td width="5%">:</td>
            <td>{{$jumlahAntrian}}</td>
        </tr>

    </table>

</body>

