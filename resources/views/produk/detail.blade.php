@extends('templates.header')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Produk menu
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ url('/produk') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">{{ $produk->title }}</h3>
          <div class="box-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    
                </div>
            </div>
          </div>
          <!-- /.box-body -->
          <!-- /.box-footer-->
        </div>
        <!-- /.box -->
  
      </section>
      <!-- /.content -->
@endsection