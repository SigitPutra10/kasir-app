@extends('main')
@section('title', '| Pengguna')
@section('breadcrumb1', 'Pengguna')
@section('breadcrumb2', 'Pengguna')

@section('content')
    <div class="row">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @if (Auth::user()->role === 'admin')
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Pengguna</a>
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>
                                        @if (Auth::user()->role === 'admin')
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm" 
                                            style="background-color: #fbc02d; color: white;">Edit</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;" 
                                                onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm" style="background-color: #ff5252; color: white;">Hapus</button>
                                            </form>
                                            @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function notif(type, msg) {
            Swal.fire({
                icon: type,
                text: msg
            })
        }
        @if(session('success'))
            notif('success', "{{ session('success') }}")
        @endif
        @if(session('error'))
            notif('error', "{{ session('error') }}")
        @endif

</script>
@endsection
