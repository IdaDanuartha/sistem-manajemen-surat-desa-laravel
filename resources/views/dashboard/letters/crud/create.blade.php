@extends('layouts.main')
@section('title', 'Tambah Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.store') }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="citizent_id" value="{{ auth()->user()->authenticatable->id }}">
			<div class="col-span-12 flex flex-col">
				<label for="letter_file" class="text-second mb-1">Upload Surat</label>
				<span for="letter_file" class="text-sm">Type : pdf, doc, docx</span>
				<span for="letter_file" class="text-sm mb-1">Maximum Size : 5mb</span>
				<input
					type="file"
					id="letter_file"
					name="letter_file"
					class="input-crud py-0"
					/>
				@error('letter_file')
					<div class="text-danger mt-1">{{ $message }}</div>
				@enderror
			</div>
			<div class="col-span-12 flex items-center gap-3 mt-2">
				<button class="button btn-main" type="submit">Tambah Surat</button>
				<a href="{{ route('letters.index') }}" class="button btn-second text-white" type="reset">Batal Tambah</a>
			</div>
		</form>
	</div>
@endsection