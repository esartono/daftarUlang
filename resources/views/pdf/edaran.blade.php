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
        <br>
        <table style="font-size: 80%; width: 100%">
            <tr>
                <td>
                    No : {{ $d['surat'] }}/ST/KEU/SITNF/VI/2021<br>
                    Lamp : 1 lembar<br>
                    Hal : Edaran tentang Daftar Ulang Siswa Tahun Pelajaran 2021/2022
                </td>
                <td align="right">Depok, 24 Juni 2021<br>&nbsp;<br>&nbsp;</td>
            </tr>
        </table>
        <p>Yang kami hormati,</p>
        Bapak/Ibu Orang tua siswa dari <b>{{ $d['nama'] }}</b><br>
        Kelas <b>{{ $d['kelas'] }}</b> {{ $unitnya[$d['unit']] }}<br>
        di tempat
        <br>
        <b><i>Assalamu’alaikum Warahmatullahi Wabarakaatuh,</i></b><br>
        <p style="margin-bottom: 1px">
            Segala puji bagi Allah <i>subhanahu wa ta’ala</i>. Shalawat dan Salam semoga tercurah untuk rasul-Nya,
            Muhammad <i>shollallahu ‘alayhi wa sallam</i>, sahabat serta seluruh pengikutnya yang setia hingga akhir zaman.
            Kami mendoakan Bapak/Ibu selalu sehat, sukses, dan berkah dalam melaksanakan aktivitas sehari-hari.
        </p>
        <p>
        Sehubungan dengan akan berakhirnya Kegiatan Belajar Mengajar Tahun Pelajaran 2020/2021 dan dimulainya Tahun Pelajaran 2021/2022, bersama ini kami sampaikan informasi terkait administrasi keuangan siswa sebagai berikut :
        <ol>
            <li>
                Memulai Tahun Pelajaran 2021/2022 adalah dengan melakukan daftar ulang bagi seluruh siswa TK, SDIT, SMPIT dan SMAIT Nurul Fikri. Kebijakan daftar ulang sudah dimulai sejak Tahun Pelajaran 2019/2020.
            </li>
            <li>
                Daftar Ulang merupakan proses administrasi yang dilakukan oleh siswa SIT Nurul Fikri untuk Tahun Pelajaran 2021/2022 dengan melakukan pelunasan kewajiban keuangan siswa sebagai berikut :
            </li>
            <table class="biodata">
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Deskripsi</th>
                    <th colspan="2" width="15%">Jumlah</th>
                    <th width="55%">Keterangan</th>
                </tr>
                @isset($d['ket']['Dana Tahunan'])
                <tr>
                    <th> 1 </th>
                    <td>Dana Tahunan</td>
                    <td style="border-right: solid 1px #FFF;"> Rp. </td>
                    <td align="right">{{ number_format($d['ket']['Dana Tahunan']) }}</td>
                    <td>Daftar Ulang TP 2021/2022, sesuai dengan Form PPDB yang sudah ditandatangani.</td>
                </tr>
                @endisset
                <tr>
                    <th> 2 </th>
                    <td>SPP s/d Juni 2021</td>
                    <td style="border-right: solid 1px #FFF;"> Rp. </td>
                    <td align="right">{{ number_format($d['ket']['SPP s/d Juni 21']) }}</td>
                    <td>Sesuai data penerimaan SPP sampai tanggal 14 Juni 2021</td>
                </tr>
                <tr>
                    <th> 3 </th>
                    <td>SPP Juli 2021</td>
                    <td style="border-right: solid 1px #FFF;"> Rp. </td>
                    <td align="right">{{ number_format($d['ket']['SPP Juli 21']) }}</td>
                    <td>Kenaikan SPP sesuai dengan ketentuan</td>
                </tr>
                <tr>
                    <th> 4 </th>
                    <td>Potongan PJJ Juli 2021</td>
                    <td style="border-right: solid 1px #FFF;"> Rp. </td>
                    <td align="right">{{ number_format($d['ket']['Potongan PJJ']) }}</td>
                    <td></td>
                </tr>
                <tr>
                    <th> 5 </th>
                    <td>Tunggakan PSB</td>
                    <td style="border-right: solid 1px #FFF;"> Rp. </td>
                    <td align="right">{{ number_format($d['ket']['Tunggakan PSB']) }}</td>
                    <td></td>
                </tr>
                @isset($d['ket']['Tunggakan Ketring'])
                <tr>
                    <th> 6 </th>
                    <td>Tunggakan Katering</td>
                    <td style="border-right: solid 1px #FFF;"> Rp. </td>
                    <td align="right">{{ number_format($d['ket']['Tunggakan Ketring']) }}</td>
                    <td></td>
                </tr>
                @endisset
                <tr>
                    <th colspan="2"><b>Total Tagihan</b></th>
                    <td style="border-right: solid 1px #FFF;"> <b>Rp.</b> </td>
                    <td align="right"><b>{{ number_format($d['ket']['Total Tagihan']) }}</b></td>
                    <td><b>{{ $d['ket']['Ket Total'] }}</b></td>
                </tr>
            </table>
            <li>
                Daftar Ulang dilakukan mulai tanggal <b>1-10 Juli 2021</b>
            </li>
            <li>
                Pembayaran (pelunasan) dapat melalui <i>Virtual Account</i> atas nama : <br><b>{{ $d['nama'] }}</br> No. VA : <b>{{ $d['va'] }} Bank {{ ($d['bank'] === 'BMI' ? 'BMI (Bank Muamalat Indonesia)' : 'BJBS (Bank Jabar Banten Syariah') }}</b>
            </li>
            <li>
                Bagi yang tidak melakukan penyelesaian administrasi sesuai dengan jadwal yang telah ditentukan maka dianggap <b>mengundurkan diri</b> sebagai siswa SIT Nurul Fikri TP 2021/2022
            </li>
            <li>
                Siswa wajib menunjukkan Kartu Daftar Ulang untuk pengambilan buku paket di sekolah dan wajib membawa Kartu Daftar Ulang di hari pertama sekolah tanggal <b>19 Juli 2021</b>
            </li>
            <li>
                Konfirmasi daftar ulang melalui Google Form <a target="_blank" href="https://forms.gle/f828VDbb3twmn2Aa8">https://forms.gle/f828VDbb3twmn2Aa8</a>
            </li>
            <li>
                Tata cara daftar ulang terlampir
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
        Demikianlah kami sampaikan, Atas perhatian dan kebijaksanaan Bapak/Ibu kami sampaikan <i>Jazakumullah khoyran katsiran</i>.
        <br>
        <br>
        <i>Wassalamu’alaikum Warahmatullahi Wabarakatuh.</i>
        <br>
        <table class="ttd">
            <tr>
                <td>
                    Manajer Keuangan<br>
                    <img class="cap" src="img/cap.png" alt="stempel" height="80" width="auto"></img><br>
                    Yosi Syamsiar
                </td>
                <td width="30%">&nbsp;</td>
                <td>
                    Kepala Unit<br>
                    {{ $unitnya[$d['unit']] }}<br>
                    <img class="cap" src="img/ttd-{{ $d['unit'] }}.png" alt="stempel" height="65" width="auto"></img><br>
                    {{ $kepseknya[$d['unit']] }}
                </td>
            </tr>
        </table>
    </div>
