@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0" style="background: transparent">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Kriteria</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Kriteria</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">kriteria</h4>
                    <a href="{{ route('admin.kriteria.add') }}" class="btn btn-primary">Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper">
                            <table id="example" class="display dataTable" style="min-width: 845px" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" rowspan="1" colspan="1">No</th>
                                        <th class="sorting" rowspan="1" colspan="1">Kode</th>
                                        <th class="sorting" rowspan="1" colspan="1">Kriteria</th>
                                        <th class="sorting" rowspan="1" colspan="1">Jenis</th>
                                        <th class="sorting" rowspan="1" colspan="1">Bobot</th>
                                        <th class="sorting" rowspan="1" colspan="1">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriterias as $index => $kriteria)                                    
                                        <tr role="row">
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $kriteria->code }}</td>
                                            <td>{{ $kriteria->name }}</td>
                                            <td>{{ $kriteria->type }}</td>
                                            <td>{{ $kriteria->value }}</td>
                                            <td>
                                                <a href="{{ route('admin.kriteria.edit', $kriteria->id) }}" class="badge badge-warning">Edit</a>
                                                <a href="{{ route('admin.kriteria.destroy', $kriteria->id) }}" class="badge badge-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                  
                                </tbody>
                            </table>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sub kriteria</h4>
                    <bbutton class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Tambah Sub Kriteria</bbutton>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper">
                            <table id="example" class="display dataTable" style="min-width: 845px" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" rowspan="1" colspan="1">Kriteria</th>
                                        <th class="sorting" rowspan="1" colspan="1">Sub Kriteria</th>
                                        <th class="sorting" rowspan="1" colspan="1">Bobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriterias as $index => $item)                                    
                                        <tr role="row">
                                            <td rowspan="{{ count($item->sub_kriteria) + 1 }}">{{ $item->name }}</td>
                                        </tr>
                                        @foreach ($item->sub_kriteria as $sub)
                                            <tr>
                                                <td>{{ $sub->keterangan }}</td>
                                                <td>{{ $sub->value }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Sub Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.kriteria.store_sub') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Pilih Kriteria</label>
                        <select class="form-control" id="input-topik" name="kriterias_id">
                            @foreach ($kriterias as $item)
                                <option value="{{ $item->id }}" attrBobot="{{ $item->id }}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Sub Kriteria Baru</label>
                        <input type="text" class="form-control" name="keterangan">
                    </div>

                    <div class="form-group">
                        <label for="">Bobot Sub Kriteria</label>
                        <input type="number" class="form-control" name="value">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection