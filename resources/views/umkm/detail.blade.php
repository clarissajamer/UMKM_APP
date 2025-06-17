@extends('templates.header')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          umkm
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ url('/umkm') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <span class="box-title">{{ $umkm->umkm_name }}</span>
          <div class="box-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if ($umkm->images)
                        <img src="{{ asset('uploads/' . $umkm->images) }}" class="img-thumbnail" width="250">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" class="img-thumbnail" width="250">
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-stripped">
                        <tr>
                            <th>Owner UMKM</th>
                            <td>{{ $umkm->owner_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $umkm->umkm_desc ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>NO Telp</th>
                            <td>{{ $umkm->phone ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $umkm->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $umkm->address ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
          </div>
          <!-- /.box-body -->
          <!-- /.box-footer-->
            <div class="box-footer">
                <a href="{{ url('umkm') }}" class="btn bg-purple"><i class="fa fa-chevron-left"></i>Kembali</a>
            </div>
        </div>
        <!-- /.box -->
  
      </section>
      <!-- /.content -->
@endsection