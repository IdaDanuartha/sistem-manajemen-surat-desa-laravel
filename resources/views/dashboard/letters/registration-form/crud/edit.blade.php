@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.registration-form.update', $get_letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
			@csrf
			@method('PUT')			
			{{-- <div class="col-span-12 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" value="{{ $get_letter->sk->reference_number }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('sk.reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div> --}}
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="time_period" class="text-second mb-1">Jangka Waktu sebagai Nonpermanen</label>
                <input type="text" class="input-crud" name="time_period" id="time_period" value="{{ $get_letter->time_period }}"
                    placeholder="Masukkan Jangka Waktu..." required />
                @error('time_period')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reason" class="text-second mb-1">Alasan Pembatalan Penduduk</label>
                <input type="text" class="input-crud" name="reason" id="reason" value="{{ $get_letter->reason }}"
                    placeholder="Masukkan Alasan Pembatalan..." required />
                @error('reason')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 mt-4">*Diisi sesuai dengan keperluan sebagai nonpermanen</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="kaling_number" class="text-second mb-1">No Kaling</label>
                <input type="text" class="input-crud" name="kaling_number" id="kaling_number" value="{{ $get_letter->kaling_number }}"
                    placeholder="Masukkan Nomor Kaling..." />
                @error('kaling_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="bourding_house_owner" class="text-second mb-1">Nama Pemilik Kos</label>
                <input type="text" class="input-crud" name="bourding_house_owner" id="bourding_house_owner" value="{{ $get_letter->bourding_house_owner }}"
                    placeholder="Masukkan Nama Pemilik Kos..." />
                @error('bourding_house_owner')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="address" class="text-second mb-1">Alamat</label>
                <input type="text" class="input-crud" name="address" id="address" value="{{ $get_letter->address }}"
                    placeholder="Masukkan Alamat..." />
                @error('address')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="phone_number" class="text-second mb-1">Nomor Telepon</label>
                <input type="text" class="input-crud" name="phone_number" id="phone_number" value="{{ $get_letter->phone_number }}"
                    placeholder="Masukkan Nomor Telepon..." />
                @error('phone_number')
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
			<div class="col-span-12 flex items-center gap-3 mt-2">
				<button class="button btn-main" type="submit">Edit Surat</button>
				<a href="{{ route('letters.registration-form.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
			</div>
		</form>
	</div>
@endsection

@push('js')
<script>
	// let status = $(".status-select2").select2()
</script>
@endpush
