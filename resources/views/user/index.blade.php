@extends('layout.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Master User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Master User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <a href="{{ route('master.user.create.view') }}" class="btn btn-primary mb-3">Tambah User</a>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Nama Pengguna</td>
                                <td>Email</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @push('css')
        <link href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/3.2.1/css/buttons.bootstrap4.min.css" rel="stylesheet">
    @endpush
    @push('script')
        <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.2.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#table').dataTable({
                    ajax: {
                        url: '{{ route('api.users') }}',
                        'beforeSend': function(request) {
                            request.setRequestHeader("Authorization",
                                'Bearer {{ session('user_token')->plainTextToken }}');
                        }
                    },
                    columns: [{
                            'data': "user_id"
                        },
                        {
                            'data': "user_fullname"
                        },
                        {
                            'data': "user_email"
                        },
                        {
                            'data': null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return '<a href="{{ url('/user') }}/' + row.user_id +
                                    '" class="btn btn-primary">Edit</a><br><a href="{{url('/user')}}/'+row.user_id+'/delete" class="btn btn-danger">Hapus</a>'
                            }
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection
