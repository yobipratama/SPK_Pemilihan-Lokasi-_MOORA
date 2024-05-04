@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0" style="background: transparent">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Hasil Penilaian</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Penilaian</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-end">
                        {{-- <div class="col-6"></div> --}}
                        <div class="col-1">
                            <a href="{{ route('admin.penilaian.pdf', $id) }}" class="btn btn-primary">
                                Cetak
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Matrix</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper">
                            <table class="display dataTable" style="min-width: 845px" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th>Kode</th>
                                        @for ($i = 1; $i < count($matrix[0]); $i++)
                                            <th>C{{ $i }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($matrix); $i++)                          
                                    <tr>
                                        @for ($j = 0; $j < count($matrix[0]); $j++)
                                            <td>{{ $matrix[$i][$j] }}</td>
                                        @endfor
                                    </tr>
                                    @endfor
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
                    <h4 class="card-title">Nilai Matrix Normalisasi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper">
                            <table id="example1" class="display dataTable s" style="min-width: 845px" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th>Kode</th>
                                        @for ($i = 1; $i < count($matrix[0]); $i++)
                                            <th>C{{ $i }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($matrix_normalisasi); $i++)                          
                                    <tr>
                                        @for ($j = 0; $j < count($matrix_normalisasi[0]); $j++)
                                            <td>{{ $matrix_normalisasi[$i][$j] }}</td>
                                        @endfor
                                    </tr>
                                    @endfor
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
                    <h4 class="card-title">Nilai Matrix Normalisasi dengan bobot</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper">
                            <table id="example1" class="display dataTable" style="min-width: 845px" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th>Kode</th>
                                        @for ($i = 1; $i < count($matrix[0]); $i++)
                                            <th>C{{ $i }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($matrix_normalisasi_w); $i++)                          
                                    <tr>
                                        @for ($j = 0; $j < count($matrix_normalisasi_w[0]); $j++)
                                            <td>{{ $matrix_normalisasi_w[$i][$j] }}</td>
                                        @endfor
                                    </tr>
                                    @endfor
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
                    <h4 class="card-title">Ranking</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper">
                            <table id="example1" class="display dataTable" style="min-width: 845px" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th>No</th>
                                        <th>Alternatif</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($ranking); $i++)                          
                                    <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ $ranking[$i][0] }}</td>
                                        <td>{{ $ranking[$i][1] }}</td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <p class="text-dark">Dari hasil perhitungan, maka diperoleh hasil rekomendasi yaitu <strong>{{ $ranking[0][0] }}</strong></p>
        </div>
    </div>
</div>
@endsection