@extends('layouts.main')
@section('title', 'Tambah Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.store') }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="citizent_id" value="{{ auth()->user()->authenticatable->id }}">
			{{-- <div class="col-span-12 flex flex-col">
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
			</div> --}}
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="reference_number" id="reference_number" value="{{ old('reference_number') }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="attachment" class="text-second mb-1">Lampiran</label>
                <input type="text" class="input-crud" placeholder="Masukkan Lampiran Surat..." required
                    id="attachment" name="attachment"
                    value="{{ old('attachment') }}">
                @error('attachment')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="regarding" class="text-second mb-1">Perihal</label>
                <input type="text" class="input-crud" name="regarding" id="regarding" value="{{ old('regarding') }}"
                    placeholder="Masukkan Perihal Surat..." required />
                @error('regarding')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="dear" class="text-second mb-1">Yth</label>
                <input type="text" class="input-crud" placeholder="Masukkan Yang Terhormat..." required
                    id="dear" name="dear"
                    value="{{ old('dear') }}">
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
						>
						<div style="text-wrap: nowrap">Kirim Surat</div>
					</div>
				</label>
			</div>
            <div class="col-span-12 flex flex-col">
                <label for="message" class="text-second mb-1">Isi Surat</label>
				<textarea id="message" name="message">{{ old("message") ?? "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dalam rangka Perencanaan Pembangunan Lingkungan untuk tahun 2025 perlu adanya
					musyawarah masyarakat (Musrenbangkel) di wilayah Kelurahan.Subagan untuk menampung Aspirasi
					usulan yang menjadi perioritas pembangunan di Kelurahan Subagan yang meliputi : Bidang Pangan
					Sandang dan Papan, Bidang Kesehatan dan Pendidikan. Bidang Jaminan Sosial dan Ketenagakerjaan, Bidang
					Adat, Agama, Tradisi seni, Budaya dan Bidang Pariwisata.</p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Untuk memperlancar kegiatan dimaksud, mohon kehadirannya Bapak/Ibu pada :</p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hari Tanggal : Senin , 22 Januari 2024</p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jam : 08.00 wita-selesai</p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat : Aula Kantor Lurah Subagan</p>
	<br />
	
					Demikian disampaikan atas perhatiannya dan kehadirannya kami ucapkan banyak terima kasih.
	<br />" }}</textarea>
				@error('message')
				  <div class="text-danger mt-1">{{ $message }}</div>
				@enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="copy_submitted" class="text-second mb-1">Tembusan Disampaikan</label>
				<textarea id="copy_submitted" name="copy_submitted">{{ old("copy_submitted") ?? "<p>1. Camat Karangasem di Amlapura (mohon kehadirannya)</p>
					<p>
										2. Babinkatibmas dan Babinsa Kelurahan Subagan (mohon kehadirannya)</p>
					<p>
										3. Staf Kelurahan Subagan mohon menyiapkan tempat</p>
					
										4. Arsip" }}</textarea>
				@error('copy_submitted')
				  <div class="text-danger mt-1">{{ $message }}</div>
				@enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="invitation_attachment" class="text-second mb-1">Lampiran Surat Undangan</label>
				<textarea id="invitation_attachment" name="invitation_attachment">{{ old("invitation_attachment") ?? "<p>1. Ketua LPM Kelurahan Subagan</p>
					<p> 
									2. Korwil Dinas Pendidikan Kecamatan Karangasem</p>
					<p>
									3. Penyuluh Pertanian, Peternakan dan Prikanan Kecamatan Karangasem.</p>
					<p>
									4. Penyuluh KB Kelurahan Subagan</p>" }}</textarea>
				@error('invitation_attachment')
				  <div class="text-danger mt-1">{{ $message }}</div>
				@enderror
            </div>
			<div class="flex col-span-12 justify-between mt-2">
				<div class="flex items-center gap-3">
					<button class="button btn-main" type="submit">Tambah Surat</button>
					<a href="{{ route('letters.index') }}" class="button btn-second text-white" type="reset">Batal Tambah</a>
				</div>
				{{-- <div class="flex">
					<a href="{{ route('letters.preview') }}" target="_blank" class="button btn-main">Preview Surat</a>
				</div> --}}
			</div>
		</form>
	</div>
@endsection

@push('js')
	<script>
		let message = new RichTextEditor("#message");
		let copy_submitted = new RichTextEditor("#copy_submitted");
		let invitation_attachment = new RichTextEditor("#invitation_attachment");
	</script>
@endpush