<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Surat Informasi Keuangan - SIT Nurul Fikri</title>
    <style>
            /** Define the margins of your page **/
            @page {
                /* margin: 25px 60px 30px 60px; */
                margin: 0px;
                header: header;
	            footer: footer;
            }

            header {
                position: fixed;
                top: 0px;
                left: 0px;
                right: 0px;
            }

            footer {
                position: fixed;
                bottom: -10px;
                left: 0px;
                right: 0px;
                /* height: 50px; */
                text-align: center;
            }

            .page-break {
                page-break-before: always;
                margin-top: 130px;
            }

            main {
                /* position: fixed; */
                top: 0px;
                left: 0px;
                right: 0px;
                margin: 60px;
                /* margin-bottom: 30px; */
                font-size: 85%;
                /* border-top: 2px solid black; */
                text-align: justify;
            }

            .second {
                /* position: fixed; */
                top: 0px;
                left: 0px;
                right: 0px;
                margin: 60px;
                /* margin-bottom: 30px; */
                font-size: 78%;
                /* border-top: 2px solid black; */
                text-align: justify;
            }

            .three {
                /* position: fixed; */
                top: 0px;
                left: 0px;
                right: 0px;
                margin: 60px;
                /* margin-bottom: 30px; */
                font-size: 100%;
                /* border-top: 2px solid black; */
                text-align: justify;
            }

            .biodata {
                width: 95%;
                border-collapse: collapse;
                margin: 15px 0px;
            }

            .biodata, .biodata th, .biodata td {
                border: 1px solid black;
                font-size: 85%;
                padding: 2px 5px;
            }

            .ttd {
                width: 100%;
                border-collapse: collapse;
                margin: 15px 25px;
            }

            .ttd, .ttd th, .ttd td {
                font-size: 90%;
                text-align: center;
            }
        </style>
</head>

<body>
    <header>
        <img src="img/header.png" alt="header" height='auto' width='100%'></img>
    </header>
    <footer>
        <img src="img/footer.png" alt="footer" height='auto' width='100%'></img>
        {{-- <div class="halaman">{{ Str::title($d->nama) }} ({{ $d->nis }}) - hal. <span class="pagenum"></span></div> --}}
    </footer>
    <main>
        @yield('isi')
    </main>
    <header>
        <img src="img/header.png" alt="header" height='auto' width='100%'></img>
    </header>
    <footer>
        <img src="img/footer.png" alt="footer" height='auto' width='100%'></img>
    </footer>
    <div class='second'>
        @include('pdf.edaran')
    </div>
    <header>
        <img src="img/header.png" alt="header" height='auto' width='100%'></img>
    </header>
    <footer>
        <img src="img/footer.png" alt="footer" height='auto' width='100%'></img>
    </footer>
    <div class='three'>
        @include('pdf.lampiran')
    </div>
</body>

</html>
