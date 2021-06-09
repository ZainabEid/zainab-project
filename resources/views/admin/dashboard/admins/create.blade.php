@extends('admin.dashboard.layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('site.admins') }}</h1>
        </div><!-- /.col -->
        
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">admins</a></li>
            <li class="breadcrumb-item active">create admin</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
     <!-- general form elements -->
     <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create New admin</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      {!! Form::open(['route'=> 'admin.admins.store', 'role' => 'form', 'files' => true]) !!}

      @include('admin.dashboard.admins._adminForm')
      {!! Form::close() !!}

    
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
    
@endsection