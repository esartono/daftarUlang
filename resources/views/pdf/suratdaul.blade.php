@extends('pdf.template')

@section('isi')
    <div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <table style="font-size: 80%; width: 100%">
            <tr>
                <td>
                    No : 001/Ekst/KEU/SITNF/VI/2021<br>
                    Lamp : -<br>
                    Hal : Informasi Daftar Ulang Siswa Tahun Pelajaran 2021/2022
                </td>
                <td align="right">Depok, 24 Juni 2021<br>&nbsp;<br>&nbsp;</td>
            </tr>
        </table>
        <p>Yang kami hormati, <br>
        <b>
            Orangtua/Wali Siswa kelas {{ $kelasnya[$d['unit']] }}<br>
            {{ $unitnya[$d['unit']] }}<br>
        </b>
        di tempat
        </p>
        <br>
        <b><i>Assalamu’alaikum Warahmatullahi Wabarakaatuh,</i></b><br>
        <p style="margin-bottom: 1px">
            Segala puji bagi Allah <i>subhanahu wa ta’ala</i>. Shalawat dan Salam semoga tercurah untuk rasul-Nya,
            Muhammad <i>shollallahu ‘alayhi wa sallam</i>, sahabat serta seluruh pengikutnya yang setia hingga akhir zaman.
            Kami mendoakan Bapak/Ibu selalu sehat, sukses, dan berkah dalam melaksanakan aktivitas sehari-hari.
        </p>
        <p>
        Sehubungan dengan akan berakhirnya Kegiatan Belajar Mengajar Tahun Pelajaran 2020/2021 dan dimulainya Tahun Pelajaran 2021/2022, bersama ini kami sampaikan informasi sebagai berikut :
        <ol>
            <li>
                Sesuai ketentuan pemerintah bahwa periode Tahun Ajaran 2021/2022 adalah 12 (dua belas) bulan mulai Juli 2021 sampai bulan Juni 2022, maka pembayaran SPP akan dilaksanakan untuk 12 bulan (Juli 2021 sampai Juni 2022).
            </li>
            <li>
                Memulai Tahun Pelajaran 2021/2022 adalah dengan melakukan daftar ulang bagi seluruh siswa TK, SDIT, SMPIT dan SMAIT Nurul Fikri. Kebijakan daftar ulang sudah dimulai sejak Tahun Pelajaran 2019/2020.
            </li>
            <li>
                Daftar Ulang merupakan proses administrasi yang dilakukan oleh siswa SIT Nurul Fikri untuk Tahun Pelajaran 2021/2022 dengan melakukan pembayaran Dana Tahunan dan SPP bulan Juli 2021.
            </li>
            <li>
                Daftar Ulang dilakukan mulai tanggal <b>1-10 Juli 2021</b>
            </li>
            <li>
                Bagi yang tidak melakukan penyelesaian administrasi sesuai dengan jadwal yang telah ditentukan maka dianggap <b>mengundurkan diri</b> sebagai siswa SIT Nurul Fikri TP 2021/2022
            </li>
            <li>
                Siswa wajib menunjukkan Kartu Daftar Ulang untuk pengambilan buku paket di sekolah dan wajib membawa Kartu Daftar Ulang di hari pertama sekolah tanggal <b>19 Juli 2021</b>
            </li>
            <li>
                Proses pengambilan buku dapat dilakukan setelah melakukan daftar ulang (pengambilan buku sesuai jadwal dimulai tanggal <b>12 Juli 2021</b>).
            </li>
            <li>
                Informasi besaran tagihan, tata cara daftar ulang dan cetak Kartu Daftar Ulang dapat diakses melalui e-mail masing-masing siswa dengan domain @nurulfikri.sch.id mulai tanggal <b>28 Juni 2021 sampai dengan 10 Juli 2021</b>.
            </li>
            <li>
                Konfirmasi daftar ulang melalui Google Form <a target="_blank" href="https://forms.gle/f828VDbb3twmn2Aa8">https://forms.gle/f828VDbb3twmn2Aa8</a>
            </li>
            <li>
                Informasi lebih lanjut dapat menghubungi: <br>
                <i>Contact Person:</i>
                <ul>
                    <li>
                        Admin Keuangan <b>TK dan SD : Ibu Sandra (<i>Whatsapp: </i>0858-8845-6310)</b>
                    </li>
                    <li>
                        Admin Keuangan <b>SMP dan SMA : Ibu Irma (<i>Whatsapp: </i>0896-7841-2132)</b>
                    </li>
                </ul>
            </li>
        </ol>
        </p>
        <br>
        Demikianlah kami sampaikan, Atas perhatian dan kebijaksanaan Bapak/Ibu kami sampaikan <i>Jazakumullah khoyran katsiran</i>.
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
                    {{ $unitnya[$d['unit']] }}<br>
                    <img class="cap" src="img/ttd-{{ $d['unit'] }}.png" alt="stempel" height="55" width="auto"></img><br>
                    {{ $kepseknya[$d['unit']] }}
                </td>
            </tr>
        </table>
    </div>

    <div class="page-break"></div>
@endsection
