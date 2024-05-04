@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0" style="background: transparent">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Riwayat Penilaian</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Riwayat Penilaian</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Riwayat Penilaian</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper">
                            <table id="" class="display dataTable" style="min-width: 845px" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th>No</th>
                                        <th>Alternatif</th>
                                        <th>Tanggal Penilaian</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penilaian as $index => $item)                                    
                                        <tr role="row">
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $item->alternatif }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.penilaian.detail_history', $item->id) }}" class="btn btn-success">Detail</a>
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