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
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="all-user">
                                <div class="spinner-border text-light" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </h3>

                            <p>All Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="active-user">
                                <div class="spinner-border text-light" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </h3>

                            <p>Active Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @push('script')
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: '{{ route('api.user.count') }}',
                    type: 'GET',
                    headers: {
                        'Authorization': 'Bearer {{ session('user_token')->plainTextToken }}'
                    },
                    success: function(response) {
                        $('#all-user').html(response.data.user);
                        $('#active-user').html(response.data.active_user);
                    },

                })
            });
        </script>
    @endpush
@endsection
