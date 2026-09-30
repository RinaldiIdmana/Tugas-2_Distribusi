<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container">

    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div class="alert alert-success my-2">{{ session('success') }}</div>
    @endif

    {{-- Pesan Error --}}
    @if($errors->any())
        <div class="alert alert-danger my-2">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- START FORM -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <form action="{{ isset($student) ? url('student/' . $student['id']) : url('student') }}" method="post">
            @csrf
            @if(isset($student))
                @method('PUT')
            @endif
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">NIM</label>
                        <div class="col-sm-8">
                            <input type="text" name="nim" class="form-control" value="{{ old('nim', $student['nim'] ?? '') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', $student['nama'] ?? '') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">Prodi</label>
                        <div class="col-sm-8">
                            <select name="prodi" class="form-control">
                                <option value="">Pilih Prodi</option>
                                @foreach(['TRM', 'TRMK', 'TRPL', 'TL'] as $prodi)
                                    <option value="{{ $prodi }}" {{ old('prodi', $student['prodi'] ?? '') == $prodi ? 'selected' : '' }}>
                                        {{ $prodi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-8">
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $student['tanggal_lahir'] ?? '') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" value="{{ old('email', $student['email'] ?? '') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label">Alamat</label>
                        <div class="col-sm-8">
                            <textarea name="alamat" rows="3" class="form-control">{{ old('alamat', $student['alamat'] ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-6 d-grid">
                    <button type="submit" class="btn btn-primary">{{ isset($student) ? 'Update' : 'Simpan' }}</button>
                </div>
            </div>
        </form>
    </div>
    <!-- AKHIR FORM -->

    <!-- START DATA -->
    @if(!isset($student))
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h5>Data Mahasiswa</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Tanggal Lahir</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($students as $data)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $data['nim'] }}</td>
                        <td>{{ $data['nama'] }}</td>
                        <td>{{ $data['prodi'] }}</td>
                        <td>{{ date('d/m/Y', strtotime($data['tanggal_lahir'])) }}</td>
                        <td>{{ $data['email'] }}</td>
                        <td>{{ $data['alamat'] }}</td>
                        <td>
                            <a href="{{ url('student/'.$data['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form onsubmit="return confirm('Hapus data ini?')" class="d-inline" action="{{ url('student/'.$data['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Del</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <!-- AKHIR DATA -->

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
