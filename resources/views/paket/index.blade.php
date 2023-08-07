@include('atribut.header')
@include('atribut.navbar')

<div class="wrapper">
    @include('atribut.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Paket Kuota</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Paket Kuota</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <button type="button" class="btn btn-default mr-2" data-toggle="modal" data-target="#modal-create">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                    <button id="refreshButton" class="btn btn-primary ml-2">
                        <i class="fas fa-arrows-rotate"></i> Refresh
                    </button>
                </div>

                <div class="float-left">
                    <form action="/paket/filter" method="GET">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Dari</span>
                            </div>
                            <input type="date" id="fromDate" name="start_date" class="form-control">

                            <div class="input-group-prepend">
                                <span class="input-group-text">Sampai</span>
                            </div>
                            <input type="date" id="toDate" name="end_date" class="form-control">

                            <button id="filterButton" type="submit" class="btn btn-primary ml-2">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <table id="paket" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="bg-warning text-white">Paket Kuota</th>
                            <th class="bg-warning text-white">Berat</th>
                            <th class="bg-warning text-white">Harga</th>
                            <th class="bg-warning text-white">Cabang</th>
                            <th class="bg-warning text-white">Created at</th>
                            <th class="bg-warning text-white">Status</th>
                            <th class="bg-warning text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $paket)
                        <tr>
                            <td class="text-center">{{ $paket->paket_kuota }}</td>
                            <td class="text-center">{{ $paket->berat }} {{ $paket->satuan_unit }}</td>
                            <td class="text-center">Rp. {{ $paket->harga }}</td>
                            <td class="text-center">{{ $paket->cabang }}</td>
                            <td class="text-center">{{ $paket->created_at }}</td>
                            <td class="text-center">@if($paket->status == 'Aktif')
                                <a href="{{ route('paket.nonaktif', $paket->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-check-circle"></i> Aktif
                                </a>
                                @else
                                <a href="{{ route('paket.aktif', $paket->id) }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-times-circle"></i> Nonaktif
                                </a>
                                @endif</td>
                                <td class="text-center">
                                    <div class="text-center">
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#detailEditModal{{ $paket->id }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#deleteModal{{ $paket->id }}" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $paket->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Paket</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('paket.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="paket_kuota">Paket Kuota</label>
                        <select class="form-control" id="paket_kuota" name="paket_kuota" required>
                            <option value="" disabled selected>Silahkan Pilih</option>
                            <option value="Kuota Setrika">Kuota Setrika</option>
                            <option value="Kuota Cuci & Setrika">Kuota Cuci & Setrika</option>
                            <option value="Kuota Cuci">Kuota Cuci</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="berat">Berat</label>
                        <input type="text" class="form-control" id="berat" name="berat" required>
                    </div>
                    <div class="form-group">
                        <label for="satuan_unit">Satuan</label>
                        <select class="form-control" id="satuan_unit" name="satuan_unit" required>
                            <option value="" disabled selected>Silahkan Pilih</option>
                            @foreach ($satuans as $satuan)
                                <option value="{{ $satuan->id }}">{{ $satuan->satuan_unit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="cabang">cabang</label>
                        <input type="text" class="form-control" id="cabang" name="cabang" required>
                    </div>
                    <input type="hidden" name="status" value="masuk">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="detailEditModal{{ $paket->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Paket</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('paket.update', $paket->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="paket_kuota">Paket Kuota</label>
                        <select class="form-control" id="paket_kuota" name="paket_kuota" required>
                            <option value="Kuota Setrika" {{ $paket->paket_kuota === 'Kuota Setrika' ? 'selected' : '' }}>Kuota Setrika</option>
                            <option value="Kuota Cuci & Setrika" {{ $paket->paket_kuota === 'Kuota Cuci & Setrika' ? 'selected' : '' }}>Kuota Cuci & Setrika</option>
                            <option value="Kuota Cuci" {{ $paket->paket_kuota === 'Kuota Cuci' ? 'selected' : '' }}>Kuota Cuci</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="berat">Berat</label>
                        <input type="text" class="form-control" id="berat" name="berat" value="{{ $paket->berat }}" required>
                    </div>
                    <div class="form-group">
                        <label for="satuan_unit">Satuan</label>
                        <select class="form-control" id="satuan_unit" name="satuan_unit" required>
                            <option value="" disabled selected>Silahkan Pilih</option>
                            @foreach ($satuans as $satuan)
                                <option value="{{ $satuan->id }}" {{ $satuan->id === $satuan->id ? 'selected' : '' }}>{{ $satuan->satuan_unit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" value="{{ $paket->harga }}" required>
                    </div>
                    <div class="form-group">
                        <label for="cabang">Cabang</label>
                        <input type="text" class="form-control" id="cabang" name="cabang" value="{{ $paket->cabang }}" required>
                    </div>
                    <input type="hidden" name="status" value="masuk">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>



@include('atribut.footer')
