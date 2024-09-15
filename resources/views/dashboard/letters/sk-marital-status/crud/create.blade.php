@extends('layouts.main')
@section('title', 'Tambah Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sk-marital-status.store') }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
			@csrf
			@if (auth()->user()->isCitizent())
				<input type="hidden" name="sk[citizent_id]" value="{{ auth()->user()->authenticatable->id }}">
			@else
				<div class="col-span-12 md:col-span-6 flex flex-col">
					<label for="sk_citizent_id" class="text-second mb-2">Nama Pembuat Surat</label>
					<select name="sk[citizent_id]" id="sk_citizent_id" class="citizent-select2">
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
			<div class="col-span-12 {{ auth()->user()->isCitizent() ? "" : "md:col-span-6" }} flex-col reference-number-1">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                {{-- <input type="text" class="input-crud" name="sk[reference_number]" readonly value="{{ $reference_number_1 }}"
                    placeholder="Masukkan Nomor Surat..." required /> --}}
                <input type="text" class="input-crud" name="sk[reference_number]"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			{{-- <div class="col-span-12 md:col-span-6 flex-col flex reference-number-2">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" readonly value="{{ $reference_number_2 }}"
                    placeholder="Masukkan Nomor Surat..." required />
                <input type="text" class="input-crud" name="sk[reference_number]"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div> --}}
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="cover_letter_number" class="text-second mb-1">Nomor SP Kaling</label>
                {{-- <input type="text" class="input-crud" id="cover_letter_number" name="sk[cover_letter_number]" readonly value="{{ $cover_letter_number }}"
                    placeholder="Masukkan Nomor SP Kaling..." required /> --}}
                <input type="text" class="input-crud" id="cover_letter_number" name="sk[cover_letter_number]"
                    placeholder="Masukkan Nomor SP Kaling..." required />
                @error('sk.cover_letter_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="status" class="text-second mb-2">Status</label>
                <select name="status" id="status" class="status-select2">
					<option value="1">Duda</option>
					<option value="2">Janda</option>
					<option value="3">Cerai</option>
				</select>
                @error('status')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="citizent_id" class="text-second mb-2">Nama Pasangan</label>
                <select name="citizent_id" id="citizent_id" class="citizent-select2">
					<option value="">Cari Pasangan</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}">{{ "$item->name - $item->national_identify_number" }}</option>
					@endforeach
				</select>
                @error('citizent_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="date" class="text-second mb-1">Tanggal</label>
                <input type="date" class="input-crud" name="date" id="date" value="{{ old('date') }}"
                    placeholder="Masukkan Tanggal..." required />
                @error('date')
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
					<a href="{{ route('letters.sk-marital-status.index') }}" class="button btn-second text-white" type="reset">Batal Tambah</a>
				</div>
			</div>
		</form>
	</div>
@endsection

@push('js')
	<script>
		let status = $(".status-select2").select2()
		let citizent = $(".citizent-select2").select2()
		let sk_citizent = $(".sk_citizent-select2").select2()

		// $(".status-select2").change(function() {
		// 	if($(this).val() == 3) {
		// 		$(".reference-number-1").addClass("flex")
		// 		$(".reference-number-1").removeClass("hidden")
		// 		$(".reference-number-1 input").attr("name", "sk[reference_number]")

		// 		$(".reference-number-2").addClass("hidden")
		// 		$(".reference-number-2").removeClass("flex")
		// 		$(".reference-number-2 input").attr("name", "")
		// 	} else if($(this).val() == 1 || $(this).val() == 2) {
		// 		$(".reference-number-1").addClass("hidden")
		// 		$(".reference-number-1").removeClass("flex")
		// 		$(".reference-number-1 input").attr("name", "")
				
		// 		$(".reference-number-2").addClass("flex")
		// 		$(".reference-number-2").removeClass("hidden")
		// 		$(".reference-number-2 input").attr("name", "sk[reference_number]")
		// 	}
		// })
	</script>
@endpush