@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sk-grant.update', $get_letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
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
                <label for="citizent_id" class="text-second mb-2">Penerima Hibah</label>
                <select name="citizent_id" id="citizent_id" class="citizent-select2">
					<option value="">Cari Nama Penerima Hibah</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}" @selected($get_letter->citizent_id === $item->id)>{{ "$item->name - $item->national_identify_number" }}</option>
					@endforeach
				</select>
                @error('citizent_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="police_number" class="text-second mb-1">Nomor Polisi</label>
                <input type="text" class="input-crud" name="police_number" id="police_number" value="{{ $get_letter->police_number }}"
                    placeholder="DK-1234-AB" required />
                @error('police_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="owner_name" class="text-second mb-1">Nama Pemilik</label>
                <input type="text" class="input-crud" name="owner_name" id="owner_name" value="{{ $get_letter->owner_name }}"
                    placeholder="Masukkan Nama Pemilik..." required />
                @error('owner_name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="address" class="text-second mb-1">Alamat</label>
                <input type="text" class="input-crud" name="address" id="address" value="{{ $get_letter->address }}"
                    placeholder="Masukkan Alamat..." required />
                @error('address')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="brand" class="text-second mb-1">Merk/Brand</label>
                <input type="text" class="input-crud" name="brand" id="brand" value="{{ $get_letter->brand }}"
                    placeholder="Honda" required />
                @error('brand')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="type" class="text-second mb-1">Jenis</label>
                <input type="text" class="input-crud" name="type" id="type" value="{{ $get_letter->type }}"
                    placeholder="SPD Motor Solo" required />
                @error('type')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="model" class="text-second mb-1">Model</label>
                <input type="text" class="input-crud" name="model" id="model" value="{{ $get_letter->model }}"
                    placeholder="Sepeda Motor" required />
                @error('model')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="production_year" class="text-second mb-1">Tahun Produksi</label>
                <input type="number" min="1900" max="{{ date("Y") }}" class="input-crud" name="production_year" id="production_year" value="{{ $get_letter->production_year }}"
                    placeholder="2020" required />
                @error('production_year')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="cylinder_filling" class="text-second mb-1">Isi Selinder</label>
                <input type="text" class="input-crud" name="cylinder_filling" id="cylinder_filling" value="{{ $get_letter->cylinder_filling }}"
                    placeholder="150 CC" required />
                @error('cylinder_filling')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="frame_number" class="text-second mb-1">No. Rangka</label>
                <input type="text" class="input-crud" name="frame_number" id="frame_number" value="{{ $get_letter->frame_number }}"
                    placeholder="MH1JM313XLK2812345" required />
                @error('frame_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="machine_number" class="text-second mb-1">No. Mesin</label>
                <input type="text" class="input-crud" name="machine_number" id="machine_number" value="{{ $get_letter->machine_number }}"
                    placeholder="JM3IE-319343" required />
                @error('machine_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="bpkb_number" class="text-second mb-1">No. BPKB</label>
                <input type="text" class="input-crud" name="bpkb_number" id="bpkb_number" value="{{ $get_letter->bpkb_number }}"
                    placeholder="Q0123456-0" required />
                @error('bpkb_number')
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
                <a href="{{ route('letters.sk-grant.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
            </div>
		</form>
	</div>
@endsection

@push('js')
<script>
	let citizent = $(".citizent-select2").select2()
</script>
@endpush
