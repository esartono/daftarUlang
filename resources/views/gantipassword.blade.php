@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Ganti Password</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('gantipassword') }}" class="form-horizontal">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <div class="box-body">
                            <div class="form-group row">
                                <label for="nis" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" name="name" value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" name="email" value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4 col-form-label">Password Baru</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="new" required>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary col-md-4 float-right" value="Ganti Password">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
