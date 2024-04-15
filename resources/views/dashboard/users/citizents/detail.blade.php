@extends('layouts.main')
@section('title', 'Detail Pengguna')
@section('main')
	<div class="table-wrapper mt-[20px] input-teacher">
		<form class="grid grid-cols-12 gap-4">						
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="nama" class="text-second mb-1">Nama</label>
				<input
					type="text"
				 	class="input-crud"
					value="{{ $citizent->name }}"
					disabled
				/>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="environmental_id" class="text-second mb-1">Lingkungan</label>
				<input
					type="text"
				 	class="input-crud"
					value="{{ $citizent->environmental ? ($citizent->environmental->name . " (" . $citizent->environmental->code . ")") : "-" }}"
					disabled
				/>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="national_identify_number" class="text-second mb-1">NIK</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $citizent->national_identify_number }}"
					disabled
				>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="family_card_number" class="text-second mb-1">Nomor KK</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $citizent->family_card_number }}"
					disabled
				>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="phone_number" class="text-second mb-1">Nomor Telepon</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $citizent->phone_number }}"
					disabled
				>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="birth_place" class="text-second mb-1">Tempat Lahir</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $citizent->birth_place }}"
					disabled
				>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="birth_date" class="text-second mb-1">Tanggal Lahir</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $citizent->birth_date->format('d M Y') }}"
					disabled
				>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="birth_date" class="text-second mb-1">Kewarganegaraan</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $citizent->citizenship }}"
					disabled
				>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="birth_date" class="text-second mb-1">Pekerjaan</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $citizent->work }}"
					disabled
				>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="birth_date" class="text-second mb-1">Alamat</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $citizent->address }}"
					disabled
				>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="gender" class="text-second mb-2">Jenis Kelamin</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $citizent->gender->label() }}"
					disabled
				>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="blood_group" class="text-second mb-2">Golongan Darah</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $citizent->blood_group->label() }}"
					disabled
				>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="religion" class="text-second mb-2">Agama</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $citizent->religion->label() }}"
					disabled
				>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="marital_status" class="text-second mb-2">Status Pernikahan</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $citizent->marital_status->label() }}"
					disabled
				>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="email" class="text-second mb-1">Email</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $citizent->user->email }}"
					disabled
				>
			</div>
			<div class="col-span-12 flex flex-col">
				<p class="text-second mb-1">Status Akun</p>
				<label class="switch">
					<input type="checkbox" disabled @checked($citizent->user->status->value == 1 ? 'on' : '')>
					<span class="slider round"></span>
				</label>
			</div>
			@if ($citizent->user->signature_image)
				<div class="col-span-12 flex flex-col">
					<label for="signature_image" class="text-second mb-1">Foto TTE</label>
					<label for="signature_image" class="d-block mb-3">
						<img src="{{ asset('uploads/users/signatures/' . $citizent->user->signature_image) }}" class="border"
							width="300" alt="">
					</label>
				</div>
			@endif
			@if ($citizent->id_card_file)
				<div class="col-span-12 flex flex-col">
					<label for="id_card_file" class="text-second mb-1">Foto Kartu Tanda Penduduk</label>
					<label for="id_card_file" class="d-block mb-3">
						<img src="{{ asset('uploads/users/id_cards/' . $citizent->id_card_file) }}" class="border"
							width="300" alt="">
					</label>
				</div>
			@endif
			@if ($citizent->family_card_file)
				<div class="col-span-12 flex flex-col">
					<label for="family_card_file" class="text-second mb-1">Foto Kartu Keluarga</label>
					<label for="family_card_file" class="d-block mb-3">
						<img src="{{ asset('uploads/users/family_cards/' . $citizent->family_card_file) }}" class="border"
							width="300" alt="">
					</label>
				</div>
			@endif
			@if ($citizent->birth_certificate_file)
				<div class="col-span-12 flex flex-col">
					<label for="birth_certificate_file" class="text-second mb-1">Foto Akta Kelahiran</label>
					<label for="birth_certificate_file" class="d-block mb-3">
						<img src="{{ asset('uploads/users/birth_certificates/' . $citizent->birth_certificate_file) }}" class="border"
							width="300" alt="">
					</label>
				</div>
			@endif
			@if ($citizent->marriage_certificate_file)
				<div class="col-span-12 flex flex-col">
					<label for="marriage_certificate_file" class="text-second mb-1">Foto Kartu Nikah</label>
					<label for="marriage_certificate_file" class="d-block mb-3">
						<img src="{{ asset('uploads/users/marriage_certificates/' . $citizent->marriage_certificate_file) }}" class="border"
							width="300" alt="">
					</label>
				</div>
			@endif
			@if ($citizent->land_certificate_file)
				<div class="col-span-12 flex flex-col">
					<label for="land_certificate_file" class="text-second mb-1">Foto Akta Tanah</label>
					<label for="land_certificate_file" class="d-block mb-3">
						<img src="{{ asset('uploads/users/land_certificates/' . $citizent->land_certificate_file) }}" class="border"
							width="300" alt="">
					</label>
				</div>
			@endif
			<div class="col-span-12 flex items-center gap-3 mt-2">				
				<a href="{{ route('citizents.index') }}" class="button btn-second text-white" type="reset">Kembali</a>
			</div>
		</form>
	</div>
@endsection
