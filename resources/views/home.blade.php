@extends('layouts.app')

@section('content')
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding:0.5em 0.2em !important;
        margin-left:1px !important;
    }

    table th {
        font-size: 0.9em;
    }

    table.dataTable td {
        font-size: 0.9em;
    }

    table.dataTable tr.dtrg-level-0 td {
        font-size: 0.9em;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Daftar Tagihan - SIT Nurul Fikri') }}</div>
                <div class="card-body">
                    <button class="btn btn-warning col-md-1" onclick="clickTable('TK')">TK</button>
                    <button class="btn btn-success col-md-1" onclick="clickTable('SD')">SD</button>
                    <button class="btn btn-primary col-md-1" onclick="clickTable('SMP')">SMP</button>
                    <button class="btn btn-secondary col-md-1" onclick="clickTable('SMA')">SMA</button>
                    @if(Auth::user()->email === 'eko.sartono@nurulfikri.sch.id')
                    <div class="float-right col-md-5 bg-success" style="padding: 10px">
                        <a href="kirimall" class="btn btn-warning col-md-6">Kirim Surat Daul</a>
                        <a href="generatePDF" class="btn btn-danger col-md-6 float-right">Generate PDF</a>
                    </div>
                    @endif
                    <br>
                    <hr>
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Unit</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Bank</th>
                                <th>No. VA</th>
                                <th>Tagihan</th>
                                <th>Email</th>
                                <th>Surat Tagihan</th>
                                <th>Email Tagihan</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#myToast").toast({
            delay: 6000
        });
        $("#myToast").toast('show');
        clickTable('TK')
    });

    function clickTable(data){
        if (data == 'TK') {
            var route = "{{ url('datasiswa/TK') }}";
        }
        if (data == 'SD') {
            var route = "{{ url('datasiswa/SD') }}";
        }
        if (data == 'SMP') {
            var route = "{{ url('datasiswa/SMP') }}";
        }
        if (data == 'SMA') {
            var route = "{{ url('datasiswa/SMA') }}";
        }

        $('.data-table').DataTable().destroy();
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: route,
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'unit', name: 'unit'},
                {data: 'nis', name: 'nis'},
                {data: 'nama', name: 'nama'},
                {data: 'bank', name: 'bank', searchable: true, visible: false, orderable: false},
                {data: 'va', name: 'va'},
                {data: 'tagihan', name: 'tagihan', className: "text-right", orderable: false, searchable: false},
                {data: 'email', name: 'email', clasName: "text-break", searchable: false},
                {data: 'daul', name: 'daul', className: "text-center", orderable: false, searchable: false},
                {data: 'emaildaul', name: 'emaildaul', className: "text-center", orderable: false, searchable: false},
            ],
            order: [[ 3, "asc" ]]
        });
    };
</script>
@endsection
