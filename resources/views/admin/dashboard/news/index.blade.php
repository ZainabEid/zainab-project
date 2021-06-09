@extends('admin.dashboard.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ __('site.news') }}</h1>
                    </div><!-- /.col -->

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">news</li>

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
                    <h3 class="card-title">{{ __('site.news-table') }}</h3>
                    <a href="{{ route('admin.news.create') }}" class="btn btn-info">add new new</a>

                </div>
              
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Title ar</th>
                                <th>Title en</th>
                                <th>Description</th>
                                <th>Photo</th>
                                <th>Admin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($news->count() > 0)

                                @foreach ($news as $index => $new)

                                    <tr>
                                        <td>{{ $index + 1 }}.</td>
                                        <td>{{ $new->title_ar  }}</td>
                                        <td>{{ $new->title_en  }}</td>
                                        <td>{{ $new->description  }}</td>
                                        <td>
                                            <img src="{{ get_image('news', $new->photo)}}" alt="{{ $new->name.' image' }}" class=" img-thumbnail"
                                            style="height: 50px; width:50px;">
                                        </td>
                                        <td>{{ $new->admin->name  }}</td>
                                        <td>
                                            <div class="row d-flex">
                                                <a href="{{ route('admin.news.edit', $new->id) }}"
                                                    class="btn btn-warning">edit</a>
    
                                                {!! Form::open(['route' => ['admin.news.destroy', $new->id], 'method' => 'delete', 'class' => 'delete']) !!}
                                                {!! Form::submit('delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                                {!! Form::close() !!}
                                                </div>
                                        </td>
                                    </tr>
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
