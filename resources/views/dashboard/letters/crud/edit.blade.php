@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.update', $letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
			@csrf
			@method('PUT')			
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="reference_number" id="reference_number" value="{{ $letter->reference_number }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="attachment" class="text-second mb-1">Lampiran</label>
                <input type="text" class="input-crud" placeholder="Masukkan Lampiran Surat..." required
                    id="attachment" name="attachment"
                    value="{{ $letter->attachment }}">
                @error('attachment')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="regarding" class="text-second mb-1">Perihal</label>
                <input type="text" class="input-crud" name="regarding" id="regarding" value="{{ $letter->regarding }}"
                    placeholder="Masukkan Perihal Surat..." required />
                @error('regarding')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="dear" class="text-second mb-1">Yth</label>
                <input type="text" class="input-crud" placeholder="Masukkan Yang Terhormat..." required
                    id="dear" name="dear"
                    value="{{ $letter->dear }}">
                @error('dear')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div>
				<label>
					<div class="flex items-center select-none">
						<input
								name="is_published"
								type="checkbox"
								class="input-crud mr-4 w-fit"
								@checked($letter->is_published == 1 ? 'on' : '')
						>
						<div style="text-wrap: nowrap">Kirim Surat</div>
					</div>
				</label>
			</div>
            <div class="col-span-12 flex flex-col">
                <label for="message" class="text-second mb-1">Isi Surat</label>
				<textarea id="message" name="message">{{ $letter->message }}</textarea>
				@error('message')
				  <div class="text-danger mt-1">{{ $message }}</div>
				@enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="copy_submitted" class="text-second mb-1">Tembusan Disampaikan</label>
				<textarea id="copy_submitted" name="copy_submitted">{{ $letter->copy_submitted }}</textarea>
				@error('copy_submitted')
				  <div class="text-danger mt-1">{{ $message }}</div>
				@enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="invitation_attachment" class="text-second mb-1">Lampiran Surat Undangan</label>
				<textarea id="invitation_attachment" name="invitation_attachment">{{ $letter->invitation_attachment }}</textarea>
				@error('invitation_attachment')
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
		{{-- @if (auth()->user()->isVillageHead())
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
		@endif --}}
	</div>
@endsection

@push('js')
<script>

	// var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});

	// $('#clear').click(function(e) {

	// 		e.preventDefault();

	// 		sig.signature('clear');

	// 		$("#signature64").val('');

	// });
	let message = new RichTextEditor("#message");
	let copy_submitted = new RichTextEditor("#copy_submitted");
	let invitation_attachment = new RichTextEditor("#invitation_attachment");

</script>
@endpush
