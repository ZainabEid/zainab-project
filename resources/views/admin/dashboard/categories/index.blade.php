@extends('admin.dashboard.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ __('site.categories') }}</h1>
                    </div><!-- /.col -->

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">categories</li>

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
                    <h3 class="card-title">{{ __('site.categories-table') }}</h3>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-info">add new category</a>

                </div>
              
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>{{ __('site.name') }}</th>
                                <th>{{ __('site.photo') }}</th>
                                <th>{{ __('site.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($categories->count() > 0)

                                @foreach ($categories as $index => $category)

                                    <tr>
                                        <td>{{ $index + 1 }}.</td>
                                        <td>{{ $category->name  }}</td>
                                        <td>
                                            <img src="{{ get_image('categories', $category->photo)  }}" alt="{{ $category->name.' image' }}" class=" img-thumbnail"
                                                style="height: 50px; width:50px;">
                                        </td>
                                        <td>
                                            <div class="row d-flex">
                                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                    class="btn btn-warning">edit</a>
    
                                                {!! Form::open(['route' => ['admin.categories.destroy', $category->id], 'method' => 'delete', 'class' => 'delete']) !!}
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
