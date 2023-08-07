@include('atribut.header')
@include('atribut.navbar')

<div class="wrapper">
    @include('atribut.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Satuan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Satuan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Satuan Unit</h3>
                <div class="float-right">

                    <button id="refreshButton" class="btn btn-primary">
                        <i class=" fas fa-arrows-rotate"></i> Refresh</button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#tambahSatuanModal">
                        <i class="fas fa-plus"></i> Create
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="satuan" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="bg-success text-center">Satuan Unit</th>
                            <th class="bg-success text-center">Deskripsi</th>
                            <th class="bg-success text-center">Status</th>
                            <th class="bg-success text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($satuans as $satuan)
                        <tr>
                            <td class="text-center">{{ $satuan->satuan_unit }}</td>
                            <td class="text-center">{{ $satuan->deskripsi }}</td>
                            <td class="text-center">
                                @if($satuan->status == 'Aktif')
                                <a href="{{ route('satuan.nonaktif', $satuan->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-check-circle"></i> Aktif
                                </a>
                                @else
                                <a href="{{ route('satuan.aktif', $satuan->id) }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-times-circle"></i> Nonaktif
                                </a>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="text-center">
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#detailEditModal{{ $satuan->id }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#deleteModal{{ $satuan->id }}" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $satuan->id }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Satuan Unit</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="tambahSatuanModal" tabindex="-1" role="dialog" aria-labelledby="tambahSatuanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSatuanModalLabel">Tambah Satuan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('satuan.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="satuan_unit">Satuan Unit</label>
                        <input type="text" class="form-control" id="satuan_unit" name="satuan_unit" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                    </div>
                    <input type="hidden" name="status" value="Aktif">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach($satuans as $satuan)
    <div class="modal fade" id="deleteModal{{ $satuan->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $satuan->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $satuan->id }}">Konfirmasi Penghapusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-exclamation-triangle text-warning" style="font-size 48px;"></i>
                    </div>
                    <p>Anda yakin ingin menghapus data ini secara permanen?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form id="deleteForm{{ $satuan->id }}" action="{{ route('satuan.destroy', $satuan->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                         Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    @foreach($satuans as $satuan)
    <!-- Modal Detail & Edit -->
    <div class="modal fade" id="detailEditModal{{ $satuan->id }}" tabindex="-1" aria-labelledby="detailEditModalLabel{{ $satuan->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailEditModalLabel{{ $satuan->id }}">Detail dan Edit Satuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('satuan.update', $satuan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="satuan_unit">Satuan Unit</label>
                            <input type="text" class="form-control" id="satuan_unit" name="satuan_unit" value="{{ $satuan->satuan_unit }}">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $satuan->deskripsi }}">
                        </div>
                        <input type="hidden" name="status" value="{{ $satuan->status }}">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

{{-- End Modal --}}

        @include('atribut.footer')
