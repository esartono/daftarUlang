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
                <div class="card-header">Data Daftar Ulang - {{ $lunas }}</div>
                <div class="card-body">
                    <button class="btn btn-warning col-md-1" onclick="clickTable('TK')">TK</button>
                    <button class="btn btn-success col-md-1" onclick="clickTable('SD')">SD</button>
                    <button class="btn btn-primary col-md-1" onclick="clickTable('SMP')">SMP</button>
                    <button class="btn btn-secondary col-md-1" onclick="clickTable('SMA')">SMA</button>
                    <hr>
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Unit</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Bank</th>
                                <th>No. VA</th>
                                <th>Tagihan</th>
                                <th>Surat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="bayarModal" tabindex="-1" data-toggle="modal" data-backdrop="static" data-keyboard="false">>
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('dauls.store') }}" class="form-horizontal" id="formBayar">
                <div class="modal-header">
                    <h5 class="modal-title">Cek Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="box-body">
                        <div class="form-group row">
                            <label for="nis" class="col-sm-4 col-form-label">No. Induk Siswa</label>
                            <div class="col-sm-8">
                                <input type="text" readonly name="nis" class="form-control" id="nis">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama Siswa</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-4 col-form-label">Unit</label>
                            <div class="col-sm-8">
                                <input type="text" readonly name="unit" class="form-control" id="unit">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="kelas">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="alert alert-danger" role="alert">
                        Dengan mengklik Lunas, maka Siswa tersebut diatas dinyatakan telah LUNAS Daftar Ulang dan <br>Surat telah LUNAS Daftar Ulang akan secara otomatis dikirim melalui email siswa.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger col-sm-3" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-primary col-sm-3" value="LUNAS">
                </div>
            </form>
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

    function clickBayar(nis){
        $.ajax({
            type: 'GET',
            url: 'dauls/' + nis,
            success: function (data) {
                $('#formBayar').trigger("reset");
                $('#nis').val(data['nis']);
                $('#nama').val(data['nama']);
                $('#unit').val(data['unit']);
                $('#kelas').val(data['kelas']);
                $('#bayarModal').modal('show')
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

    function clickTable(unit){
        var ok = '{{ $lunas }}'
        if(ok == 'SUDAH LUNAS') {
            var kolom = [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'unit', name: 'unit'},
                {data: 'nis', name: 'nis'},
                {data: 'nama', name: 'nama'},
                {data: 'kelas', name: 'kelas'},
                {data: 'bank', name: 'bank', searchable: true, visible: false, orderable: false},
                {data: 'va', name: 'va'},
                {data: 'tagihan', name: 'tagihan', className: "text-right", orderable: false, searchable: false},
                {data: 'daul', name: 'daul', className: "text-center", visible: true, orderable: false, searchable: false},
                {data: 'emaildaul', name: 'emaildaul', className: "text-center", orderable: false, searchable: false},
            ];
        } else {
            var kolom = [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'unit', name: 'unit'},
                {data: 'nis', name: 'nis'},
                {data: 'nama', name: 'nama'},
                {data: 'kelas', name: 'kelas', className: "text-center"},
                {data: 'bank', name: 'bank', searchable: true, visible: false, orderable: false},
                {data: 'va', name: 'va'},
                {data: 'tagihan', name: 'tagihan', className: "text-right", orderable: false, searchable: false},
                {data: 'daul', name: 'daul', className: "text-center", visible: false, orderable: false, searchable: false},
                {data: 'emaildaul', name: 'emaildaul', className: "text-center", orderable: false, searchable: false},
            ];
        }

        $('.data-table').DataTable().destroy();
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax : {
                url: 'datadaul',
                type: 'POST',
                data: {
                    unit: unit,
                    lunas: '{{ $lunas }}',
                    _token: '{{ csrf_token() }}'
                }
            },
            columns: kolom,
            order: [[ 3, "asc" ]]
        });
    };
</script>
@endsection
