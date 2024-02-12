@extends('layouts.main')
@section('title', 'Tambah Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sk-name.store') }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="sk[citizent_id]" value="{{ auth()->user()->authenticatable->id }}">
			<div class="col-span-12 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" value="{{ old('sk.reference_number') }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="national_identify_number_other" class="text-second mb-1">NIK</label>
                <input type="text" class="input-crud" name="national_identify_number_other" id="national_identify_number_other" value="{{ old('national_identify_number_other') }}"
                    placeholder="Masukkan NIK yang berbeda..." required />
                @error('national_identify_number_other')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="national_identify_number_listed" class="text-second mb-1">Tempat NIK Tercantum</label>
                <input type="text" class="input-crud" name="national_identify_number_listed" id="national_identify_number_listed" value="{{ old('national_identify_number_listed') }}"
                    placeholder="Masukkan Tempat NIK Tercantum..." required />
                @error('national_identify_number_listed')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
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
					<a href="{{ route('letters.sk-name.index') }}" class="button btn-second text-white" type="reset">Batal Tambah</a>
				</div>
			</div>
		</form>
	</div>
@endsection

@push('js')
	<script>
		let status = $(".status-select2").select2()
	</script>
@endpush