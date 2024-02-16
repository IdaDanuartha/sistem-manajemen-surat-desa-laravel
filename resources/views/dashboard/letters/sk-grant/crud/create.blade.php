@extends('layouts.main')
@section('title', 'Tambah Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sk-grant.store') }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
			@csrf
            @if (auth()->user()->isCitizent())
                <input type="hidden" name="sk[citizent_id]" value="{{ auth()->user()->authenticatable->id }}">
            @else
                <div class="col-span-12 flex flex-col">
                    <label for="citizent_id" class="text-second mb-2">Nama Pembuat Surat</label>
                    <select name="sk[citizent_id]" id="sk_citizent_id" class="sk-citizent-select2">
                        <option value="">Cari nama warga</option>
                        @foreach ($citizents as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('sk.citizent_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            @endif
			<div class="col-span-12 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" value="{{ old('sk.reference_number') }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="citizent_id" class="text-second mb-2">Penerima Hibah</label>
                <select name="citizent_id" id="citizent_id" class="citizent-select2">
					<option value="">Cari Nama Penerima Hibah</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}" @selected(old("citizent") === $item->id)>{{ $item->name }}</option>
					@endforeach
				</select>
                @error('citizent_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="police_number" class="text-second mb-1">Nomor Polisi</label>
                <input type="text" class="input-crud" name="police_number" id="police_number" value="{{ old('police_number') }}"
                    placeholder="DK-1234-AB" required />
                @error('police_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="owner_name" class="text-second mb-1">Nama Pemilik</label>
                <input type="text" class="input-crud" name="owner_name" id="owner_name" value="{{ old('police_number') }}"
                    placeholder="Masukkan Nama Pemilik..." required />
                @error('owner_name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="address" class="text-second mb-1">Alamat</label>
                <input type="text" class="input-crud" name="address" id="address" value="{{ old('address') }}"
                    placeholder="Masukkan Alamat..." required />
                @error('address')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="brand" class="text-second mb-1">Merk/Brand</label>
                <input type="text" class="input-crud" name="brand" id="brand" value="{{ old('brand') }}"
                    placeholder="Honda" required />
                @error('brand')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="type" class="text-second mb-1">Jenis</label>
                <input type="text" class="input-crud" name="type" id="type" value="{{ old('type') }}"
                    placeholder="SPD Motor Solo" required />
                @error('type')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="model" class="text-second mb-1">Model</label>
                <input type="text" class="input-crud" name="model" id="model" value="{{ old('model') }}"
                    placeholder="Sepeda Motor" required />
                @error('model')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="production_year" class="text-second mb-1">Tahun Produksi</label>
                <input type="number" min="1900" max="{{ date("Y") }}" class="input-crud" name="production_year" id="production_year" value="{{ old('production_year') }}"
                    placeholder="2020" required />
                @error('production_year')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="cylinder_filling" class="text-second mb-1">Isi Selinder</label>
                <input type="text" class="input-crud" name="cylinder_filling" id="cylinder_filling" value="{{ old('cylinder_filling') }}"
                    placeholder="150 CC" required />
                @error('cylinder_filling')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="frame_number" class="text-second mb-1">No. Rangka</label>
                <input type="text" class="input-crud" name="frame_number" id="frame_number" value="{{ old('frame_number') }}"
                    placeholder="MH1JM313XLK2812345" required />
                @error('frame_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="machine_number" class="text-second mb-1">No. Mesin</label>
                <input type="text" class="input-crud" name="machine_number" id="machine_number" value="{{ old('machine_number') }}"
                    placeholder="JM3IE-319343" required />
                @error('machine_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="bpkb_number" class="text-second mb-1">No. BPKB</label>
                <input type="text" class="input-crud" name="bpkb_number" id="bpkb_number" value="{{ old('bpkb_number') }}"
                    placeholder="Q0123456-0" required />
                @error('bpkb_number')
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
					<a href="{{ route('letters.sk-grant.index') }}" class="button btn-second text-white" type="reset">Batal Tambah</a>
				</div>
			</div>
		</form>
	</div>
@endsection

@push('js')
	<script>
		let sk_citizent = $(".sk-citizent-select2").select2()
		let citizent = $(".citizent-select2").select2()
	</script>
@endpush