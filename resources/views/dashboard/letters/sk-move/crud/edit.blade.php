@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sk-move.update', $get_letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
			@csrf
			@method('PUT')			
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" readonly id="reference_number" value="{{ $get_letter->sk->reference_number }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="cover_letter_number" class="text-second mb-1">Nomor SP Kaling</label>
                <input type="text" class="input-crud" name="sk[cover_letter_number]" readonly id="cover_letter_number" value="{{ $get_letter->sk->cover_letter_number }}"
                    placeholder="Masukkan Nomor SP Kaling..." required />
                @error('cover_letter_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="citizent_id" class="text-second mb-2">Kepala Keluarga</label>
                <select name="citizent_id" id="citizent_id" class="citizent-select2">
					<option value="">Cari kepala keluarga</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}" @selected($item->id === $get_letter->citizent_id)>{{ "$item->name - $item->national_identify_number" }}</option>
					@endforeach
				</select>
                @error('citizent_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="sk_move_type" class="text-second mb-2">Jenis</label>
                <select name="sk_move_type" id="sk_move_type" class="type-select2">
					<option value="">Pilih Jenis Surat</option>
					@foreach (\App\Enums\SkMoveType::labels() as $key => $item)
						<option value="{{ $key+1 }}" @selected($key+1 === $get_letter->sk_move_type->value)>{{ $item }}</option>
					@endforeach
				</select>
                @error('sk_move_type')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reason" class="text-second mb-2">Alasan Pindah</label>
                <input type="text" class="input-crud" name="reason" placeholder="Masukkan Alasan Pindah..." required id="reason" value="{{ $get_letter->reason }}" />
                @error('reason')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="moving_address" class="text-second mb-2">Alamat Pindah</label>
                <input type="text" class="input-crud" name="moving_address" placeholder="Masukkan Alamat Pindah..." required id="moving_address" value="{{ $get_letter->moving_address }}" />
                @error('moving_address')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-8 flex mt-5 flex-col moving-family-group">
				<div class="flex items-center mb-2">
					<label for="sk_move_family_citizent_id" class="text-second">Keluarga Yang Pindah</label>
					<button type="button" class="ml-1 btn-add-family">
						<i class='bx bx-plus'></i>
					</button>
				</div>
				@foreach ($get_letter->families as $family)
					<select class="moving-family-select2 moving-family" name="family_citizent_id[]">
						<option value="">Cari keluarga yang pindah</option>
						@foreach ($citizents as $item)
							<option value="{{ $item->id }}" @selected($family->citizent_id === $item->id)>{{ "$item->name - $item->national_identify_number" }}</option>
						@endforeach
					</select>
					<br>
				@endforeach
            </div>
			<div class="col-span-12 md:col-span-4 flex mt-5 flex-col relationship-status-group">
                <label for="relationship_status" class="text-second mb-2">Status Hubungan</label>
				@foreach ($get_letter->families as $family)
					<select class="relationship-status-select2 relationship-status" name="family_relationship_status[]">
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
				<a href="{{ route('letters.sk-move.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
			</div>
		</form>
	</div>
@endsection

@push('js')
<script>
	let citizent = $(".citizent-select2").select2()
	let type = $(".type-select2").select2()
	let moving_family = $(".moving-family-select2").select2()
	let relationship_status = $(".relationship-status-select2").select2()

	$(".btn-add-family").click(function() {
		$(".moving-family-group").append(`			
			<select class="moving-family2-select2 moving-family" name="family_citizent_id[]">
				<option value="">Cari keluarga yang pindah</option>
				@foreach ($citizents as $item)
					<option value="{{ $item->id }}">{{ "$item->name - $item->national_identify_number" }}</option>
				@endforeach
			</select>
			<br>
		`)

		let moving_family2 = $(".moving-family2-select2").select2()

		$(".relationship-status-group").append(`			
			<select class="relationship-status2-select2 relationship-status" name="family_relationship_status[]">
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
