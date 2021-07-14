@extends('pdf.template')

@section('isi')
    <div>
        <p>Depok, 6 Mei 2020</p>
        <br>
        No : {{ $d['surat'] }}/ST/KEU/SITNF/V/2020<br>
        Lamp : -<br>
        Hal : Informasi Keuangan Siswa TP 2019/2020
        <br>
        <p>Yang kami hormati,</p>
        <br>
        Bapak/Ibu Orang tua siswa dari <b>{{ $d['nama'] }}</b><br>
        Kelas <b>{{ $d['kelas'] }}</b> CCEC Nurul Fikri<br>
        di tempat
        <br>
        <br>
        <b><i>Assalamu’alaikum Warahmatullahi Wabarakaatuh,</i></b><br>
        <p style="margin-bottom: 1px">
        Segala puji hanya milik Allah SWT. Shalawat dan salam semoga tercurah kepada Nabi Muhammad SAW
        teriring doa semoga Bapak/Ibu senantiasa selalu berada dalam lindungan Allah SWT sehingga dapat
        melaksanakan aktivitasnya dengan baik.
        </p>
        <p>
        Sehubungan dengan pelaksanaan Pembelajaran Jarak Jauh (PJJ) maka dengan ini kami infomasikan :
        <ol>
            <li>
                Satu periode Tahun Pelajaran 2019/2020 adalah 12 bulan yaitu bulan Juli 2019 – bulan Juni 2020, maka pembayaran SPP mengikuti periode Tahun Pelajaran yaitu 12 bulan.
            </li>
            <li>
                Pembayaran SPP mulai bulan April 2020 sampai dengan bulan Juni 2020 mendapat potongan sebesar <b>15%</b> dari <b>Rp. {{ number_format($d['ket']['spp normal']) }}</b> menjadi <b>Rp. {{ number_format($d['ket']['spp diskon']) }}</b>
            </li>
            <li>
                Kelebihan pembayaran SPP sebagai kompensasi PJJ dan atau catering akan di alokasikan untuk tagihan SPP bulan berikutnya.
            </li>
            <li>
                Berikut ini adalah data keuangan per tanggal 5 Mei 2020.
            </li>
        </ol>
        </p>
    </div>
        <table class="biodata">
            <tr>
                <th width="5%">No</th>
                <th width="35%">Jenis Tagihan</th>
                <th width="35%">Keterangan</th>
                <th colspan="2" width="25%">Jumlah</th>
            </tr>
            <tr>
                <th> 1 </th>
                <td>SPP s.d. April 2020</td>
                <td>{{ $d['ket']['Ket April'] }}</td>
                <td style="border-right: solid 1px #FFF;"> Rp. </td>
                <td align="right">{{ number_format($d['ket']['SPP  April']) }}</td>
            </tr>
            <tr>
                <th>  </th>
                <td>Kompensasi PJJ April 2020</td>
                <td></td>
                <td style="border-right: solid 1px #FFF;"> Rp. </td>
                <td align="right">{{ number_format($d['ket']['kompensasi april']) }}</td>
            </tr>
            <tr>
                <th> 2 </th>
                <td>SPP Mei 2020</td>
                <td>{{ $d['ket']['Ket Mei'] }}</td>
                <td style="border-right: solid 1px #FFF;"> Rp. </td>
                <td align="right">{{ number_format($d['ket']['SPP Mei']) }}</td>
            </tr>
            <tr>
                <th> 3 </th>
                <td>SPP Juni 2020</td>
                <td>{{ $d['ket']['Ket Juni'] }}</td>
                <td style="border-right: solid 1px #FFF;"> Rp. </td>
                <td align="right">{{ number_format($d['ket']['SPP Juni']) }}</td>
            </tr>
            <tr>
                <th> 4 </th>
                <td>Biaya PSB</td>
                <td></td>
                <td style="border-right: solid 1px #FFF;"> Rp. </td>
                <td align="right">{{ number_format($d['ket']['PSB']) }}</td>
            </tr>
            <tr>
                <th> 5 </th>
                <td>Katering</td>
                <td>{{ $d['ket']['Ket ketring'] }}</td>
                <td style="border-right: solid 1px #FFF;"> Rp. </td>
                <td align="right">{{ number_format($d['ket']['Ketring']) }}</td>
            </tr>
            <tr>
                <th> &nbsp; </th>
                <td></td>
                <td></td>
                <td style="border-right: solid 1px #FFF;"> </td>
                <td align="right"></td>
            </tr>
            <tr>
                <th></th>
                <td colspan="2"><b>Total {{ $d['ket']['Ket All'] }} sampai dengan Juni 2020</b></td>
                <td style="border-right: solid 1px #FFF;"> <b>Rp.</b> </td>
                <td align="right"><b>{{ number_format($d['ket']['Total all']) }}</b></td>
            </tr>
            <tr>
                <td align="right" colspan="5" style="padding: 5px;
                    border-left: solid 1px #FFF; border-right: solid 1px #FFF; border-bottom: solid 1px #FFF;">
                    Note : Kelebihan SPP di TP 2019/2020 akan di alokasikan untuk SPP Bulan Juli 2020 TP 2020/2021
                </td>
            </tr>
        </table>
        Konfirmasi kepada Bagian Keuangan SIT Nurul Fikri dengan datang ke kantor Keuangan SIT Nurul Fikri
        (Ruang Tata Usaha SDIT Nurul Fikri) atau menghubungi admin keuangan PG (Bu Sandra) di No. <i>Whatsapp</i> 0857-1068-8325.
        <br>
        <br>
        Untuk pembayaran (pelunasan) dapat melalui <i>Virtual Account</i> atas nama <b>{{$d['nama']}}</b> No. Va. <b>{{$d['ket']['va']}} Bank {{$d['ket']['Bank']}} </b>.
        <br>
        <br>
        Demikianlah kami sampaikan, Atas perhatian dan kerjasama Bapak/Ibu kami ucapkan terima kasih.
        <br>
        <br>
        <i>Wassalamu’alaikum Warahmatullahi Wabarakatuh.</i>
        <br>
        <table class="ttd">
            <tr>
                <td>
                    Manajer Keuangan<br>
                    <img class="cap" src="img/cap.png" alt="stempel" height="100" width="auto"></img><br>
                    Yosi Syamsiar
                </td>
                <td width="30%">&nbsp;</td>
                <td>
                    Kepala Unit<br>
                    CCEC Nurul Fikri<br>
                    <br>
                    <img class="cap" src="img/ttd-pg.png" alt="stempel" height="55" width="auto"></img><br>
                    <br>
                    Ros Gestasia
                </td>
            </tr>
        </table>
    </div>
@endsection
