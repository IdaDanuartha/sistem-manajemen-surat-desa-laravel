@extends('layouts.main')
@section('title', 'Tambah Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.tree-felling.store') }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
			@csrf
			@if (auth()->user()->isCitizent())
				<input type="hidden" name="sk[citizent_id]" value="{{ auth()->user()->authenticatable->id }}">
			@else
				<div class="col-span-12 md:col-span-6 flex flex-col">
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
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                {{-- <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" value="{{ $reference_number }}"
                    placeholder="Masukkan Nomor Surat..." required readonly /> --}}
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="cover_letter_number" class="text-second mb-1">Nomor SP Kaling</label>
                {{-- <input type="text" class="input-crud" name="sk[cover_letter_number]" id="cover_letter_number" value="{{ $cover_letter_number }}"
                    placeholder="Masukkan Nomor SP Kaling..." required readonly /> --}}
                <input type="text" class="input-crud" name="sk[cover_letter_number]" id="cover_letter_number"
                    placeholder="Masukkan Nomor SP Kaling..." required />
                @error('cover_letter_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 {{ auth()->user()->isCitizent() ? "" : "md:col-span-6" }} flex flex-col">
                <label for="regarding" class="text-second mb-2">Perihal</label>
				<input type="text" class="input-crud" name="regarding" id="regarding" value="{{ old('regarding') }}"
				placeholder="Masukkan Perihal Surat..." required />
                @error('regarding')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 flex flex-col">
                <label for="description" class="text-second mb-2">Lokasi</label>
				<input type="text" class="input-crud" name="description" id="description" value="{{ old('description') }}"
				placeholder="Masukkan Lokasi..." required />
                @error('description')
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
					<a href="{{ route('letters.tree-felling.index') }}" class="button btn-second text-white" type="reset">Batal Tambah</a>
				</div>
			</div>
		</form>
	</div>
@endsection

@push('js')
	<script>
		let citizent = $(".citizent-select2").select2()
		// let description = new RichTextEditor("#description");
	</script>
@endpush