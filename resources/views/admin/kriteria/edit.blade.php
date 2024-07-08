@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Edit Kriteria</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Kriteria</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Kriteria</h4>
                    </div>
                    <form action="{{ route('admin.kriteria.update', $kriteria->id) }}" method="post">
                        <div class="card-body">
                            <div class="basic-form">
                                @csrf
                                <input type="hidden" name="id" value="{{ $kriteria->id }}">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label>Code</label>
                                        <input name="code" type="text" class="form-control" value="{{ $kriteria->code }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label>Kriteria</label>
                                        <input name="name" type="text" class="form-control" value="{{ $kriteria->name }}">
                                    </div>
                                </div>

                                <div class="">
                                    <label>Jenis</label>
                                    <div class="form-group col p-0">
                                        <label class="radio-inline">
                                            <input type="radio" name="type" value="Benefit" {{ $kriteria->type == 'Benefit' ? 'checked' : '' }}> Benefit</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="type" value="Cost" {{ $kriteria->type == 'Cost' ? 'checked' : '' }}> Cost</label>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="mb-3 text-right">
                                    <button type="button" class="btn btn-success mb-3" id="add-sub-kriteria">
                                        <i class="bx bx-plus"></i> Tambah Sub Kriteria
                                    </button>

                                </div>
                                <div class="" id="sub-kriteria-form">
                                    @foreach($kriteria->sub_kriteria as $index => $subKriteria)
                                        <div class="sub-kriteria-group" id="sub-kriteria-group-{{ $index + 1 }}">
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label for="" class="keterangan-label">Keterangan {{ $index + 1 }}</label>
                                                    <input type="text" class="form-control" name="keterangan[]" value="{{ $subKriteria->keterangan }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label for="">Bobot</label>
                                                    <input type="number" class="form-control" name="value[]" value="{{ $subKriteria->value }}">
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger mb-3 remove-sub-kriteria" data-id="{{ $index + 1 }}">Hapus</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    @push('script')
    <script>
        $(document).ready(function() {
            let count = {{ $kriteria->sub_kriteria->count() }};

            function updateLabels() {
                $('.sub-kriteria-group').each(function(index) {
                    $(this).find('.keterangan-label').text('Keterangan ' + (index + 1));
                    $(this).attr('id', 'sub-kriteria-group-' + (index + 1));
                    $(this).find('.remove-sub-kriteria').attr('data-id', (index + 1));
                });
            }

            $('#add-sub-kriteria').click(function() {
                count++;
                $('#sub-kriteria-form').append(`
                    <div class="sub-kriteria-group" id="sub-kriteria-group-` + count + `">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="" class="keterangan-label">Keterangan ` + count + `</label>
                                <input type="text" class="form-control" name="keterangan[]">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="">Bobot ` + count + `</label>
                                <input type="number" class="form-control" name="value[]">
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger mb-3 remove-sub-kriteria" data-id="` + count + `">Hapus</button>
                    </div>
                `);
            });

            $(document).on('click', '.remove-sub-kriteria', function() {
                $(this).closest('.sub-kriteria-group').remove();
                updateLabels();
                if ($('.sub-kriteria-group').length === 0) {
                    count = 0;
                }
            });
        });
    </script>
    @endpush
@endsection
