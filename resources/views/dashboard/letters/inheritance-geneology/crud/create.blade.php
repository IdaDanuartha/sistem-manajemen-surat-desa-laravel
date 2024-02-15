@extends('layouts.main')
@section('title', 'Tambah Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.inheritance-geneology.store') }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="sk[citizent_id]" value="{{ auth()->user()->authenticatable->id }}">
			<div class="col-span-12 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" value="{{ old('sk.reference_number') }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 flex flex-col">
                <label for="inheritance_image" class="text-second mb-1">Gambar Silsilah Waris</label>
                <label for="inheritance_image" class="d-block mb-3">
                    <img src="{{ asset('assets/img/upload-image.jpg') }}" class="create-inheritance-geneology-preview-img border"
                        width="300" alt="">
                </label>
                <input type="file" id="inheritance_image" name="inheritance_image"
                    class="input-crud py-0 create-inheritance-geneology-input hidden" />
                <label for="inheritance_image" class="button btn-second text-center w-[300px]">Upload Gambar</label>
                @error('inheritance_image')
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
					<a href="{{ route('letters.inheritance-geneology.index') }}" class="button btn-second text-white" type="reset">Batal Tambah</a>
				</div>
			</div>
		</form>
	</div>
@endsection

@push('js')
	<script>
		previewImg("create-inheritance-geneology-input", "create-inheritance-geneology-preview-img")
	</script>
@endpush