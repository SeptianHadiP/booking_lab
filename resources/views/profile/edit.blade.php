    @extends('dashboard.layouts.app')

    @section('title', 'Dashboard - Bhayangkara University Lab Booking')

    @section('content')
        <!-- Profile Card -->
        <div class="bg-white shadow-xl rounded-3xl p-10 transition">
            <!-- Header Profile -->
            <div class="flex flex-col md:flex-row items-center justify-between border-b border-gray-200 pb-8">
                <div class="flex items-center space-x-6">
                    <!-- Foto Profil -->
                    <style>
                        [x-cloak] { display: none !important; }
                    </style>

                    <div x-data="{ open: false, showImage: false }" class="relative">
                        <!-- Foto Profil (trigger modal) -->
                        <div @click="open = true" class="cursor-pointer">
                            <img id="profileImage"
                                class="w-28 h-28 rounded-full object-cover ring-4 ring-gray-100"
                                src="{{ auth()->user()->profile ? asset('storage/' . auth()->user()->profile) : 'https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png' }}"
                                alt="profile photo">
                        </div>

                        <!-- Popup Modal Pilihan -->
                        <div x-show="open" x-cloak
                            class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                            <div @click.outside="open = false"
                                class="bg-white rounded-2xl shadow-xl w-64 p-6 text-center">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pilihan Profil</h3>

                                <!-- Lihat Profil -->
                                <button type="button"
                                    @click="open = false; showImage = true"
                                    class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                                    Lihat Profil
                                </button>

                                <!-- Ubah Profil -->
                                <button type="button"
                                    onclick="document.getElementById('uploadProfile').click();"
                                    class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                                    Ubah Profil
                                </button>

                                <!-- Input file hidden -->
                                <form id="uploadProfileForm" action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data" class="hidden">
                                    @csrf
                                    <input type="file" id="uploadProfile" name="profile" accept="image/*"
                                        onchange="document.getElementById('uploadProfileForm').submit();">
                                </form>

                                <!-- Hapus Profil -->
                                <form id="deleteProfileForm" action="{{ route('profile.deletePhoto') }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button"
                                    onclick="if(confirm('Yakin hapus foto profil?')) document.getElementById('deleteProfileForm').submit();"
                                    class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-100 rounded-lg">
                                    Hapus Profil
                                </button>
                            </div>
                        </div>

                        <!-- Modal Lihat Foto -->
                        <div x-show="showImage" x-cloak
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
                            @click.self="showImage = false">
                            
                            <div class="p-4">
                                <img class="max-w-lg max-h-[90vh] rounded-2xl shadow-2xl"
                                    src="{{ auth()->user()->profile ? asset('storage/' . auth()->user()->profile) : 'https://via.placeholder.com/150' }}"
                                    alt="profile large">
                            </div>
                        </div>

                    </div>

                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">
                            {{ auth()->user()->name ?? '-' }}
                        </h2>
                        <p class="text-gray-500 text-lg">
                            {{ auth()->user()->email ?? '-' }}
                        </p>
                        <span class="inline-block mt-2 px-4 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-700">
                            {{ auth()->user()->roles->first()->name ?? '-' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Biodata User -->
            <h3 class="mt-10 text-xl font-semibold text-gray-800 border-b border-gray-200 pb-3">Biodata User</h3>
            <form action="{{ route('profile.update') }}" method="POST" class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                @csrf
                @method('PATCH')

                <!-- Nama Full -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Full</label>
                    <input type="text" name="name"
                        value="{{ old('name', auth()->user()->name ?? '') }}"
                        class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm px-4 py-3 text-gray-700 placeholder-gray-400 bg-white"
                        placeholder="Nama lengkap kamu">
                </div>

                <!-- Gelar -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gelar</label>
                    <input type="text" name="title"
                        value="{{ old('title', auth()->user()->title ?? '') }}"
                        class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm px-4 py-3 text-gray-700 placeholder-gray-400 bg-white"
                        placeholder="Gelar kamu">
                </div>

                <!-- NIP/NIM -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">NIP / NIM</label>
                    <input type="text" name="nip_npm"
                        value="{{ old('nip_npm', auth()->user()->nip_npm ?? '') }}"
                        class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm px-4 py-3 text-gray-700 placeholder-gray-400 bg-white"
                        placeholder="Masukkan NIP atau NIM">
                </div>

                <!-- Nama Panggilan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Panggilan</label>
                    <input type="text" name="nickname"
                        value="{{ old('nickname', auth()->user()->nickname ?? '') }}"
                        class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm px-4 py-3 text-gray-700 placeholder-gray-400 bg-white"
                        placeholder="Nama panggilan">
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                    <select name="gender"
                        class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm px-4 py-3 text-gray-700 bg-white">
                        <option value="">Pilih jenis kelamin</option>
                        <option value="L" {{ old('gender', auth()->user()->gender ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('gender', auth()->user()->gender ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="tel" name="phone"
                        value="{{ old('phone', auth()->user()->phone ?? '') }}"
                        class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm px-4 py-3 text-gray-700 placeholder-gray-400 bg-white"
                        placeholder="08xxxxxxxxxx">
                </div>

                <!-- Tempat Lahir -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                    <input type="text" name="place_of_birth"
                        value="{{ old('place_of_birth', auth()->user()->place_of_birth ?? '') }}"
                        class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm px-4 py-3 text-gray-700 placeholder-gray-400 bg-white"
                        placeholder="Masukkan kota kelahiran">
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                    <input type="date" name="birth_date"
                        value="{{ old('birth_date', auth()->user()->birth_date ?? '') }}"
                        class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm px-4 py-3 text-gray-700 bg-white">
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <textarea name="address" class="w-full h-28 rounded-2xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm px-4 py-3 text-gray-700 placeholder-gray-400 bg-white resize-none"
                        placeholder="Masukkan alamat lengkap kamu">{{ old('address', auth()->user()->address ?? '') }}</textarea>
                </div>

                <!-- Save Biodata -->
                <div class="md:col-span-2 flex justify-end mt-4">
                    <button
                        class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 transition text-white font-semibold px-8 py-3 rounded-2xl shadow-md">
                        Save Biodata
                    </button>
                </div>
            </form>

            <!-- Keamanan Akun -->
            <h3 class="mt-12 text-xl font-semibold text-gray-800 border-b border-gray-200 pb-3">Keamanan Akun</h3>
            <form id="formKeamanan" action="{{ route('profile.updateSecurity') }}" method="POST" class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                @csrf
                @method('PUT')

                <!-- Email -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="emailKeamanan" name="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        class="w-full rounded-2xl border-gray-200 shadow-sm px-4 py-3 text-gray-700 placeholder-gray-400 bg-gray-100 cursor-not-allowed"
                        placeholder="Email kamu" disabled>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="passwordKeamanan" name="password"
                        class="w-full rounded-2xl border-gray-200 shadow-sm px-4 py-3 text-gray-700 placeholder-gray-400 bg-gray-100 cursor-not-allowed"
                        placeholder="********" disabled>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <input type="password" id="confirmPasswordKeamanan" name="password_confirmation"
                        class="w-full rounded-2xl border-gray-200 shadow-sm px-4 py-3 text-gray-700 placeholder-gray-400 bg-gray-100 cursor-not-allowed"
                        placeholder="********" disabled>
                </div>

                <!-- Buttons -->
                <div class="md:col-span-2 flex justify-end mt-4 space-x-3">
                    <button type="button" id="btnEditKeamanan"
                        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 transition text-white font-semibold px-8 py-3 rounded-2xl shadow-md">
                        Edit Keamanan
                    </button>
                    <button type="submit" id="btnSaveKeamanan" disabled
                        class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 transition text-white font-semibold px-8 py-3 rounded-2xl shadow-md opacity-60 cursor-not-allowed">
                        Save Keamanan
                    </button>
                </div>
            </form>
        </div>

        <script>
            const btnEdit = document.getElementById('btnEditKeamanan');
            const btnSave = document.getElementById('btnSaveKeamanan');
            const fields = [
                document.getElementById('emailKeamanan'),
                document.getElementById('passwordKeamanan'),
                document.getElementById('confirmPasswordKeamanan')
            ];

            btnEdit.addEventListener('click', function () {
                const isEditing = btnEdit.dataset.editing === "true";

                if (!isEditing) {
                    // Aktifkan edit mode
                    fields.forEach(el => {
                        el.disabled = false;
                        el.classList.remove('bg-gray-100', 'cursor-not-allowed');
                        el.classList.add('bg-white');
                    });

                    btnSave.disabled = false;
                    btnSave.classList.remove('opacity-60', 'cursor-not-allowed');

                    btnEdit.textContent = "Batal";
                    btnEdit.classList.remove("from-blue-500", "to-blue-600", "hover:from-blue-600", "hover:to-blue-700");
                    btnEdit.classList.add("from-red-500", "to-red-600", "hover:from-red-600", "hover:to-red-700");

                    btnEdit.dataset.editing = "true";
                } else {
                    // Batalkan edit mode
                    fields.forEach(el => {
                        el.disabled = true;
                        el.classList.add('bg-gray-100', 'cursor-not-allowed');
                        el.classList.remove('bg-white');
                    });

                    btnSave.disabled = true;
                    btnSave.classList.add('opacity-60', 'cursor-not-allowed');

                    btnEdit.textContent = "Edit Keamanan";
                    btnEdit.classList.remove("from-red-500", "to-red-600", "hover:from-red-600", "hover:to-red-700");
                    btnEdit.classList.add("from-blue-500", "to-blue-600", "hover:from-blue-600", "hover:to-blue-700");

                    btnEdit.dataset.editing = "false";
                }
            });
        </script>
        <script src="//unpkg.com/alpinejs" defer></script>
    @endsection
@error('name')
    <span class="text-red-500 text-sm">{{ $message }}</span>
@enderror
