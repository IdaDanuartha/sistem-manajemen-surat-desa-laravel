@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sk-marry.update', $get_letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
			@csrf
			@method('PUT')			
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Kode Surat</label>
                <input type="text" class="input-crud" disabled value="{{ $get_letter->sk->code }}" />
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" value="{{ $get_letter->sk->reference_number }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('sk.reference_number')
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
					<a href="{{ route('letters.sk-marry.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
				</div>
			@endif
		</form>
		{{-- @if (auth()->user()->isVillageHead())
		<form method="POST" class="mt-4" action="{{ route('letters.signed', $get_letter->id) }}">
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
