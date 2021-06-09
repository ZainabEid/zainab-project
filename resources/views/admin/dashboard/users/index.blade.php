@extends('admin.dashboard.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Users</h1>
                    </div><!-- /.col -->

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">users</li>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Users Table</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">

                    {{-- add new user --}}
                    <button type="button" id="add-new-user" class="btn btn-info" data-toggle="modal"
                        data-target="#popup-modal" data-url="{{ route('admin.users.create') }}">
                        add new user
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="popup-modal" tabindex="-1" role="dialog" aria-labelledby="addNewUserLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">


                            </div>
                        </div>
                    </div>




                    {{-- users table --}}
                    <table class="table table-bordered table-responsive-sm" id="users-table">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>{{ __('site.name') }}</th>
                                <th>{{ __('site.email') }}</th>
                                <th>{{ __('site.password') }}</th>
                                <th>{{ __('site.phone') }}</th>
                                <th>{{ __('site.photo') }}</th>
                                <th>{{ __('site.delete') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->count() > 0)

                                @foreach ($users as $table_index => $user)

                                    @include('admin.dashboard.users._user_row')

                                @endforeach

                            @else
                                <tr>
                                    <p> there is not data</p>
                                </tr>

                            @endif



                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
