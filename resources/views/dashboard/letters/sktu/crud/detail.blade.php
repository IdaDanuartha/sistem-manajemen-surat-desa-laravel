@extends('layouts.main')
@section('title', 'Detail Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		@if (!auth()->user()->isCitizent())
			<div class="flex justify-content-end">
				@if (auth()->user()->isEnvironmentalHead())
					@if ($get_letter->sk->status_by_environmental_head !== 1)
						<button data-bs-toggle="modal" data-bs-target="#rejectLetterModal" type="button"
						class="flex button {{ $get_letter->sk->status_by_environmental_head === 0 ? 'btn-danger' : 'btn-second' }} mr-3 duration-200 capitalize w-max items-center gap-1" 
							{{ $get_letter->sk->status_by_environmental_head === 2 ? 'disabled' : '' }}>
								@if ($get_letter->sk->status_by_environmental_head)
									Surat Ditolak								
								@else
									Tolak Surat
								@endif								
						</button>
					@endif
					@if($get_letter->sk->status_by_environmental_head !== 2)
						<button data-bs-toggle="modal" data-bs-target="#approveLetterModal" type="button"
								class="flex button {{ $get_letter->sk->status_by_environmental_head ? 'btn-second' : 'btn-main' }} duration-200 capitalize w-max items-center gap-1" 
								{{ $get_letter->sk->status_by_environmental_head === 1 ? 'disabled' : '' }}>
									@if ($get_letter->sk->status_by_environmental_head)
										Surat Disetujui								
									@else
										Setujui Surat
									@endif								
						</button>
					@endif
				@endif
				@if (auth()->user()->isSectionHead())
					@if ($get_letter->sk->status_by_section_head !== 1)
						<button data-bs-toggle="modal" data-bs-target="#rejectLetterModal" type="button"
						class="flex button {{ $get_letter->sk->status_by_section_head === 0 ? 'btn-danger' : 'btn-second' }} mr-3 duration-200 capitalize w-max items-center gap-1" 
							{{ $get_letter->sk->status_by_section_head === 2 ? 'disabled' : '' }}>
								@if ($get_letter->sk->status_by_section_head)
									Surat Ditolak								
								@else
									Tolak Surat
								@endif								
						</button>
					@endif
					@if($get_letter->sk->status_by_section_head !== 2)
						<button data-bs-toggle="modal" data-bs-target="#approveLetterModal" type="button"
								class="flex button {{ $get_letter->sk->status_by_section_head ? 'btn-second' : 'btn-main' }} duration-200 capitalize w-max items-center gap-1" 
								{{ $get_letter->sk->status_by_section_head === 1 ? 'disabled' : '' }}>
									@if ($get_letter->sk->status_by_section_head)
										Surat Disetujui								
									@else
										Setujui Surat
									@endif								
						</button>
					@endif
				@endif
				@if (auth()->user()->isVillageHead())
					@if ($get_letter->sk->status_by_village_head !== 1)
						<button data-bs-toggle="modal" data-bs-target="#rejectLetterModal" type="button"
						class="flex button {{ $get_letter->sk->status_by_village_head === 0 ? 'btn-danger' : 'btn-second' }} mr-3 duration-200 capitalize w-max items-center gap-1" 
							{{ $get_letter->sk->status_by_village_head === 2 ? 'disabled' : '' }}>
								@if ($get_letter->sk->status_by_village_head)
									Surat Ditolak								
								@else
									Tolak Surat
								@endif								
						</button>
					@endif
					@if($get_letter->sk->status_by_village_head !== 2)
						<button data-bs-toggle="modal" data-bs-target="#approveLetterModal" type="button"
								class="flex button {{ $get_letter->sk->status_by_village_head ? 'btn-second' : 'btn-main' }} duration-200 capitalize w-max items-center gap-1" 
								{{ $get_letter->sk->status_by_village_head === 1 ? 'disabled' : '' }}>
									@if ($get_letter->sk->status_by_village_head)
										Surat Disetujui								
									@else
										Setujui Surat
									@endif								
						</button>
					@endif
				@endif
			</div>
		@endif
		<form class="grid grid-cols-12 gap-4">						
			<div class="col-span-12 md:col-span-4 flex flex-col">
				<label for="" class="text-second mb-1">Kode Surat</label>
				<input type="text" class="input-crud" value="{{ $get_letter->sk->code }}" disabled />
			</div>
			<div class="col-span-12 md:col-span-4 flex flex-col">
                <label for="" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" value="{{ $get_letter->sk->reference_number }}" disabled />
            </div>
			<div class="col-span-12 md:col-span-4 flex flex-col">
                <label for="" class="text-second mb-1">Nama Usaha</label>
                <input type="text" class="input-crud" value="{{ $get_letter->business_name }}" disabled />
            </div>
            @if (auth()->user()->isCitizent())
				<div class="col-span-12 md:col-span-4 flex flex-col">
					<label class="text-second mb-1">Kepala Lingkungan</label>
					<input
						type="text"
						class="input-crud"
						value="@if ($get_letter->sk->status_by_environmental_head == 1){{ $get_letter->sk->environmentalHead?->citizent->name . ' (Menyetujui) ' }}
						@elseif($get_letter->sk->status_by_environmental_head == 2){{ $get_letter->sk->environmentalHead?->citizent->name . ' (Menolak) '  }}
						@else Belum Dikonfirmasi @endif"
						disabled
					>
				</div>
				<div class="col-span-12 md:col-span-4 flex flex-col">
					<label class="text-second mb-1">Kepala Seksi</label>
					<input
						type="text"
						class="input-crud"
						value="@if ($get_letter->sk->status_by_section_head == 1){{ $get_letter->sk->sectionHead?->citizent->name . ' (Menyetujui) ' }}
						@elseif($get_letter->sk->status_by_section_head == 2){{ $get_letter->sk->sectionHead?->citizent->name . ' (Menolak) '  }}
						@else Belum Dikonfirmasi @endif"
						disabled
					>
				</div>
				<div class="col-span-12 md:col-span-4 flex flex-col">
					<label class="text-second mb-1">Kepala Kelurahan</label>
					<input
						type="text"
						class="input-crud"
						value="@if ($get_letter->sk->status_by_village_head == 1){{ $get_letter->sk->villageHead?->citizent->name . ' (Menyetujui) ' }}
						@elseif($get_letter->sk->status_by_village_head == 2){{ $get_letter->sk->villageHead?->citizent->name . ' (Menolak) '  }}
						@else Belum Dikonfirmasi @endif"
						disabled
					>
				</div>
				<div class="col-span-12 flex flex-col">
					<p class="text-second mb-1">Kirim Surat</p>
					<label class="switch">
						<input type="checkbox" name="sk[is_published]" disabled @checked($get_letter->sk->is_published ? 'on' : '')>
						<span class="slider round"></span>
					</label>
				</div>
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
						<p class="text-red-400">Silahkan tambahkan TTE di halaman <a class="text-red-400 underline duration-300" href="{{ route('profile.edit') }}">profil</a> terlebih dahulu!</p>
					</div>
				@endif
			</div>
			@endif
			<div class="col-span-12  flex justify-between">
				<div class="flex items-center gap-3">				
					<a href="{{ route('letters.sktu.preview', $get_letter->id) }}" target="_blank" class="button btn-main text-white">Preview Surat</a>
					<a href="{{ route('letters.sktu.index') }}" class="button btn-second text-white" type="reset">Kembali</a>
				</div>
				<div class="flex items-center">
					<a href="{{ route('letters.sktu.download', $get_letter->id) }}" target="_blank" class="button btn-second mr-2 text-white">Download PDF</a>
				</div>
			</div>
		</form>
	</div>
	
<x-modal-approve-letter>
	<x-slot name="route">/letters/sktu/{{ $get_letter->id }}/approve</x-slot>
</x-modal-approve-letter>
<x-modal-reject-letter>
	<x-slot name="route">/letters/sktu/{{ $get_letter->id }}/reject</x-slot>
</x-modal-reject-letter>
@endsection

@push('js')
	<script>
		// previewImg("create-tte-input", "create-tte-preview-img")
		// $("#signature_image").change(function() {
		// 	$("#signature_image_real").val($(".create-tte-input").val())
	</script>
@endpush