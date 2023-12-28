@extends('layouts.app')

@section('content')
    

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            
            <div class="card mb-4">
                
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Survei POI
                </div>
                
                <div class="card-body">
                    <table id="datatablesSimple">
                        <a href="{{ route('admin.datasurvey.create') }}" class="btn btn-primary my-2">Tambah Data</a>

                        <thead>
                            <tr>
                                <th>Nama Bisnis</th>
                                <th>Jenis Usaha</th>
                                <th>Nama PIC</th>
                                <th>Nomor HP</th>
                                <th>Nomor Pelanggan</th>
                                <th>Alamat</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                                @if(Auth::user()->username == 'admin')
                                <th>Status</th>
                                @endif
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($menus as $dataSurvey)
                                <tr>
                                    <td>{{ $dataSurvey->nama_bisnis }}</td>
                                    <td>{{ $dataSurvey->jenis_usaha }}</td>
                                    <td>{{ $dataSurvey->nama_pic }}</td>
                                    <td>{{ $dataSurvey->no_hp }}</td>
                                    <td>{{ $dataSurvey->no_pelanggan }}</td>
                                    <td>{{ $dataSurvey->alamat }}</td>
                                    <td>
                                        @if ($dataSurvey->foto)
                                            <img src="{{ asset('foto/' . $dataSurvey->foto) }}" alt="Foto" class="img-thumbnail" width="150" height="150">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $dataSurvey->id }}">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $dataSurvey->id }}">
                                            Delete
                                        </button>
                                    </td>
                                    </td>
                                    @if(Auth::user()->username == 'admin')
                                    <td>
                                        @if($dataSurvey->status == 'setuju')
                                        <div class="alert alert-success" role="alert">
                                            Telah Disetujui
                                        </div>
                                    @elseif($dataSurvey->status == 'tolak')
                                        <div class="alert alert-danger" role="alert">
                                            Ditolak
                                        </div>
                                    @else
                                        <!-- Tombol Setuju -->
                                        <form action="{{ route('admin.datasurvey.setuju', $dataSurvey->id) }}" method="post" style="display: inline-block; margin-right: 5px;">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    
                                        <!-- Tombol Tolak -->
                                        <form action="{{ route('admin.datasurvey.tolak', $dataSurvey->id) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <!-- Edit Modal -->
    @foreach($menus as $dataSurvey)
    <div class="modal fade" id="editModal{{ $dataSurvey->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Survei</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your edit form goes here -->
                    <form action="{{ route('admin.datasurvey.update', $dataSurvey->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_bisnis" class="form-label">Nama Bisnis</label>
                            <input type="text" class="form-control" id="nama_bisnis" name="nama_bisnis" value="{{ $dataSurvey->nama_bisnis }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_usaha" class="form-label">Jenis Usaha</label>
                            <input type="text" class="form-control" id="jenis_usaha" name="jenis_usaha" value="{{ $dataSurvey->jenis_usaha }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pic" class="form-label">Nama PIC</label>
                            <input type="text" class="form-control" id="nama_pic" name="nama_pic" value="{{ $dataSurvey->nama_pic }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $dataSurvey->no_hp }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_pelanggan" class="form-label">Nomor Pelanggan</label>
                            <input type="text" class="form-control" id="no_pelanggan" name="no_pelanggan" value="{{ $dataSurvey->no_pelanggan }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required>{{ $dataSurvey->alamat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Delete Confirmation Modal -->
@foreach($menus as $dataSurvey)
<div class="modal fade" id="deleteModal{{ $dataSurvey->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $dataSurvey->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $dataSurvey->id }}">Konfirmasi Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.datasurvey.destroy', $dataSurvey->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach




@endsection