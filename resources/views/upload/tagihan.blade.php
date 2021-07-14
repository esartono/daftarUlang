@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success">Upload TAGIHAN File Excel</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('uploads.store') }}" class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <div class="form-group">
                                <label>Import Data Tagihan</label>
                                <input type="file" id="file" ref="myFiles" name="file" class="form-control" required>
                            </div>
                            <input type="submit" class="btn btn-primary col-md-6" value="Upload">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning">Upload Alamat Email - File Excel</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('emails.store') }}" class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <div class="form-group">
                                <label>Import Data Alamat Email</label>
                                <input type="file" id="file" ref="myFiles" name="file" class="form-control" required>
                            </div>
                            <input type="submit" class="btn btn-danger col-md-6" value="Upload">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
