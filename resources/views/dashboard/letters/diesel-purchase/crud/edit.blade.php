@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.diesel-purchase.update', $get_letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
			@csrf
			@method('PUT')			
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" readonly id="reference_number" value="{{ $get_letter->sk->reference_number }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('sk.reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="cover_letter_number" class="text-second mb-1">Nomor SP Kaling</label>
                <input type="text" class="input-crud" name="sk[cover_letter_number]" readonly id="cover_letter_number" value="{{ $get_letter->sk->cover_letter_number }}"
                    placeholder="Masukkan Nomor SP Kaling..." required />
                @error('sk.cover_letter_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="business_address" class="text-second mb-1">Alamat Usaha</label>
                <input type="text" class="input-crud" name="business_address" id="business_address" value="{{ $get_letter->business_address }}"
                    placeholder="Masukkan Alamat Usaha..." required />
                @error('business_address')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="purpose" class="text-second mb-1">Keperluan BBM</label>
                <input type="text" class="input-crud" name="purpose" id="purpose" value="{{ $get_letter->purpose }}"
                    placeholder="Masukkan Keperluan BBM..." required />
                @error('purpose')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="requirement" class="text-second mb-1">Kebutuhan BBM</label>
                <input type="text" class="input-crud" name="requirement" id="requirement" value="{{ $get_letter->requirement }}"
                    placeholder="Masukkan Kebutuhan BBM..." required />
                @error('requirement')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="purchase_place" class="text-second mb-1">Tempat Pembelian BBM</label>
				<input type="text" class="input-crud" name="purchase_place" id="purchase_place" value="{{ $get_letter->purchase_place }}"
					placeholder="Masukkan Tujuan Pembelian BBM..." required />
				@error('purchase_place')
					<div class="text-danger mt-1">{{ $message }}</div>
				@enderror
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="start_expired_date" class="text-second mb-1">Masa Berlaku Mulai</label>
                <input type="date" class="input-crud" name="start_expired_date" id="start_expired_date" value="{{ $get_letter->start_expired_date->format("Y-m-d") }}"
                    required />
                @error('start_expired->format("Y-m-d")')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="end_expired_date" class="text-second mb-1">Masa Berlaku Selesai</label>
                <input type="date" class="input-crud" name="end_expired_date" id="end_expired_date" value="{{ $get_letter->end_expired_date->format("Y-m-d") }}"
				required />
                @error('end_expired_date')
				<div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 flex flex-col">
				<p class="text-second mb-1">Kirim Surat</p>
				<label class="switch">
					<input type="checkbox" name="sk[is_published]" @checked($get_letter->sk->is_published ? 'on' : '')>
					<span class="slider round"></span>
				</label>
			</div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Edit Surat</button>
                <a href="{{ route('letters.diesel-purchase.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
            </div>
		</form>
	</div>
@endsection