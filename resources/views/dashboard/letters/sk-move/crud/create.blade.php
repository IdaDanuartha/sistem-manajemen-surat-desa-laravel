@extends('layouts.main')
@section('title', 'Tambah Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sk-move.store') }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="sk[citizent_id]" value="{{ auth()->user()->authenticatable->id }}">
		<input type="hidden" name="family_citizent_id" class="sk_move_family_citizent_input">
			<input type="hidden" name="family_relationship_status" class="sk_move_family_status_input">
			<div class="col-span-12 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" value="{{ old('sk.reference_number') }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="citizent_id" class="text-second mb-2">Kepala Keluarga</label>
                <select name="citizent_id" id="citizent_id" class="citizent-select2">
					<option value="">Cari kepala keluarga</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}">{{ $item->name }}</option>
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
						<option value="{{ $key+1 }}">{{ $item }}</option>
					@endforeach
				</select>
                @error('sk_move_type')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reason" class="text-second mb-2">Alasan Pindah</label>
                <input type="text" class="input-crud" name="reason" placeholder="Masukkan Alasan Pindah..." required id="reason" value="{{ old('reason') }}" />
                @error('reason')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="moving_address" class="text-second mb-2">Alamat Pindah</label>
                <input type="text" class="input-crud" name="moving_address" placeholder="Masukkan Alamat Pindah..." required id="moving_address" value="{{ old('moving_address') }}" />
                @error('moving_address')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-8 flex mt-5 flex-col moving-family-group">
                <label for="sk_move_family_citizent_id" class="text-second mb-2">Keluarga Yang Pindah</label>
                <select class="moving-family-select2 moving-family">
					<option value="">Cari keluarga yang pindah</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}">{{ $item->name }}</option>
					@endforeach
				</select>
				<br>
                <select class="moving-family2-select2 moving-family">
					<option value="">Cari keluarga yang pindah</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}">{{ $item->name }}</option>
					@endforeach
				</select>
				<br>
                <select class="moving-family3-select2 moving-family">
					<option value="">Cari keluarga yang pindah</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}">{{ $item->name }}</option>
					@endforeach
				</select>
				<br>
                <select class="moving-family4-select2 moving-family">
					<option value="">Cari keluarga yang pindah</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}">{{ $item->name }}</option>
					@endforeach
				</select>
            </div>
			<div class="col-span-12 md:col-span-4 flex mt-5 flex-col relationship-status-group">
                <label for="relationship_status" class="text-second mb-2">Status Hubungan</label>
				<select class="relationship-status-select2 relationship-status">
					<option value="">Pilih status hubungan</option>
					@foreach (\App\Enums\RelationshipStatus2::labels() as $key => $item)
						<option value="{{ $key+1 }}">{{ $item }}</option>
					@endforeach
				</select>
				<br>
				<select class="relationship-status2-select2 relationship-status">
					<option value="">Pilih status hubungan</option>
					@foreach (\App\Enums\RelationshipStatus2::labels() as $key => $item)
						<option value="{{ $key+1 }}">{{ $item }}</option>
					@endforeach
				</select>
				<br>
				<select class="relationship-status3-select2 relationship-status">
					<option value="">Pilih status hubungan</option>
					@foreach (\App\Enums\RelationshipStatus2::labels() as $key => $item)
						<option value="{{ $key+1 }}">{{ $item }}</option>
					@endforeach
				</select>
				<br>
				<select class="relationship-status4-select2 relationship-status">
					<option value="">Pilih status hubungan</option>
					@foreach (\App\Enums\RelationshipStatus2::labels() as $key => $item)
						<option value="{{ $key+1 }}">{{ $item }}</option>
					@endforeach
				</select>
				
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
					<a href="{{ route('letters.sk-move.index') }}" class="button btn-second text-white" type="reset">Batal Tambah</a>
				</div>
			</div>
		</form>
	</div>
@endsection

@push('js')
	<script>
		let citizent = $(".citizent-select2").select2()
		let type = $(".type-select2").select2()
		let moving_family = $(".moving-family-select2").select2()
		let moving_family2 = $(".moving-family2-select2").select2()
		let moving_family3 = $(".moving-family3-select2").select2()
		let moving_family4 = $(".moving-family4-select2").select2()
		let relationship_status = $(".relationship-status-select2").select2()
		let relationship_status2 = $(".relationship-status2-select2").select2()
		let relationship_status3 = $(".relationship-status3-select2").select2()
		let relationship_status4 = $(".relationship-status4-select2").select2()

		let family_data = []
		$(".moving-family").change(function() {
			if($(this).val() === "") {
				new_data = family_data.filter((item, index) => item === $(this).val())
				console.log(new_data)
			} else {
				family_data.push($(this).val())
				new_data = family_data.filter((item, index) => family_data.indexOf(item) === index)
			}

			$(".sk_move_family_citizent_input").val(new_data);
		})

		let relationship_status_data = []
		$(".relationship-status").change(function() {
			relationship_status_data.push($(this).val())
			$(".sk_move_family_status_input").val(relationship_status_data);
		})
	</script>
@endpush