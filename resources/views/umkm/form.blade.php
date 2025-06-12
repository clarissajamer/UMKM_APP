@extends('templates/header')

@section('content')   
   <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          {{ empty($result) ? 'Tambah' : 'Edit' }} UMKM
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ url('umkm') }}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li>UMKM</li>
          <li class="active">{{ empty($result) ? 'Tambah' : 'Edit' }} UMKM</li>
        </ol>
      </section>
  
      <!-- Main content -->
      <section class="content">
        
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <a href="{{ url('umkm') }}" class="btn bg-purple"><i class="fa fa-chevron-left"></i>Kembali</a>
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
              action="{{ empty($result) ? url('umkm') : url("umkm/$result->id/edit") }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="form-horizontal">
              
              @csrf
              @if (!empty($result))
                  @method('PATCH')
              @endif

              {{-- Nama --}}
              <div class="form-group">
                  <label class="control-label col-sm-2">Nama UMKM</label>
                  <div class="col-sm-10">
                      <input type="text" name="umkm_name" class="form-control" placeholder="umkm_name" value="{{ @$result->umkm_name }}">
                  </div>
              </div>

              {{-- owner --}}
              <div class="form-group">
                  <label class="control-label col-sm-2">Nama Owner</label>
                  <div class="col-sm-10">
                      <input type="text" name="owner_name" class="form-control" placeholder="owner_name" value="{{ @$result->owner_name }}">
                  </div>
              </div>

              {{-- deskripsi --}}
              <div class="form-group">
                  <label class="control-label col-sm-2">Deskripsi UMKM</label>
                  <div class="col-sm-10">
                      <textarea name="umkm_desc" class="form-control" placeholder="umkm_desc">{{ @$result->umkm_desc }}</textarea>
                  </div>
              </div>

                {{-- owner --}}
              <div class="form-group">
                  <label class="control-label col-sm-2">NO. Telp</label>
                  <div class="col-sm-10">
                      <input type="numeric" name="phone" class="form-control" placeholder="phone" value="{{ @$result->phone }}">
                  </div>
              </div>

                {{-- email --}}
              <div class="form-group">
                  <label class="control-label col-sm-2">Email</label>
                  <div class="col-sm-10">
                      <input type="email" name="email" class="form-control" placeholder="email" value="{{ @$result->email }}">
                  </div>
              </div>

                {{-- address --}}
              <div class="form-group">
                  <label class="control-label col-sm-2">Alamat</label>
                  <div class="col-sm-10">
                      <input type="text" name="address" class="form-control" placeholder="address" value="{{ @$result->address }}">
                  </div>
              </div>

              {{-- Foto --}}
              <div class="form-group">
                  <label class="control-label col-sm-2">Foto</label>
                  <div class="col-sm-10">
                      <input type="file" name="images" />
                      @if (!empty($result->images))
                          <br>
                          <img src="{{ asset('uploads/' . $result->images) }}" width="100" />
                      @endif
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