@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sk-inheritance-distribution.update', $get_letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
			@csrf
			@method('PUT')			
			{{-- <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" value="{{ $get_letter->sk->reference_number }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('sk.reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div> --}}
			{{-- <div class="col-span-12 flex flex-col">
                <label for="citizent_id" class="text-second mb-2">Penerima Kuasa</label>
                <select name="citizent_id" id="citizent_id" class="citizent-select2">
					<option value="">Cari nama penerima kuasa</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}" @selected($item->id === $get_letter->citizent_id)>{{ "$item->name -  $item->national_identify_number" }}</option>
					@endforeach
				</select>
				@error('citizent_id')
					<div class="text-danger mt-1">{{ $message }}</div>
				@enderror
            </div> --}}
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="certificate_number" class="text-second mb-2">Nomor Sertifikat Hak Milik</label>
                <input type="number" class="input-crud" name="certificate_number" id="certificate_number" value="{{ $get_letter->certificate_number }}"
                    placeholder="Masukkan nomor sertifikat..." required />
                @error('certificate_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="surface_area" class="text-second mb-1">Luas Tanah (m2)</label>
                <input type="number" class="input-crud" name="surface_area" id="surface_area" value="{{ $get_letter->surface_area }}"
                    placeholder="Masukkan luas tanah..." required />
                @error('surface_area')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col heir-group">
				<div class="flex items-center mb-2">
					<label for="inheritance_distribution_family" class="text-second">Ahli Waris</label>
					<button type="button" class="ml-1 btn-add-family">
						<i class='bx bx-plus'></i>
					</button>
				</div>
                @foreach ($get_letter->families as $family)
					<select class="heir-select2 heir" name="inheritance_distribution_family[]" required>
						<option value="">Cari keluarga</option>
						@foreach ($citizents as $item)
							<option value="{{ $item->id }}" @selected($family->citizent_id === $item->id)>{{ "$item->name - $item->national_identify_number" }}</option>
						@endforeach
					</select>
					<br>
				@endforeach
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col relationship-status-group">
                <label for="inheritance_distribution_area" class="text-second mb-1">Pembagian Tanah</label>
				@foreach ($get_letter->families as $family)
					<input type="number" class="input-crud" name="inheritance_distribution_area[]" id="inheritance_distribution_area" value="{{ $family->area }}"
                    	placeholder="Masukkan luas tanah..." required />
					<br>
				@endforeach
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
				<a href="{{ route('letters.sk-inheritance-distribution.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
			</div>
		</form>
	</div>
@endsection

@push('js')
<script>
	let citizent_id = $(".citizent-select2").select2()
	let moving_family = $(".heir-select2").select2()
	let relationship_status = $(".relationship-status-select2").select2()

	$(".btn-add-family").click(function() {
		$(".heir-group").append(`				
			<select class="heir2-select2 heir" name="inheritance_distribution_family[]">
				<option value="">Cari keluarga yang pindah</option>
				@foreach ($citizents as $item)
					<option value="{{ $item->id }}">{{ "$item->name - $item->national_identify_number" }}</option>
				@endforeach
			</select>
			<br>
		`)

		let moving_family2 = $(".heir2-select2").select2()

		$(".relationship-status-group").append(`				
			<input type="number" class="input-crud" name="inheritance_distribution_area[]" id="inheritance_distribution_area" value="{{ old('inheritance_distribution_area') }}"
				placeholder="Masukkan luas tanah..." required />
			<br>
		`)
		
		let relationship_status2 = $(".relationship-status2-select2").select2()
	})
</script>
@endpush
