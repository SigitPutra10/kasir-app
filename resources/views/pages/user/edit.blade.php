@extends('main')
@section('title', '| Edit Pengguna')
@section('breadcrumb1', 'Pengguna')
@section('breadcrumb2', 'Edit Pengguna')

@section('content')
<div class="row">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="col-12">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf                    
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Role <span class="text-danger">*</span></label>
                                    <select class="form-control" name="role" required>
                                        <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password (Opsional)</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary w-25">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection