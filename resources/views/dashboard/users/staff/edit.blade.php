@extends('layouts.main')
@section('title', 'Edit Pengguna')
@section('main')

    <div class="table-wrapper mt-[20px] input-teacher">
        <form
            action="{{ route('citizents.update', $citizent->id) }}"
            method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
            @csrf
            @method('PUT')
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" name="name" id="name" value="{{ $citizent->name }}"
                    placeholder="Masukkan Nama..." required />
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="national_identify_number" class="text-second mb-1">NIK</label>
                <input type="number" class="input-crud" placeholder="Masukkan Nomor Induk Kependudukan Warga..." required
                    id="national_identify_number" name="national_identify_number"
                    value="{{ $citizent->national_identify_number }}">
                @error('national_identify_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="family_card_number" class="text-second mb-1">Nomor KK</label>
                <input type="number" class="input-crud" placeholder="Masukkan Nomor Kartu Keluarga Warga..." required
                    id="family_card_number" name="family_card_number" value="{{ $citizent->family_card_number }}">
                @error('family_card_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="phone_number" class="text-second mb-1">Nomor Telepon</label>
                <input type="number" class="input-crud" placeholder="Masukkan Nomor Telepon Warga..." required
                    id="phone_number" name="phone_number" value="{{ $citizent->phone_number }}">
                @error('phone_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="birth_place" class="text-second mb-1">Tempat Lahir</label>
                <input type="text" class="input-crud" required id="birth_place" name="birth_place"
                    placeholder="Masukkan Tempat Lahir Warga" value="{{ $citizent->birth_place }}">
                @error('birth_place')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="birth_date" class="text-second mb-1">Tanggal Lahir</label>
                <input type="date" class="input-crud" required id="birth_date" name="birth_date"
                    value="{{ $citizent->birth_date->format('Y-m-d') }}">
                @error('birth_date')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="citizenship" class="text-second mb-1">Kewarganegaraan</label>
                <input type="text" class="input-crud" required id="citizenship" name="citizenship"
                    value="{{ $citizent->citizenship }}">
                @error('citizenship')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="work" class="text-second mb-1">Pekerjaan</label>
                <input type="text" class="input-crud" required id="work" name="work"
                    value="{{ $citizent->work }}">
                @error('work')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="address" class="text-second mb-1">Alamat</label>
                <input type="text" class="input-crud" required id="address" name="address"
                    value="{{ $citizent->address }}">
                @error('address')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="gender" class="text-second mb-2">Jenis Kelamin</label>
                <select required class="gender-select2 input-crud" name="gender">
                    @foreach (App\Enums\Gender::labels() as $key => $value)
                        <option value="{{ $key + 1 }}" class="capitalize" @selected($citizent->gender->value == $key + 1)>
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
                        <option value="{{ $key + 1 }}" class="capitalize" @selected($citizent->blood_group->value == $key + 1)>
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
                        <option value="{{ $key + 1 }}" class="capitalize" @selected($citizent->religion->value == $key + 1)>
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
                        <option value="{{ $key + 1 }}" class="capitalize" @selected($citizent->marital_status->value == $key + 1)>
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
                    placeholder="Masukkan Email..."
                    value="{{ $citizent->user->email }}"
                    required>
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
                    <input type="checkbox" name="user[status]" @checked($citizent->user->status->value == 1 ? 'on' : '')>
                    <span class="slider round"></span>
                </label>

                @error('user.status')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            {{-- <div class="col-span-12 flex flex-col">
				<label for="profile_image" class="text-second mb-1">Foto Profil</label>
				<label for="profile_image" class="d-block mb-3">
					@if ($citizent->user->profile_image)
						<img src="{{ asset('uploads/users/' . $citizent->user->profile_image) }}" class="edit-citizent-preview-img border" width="300" alt="">
					@else
						<img src="{{ asset('assets/img/upload-image.jpg') }}" class="edit-citizent-preview-img border" width="300" alt="">
					@endif
				</label>
				<input
					type="file"
					id="profile_image"
					name="user[profile_image]"
					class="input-crud py-0 edit-citizent-input hidden"
					/>
				<label for="profile_image" class="button btn-second text-center w-[300px]">Upload File</label>
				@error('user.profile_image')
					<div class="text-danger mt-1">{{ $message }}</div>
				@enderror
			</div> --}}
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Edit Pengguna</button>
                <a href="{{ route('citizents.index') }}"
                    class="button btn-second text-white" type="reset">Batal Edit</a>
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
        previewImg("edit-citizent-input", "edit-citizent-preview-img")
    </script>
@endpush
