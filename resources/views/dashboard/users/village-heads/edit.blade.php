@extends('layouts.main')
@section('title', 'Edit Pengguna')
@section('main')

    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ route('village-heads.update', $villageHead->id) }}" method="post"
            enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
            @csrf
            @method('PUT')
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" name="name" id="name" value="{{ $villageHead->name }}"
                    placeholder="Masukkan Nama..." required />
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="employee_number" class="text-second mb-2">NIP</label>
                <input type="text" class="input-crud" name="employee_number" id="employee_number" value="{{ $villageHead->employee_number }}"
                    placeholder="Masukkan Nomor Induk Pegawai..." required />
                @error('employee_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="email" class="text-second mb-1">Email</label>
                <input type="email" class="input-crud" id="email" name="user[email]" placeholder="Masukkan Email..."
                    value="{{ $villageHead->user->email }}" required>
                @error('user.email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="password" class="text-second mb-1">Password</label>
                <input type="password" class="input-crud" id="password" name="user[password]"
                    placeholder="Masukkan Password...">
                @error('user.password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <p class="text-second mb-1">Status Akun</p>
                <label class="switch">
                    <input type="checkbox" name="user[status]" @checked($villageHead->user->status->value == 1 ? 'on' : '')>
                    <span class="slider round"></span>
                </label>

                @error('user.status')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="signature_image" class="text-second mb-1">Foto TTE</label>
                <label for="signature_image" class="d-block mb-3">
                    @if ($villageHead->user->signature_image)
                        <img src="{{ asset('uploads/users/signatures/' . $villageHead->user->signature_image) }}" class="edit-tte-preview-img border"
                            width="300" alt="">
                    @else
                        <img src="{{ asset('assets/img/upload-image.jpg') }}" class="edit-tte-preview-img border"
                            width="300" alt="">
                    @endif
                </label>
                <input type="file" id="signature_image" name="user[signature_image]"
                    class="input-crud py-0 edit-tte-input hidden" />
                <label for="signature_image" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('user.signature_image')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Edit Pengguna</button>
                <a href="{{ route('village-heads.index') }}" class="button btn-second text-white"
                    type="reset">Batal Edit</a>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        previewImg("edit-tte-input", "edit-tte-preview-img")
    </script>
@endpush
