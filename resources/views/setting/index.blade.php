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
                <h1>Settings</h1>
                <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Logo</label>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" name="logo" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file for logo</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Background</label>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" name="background" id="customFile2">
                            <label class="custom-file-label" for="customFile2">Choose file for background</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>

            <div class="card card-body">
                <h1>Menu Order Settings</h1>
                <form action="{{ route('setting.menu.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-6">
                            <label for=""></label>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
