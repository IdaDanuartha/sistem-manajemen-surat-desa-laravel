@extends('layouts.main')
@section('title', 'Tambah Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.store') }}" method="post" class="grid grid-cols-12 gap-4">
			@csrf
			<input type="hidden" name="citizent_id" value="{{ auth()->id() }}">
			<div class="col-span-12 flex flex-col">
				<label for="title" class="text-second mb-1">Judul Surat</label>
				<input
					type="text"
				 	class="input-crud"
					name="title"
					id="title"
					value="{{ old('title') }}"
				  placeholder="Masukkan Judul Surat..."
					required
				/>
				@error('title')
					<div class="text-danger mt-1">{{ $message }}</div>
        @enderror
			</div>
			<div class="col-span-12 flex flex-col">
				<label for="letter_number" class="text-second mb-1">Nomor Surat</label>
				<input
					type="text"
					class="input-crud"
					placeholder="Masukkan Nomor Surat..."
					required
					id="letter_number"
          name="letter_number"
					value="{{ old('letter_number') }}"
				>
				@error('letter_number')
          <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
			</div>
			<div class="col-span-12 flex flex-col">
				<label for="date" class="text-second mb-1">Tanggal</label>
				<input
					type="date"
					class="input-crud"
					placeholder="Masukkan Tanggal Surat..."
					required
					id="date"
          name="date"
					value="{{ old('date') }}"
				>
				@error('date')
          <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
			</div>
			<div class="col-span-12 flex flex-col">
				<label for="message" class="text-second mb-1">Pesan</label>
				<textarea					
					class="input-crud"
					placeholder="Masukkan Pesan..."
					required
					id="message"
          name="message"					
					cols="30"
					rows="10"
				>{{ old('message') }}</textarea>
				@error('message')
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
