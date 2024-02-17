@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sk-power-attorney.update', $get_letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
			@csrf
			@method('PUT')			
			<div class="col-span-12 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" readonly value="{{ $get_letter->sk->reference_number }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('sk.reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="citizent_id" class="text-second mb-2">Pewaris</label>
                <select name="citizent_id" id="citizent_id" class="citizent-select2">
					<option value="">Cari pewaris</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}" @selected($item->id === $get_letter->citizent_id)>{{ "$item->name - $item->national_identify_number" }}</option>
					@endforeach
				</select>
                @error('citizent_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="date_of_death" class="text-second mb-1">Tanggal Meninggal</label>
                <input type="date" class="input-crud" name="date_of_death" id="date_of_death" value="{{ $get_letter->date_of_death->format("Y-m-d") }}"
                    placeholder="Masukkan Tanggal Meninggal..." required />
                @error('date_of_death')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="md:col-span-8 col-span-6 flex mt-5 flex-col heir-group">
				<div class="flex items-center mb-2">
					<label for="power_attorney_family" class="text-second">Ahli Waris</label>
					<button type="button" class="ml-1 btn-add-family">
						<i class='bx bx-plus'></i>
					</button>
				</div>
                @foreach ($get_letter->families as $family)
					<select class="heir-select2 heir" name="power_attorney_family[]" required>
						<option value="">Cari keluarga</option>
						@foreach ($citizents as $item)
							<option value="{{ $item->id }}" @selected($family->citizent_id === $item->id)>{{ "$item->name - $item->national_identify_number" }}</option>
						@endforeach
					</select>
					<br>
				@endforeach
            </div>
			<div class="md:col-span-4 col-span-6 flex mt-5 flex-col relationship-status-group">
                <label for="relationship_status" class="text-second mb-2">Status Hubungan</label>

				@foreach ($get_letter->families as $family)
					<select class="relationship-status-select2 relationship-status" name="power_attorney_relationship_status[]" required>
						<option value="">Pilih status hubungan</option>
						@foreach (\App\Enums\RelationshipStatus2::labels() as $key => $item)
							<option value="{{ $key+1 }}" @selected($family->relationship_status->value === $key+1)>{{ $item }}</option>
						@endforeach
					</select>
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
				<a href="{{ route('letters.sk-power-attorney.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
			</div>
		</form>
	</div>
@endsection

@push('js')
<script>
	let citizent = $(".citizent-select2").select2()

	let moving_family = $(".heir-select2").select2()
		let relationship_status = $(".relationship-status-select2").select2()

		$(".btn-add-family").click(function() {
			$(".heir-group").append(`				
                <select class="heir2-select2 heir" name="power_attorney_family[]">
					<option value="">Cari keluarga yang pindah</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}">{{ "$item->name - $item->national_identify_number" }}</option>
					@endforeach
				</select>
				<br>
			`)

			let moving_family2 = $(".heir2-select2").select2()

			$(".relationship-status-group").append(`				
				<select class="relationship-status2-select2 relationship-status" name="power_attorney_relationship_status[]">
					<option value="">Pilih status hubungan</option>
					@foreach (\App\Enums\RelationshipStatus2::labels() as $key => $item)
						<option value="{{ $key+1 }}">{{ $item }}</option>
					@endforeach
				</select>
				<br>
			`)
			
			let relationship_status2 = $(".relationship-status2-select2").select2()
		})
</script>
@endpush
