@extends('layouts.main')
@section('title', 'Tambah Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.registration-form.store') }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
			@csrf
            @if (auth()->user()->isCitizent())
                <input type="hidden" name="sk[citizent_id]" value="{{ auth()->user()->authenticatable->id }}">
            @else
                <div class="col-span-12 flex flex-col">
                    <label for="citizent_id" class="text-second mb-2">Nama Pembuat Surat</label>
                    <select name="sk[citizent_id]" id="citizent_id" class="citizent-select2">
                        <option value="">Cari nama warga</option>
                        @foreach ($citizents as $item)
                            <option value="{{ $item->id }}">{{ "$item->name - $item->national_identify_number" }}</option>
                        @endforeach
                    </select>
                    @error('sk.citizent_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            @endif
			{{-- <div class="col-span-12 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" value="{{ old('sk.reference_number') }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div> --}}
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="time_period" class="text-second mb-1">Jangka Waktu sebagai Nonpermanen</label>
                <input type="text" class="input-crud" name="time_period" id="time_period" value="{{ old('time_period') }}"
                    placeholder="Masukkan Jangka Waktu..." required />
                @error('time_period')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reason" class="text-second mb-1">Alasan Pembatalan Penduduk</label>
                <input type="text" class="input-crud" name="reason" id="reason" value="{{ old('reason') }}"
                    placeholder="Masukkan Alasan Pembatalan..." required />
                @error('reason')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 mt-4">*Diisi sesuai dengan keperluan sebagai nonpermanen</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="kaling_number" class="text-second mb-1">No Kaling</label>
                <input type="text" class="input-crud" name="kaling_number" id="kaling_number" value="{{ old('kaling_number') }}"
                    placeholder="Masukkan Nomor Kaling..." />
                @error('kaling_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="bourding_house_owner" class="text-second mb-1">Nama Pemilik Kos</label>
                <input type="text" class="input-crud" name="bourding_house_owner" id="bourding_house_owner" value="{{ old('bourding_house_owner') }}"
                    placeholder="Masukkan Nama Pemilik Kos..." />
                @error('bourding_house_owner')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="address" class="text-second mb-1">Alamat</label>
                <input type="text" class="input-crud" name="address" id="address" value="{{ old('address') }}"
                    placeholder="Masukkan Alamat..." />
                @error('address')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="phone_number" class="text-second mb-1">Nomor Telepon</label>
                <input type="text" class="input-crud" name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
                    placeholder="Masukkan Nomor Telepon..." />
                @error('phone_number')
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
					<a href="{{ route('letters.registration-form.index') }}" class="button btn-second text-white" type="reset">Batal Tambah</a>
				</div>
			</div>
		</form>
	</div>
@endsection

@push('js')
	<script>
		let citizent = $(".citizent-select2").select2()
	</script>
@endpush