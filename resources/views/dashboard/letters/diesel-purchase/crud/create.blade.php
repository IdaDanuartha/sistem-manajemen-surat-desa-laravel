@extends('layouts.main')
@section('title', 'Tambah Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.diesel-purchase.store') }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
			@csrf
            @if (auth()->user()->isCitizent())
                <input type="hidden" name="sk[citizent_id]" value="{{ auth()->user()->authenticatable->id }}">
            @else
                <div class="col-span-12 flex flex-col">
                    <label for="citizent_id" class="text-second mb-2">Nama Pembuat Surat</label>
                    <select name="sk[citizent_id]" id="citizent_id" class="citizent-select2">
                        <option value="">Cari nama warga</option>
                        @foreach ($citizents as $item)
                            <option value="{{ $item->id }}">{{ "$item->name - $item->national_identify_number" }}</option>
                        @endforeach
                    </select>
                    @error('sk.citizent_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            @endif
			<div class="col-span-12 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" value="{{ old('sk.reference_number') }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="business_address" class="text-second mb-1">Alamat Usaha</label>
                <input type="text" class="input-crud" name="business_address" id="business_address" value="{{ old('business_address') }}"
                    placeholder="Masukkan Alamat Usaha..." required />
                @error('business_address')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="purpose" class="text-second mb-1">Keperluan BBM</label>
                <input type="text" class="input-crud" name="purpose" id="purpose" value="{{ old('purpose') }}"
                    placeholder="Masukkan Keperluan BBM..." required />
                @error('purpose')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="requirement" class="text-second mb-1">Kebutuhan BBM</label>
                <input type="text" class="input-crud" name="requirement" id="requirement" value="{{ old('requirement') }}"
                    placeholder="Masukkan Kebutuhan BBM..." required />
                @error('requirement')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="purchase_place" class="text-second mb-1">Tempat Pembelian BBM</label>
				<input type="text" class="input-crud" name="purchase_place" id="purchase_place" value="{{ old('purchase_place') }}"
					placeholder="Masukkan Tujuan Pembelian BBM..." required />
				@error('purchase_place')
					<div class="text-danger mt-1">{{ $message }}</div>
				@enderror
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="start_expired_date" class="text-second mb-1">Masa Berlaku Mulai</label>
                <input type="date" class="input-crud" name="start_expired_date" id="start_expired_date" value="{{ old('start_expired_date') }}"
                    required />
                @error('start_expired_date')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="end_expired_date" class="text-second mb-1">Masa Berlaku Selesai</label>
                <input type="date" class="input-crud" name="end_expired_date" id="end_expired_date" value="{{ old('end_expired_date') }}"
				required />
                @error('end_expired_date')
				<div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			{{-- <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="description" class="text-second mb-1">Keterangan</label>
                <input type="text" class="input-crud" name="description" id="description" value="{{ old('description') }}"
                    placeholder="Masukkan Keterangan..." required />
                @error('description')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div> --}}
			<div class="col-span-12 flex flex-col">
				<p class="text-second mb-1">Kirim Surat?</p>
                <label class="switch">
                    <input type="checkbox" name="sk[is_published]">
                    <span class="slider round"></span>
                </label>
			</div>
			<div class="flex col-span-12 justify-between mt-2">
				<div class="flex items-center gap-3">
					<button class="button btn-main" type="submit">Tambah Surat</button>
					<a href="{{ route('letters.diesel-purchase.index') }}" class="button btn-second text-white" type="reset">Batal Tambah</a>
				</div>
			</div>
		</form>
	</div>
@endsection

@push('js')
	<script>
		let citizent = $(".citizent-select2").select2()
	</script>
@endpush