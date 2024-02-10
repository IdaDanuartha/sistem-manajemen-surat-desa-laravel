@extends('layouts.main')
@section('title', 'Detail Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		@if (!auth()->user()->isCitizent())
			<div class="flex justify-content-end">
				@if (auth()->user()->isEnvironmentalHead())
					<button data-bs-toggle="modal" data-bs-target="#confirmationLetterModal" type="button"
							class="flex button {{ $get_letter->approved_by_environmental_head ? 'btn-second' : 'btn-main' }} duration-200 capitalize w-max items-center gap-1" 
							{{ $get_letter->approved_by_environmental_head ? 'disabled' : '' }}>
								@if ($get_letter->approved_by_environmental_head)
									Surat Sudah Disetujui								
								@else
									Setujui Surat
								@endif								
					</button>
				@endif
				@if (auth()->user()->isSectionHead())
					<button data-bs-toggle="modal" data-bs-target="#confirmationLetterModal" type="button"
							class="flex button {{ $get_letter->approved_by_section_head ? 'btn-second' : 'btn-main' }} duration-200 capitalize w-max items-center gap-1"
							{{ $get_letter->approved_by_section_head ? 'disabled' : '' }}>
								@if ($get_letter->approved_by_section_head)
									Surat Sudah Disetujui								
								@else
									Setujui Surat
								@endif								
					</button>
				@endif
				@if (auth()->user()->isVillageHead())
					<button data-bs-toggle="modal" data-bs-target="#confirmationLetterModal" type="button"
						class="flex button {{ $get_letter->approved_by_village_head ? 'btn-second' : 'btn-main' }} duration-200 capitalize w-max items-center gap-1"
						{{ $get_letter->approved_by_village_head ? 'disabled' : '' }}>
							@if ($get_letter->approved_by_village_head)
								Surat Sudah Disetujui								
							@else
								Setujui Surat
							@endif								
					</button>
				@endif
			</div>
		@endif
		<form class="grid grid-cols-12 gap-4">						
			@if (!auth()->user()->isCitizent())
				<div class="col-span-12 md:col-span-6 flex flex-col">
					<label for="" class="text-second mb-1">Kode Surat</label>
					<input type="text" class="input-crud" value="{{ $get_letter->code }}" disabled />
				</div>
			@endif
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" value="{{ $get_letter->reference_number }}" disabled />
            </div>
            @if (auth()->user()->isCitizent())
				<div class="col-span-12 md:col-span-6 flex flex-col">
					<label for="attachment" class="text-second mb-1">Lampiran</label>
					<input type="text" class="input-crud" value="{{ $get_letter->attachment }}" disabled />
				</div>
				<div class="col-span-12 md:col-span-6 flex flex-col">
					<label for="regarding" class="text-second mb-1">Perihal</label>
					<input type="text" class="input-crud" value="{{ $get_letter->regarding }}" disabled />
				</div>
				<div class="col-span-12 md:col-span-6 flex flex-col">
					<label for="dear" class="text-second mb-1">Yth</label>
					<input type="text" class="input-crud" value="{{ $get_letter->dear }}" disabled />
				</div>
				<div>
					<label>
						<div class="flex items-center select-none">
							<input
									type="checkbox"
									class="input-crud mr-4 w-fit"
									@checked($get_letter->is_published == 1 ? 'on' : '')
									disabled
							>
							<div style="text-wrap: nowrap">Kirim Surat {{ $get_letter->is_published == 1 ? "(Terkirim)" : "(Belum terkirim)" }}</div>
						</div>
					</label>
				</div>
				<div class="col-span-12 flex flex-col">
					<label for="message" class="text-second mb-1">Isi Surat</label>
					<textarea id="message">{{ $get_letter->message }}</textarea>
				</div>
				<div class="col-span-12 flex flex-col">
					<label for="copy_submitted" class="text-second mb-1">Tembusan Disampaikan</label>
					<textarea id="copy_submitted">{{ $get_letter->copy_submitted }}</textarea>
				</div>
				<div class="col-span-12 flex flex-col">
					<label for="invitation_attachment" class="text-second mb-1">Lampiran Surat Undangan</label>
					<textarea id="invitation_attachment">{{ $get_letter->invitation_attachment }}</textarea>
				</div>
				@if(auth()->user()->isCitizent())
					<div class="col-span-4 flex flex-col">
						<label class="text-second mb-1">Kepala Lingkungan</label>
						<input
							type="text"
							class="input-crud"
							value="{{ $get_letter->approved_by_environmental_head ? $get_letter->environmentalHead?->citizent->name . ' (Menyetujui) ' : "Belum Disetujui" }}"
							disabled
						>
					</div>
					<div class="col-span-4 flex flex-col">
						<label class="text-second mb-1">Kepala Seksi</label>
						<input
							type="text"
							class="input-crud"
							value="{{ $get_letter->approved_by_section_head ? $get_letter->sectionHead?->citizent->name . ' (Menyetujui)' : "Belum Disetujui" }}"
							disabled
						>
					</div>
					<div class="col-span-4 flex flex-col">
						<label class="text-second mb-1">Kepala Kelurahan</label>
						<input
							type="text"
							class="input-crud"
							value="{{ $get_letter->approved_by_village_head ? $get_letter->villageHead?->citizent->name . ' (Menyetujui) ' : "Belum Disetujui" }}"
							disabled
						>
					</div>
				@endif	
			@endif	
			@if (auth()->user()->isVillageHead())
			<div class="col-span-12 flex flex-col">
				<label for="signature_image" class="text-second mb-1">Tanda Tangan Elektronik</label>
				@if (auth()->user()->signature_image)
					<div class="d-block">
						<img draggable="false" class="create-tte-preview-img" src="{{ asset('uploads/users/signatures/' . auth()->user()->signature_image) }}" class="border" width="200px" alt="">	
					</div>
				@else
					<div class="d-block">
						<p class="text-red-400">Silahkan upload TTE di halaman <a class="text-red-400 underline duration-300" href="{{ route('profile.edit') }}">profil</a> terlebih dahulu!</p>
					</div>
				@endif
			</div>
			@endif
			<div class="col-span-12 flex items-center gap-3">				
				<a href="{{ route('letters.preview', $get_letter->id) }}" target="_blank" class="button btn-main text-white">Preview Surat</a>
				{{-- @if (auth()->user()->isVillageHead() && !$get_letter->approved_by_village_head)
					<a href="{{ route('letters.edit', $get_letter->id) }}" class="button btn-main text-white">Tambah TTE</a>
				@endif --}}
				<a href="{{ route('letters.index') }}" class="button btn-second text-white" type="reset">Kembali</a>
			</div>
		</form>
	</div>

@include('partials.modal-confirmation-letter')
@endsection

@push('js')
	<script>
		// previewImg("create-tte-input", "create-tte-preview-img")
		// $("#signature_image").change(function() {
		// 	$("#signature_image_real").val($(".create-tte-input").val())
		// })

		let message = new RichTextEditor("#message");
		let copy_submitted = new RichTextEditor("#copy_submitted");
		let invitation_attachment = new RichTextEditor("#invitation_attachment");
		message.setReadOnly(true)
		copy_submitted.setReadOnly(true)
		invitation_attachment.setReadOnly(true)
	</script>
@endpush