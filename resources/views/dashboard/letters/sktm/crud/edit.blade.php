@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sktm.update', $get_letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
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
			<div class="col-span-12 md:col-span-6 flex-col {{ $get_letter->sktm_type->value === 2 ? "flex" : "hidden" }}">
                <label for="school_name" class="text-second mb-1">Nama Sekolah</label>
                <input type="text" class="input-crud" name="school_name" id="school_name" value="{{ $get_letter->sktmSchool?->school_name }}"
                    placeholder="Masukkan nama sekolah..." />
                @error('school_name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 {{ $get_letter->sktm_type->value === 2 ? "" : "md:col-span-6" }} input-purpose flex-col flex">
                <label for="purpose" class="text-second mb-1">Tujuan Surat</label>
                <input type="text" class="input-crud" name="purpose" id="purpose" value="{{ $get_letter->purpose }}"
                    placeholder="Masukkan tujuan surat..." />
                @error('purpose')
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
					<a href="{{ route('letters.sktm.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
				</div>
			@endif
		</form>
	</div>
@endsection
