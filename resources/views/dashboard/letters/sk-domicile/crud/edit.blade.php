@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sk-domicile.update', $get_letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
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
                <label for="citizent_id" class="text-second mb-2">Nama</label>
                <select name="citizent_id" id="citizent_id" class="citizent-select2">
					<option value="">Cari nama</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}" @selected($item->id === $get_letter->citizent_id)>{{ "$item->name - $item->national_identify_number" }}</option>
					@endforeach
				</select>
                @error('citizent_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="community_group" class="text-second mb-1">Kelompok Masyarakat</label>
                <input type="text" class="input-crud" name="community_group" id="community_group" value="{{ $get_letter->community_group }}"
                    placeholder="Masukkan nama kelompok masyarakat" required />
                @error('community_group')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="position" class="text-second mb-1">Jabatan</label>
                <input type="text" class="input-crud" name="position" id="position" value="{{ $get_letter->position }}"
                    placeholder="Masukkan jabatan" required />
                @error('position')
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
				<a href="{{ route('letters.sk-domicile.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
			</div>
		</form>
	</div>
@endsection

@push('js')
	<script>
		let citizent = $(".citizent-select2").select2()
	</script>
@endpush