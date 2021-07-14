@extends('pdf.template_daul')

@section('daul')
    <div style="display: flex; justify-content: center;">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h1>KARTU DAFTAR ULANG</h1>
        <br>
        <table class="kotak">
            <tr>
                <td width="22%"> Nama </td>
                <td width="2">:</td>
                <td>{{ $d['nama'] }}</td>
                <td width="20%" rowspan="3">
                    <img class="qrcode" src="data:image/png;base64,
                    {!! base64_encode(
                        QrCode::style('dot', 0.9)
                            ->eye('circle')
                            ->format('png')
                            ->size(100)
                            ->generate('https://daul.nurulfikri.sch.id/kode/'.$cek['qrcode']))
                    !!}">
                </td>
            </tr>
            <tr>
                <td> No. Induk Siswa </td>
                <td>:</td>
                <td>{{ $d['nis'] }}</td>
            </tr>
            <tr>
                <td> Unit Sekolah </td>
                <td>:</td>
                <td>{{ $unitnya[$d['unit']] }}</td>
            </tr>
        </table>
        <br>
        <br>
        Telah melaksanakan daftar ulang Tahun Ajaran 2021/2022
    </div>
@endsection
