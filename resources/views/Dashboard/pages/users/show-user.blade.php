@extends('dashboard.layouts.app')

@section('content')
<div class="container mx-auto mt-6 px-4">
    <div class="bg-white shadow-sm rounded-2xl overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-600 text-white px-6 py-4">
            <h5 class="text-lg font-semibold flex items-center gap-2">
                <i class="fa fa-user-circle"></i> Informasi Pengguna
            </h5>
        </div>

        <!-- Body -->
        <div class="p-6 text-gray-800 text-base">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <strong>👤 Nama Lengkap:</strong><br>
                    <span class="text-gray-900">{{ $user->name }}</span>
                </div>
                <div>
                    <strong>📧 Email:</strong><br>
                    <span class="text-gray-900">{{ $user->email }}</span>
                </div>
                <div>
                    <strong>👤 Username:</strong><br>
                    <span class="text-gray-900">{{ $user->username }}</span>
                </div>
                <div>
                    <strong>🔐 Roles:</strong><br>
                    @if($user->roles->isNotEmpty())
                        @foreach($user->roles as $role)
                            <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded-full mr-1">
                                {{ $role->name }}
                            </span>
                        @endforeach
                    @else
                        <span class="text-gray-400">Belum memiliki role</span>
                    @endif
                </div>
                <div>
                    <strong>🕓 Dibuat Pada:</strong><br>
                    <span class="text-gray-900">{{ $user->created_at->format('d F Y, H:i') }}</span>
                </div>
            </div>

            <hr class="my-4">

            <!-- Actions -->
            <div class="flex flex-wrap justify-end gap-2">
                <a href="{{ route('users.index') }}"
                   class="px-4 py-2 border border-gray-300 rounded-full bg-white text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>

                <a href="{{ route('users.edit', $user->id) }}"
                   class="px-4 py-2 rounded-full bg-yellow-500 text-white hover:bg-yellow-600 flex items-center gap-2">
                    <i class="fa fa-pencil"></i> Edit
                </a>

                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 rounded-full bg-red-600 text-white hover:bg-red-700 flex items-center gap-2">
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
