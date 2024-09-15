@extends('layouts.main')
@section('title', 'Tambah Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sktm.store') }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
			@csrf
			@if (auth()->user()->isCitizent())
				<input type="hidden" name="sk[citizent_id]" value="{{ auth()->user()->authenticatable->id }}">
			@else
				<div class="col-span-12 flex flex-col">
					<label for="citizent_id" class="text-second mb-2">Nama Pembuat Surat</label>
					<select name="sk[citizent_id]" id="sk_citizent_id" class="sk-citizent-select2">
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
                {{-- <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" readonly value="{{ $reference_number }}"
                    placeholder="Masukkan Nomor Surat..." required /> --}}
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('sk.reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="cover_letter_number" class="text-second mb-1">Nomor SP Kaling</label>
                {{-- <input type="text" class="input-crud" name="sk[cover_letter_number]" id="cover_letter_number" readonly value="{{ $cover_letter_number }}"
                    placeholder="Masukkan Nomor SP Kaling..." required /> --}}
                <input type="text" class="input-crud" name="sk[cover_letter_number]" id="cover_letter_number"
                    placeholder="Masukkan Nomor SP Kaling..." required />
                @error('sk.cover_letter_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			{{-- <div class="col-span-12 flex flex-col reference-number-2">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" readonly value="{{ $reference_number_2 }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div> --}}
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="sktm_type" class="text-second mb-2">Tipe Surat</label>
                <select name="sktm_type" id="sktm_type" class="sktm-type-select2">
					<option value="">Pilih Tipe Surat</option>
					@foreach (\App\Enums\SktmType::labels() as $key => $item)
						<option value="{{ $key+1 }}" @selected(old("sktm_type") === $key+1)>{{ $item }}</option>
					@endforeach
				</select>
                @error('sktm_type')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 input-purpose flex-col flex">
                <label for="purpose" class="text-second mb-1">Keperluan Surat</label>
                <input type="text" class="input-crud" name="purpose" id="purpose" value="{{ old('purpose') }}"
                    placeholder="Masukkan keperluan surat..." />
                @error('purpose')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 hidden input-citizent flex-col">
                <label for="citizent_id" class="text-second mb-2">Nama Anak</label>
                <select name="citizent_id" id="citizent_id" class="citizent-select2">
					<option value="">Cari Nama Anak</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}">{{ "$item->name - $item->national_identify_number" }}</option>
					@endforeach
				</select>
                @error('citizent_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex-col hidden input-school-name">
                <label for="school_name" class="text-second mb-1">Nama Sekolah</label>
                <input type="text" class="input-crud" name="school_name" id="school_name" value="{{ old('school_name') }}"
                    placeholder="Masukkan nama sekolah..." />
                @error('school_name')
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
					<a href="{{ route('letters.sktm.index') }}" class="button btn-second text-white" type="reset">Batal Tambah</a>
				</div>
			</div>
		</form>
	</div>
@endsection

@push('js')
	<script>
		let sk_citizent = $(".sk-citizent-select2").select2()
		let citizent = $(".citizent-select2").select2()
		let sktm_type = $(".sktm-type-select2").select2()
		
		$("#sktm_type").change(function() {
			if($(this).val() == 2) {
				$(".input-school-name").removeClass("hidden")
				$(".input-school-name").addClass("flex")
				$(".input-school-name input").attr("required", true)
				$(".input-citizent").removeClass("hidden")
				$(".input-citizent").addClass("flex")
				$(".input-citizent input").attr("required", true)
			} else {
				$(".input-school-name").removeClass("flex")
				$(".input-school-name").addClass("hidden")
				$(".input-school-name input").attr("required", false)
				$(".input-citizent").removeClass("flex")
				$(".input-citizent").addClass("hidden")
				$(".input-citizent input").attr("required", false)
			}

			// if($(this).val() == 3) {
			// 	$(".reference-number-1").addClass("flex")
			// 	$(".reference-number-1").removeClass("hidden")
			// 	$(".reference-number-1 input").attr("name", "sk[reference_number]")

			// 	$(".reference-number-2").addClass("hidden")
			// 	$(".reference-number-2").removeClass("flex")
			// 	$(".reference-number-2 input").attr("name", "")
			// } else {
			// 	$(".reference-number-1").addClass("hidden")
			// 	$(".reference-number-1").removeClass("flex")
			// 	$(".reference-number-1 input").attr("name", "")
				
			// 	$(".reference-number-2").addClass("flex")
			// 	$(".reference-number-2").removeClass("hidden")
			// 	$(".reference-number-2 input").attr("name", "sk[reference_number]")
			// }
		})
	</script>
@endpush