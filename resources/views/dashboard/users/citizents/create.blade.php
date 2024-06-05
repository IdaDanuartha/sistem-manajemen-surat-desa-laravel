@extends('layouts.main')
@section('title', 'Tambah Pengguna')
@section('main')

    <div class="table-wrapper mt-[20px] input-teacher">
        <div class="flex justify-end items-center gap-3">
            <div class="flex">
                <a href="{{ route('citizents.import') }}"
                    class="flex button btn-main duration-200 capitalize w-max items-center gap-1" type="button">
                    Import
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                        fill="none">
                        <g clip-path="url(#clip0_7909_670)">
                            <path
                                d="M5.59868 11.9841C5.51903 11.9548 5.43528 11.9331 5.36022 11.8945C5.09928 11.7602 4.94839 11.5457 4.91571 11.2524C4.9083 11.1868 4.90779 11.1201 4.90779 11.0542C4.90728 9.78863 4.90754 8.52301 4.90754 7.25714C4.90754 7.20735 4.90754 7.15756 4.90754 7.09041C4.84728 7.09041 4.79826 7.09041 4.74924 7.09041C3.46422 7.09041 2.17945 7.09093 0.894429 7.09016C0.474685 7.08991 0.16728 6.87901 0.0531524 6.51697C0.0449822 6.49118 0.034259 6.46437 0.034259 6.43782C0.0329824 6.14675 0.00591727 5.85237 0.040896 5.56565C0.0840449 5.2128 0.391705 4.95697 0.744811 4.92199C0.806598 4.91586 0.869151 4.91459 0.931449 4.91459C2.2009 4.91407 3.47009 4.91433 4.73954 4.91433C4.78932 4.91433 4.83937 4.91433 4.90754 4.91433C4.90754 4.8551 4.90754 4.80633 4.90754 4.75731C4.90754 3.47229 4.90856 2.18701 4.90677 0.901989C4.90626 0.542755 5.04592 0.267776 5.37145 0.10284C5.60966 -0.0176703 6.38098 -0.0189474 6.61894 0.100797C6.88422 0.234585 7.04124 0.450074 7.07519 0.748542C7.0826 0.814159 7.08362 0.880542 7.08362 0.94667C7.08413 2.21229 7.08388 3.4779 7.08388 4.74378C7.08388 4.79382 7.08388 4.84412 7.08388 4.91433C7.14107 4.91433 7.18983 4.91433 7.23834 4.91433C8.4843 4.91433 9.73051 4.92429 10.9762 4.90948C11.4657 4.90361 11.8394 5.07441 11.9766 5.60522C11.9766 5.86999 11.9766 6.13475 11.9766 6.39978C11.8384 6.93441 11.46 7.10088 10.9765 7.09552C9.73103 7.08122 8.48558 7.09067 7.24013 7.09067C7.19136 7.09067 7.1426 7.09067 7.08388 7.09067C7.08388 7.15961 7.08388 7.20939 7.08388 7.25944C7.08388 8.53629 7.0826 9.81314 7.0849 11.09C7.08541 11.3422 7.02158 11.5654 6.84081 11.7487C6.71596 11.8754 6.55741 11.9348 6.39298 11.9844C6.12847 11.9841 5.86371 11.9841 5.59868 11.9841Z"
                                fill="white" />
                        </g>
                        <defs>
                            <clipPath id="clip0_7909_670">
                                <rect width="12" height="12" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </a>
            </div>
        </div>
        <form action="{{ Request::is("staff*") ? route('staff.store') : route('citizents.store') }}" method="post" enctype="multipart/form-data"
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
                <label for="environmental_id" class="text-second mb-1">Lingkungan</label>
                <select required class="environmental-select2 input-crud" name="environmental_id">
                    @foreach ($environmentals as $environmental)
                        <option value="{{ $environmental->id }}" class="capitalize" @selected(old('environmental_id') == $environmental->id)>
                            {{ $environmental->name . " (" . $environmental->code . ")" }}</option>
                    @endforeach
                </select>
                @error('environmental_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="national_identify_number" class="text-second mb-1">NIK</label>
                <input type="number" class="input-crud" placeholder="Masukkan Nomor Induk Kependudukan Warga..." required
                    id="national_identify_number" name="national_identify_number"
                    value="{{ old('national_identify_number') }}">
                @error('national_identify_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="family_card_number" class="text-second mb-1">Nomor KK</label>
                <input type="number" class="input-crud" placeholder="Masukkan Nomor Kartu Keluarga Warga..." required
                    id="family_card_number" name="family_card_number" value="{{ old('family_card_number') }}">
                @error('family_card_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="phone_number" class="text-second mb-1">Nomor Telepon</label>
                <input type="number" class="input-crud" placeholder="Masukkan Nomor Telepon Warga..." required
                    id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                @error('phone_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="birth_place" class="text-second mb-1">Tempat Lahir</label>
                <input type="text" class="input-crud" required id="birth_place" name="birth_place"
                    placeholder="Masukkan Tempat Lahir Warga" value="{{ old('birth_place') }}">
                @error('birth_place')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="birth_date" class="text-second mb-1">Tanggal Lahir</label>
                <input type="date" class="input-crud" required id="birth_date" name="birth_date"
                    value="{{ old('birth_date') }}">
                @error('birth_date')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="citizenship" class="text-second mb-1">Kewarganegaraan</label>
                <input type="text" class="input-crud" id="citizenship" name="citizenshi"
                    placeholder="Masukkan kewarganegaraan..." value="{{ old('citizenship') ?? 'Indonesia' }}">
                @error('citizenship')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="work" class="text-second mb-1">Pekerjaan</label>
                <input type="text" class="input-crud" id="work" name="work" placeholder="Masukkan pekerjaan..."
                    value="{{ old('work') }}">
                @error('work')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="address" class="text-second mb-1">Alamat</label>
                <input type="text" class="input-crud" id="address" name="address"
                    placeholder="Masukkan alamat tinggal..." value="{{ old('address') }}">
                @error('address')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="gender" class="text-second mb-2">Jenis Kelamin</label>
                <select required class="gender-select2 input-crud" name="gender">
                    @foreach (App\Enums\Gender::labels() as $key => $value)
                        <option value="{{ $key + 1 }}" class="capitalize" @selected(old('gender') == $key + 1)>
                            {{ $value }}</option>
                    @endforeach
                </select>
                @error('gender')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="blood_group" class="text-second mb-2">Golongan Darah</label>
                <select required class="blood-group-select2 input-crud" name="blood_group">
                    @foreach (App\Enums\BloodGroup::labels() as $key => $value)
                        <option value="{{ $key + 1 }}" class="capitalize" @selected(old('blood_group') == $key + 1)>
                            {{ $value }}</option>
                    @endforeach
                </select>
                @error('blood_group')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="religion" class="text-second mb-2">Agama</label>
                <select required class="religion-select2 input-crud" name="religion">
                    @foreach (App\Enums\Religion::labels() as $key => $value)
                        <option value="{{ $key + 1 }}" class="capitalize" @selected(old('religion') == $key + 1)>
                            {{ $value }}</option>
                    @endforeach
                </select>
                @error('religion')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="marital_status" class="text-second mb-2">Status Pernikahan</label>
                <select required class="marital-status-select2 input-crud" name="marital_status">
                    @foreach (App\Enums\MaritalStatus::labels() as $key => $value)
                        <option value="{{ $key + 1 }}" class="capitalize" @selected(old('marital_status') == $key + 1)>
                            {{ $value }}</option>
                    @endforeach
                </select>
                @error('marital_status')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="email" class="text-second mb-1">Email</label>
                <input type="email" class="input-crud" id="email" name="user[email]"
                    placeholder="Masukkan Email..." value="{{ old('user.email') }}" required>
                @error('user.email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="password" class="text-second mb-1">Password</label>
                <input type="password" class="input-crud" id="password" name="user[password]"
                    placeholder="Masukkan Password..." required>
                @error('user.password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <p class="text-second mb-1">Status Akun</p>
                <label class="switch">
                    <input type="checkbox" name="user[status]" checked>
                    <span class="slider round"></span>
                </label>

                @error('user.status')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="signature_image" class="text-second mb-1">Foto TTE</label>
                <label for="signature_image" class="d-block mb-3">
                    <img src="{{ asset('assets/img/upload-image.jpg') }}" class="create-tte-preview-img border"
                        width="300" alt="">
                </label>
                <input type="file" id="signature_image" name="user[signature_image]"
                    class="input-crud py-0 create-tte-input hidden" />
                <label for="signature_image" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('user.signature_image')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="id_card_file" class="text-second mb-1">Foto Kartu Tanda Penduduk</label>
                <label for="id_card_file" class="d-block mb-3">
                    <img src="{{ asset('assets/img/upload-image.jpg') }}" class="create-id-card-preview-img border"
                        width="300" alt="">
                </label>
                <input type="file" id="id_card_file" name="id_card_file"
                    class="input-crud py-0 create-id-card-input hidden" />
                <label for="id_card_file" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('id_card_file')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="family_card_file" class="text-second mb-1">Foto Kartu Keluarga</label>
                <label for="family_card_file" class="d-block mb-3">
                    <img src="{{ asset('assets/img/upload-image.jpg') }}" class="create-family-card-preview-img border"
                        width="300" alt="">
                </label>
                <input type="file" id="family_card_file" name="family_card_file"
                    class="input-crud py-0 create-family-card-input hidden" />
                <label for="family_card_file" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('family_card_file')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="birth_certificate_file" class="text-second mb-1">Foto Akta Kelahiran</label>
                <label for="birth_certificate_file" class="d-block mb-3">
                    <img src="{{ asset('assets/img/upload-image.jpg') }}" class="create-birth-certificate-preview-img border"
                        width="300" alt="">
                </label>
                <input type="file" id="birth_certificate_file" name="birth_certificate_file"
                    class="input-crud py-0 create-birth-certificate-input hidden" />
                <label for="birth_certificate_file" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('birth_certificate_file')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="marriage_certificate_file" class="text-second mb-1">Foto Kartu Nikah</label>
                <label for="marriage_certificate_file" class="d-block mb-3">
                    <img src="{{ asset('assets/img/upload-image.jpg') }}" class="create-marriage-certificate-preview-img border"
                        width="300" alt="">
                </label>
                <input type="file" id="marriage_certificate_file" name="marriage_certificate_file"
                    class="input-crud py-0 create-marriage-certificate-input hidden" />
                <label for="marriage_certificate_file" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('marriage_certificate_file')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="land_certificate_file" class="text-second mb-1">Foto Akta Tanah</label>
                <label for="land_certificate_file" class="d-block mb-3">
                    <img src="{{ asset('assets/img/upload-image.jpg') }}" class="create-land-certificate-preview-img border"
                        width="300" alt="">
                </label>
                <input type="file" id="land_certificate_file" name="land_certificate_file"
                    class="input-crud py-0 create-land-certificate-input hidden" />
                <label for="land_certificate_file" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('land_certificate_file')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Tambah Pengguna</button>
                <a href="{{ Request::is('staff*') ? route('staff.index') : route('citizents.index') }}"
                    class="button btn-second text-white" type="reset">Batal
                    Tambah</a>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        $('.environmental-select2').select2();
        $('.gender-select2').select2();
        $('.blood-group-select2').select2();
        $('.religion-select2').select2();
        $('.marital-status-select2').select2();
        $('.role-select2').select2();

        previewImg('create-tte-input', 'create-tte-preview-img')
        previewImg("create-id-card-input", "create-id-card-preview-img")
        previewImg("create-family-card-input", "create-family-card-preview-img")
        previewImg("create-birth-certificate-input", "create-birth-certificate-preview-img")
        previewImg("create-marriage-certificate-input", "create-marriage-certificate-preview-img")
        previewImg("create-land-certificate-input", "create-land-certificate-preview-img")
    </script>
@endpush
