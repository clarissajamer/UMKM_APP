@extends('templates/header')

@section('content')   
   <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          {{ empty($result) ? 'Tambah' : 'Edit' }} Produk UMKM
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ url('produk') }}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li>Produk UMKM</li>
          <li class="active">{{ empty($result) ? 'Tambah' : 'Edit' }} Produk UMKM</li>
        </ol>
      </section>
  
      <!-- Main content -->
      <section class="content">
        
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <a href="{{ url('produk') }}" class="btn bg-purple"><i class="fa fa-chevron-left"></i>Kembali</a>
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
              action="{{ empty($result) ? url('produk') : url("produk/$result->id/edit") }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="form-horizontal">
              
              @csrf
              @if (!empty($result))
                  @method('PATCH')
              @endif

              {{-- Kategori --}}
              <div class="form-group">
                  <label class="control-label col-sm-2">Kategori</label>
                  <div class="col-sm-10">
                    <select name="id_kategori" class="form-control">
                        @foreach (\App\Models\kategori::all() as $k)
                          <option value="{{ $k->id }}" {{ old('id', @$result->id) == $k->id_kategori ? 'selected' : '' }}>
                              {{ $k->category }}
                          </option> 
                        @endforeach
                      </select>                      
                  </div>
              </div>

              {{-- UMKM --}}
              <div class="form-group">
                  <label class="control-label col-sm-2">Nama UMKM</label>
                  <div class="col-sm-10">
                    <select name="id_umkm" class="form-control">
                        @foreach (\App\Models\umkm::all() as $u)
                          <option value="{{ $u->id }}" {{ old('id', @$result->id) == $u->id ? 'selected' : '' }}>
                              {{ $u->umkm_name }}
                          </option>
                        @endforeach
                      </select>                      
                  </div>
              </div>

              {{-- Nama --}}
              <div class="form-group">
                  <label class="control-label col-sm-2">Nama</label>
                  <div class="col-sm-10">
                      <input type="text" name="title" class="form-control" placeholder="title" value="{{ @$result->title }}">
                  </div>
              </div>

              {{-- rating --}}
              <div class="form-group">
                  <label class="control-label col-sm-2">Rating</label>
                  <div class="col-sm-10">
                      <input type="number" name="rating" step="0.1" min="0" max="5" class="form-control" placeholder="rating" value="{{ @$result->rating }}">
                  </div>
              </div>

              {{-- price --}}
              <div class="form-group">
                  <label class="control-label col-sm-2">Harga</label>
                  <div class="col-sm-10">
                      <input type="text" name="price" class="form-control" placeholder="price" value="{{ @$result->price }}">
                  </div>
              </div>

              {{-- Deskripsi --}}
              <div class="form-group">
                  <label class="control-label col-sm-2">Deskripsi</label>
                  <div class="col-sm-10">
                      <textarea name="description" class="form-control" placeholder="description">{{ @$result->description }}</textarea>
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