@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.parental-permission.update', $get_letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
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
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="citizent_id" class="text-second mb-2">Nama Keluarga</label>
                <select name="citizent_id" id="citizent_id" class="citizent-select2">
					<option value="">Cari Nama Keluarga</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}" @selected($item->id === $get_letter->citizent_id)>{{ "$item->name - $item->national_identify_number" }}</option>
					@endforeach
				</select>
                @error('citizent_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="relationship_status" class="text-second mb-2">Status Hubungan</label>
                <select name="relationship_status" id="relationship_status" class="relationship-status-select2">
					<option value="">Pilih Status</option>
					@foreach (\App\Enums\RelationshipStatus::labels() as $key => $item)
						<option value="{{ $key+1 }}" @selected($key+1 === $get_letter->relationship_status->value)>{{ $item }}</option>
					@endforeach
				</select>
                @error('relationship_status')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 flex flex-col">
                <label for="description" class="text-second mb-1">Tujuan Izin</label>
                <input type="text" class="input-crud" name="description" id="description" value="{{ $get_letter->description }}"
                    placeholder="Masukkan Tujuan Izin..." required />
                @error('description')
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
				<a href="{{ route('letters.parental-permission.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
			</div>
		</form>
	</div>
@endsection

@push('js')
<script>
	let citizent = $(".citizent-select2").select2()
	let relationship_status = $(".relationship-status-select2").select2()
</script>
@endpush
