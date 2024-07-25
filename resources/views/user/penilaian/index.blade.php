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
                        <button class="btn btn-success text-white" data-toggle="modal"
                            data-target="#exampleModalCenter">Mulai Menilai</button>
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
                                            <th>Aksi</th>
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

    <!-- Modal tambah -->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mulai Menilai</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form id="penilaian-form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Pilih lokasi</label>
                            <select class="form-control" id="input-topik">
                                @foreach ($alternatifs as $item)
                                    <option value="{{ $item->code }}" attrBobot="{{ $item->value }}"
                                        attrType="{{ $item->type }}">
                                        {{ $item->alternatif }}</option>
                                @endforeach
                            </select>
                        </div>

                        @foreach ($kriterias as $item)
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">{{ $item->name }}</label>
                                <div class="col-sm-7">
                                    @if ($item->sub_kriteria->isEmpty())
                                        <input type="number" class="form-control" id="sub-kriteria-{{ $item->id }}"
                                            attrBobot="{{ $item->value }}" attrType="{{ $item->type }}">
                                    @else
                                        <select class="form-control" id="sub-kriteria-{{ $item->id }}"
                                            attrBobot="{{ $item->value }}" attrType="{{ $item->type }}">
                                            @foreach ($item->sub_kriteria as $sub)
                                                <option value="{{ $sub->id }}">
                                                    {{ $sub->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="tambah-penilaian" data-dismiss="modal"
                            class="btn btn-primary">Tambah</button>
                        <button type="button" id="simpan-edit-penilaian" style="display: none;" data-dismiss="modal"
                            class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('script')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var addBtn = document.getElementById('tambah-penilaian');
            var saveBtn = document.getElementById('simpan');
            var saveEditBtn = document.getElementById('simpan-edit-penilaian');
            var table = document.getElementById('data-penilaian');
            var inputTopik = document.getElementById('input-topik');
            var form = document.getElementById('penilaian-form');
            const kriteriaIds = @json($kriterias->pluck('id'));
            console.log('Kriteria IDs:', kriteriaIds);

            const getSelectedText = (el) => {
                if (el.selectedIndex === -1) {
                    return null;
                }
                return el.options[el.selectedIndex].text;
            }

            const renderTable = (data) => {
                let tableBody = '';
                data.forEach((penilaian, index) => {
                    tableBody += '<tr>';
                    tableBody += `
                        <td>${penilaian.code}</td>
                        <td>${penilaian.lokasi}</td>
                    `;
                    penilaian.kriteria.forEach(kriteriaValue => {
                        tableBody += `<td>${kriteriaValue}</td>`;
                    });
                    tableBody += `
                        <td>
                            <button class="btn btn-warning" onclick="editRow(${index})">Edit</button>
                            <button class="btn btn-danger" onclick="deleteRow(${index})">Delete</button>
                        </td>
                    `;
                    tableBody += '</tr>';
                });
                table.innerHTML = tableBody;
            }

            const deleteRow = (index) => {
                let data = JSON.parse(localStorage.getItem('penilaianData')) || [];
                data.splice(index, 1);
                localStorage.setItem('penilaianData', JSON.stringify(data));
                renderTable(data);
            }

            const editRow = (index) => {
                let data = JSON.parse(localStorage.getItem('penilaianData')) || [];
                let penilaian = data[index];

                editIndex = index;
                inputTopik.value = penilaian.code;

                kriteriaIds.forEach((kriteriaId, i) => {
                    let elem = document.getElementById('sub-kriteria-' + kriteriaId);
                    if (elem.tagName.toLowerCase() === 'input') {
                        elem.value = penilaian.value[i];
                    } else if (elem.tagName.toLowerCase() === 'select') {
                        elem.value = penilaian.value[i];
                    }
                });

                $('#exampleModalCenter').modal('show');
                addBtn.style.display = 'none';
                saveEditBtn.style.display = 'block';
            }

            addBtn.addEventListener('click', () => {

                let values = [];
                let kriteriaValues = [];
                let bobotKriteria = [];
                let typeKriteria = [];
                let kriteriaID = [];

                let penilaian = {
                    code: inputTopik.value,
                    lokasi: getSelectedText(inputTopik),
                    value: values,
                    bobot: bobotKriteria,
                    type: typeKriteria,
                    kriteria: kriteriaValues,
                    kriteriaID: kriteriaIds
                };

                kriteriaIds.forEach(kriteriaId => {
                    let elem = document.getElementById('sub-kriteria-' + kriteriaId);
                    let kriteriaValue;
                    let bobot = elem.getAttribute('attrBobot');
                    let type = elem.getAttribute('attrType');

                    if (elem.tagName === 'SELECT') {
                        kriteriaValue = getSelectedText(elem);
                    } else {
                        kriteriaValue = elem.value;
                    }

                    values.push(elem.value);
                    bobotKriteria.push(bobot);
                    typeKriteria.push(type);
                    kriteriaValues.push(kriteriaValue);
                });

                let data = JSON.parse(localStorage.getItem('penilaianData')) || [];
                data.push(penilaian);
                localStorage.setItem('penilaianData', JSON.stringify(data));

                renderTable(data);

                form.reset();
            });

            saveEditBtn.addEventListener('click', () => {
                let values = [];
                let kriteriaValues = [];
                let bobotKriteria = [];
                let typeKriteria = [];

                let penilaian = {
                    code: inputTopik.value,
                    lokasi: getSelectedText(inputTopik),
                    value: values,
                    bobot: bobotKriteria,
                    type: typeKriteria,
                    kriteria: kriteriaValues
                };

                kriteriaIds.forEach(kriteriaId => {
                    let elem = document.getElementById('sub-kriteria-' + kriteriaId);
                    let kriteriaValue;
                    let bobot = elem.getAttribute('data-bobot');
                    let type = elem.getAttribute('data-type');

                    if (elem.tagName === 'SELECT') {
                        kriteriaValue = getSelectedText(elem);
                    } else {
                        kriteriaValue = elem.value;
                    }

                    values.push(elem.value);
                    bobotKriteria.push(bobot);
                    typeKriteria.push(type);
                    kriteriaValues.push(kriteriaValue);
                });

                let data = JSON.parse(localStorage.getItem('penilaianData')) || [];
                data[editIndex] = penilaian;
                localStorage.setItem('penilaianData', JSON.stringify(data));

                renderTable(data);

                form.reset();
                editIndex = null;
                addBtn.style.display = 'block';
                saveEditBtn.style.display = 'none';
            });

            saveBtn.addEventListener('click', () => {
                let data = JSON.parse(localStorage.getItem('penilaianData')) || [];

                try {
                    $.ajax({
                        url: '{{ route('user.penilaian.store') }}',
                        type: "POST",
                        data: {
                            data: data
                        },
                        success: function(value) {
                            localStorage.removeItem('penilaianData');
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Data berhasil disimpan dan dihitung',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        `/dashboard/user/penilaian/history/${value}`
                                }
                            })
                        }
                    })
                } catch (error) {
                    console.error('Error:', error);
                }
            });

            document.addEventListener('DOMContentLoaded', () => {
                let data = JSON.parse(localStorage.getItem('penilaianData')) || [];
                renderTable(data);
            });
        </script>
    @endpush
@endsection
