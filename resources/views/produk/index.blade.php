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
            <div class="row" style="margin-bottom: 10px;">
              <div class="col-md-6">
                <div class="input-group">
                  <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id="searchBtn"><i class="fa fa-search"></i></button>
                  </span>
                </div>
              </div>
            </div>
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
                @foreach ($produk as $index => $row)
                <tr class="umkm-row" data-index="{{ $index }}">
                  <td class="row-no"></td>
                  <td>{{ $row->kategori->category ?? '-' }}</td>
                  <td>{{ $row->umkm->umkm_name ?? '-' }}</td>
                  <td>{{ $row->title }}</td>
                  <td>{{ $row->rating }}</td>
                  <td>Rp {{ number_format($row->price, 0, ',', '.') }}</td>
                  <td>{{ $row->description }}</td>
                  <td>
                    <img src="{{ asset('uploads/'.@$row->images) }}" width="80px" class="img" />
                  </td>
                  <td>
                    <a href="{{ url("produk/$row->id/detail") }}" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></a>
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
            <div class="row">
              <div class="col-md-12 text-right">
                <span id="pageInfo" class="label label-default" style="margin-right: 10px;"></span>
                <button class="btn btn-default" id="prevBtn">Previous</button>
                <button class="btn btn-primary" id="nextBtn">Next</button>
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

@push('script')
<script>
  $(function () {
    const perPage = 5;
    let page = 1;

    function render() {
      const keyword = $('#searchInput').val().toLowerCase();
      const $rows = $('.umkm-row').hide().filter((_, el) =>
        $(el).text().toLowerCase().includes(keyword)
      );

      const total = $rows.length;
      const pages = Math.max(1, Math.ceil(total / perPage));
      page = Math.min(page, pages);

      $rows.slice((page - 1) * perPage, page * perPage).each((i, el) => {
        $(el).show();
        $(el).find('.row-no').text((page - 1) * perPage + i + 1);
      });

      $('#pageInfo').text(`Halaman ${page} dari ${pages}`);
      $('#prevBtn').prop('disabled', page === 1);
      $('#nextBtn').prop('disabled', page === pages);
    }

    $('#prevBtn').click(() => { page--; render(); });
    $('#nextBtn').click(() => { page++; render(); });

    // Trigger search saat tombol diklik
    $('#searchBtn').click(() => { page = 1; render(); });

    // Trigger juga saat Enter ditekan di input
    $('#searchInput').keypress(function (e) {
      if (e.which === 13) {
        page = 1;
        render();
      }
    });

    render();
  });
</script>
@endpush
