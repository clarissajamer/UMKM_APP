@extends('templates.header')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          UMKM
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
            <a href="{{ url('umkm/add') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>Tambah</a>
          <div class="box-body">
            <table class="table table-stripped">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Nama UMKM</th>
                  <th>Owner UMKM</th>
                  <th>Deskripsi UMKM</th>
                  <th>NO. Telp</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Foto</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($result as $row)
                <tr>
                  <td>{{ !empty($i) ? ++$i : $i = 1 }}</td>
                  <td>{{ $row->umkm_name }}</td>
                  <td>{{ $row->owner_name }}</td>
                  <td>{{ $row->umkm_desc }}</td>
                  <td>{{ $row->phone }}</td>
                  <td>{{ $row->email }}</td>
                  <td>{{ $row->address }}</td>
                  <td>{{ $row->images }}</td>
                  <td>
                    <img src="{{ asset('uploads/'.@$row->images) }}" width="80px" class="img" />
                  </td>
                  <td>
                    <a href="{{ url("umkm/$row->id/edit") }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <form action="{{ url("umkm/$row->id/delete") }}" method="POST" style="display:inline;">
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