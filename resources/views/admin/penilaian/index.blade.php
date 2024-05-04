@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0" style="background: transparent">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Penilaian</h4>
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
                <div class="card-header">
                    <button class="btn btn-success text-white" data-toggle="modal" data-target="#exampleModalCenter">Mulai Menilai</button>
                    <button class="btn btn-danger" id="simpan">Mulai Menghitung</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper">
                            <table class="display dataTable">
                                <thead>
                                    <tr role="row">
                                        <th>Kode</th>
                                        <th>Alternatif</th>
                                        @foreach ($kriterias as $item)
                                            <th>{{ $item->code }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody id="data-penilaian">
                                    <tr>
                                        <td>Tidak ada data</td>
                                    </tr>
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
                <h5 class="modal-title">Mulai Menilai</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Pilih lokasi</label>
                        <select class="form-control" id="input-topik">
                            @foreach ($alternatifs as $item)
                                <option value="{{ $item->code }}" attrBobot="{{ $item->value }}">{{$item->alternatif}}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach ($kriterias as $item)                       
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">{{ $item->name }}</label>
                            <div class="col-sm-7">
                                <select class="form-control" id="sub-kriteria-{{ $item->id }}">
                                    @foreach ($item->sub_kriteria as $sub)
                                        <option value="{{ $sub->id }}" attrBobot="{{ $sub->value }}">{{$sub->keterangan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="tambah-penilaian" data-dismiss="modal" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>


    @push('script')
    <script>
        var addBtn = document.getElementById('tambah-penilaian');
        var saveBtn = document.getElementById('simpan');
        var table = document.getElementById('data-penilaian');
        var inputTopik = document.getElementById('input-topik');

        var tableBody = '';
        const data = [];

        const getSelectedText = (el) => {
            if (el.selectedIndex === -1) {
                return null;
            }
            return el.options[el.selectedIndex].text;
        }

        const getSelectedBobot = (el) => {
            if (el.selectedIndex === -1) {
                return null;
            }
            let bobot = el.options[el.selectedIndex].getAttribute('attrBobot');
            return bobot;
        }

        addBtn.addEventListener('click', () => {
            if(!tableBody.includes(inputTopik.value)){
                tableBody += '<tr>'
                tableBody += `
                    <td>${inputTopik.value}</td>
                    <td>${getSelectedText(inputTopik)}</td>
                `;
                
                let dc = [];
                var optionPenilaian  = document.querySelectorAll('[id^="sub-kriteria-"]');
                optionPenilaian.forEach(element => {
                    tableBody += `<td>${getSelectedBobot(element)}</td>`
                    dc.push(parseInt(getSelectedBobot(element)))
                });
                data.push({
                    code: getSelectedText(inputTopik),
                    kriterias: dc,
                })
                tableBody += `</tr>`;
                table.innerHTML = tableBody;
            }
        });

        saveBtn.addEventListener('click', () => {
            $.ajax({
                url: '{{ route("admin.penilaian.store") }}',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    data: data,
                },
                success: function (value) {
                    window.location.href = `/dashboard/admin/penilaian/history/${value}`
                }
            })
        });



    </script>
    @endpush

@endsection