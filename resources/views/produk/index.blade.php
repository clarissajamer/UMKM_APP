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
            <a href="{{ url('produk/add') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>Tambah</a>
          <div class="box-body">
            <table class="table table-stripped">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Kategori</th>
                  <th>Nama UMKM</th>
                  <th>Nama</th>
                  <th>Rating</th>
                  <th>Price</th>
                  <th>Deskripsi</th>
                  <th>Foto</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($produk as $row)
                <tr>
                  <td>{{ !empty($i) ? ++$i : $i = 1 }}</td>
                  <td>{{ $row->kategori->category ?? '-' }}</td>
                  <td>{{ $row->umkm->umkm_name ?? '-' }}</td>
                  <td>{{ $row->title }}</td>
                  <td>{{ $row->rating }}</td>
                  <td>{{ $row->price }}</td>
                  <td>{{ $row->description }}</td>
                  <td>
                    <img src="{{ asset('uploads/'.@$row->images) }}" width="80px" class="img" />
                  </td>
                  <td>
                    <a href="{{ url("produk/$row->id/edit") }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <form action="{{ url("produk/$row->id/delete") }}" method="POST" style="display:inline;">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr> 
                  
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          <!-- /.box-footer-->
        </div>
        <!-- /.box -->
  
      </section>
      <!-- /.content -->
@endsection