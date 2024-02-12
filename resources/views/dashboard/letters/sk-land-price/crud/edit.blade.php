@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sk-land-price.update', $get_letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
			@csrf
			@method('PUT')			
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" value="{{ $get_letter->sk->reference_number }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('sk.reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="nop" class="text-second mb-1">Nomor Objek Pajak</label>
                <input type="text" class="input-crud" name="nop" id="nop" value="{{ $get_letter->nop }}"
                    placeholder="Masukkan Nomor Objek Pajak..." required />
                @error('nop')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="land_location" class="text-second mb-1">Lokasi Tanah</label>
                <input type="text" class="input-crud" name="land_location" id="land_location" value="{{ $get_letter->land_location }}"
                    placeholder="Masukkan Lokasi Tanah..." required />
                @error('land_location')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="price" class="text-second mb-1">Harga Tanah / are</label>
                <input type="number" class="input-crud" name="price" id="price" value="{{ $get_letter->price }}"
                    placeholder="Masukkan Harga Tanah Per are..." required />
                @error('price')
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
			@if (auth()->user()->isCitizent())
				<div class="col-span-12 flex items-center gap-3 mt-2">
					<button class="button btn-main" type="submit">Edit Surat</button>
					<a href="{{ route('letters.sk-land-price.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
				</div>
			@endif
		</form>
	</div>
@endsection

@push('js')
<script>
	let status = $(".status-select2").select2()
</script>
@endpush
