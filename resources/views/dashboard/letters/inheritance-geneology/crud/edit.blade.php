@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.inheritance-geneology.update', $get_letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
			@csrf
			@method('PUT')			
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" value="{{ $get_letter->sk->reference_number }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('sk.reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 flex flex-col">
				<label for="inheritance_image" class="text-second mb-1">Gambar Silsilah Waris</label>
				<label for="inheritance_image" class="d-block mb-3">
					@if ($get_letter->inheritance_image)
						<img src="{{ asset('uploads/letters/inheritance-geneologies/' . $get_letter->inheritance_image) }}" class="edit-inheritance-geneology-preview-img border" width="300" alt="">
					@else
						<img src="{{ asset('assets/img/upload-image.jpg') }}" class="edit-inheritance-geneology-preview-img border" width="300" alt="">
					@endif
				</label>
				<input
					type="file"
					id="inheritance_image"
					name="inheritance_image"
					class="input-crud py-0 edit-inheritance-geneology-input hidden"
					/>
				<label for="inheritance_image" class="button btn-second text-center w-[300px]">Upload Gambar</label>
				@error('inheritance_image')
					<div class="text-danger mt-1">{{ $message }}</div>
				@enderror
			</div>
			<div class="col-span-12 flex flex-col">
				<p class="text-second mb-1">Kirim Surat</p>
				<label class="switch">
					<input type="checkbox" name="sk[is_published]" @checked($get_letter->sk->is_published ? 'on' : '')>
					<span class="slider round"></span>
				</label>
			</div>
			@if (auth()->user()->isCitizent())
				<div class="col-span-12 flex items-center gap-3 mt-2">
					<button class="button btn-main" type="submit">Edit Surat</button>
					<a href="{{ route('letters.inheritance-geneology.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
				</div>
			@endif
		</form>
	</div>
@endsection

@push('js')
<script>
	previewImg("edit-inheritance-geneology-input", "edit-inheritance-geneology-preview-img")
</script>
@endpush
