@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sktu.update', $get_letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
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
                <label for="cover_letter_number" class="text-second mb-1">Nomor SP Kaling</label>
                <input type="text" class="input-crud" name="sk[cover_letter_number]" id="cover_letter_number" value="{{ $get_letter->sk->cover_letter_number }}"
                    placeholder="Masukkan Nomor SP Kaling..." required />
                @error('sk.cover_letter_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 flex flex-col">
                <label for="business_name" class="text-second mb-2">Nama Usaha</label>
                <input type="text" class="input-crud" name="business_name" id="business_name" value="{{ $get_letter->business_name }}"
                    placeholder="Masukkan Nama Usaha..." required />
				@error('business_name')
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
				<a href="{{ route('letters.sktu.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
			</div>
		</form>
	</div>
@endsection

@push('js')
<script>
	let status = $(".status-select2").select2()
</script>
@endpush
