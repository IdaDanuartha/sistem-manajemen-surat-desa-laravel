@extends('layouts.main')
@section('title', 'Tambah Pengguna')
@section('main')

    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ Request::is("staff*") ? route('staff.store') : route('citizents.store') }}" method="post" enctype="multipart/form-data"
            class="grid grid-cols-12 gap-4">
            @csrf
            {{-- <input type="hidden" id="authenticatable_type" name="authenticatable_type" value="App\Models\Citizent"/> --}}
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" name="name" id="name" value="{{ old('name') }}"
                    placeholder="Masukkan Nama..." required />
                @error('name')
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
            <div class="col-span-12 {{ Request::is("staff*") ? "md:col-span-6" : "" }} flex flex-col">
                <label for="password" class="text-second mb-1">Password</label>
                <input type="password" class="input-crud" id="password" name="user[password]"
                    placeholder="Masukkan Password..." required>
                @error('user.password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            @if (Request::is('staff*'))
                <div class="col-span-12 md:col-span-6 flex flex-col">
                    <label for="role" class="text-second mb-2">Role</label>
                    <select required class="marital-status-select2 input-crud" name="user[role]">
                        @foreach (App\Enums\Role::labels() as $key => $value)
                            <option value="{{ $key }}" class="capitalize" @selected(old('role') == $key)>
                                {{ $value }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            @else
                <input type="hidden" name="user[role]" value="5">
            @endif
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
                <label for="profile_image" class="text-second mb-1">Foto Profil</label>
                <label for="profile_image" class="d-block mb-3">
                    <img src="{{ asset('assets/img/upload-image.jpg') }}" class="create-citizent-preview-img border"
                        width="300" alt="">
                </label>
                <input type="file" id="profile_image" name="user[profile_image]"
                    class="input-crud py-0 create-citizent-input hidden" />
                <label for="profile_image" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('user.profile_image')
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
        $('.gender-select2').select2();
        $('.blood-group-select2').select2();
        $('.religion-select2').select2();
        $('.marital-status-select2').select2();
        previewImg("create-citizent-input", "create-citizent-preview-img")
    </script>
@endpush
