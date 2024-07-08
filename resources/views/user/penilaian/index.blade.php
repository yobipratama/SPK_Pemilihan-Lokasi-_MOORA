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

    <!-- Modal -->
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
                                    <option value="{{ $item->code }}" attrBobot="{{ $item->value }}">
                                        {{ $item->alternatif }}</option>
                                @endforeach
                            </select>
                        </div>

                        @foreach ($kriterias as $item)
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">{{ $item->name }}</label>
                                <div class="col-sm-7">
                                    @if ($item->sub_kriteria->isEmpty())
                                        <input type="number" class="form-control" id="sub-kriteria-{{ $item->id }}">
                                    @else
                                        <select class="form-control" id="sub-kriteria-{{ $item->id }}">
                                            @foreach ($item->sub_kriteria as $sub)
                                                <option value="{{ $sub->id }}" attrBobot="{{ $sub->value }}">
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
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form id="edit-penilaian-form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit-input-topik">Pilih lokasi</label>
                            <select class="form-control" id="edit-input-topik">
                                @foreach ($alternatifs as $item)
                                    <option value="{{ $item->code }}" attrBobot="{{ $item->value }}">
                                        {{ $item->alternatif }}</option>
                                @endforeach
                            </select>
                        </div>

                        @foreach ($kriterias as $item)
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">{{ $item->name }}</label>
                                <div class="col-sm-7">
                                    @if ($item->sub_kriteria->isEmpty())
                                        <input type="number" class="form-control"
                                            id="edit-sub-kriteria-{{ $item->id }}">
                                    @else
                                        <select class="form-control" id="edit-sub-kriteria-{{ $item->id }}">
                                            @foreach ($item->sub_kriteria as $sub)
                                                <option value="{{ $sub->id }}" attrBobot="{{ $sub->value }}">
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
                        <button type="button" id="simpan-edit" class="btn btn-primary">Simpan Perubahan</button>
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
            var table = document.getElementById('data-penilaian');
            var inputTopik = document.getElementById('input-topik');
            const kriteriaIds = @json($kriterias->pluck('id'));

            var tableBody = '';
            const data = [];
            const values = [];
            const kriteriaValues = [];
            const formData = new FormData();

            const getSelectedText = (el) => {
                if (el.selectedIndex === -1) {
                    return null;
                }
                return el.options[el.selectedIndex].text;
            }

            addBtn.addEventListener('click', () => {
                let values = [];
                let kriteriaValues = [];

                tableBody += '<tr>';
                tableBody += `
                    <td>${inputTopik.value}</td>
                    <td>${getSelectedText(inputTopik)}</td>
                `;

                let penilaian = {
                    code: inputTopik.value,
                    lokasi: getSelectedText(inputTopik),
                    value: values,
                    kriteria: kriteriaValues
                };

                kriteriaIds.forEach(kriteriaId => {
                    let elem = document.getElementById('sub-kriteria-' + kriteriaId);
                    let kriteriaValue;

                    if (elem.tagName === 'SELECT') {
                        kriteriaValue = getSelectedText(elem);
                    } else {
                        kriteriaValue = elem.value;
                    }

                    values.push(elem.value);
                    kriteriaValues.push(kriteriaValue);

                    tableBody += `<td>${kriteriaValue}</td>`;
                });

                tableBody += `<td>
                                <button class="btn btn-primary edit-btn">Edit</button>
                                <button class="btn btn-danger delete-btn">Hapus</button>
                              </td>`;

                data.push(penilaian);

                tableBody += '</tr>';
                table.innerHTML = tableBody;

                // Add event listeners for edit and delete buttons
                document.querySelectorAll('.edit-btn').forEach(btn => {
                    btn.addEventListener('click', handleEdit);
                });

                document.querySelectorAll('.delete-btn').forEach(btn => {
                    btn.addEventListener('click', handleDelete);
                });
            });

            const handleEdit = (event) => {
                const row = event.target.closest('tr');
                const code = row.children[0].textContent;

                // Find data corresponding to the row
                const selectedData = data.find(item => item.code === code);

                // Fill edit modal with data
                document.getElementById('edit-input-topik').value = selectedData.code;
                kriteriaIds.forEach(kriteriaId => {
                    const elem = document.getElementById('edit-sub-kriteria-' + kriteriaId);
                    const kriteriaValue = selectedData.kriteria[kriteriaId - 1]; // Adjust index if needed
                    if (elem.tagName === 'SELECT') {
                        elem.value = kriteriaValue;
                    } else {
                        elem.value = kriteriaValue;
                    }
                });

                // Show the edit modal
                $('#editModalCenter').modal('show');
            };

            const handleDelete = (event) => {
                const row = event.target.closest('tr');
                const code = row.children[0].textContent;

                // Remove from the data array
                const index = data.findIndex(item => item.code === code);
                if (index !== -1) {
                    data.splice(index, 1);
                }

                // Remove the row from the table
                row.remove();
            };

            document.getElementById('simpan-edit').addEventListener('click', () => {
                // Update the data array with edited values
                const code = document.getElementById('edit-input-topik').value;
                const selectedDataIndex = data.findIndex(item => item.code === code);

                if (selectedDataIndex !== -1) {
                    kriteriaIds.forEach(kriteriaId => {
                        const elem = document.getElementById('edit-sub-kriteria-' + kriteriaId);
                        const kriteriaValue = elem.value;
                        data[selectedDataIndex].kriteria[kriteriaId - 1] = kriteriaValue; // Adjust index if needed
                    });

                    // Update the table row with new values
                    const row = table.querySelector(`tr td:first-child:nth-child(${selectedDataIndex + 1})`);
                    kriteriaIds.forEach(kriteriaId => {
                        const elem = document.getElementById('edit-sub-kriteria-' + kriteriaId);
                        const kriteriaValue = elem.value;
                        row.nextElementSibling.children[kriteriaId].textContent = kriteriaValue;
                    });

                    // Close the modal
                    $('#editModalCenter').modal('hide');
                }
            });

            saveBtn.addEventListener('click', () => {
                console.log(data)
                try {
                    $.ajax({
                        url: '{{ route('user.penilaian.store') }}',
                        type: "POST",
                        data: {
                            data: data
                        },
                        success: function(value) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Data berhasil disimpan dan dihitung',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = `/dashboard/admin/penilaian/history/${value}`
                                }
                            })
                        }
                    })
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        </script>
    @endpush
@endsection
