@extends('layout.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-body">
                <form action="{{ route('master.user.update', $user_id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="user_email" value="{{ $user->user_email }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" name="user_fullname" value="{{ $user->user_fullname }}" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
