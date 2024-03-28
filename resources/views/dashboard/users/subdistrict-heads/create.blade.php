@extends('layouts.main')
@section('title', 'Tambah Pengguna')
@section('main')

    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ route('subdistrict-heads.store') }}" method="post" enctype="multipart/form-data"
            class="grid grid-cols-12 gap-4">
            @csrf
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" name="name" id="name" value="{{ old('name') }}"
                    placeholder="Masukkan Nama..." required />
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="employee_number" class="text-second mb-1">NIP</label>
                <input type="text" class="input-crud" name="employee_number" id="employee_number" value="{{ old('employee_number') }}"
                    placeholder="Masukkan Nomor Induk Pegawai..." required />
                @error('employee_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="signature_image" class="text-second mb-1">Foto TTE</label>
                <label for="signature_image" class="d-block mb-3">
                    <img src="{{ asset('assets/img/upload-image.jpg') }}" class="create-tte-preview-img border"
                        width="300" alt="">
                </label>
                <input type="file" id="signature_image" name="signature_image"
                    class="input-crud py-0 create-tte-input hidden" />
                <label for="signature_image" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('signature_image')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Tambah Pengguna</button>
                <a href="{{ route('subdistrict-heads.index') }}"
                    class="button btn-second text-white" type="reset">Batal
                    Tambah</a>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        previewImg('create-tte-input', 'create-tte-preview-img')
    </script>
@endpush
