@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0" style="background: transparent">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Lokasi</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Lokasi</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lokasi</h4>
                    <a href="{{ route('admin.alternatif.add') }}" class="btn btn-primary">Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper">
                            <table id="example" class="display dataTable" style="min-width: 845px" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th>No</th>
                                        {{-- <th>Kode</th> --}}
                                        <th>Lokasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alternatif as $index => $item)                                    
                                        <tr role="row">
                                            <td>{{ $index+1 }}</td>
                                            {{-- <td>{{ $item->code }}</td> --}}
                                            <td>{{ $item->alternatif }}</td>
                                            <td class="d-flex justify-content-center">
                                                <a href="{{ route('admin.alternatif.edit', $item->id) }}" class="badge badge-warning mx-1">Edit</a>
                                                <a href="{{ route('admin.alternatif.destroy', $item->id) }}" class="badge badge-danger mx-1">Delete</a>
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
    </div>
</div>
@endsection