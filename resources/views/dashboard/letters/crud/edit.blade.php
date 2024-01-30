@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.update', $letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
			@csrf
			@method('PUT')			
			<div class="col-span-12 flex flex-col">
				<label for="title" class="text-second mb-1">Judul Surat</label>
				<input
					type="text"
				 	class="input-crud"
					name="title"
					id="title"
					value="{{ $letter->title }}"
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
					value="{{ $letter->letter_number }}"
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
					value="{{ $letter->date->format('Y-m-d') }}"
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
				>{{ $letter->message }}</textarea>
				@error('message')
          <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
			</div>
			@if (auth()->user()->isCitizent())
				<div class="col-span-12 flex items-center gap-3 mt-2">
					<button class="button btn-main" type="submit">Edit Surat</button>
					<a href="{{ route('letters.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
				</div>
			@endif
		</form>
		@if (auth()->user()->isVillageHead())
		<form method="POST" class="mt-4" action="{{ route('letters.signed', $letter->id) }}">
				@csrf
				@method("PUT")
				<div class="col-md-12">
						<label class="text-second mb-1">Signature</label>						
						<div id="sig" class="rounded"></div>
						<button id="clear" class="button p-0">Clear Signature</button>
						<textarea id="signature64" name="signature_image" style="display: none"></textarea>
				</div>
				<div class="col-span-12 flex items-center mt-4 gap-3">
					<button class="button btn-main" type="submit">Tambah TTE</button>
					<a href="{{ route('letters.index') }}" class="button btn-second text-white" type="reset">Batal Tambah</a>
				</div>				
			</form>
		@endif
	</div>
@endsection

@push('js')
<script>

	var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});

	$('#clear').click(function(e) {

			e.preventDefault();

			sig.signature('clear');

			$("#signature64").val('');

	});

</script>
@endpush
