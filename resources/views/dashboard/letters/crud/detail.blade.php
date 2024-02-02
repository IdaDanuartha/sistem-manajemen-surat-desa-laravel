@extends('layouts.main')
@section('title', 'Detail Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		@if (!auth()->user()->isCitizent())
			<div class="flex justify-content-end">
				@if (auth()->user()->isEnvironmentalHead())
					<button data-bs-toggle="modal" data-bs-target="#confirmationLetterModal" type="{{ $get_letter->approved_by_environmental_head ? 'button':'submit' }}"
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
					<button data-bs-toggle="modal" data-bs-target="#confirmationLetterModal" type="{{ $get_letter->approved_by_section_head ? 'button':'submit' }}"
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
					<button data-bs-toggle="modal" data-bs-target="#confirmationLetterModal" type="{{ $get_letter->approved_by_section_head ? 'button':'submit' }}"
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
			<div class="col-span-12 flex flex-col">
				<label for="title" class="text-second mb-1">Kode</label>
				<input
					type="text"
				 	class="input-crud"
					value="{{ $get_letter->code }}"
					disabled
				/>
			</div>
			<div class="col-span-12 flex flex-col">
				<label for="created_at" class="text-second mb-1">Tanggal</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $get_letter->created_at->format('d M Y') }}"
					disabled
				>
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
			<div class="col-span-12 flex flex-col">
				<label for="message" class="text-second mb-1">File Surat</label>
				<a href="{{ asset('uploads/letters/files/' . $get_letter->letter_file) }}">{{ $get_letter->letter_file }}</a>
			</div>
			@if ($get_letter->signature_image)
			<div class="col-span-12 flex flex-col">
				<label for="signature_image" class="text-second mb-1">Tanda Tangan Elektronik</label>
				<label for="signature_image" class="d-block mb-3">
						<img draggable="false" src="{{ asset('uploads/letters/signatures/' . $get_letter->signature_image) }}" class="border" width="100%" alt="">					
					</label>
				</div>
			@endif
			<div class="col-span-12 flex items-center gap-3 mt-2">				
				{{-- @if (auth()->user()->isCitizent())
					<a href="{{ route('letters.download', $get_letter->id) }}" class="button btn-main text-white">Download Surat</a>
				@endif --}}
				@if (auth()->user()->isVillageHead() && !$get_letter->approved_by_village_head)
					<a href="{{ route('letters.edit', $get_letter->id) }}" class="button btn-main text-white">Tambah TTE</a>
				@endif
				<a href="{{ route('letters.index') }}" class="button btn-second text-white" type="reset">Kembali</a>
			</div>
		</form>
	</div>

@include('partials.modal-confirmation-letter')
@endsection
