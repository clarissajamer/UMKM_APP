@extends('templates/header')

@section('content')   
   <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          {{ empty($result) ? 'Tambah' : 'Edit' }} Kategori Produk
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ url('kategori') }}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li>Kategori Produk</li>
          <li class="active">{{ empty($result) ? 'Tambah' : 'Edit' }} Kategori Produk</li>
        </ol>
      </section>
  
      <!-- Main content -->
      <section class="content">
        
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <a href="{{ url('kategori') }}" class="btn bg-purple"><i class="fa fa-chevron-left"></i>Kembali</a>
          </div>
          <div class="box-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                  </ul>
              </div>
            @endif  

            <form 
              action="{{ empty($result) ? url('kategori') : url("kategori/$result->id/edit") }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="form-horizontal">
              
              @csrf
              @if (!empty($result))
                  @method('PATCH')
              @endif

              {{-- Kategori --}}
              <div class="form-group">
                  <label class="control-label col-sm-2">Nama Kategori</label>
                  <div class="col-sm-10">
                      <input type="text" name="category" class="form-control" placeholder="category" value="{{ @$result->category }}">
                  </div>
              </div>

              {{-- Tombol Simpan --}}
              <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-2">
                      <button type="submit" class="btn btn-primary">
                          <i class="fa fa-save"></i> Simpan
                      </button>
                  </div>
              </div>
          </form>
          </div>
          <!-- /.box-body -->
          <!-- /.box-footer-->
        </div>
        <!-- /.box -->
  
      </section>
      <!-- /.content -->
@endsection