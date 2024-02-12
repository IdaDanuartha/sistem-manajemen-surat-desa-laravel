@extends('layouts.main')
@section('title', 'Tambah Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sktm.store') }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="sk[citizent_id]" value="{{ auth()->user()->authenticatable->id }}">
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" value="{{ old('sk.reference_number') }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
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
			<div class="col-span-12 md:col-span-6 flex-col hidden input-school-name">
                <label for="school_name" class="text-second mb-1">Nama Sekolah</label>
                <input type="text" class="input-crud" name="school_name" id="school_name" value="{{ old('school_name') }}"
                    placeholder="Masukkan nama sekolah..." />
                @error('school_name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 input-purpose flex-col flex">
                <label for="purpose" class="text-second mb-1">Tujuan Surat</label>
                <input type="text" class="input-crud" name="purpose" id="purpose" value="{{ old('purpose') }}"
                    placeholder="Masukkan nama sekolah..." />
                @error('purpose')
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
		let sktm_type = $(".sktm-type-select2").select2()
		$("#sktm_type").change(function() {
			if($(this).val() == 2) {
				$(".input-school-name").removeClass("hidden")
				$(".input-school-name").addClass("flex")
				$(".input-school-name input").attr("required", true)
				$(".input-purpose").addClass("md:col-span-6")
				$(".input-purpose").removeClass("col-span-12")
			} else {
				$(".input-school-name").removeClass("flex")
				$(".input-school-name").addClass("hidden")
				$(".input-school-name input").attr("required", false)

				$(".input-purpose").addClass("col-span-12")
				$(".input-purpose").removeClass("md:col-span-6")
			}
		})

	</script>
@endpush