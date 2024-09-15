@extends('layouts.main')
@section('title', 'Edit Surat')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form action="{{ route('letters.sk-parent-income.update', $get_letter->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
			@csrf
			@method('PUT')			
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="reference_number" class="text-second mb-1">Nomor Surat</label>
                <input type="text" class="input-crud" name="sk[reference_number]" id="reference_number" value="{{ $get_letter->sk->reference_number }}"
                    placeholder="Masukkan Nomor Surat..." required />
                @error('sk.reference_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="cover_letter_number" class="text-second mb-1">Nomor SP Kaling</label>
                <input type="text" class="input-crud" name="sk[cover_letter_number]" id="cover_letter_number" value="{{ $get_letter->sk->cover_letter_number }}"
                    placeholder="Masukkan Nomor SP Kaling..." required />
                @error('sk.cover_letter_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="citizent_id" class="text-second mb-2">Nama Anak</label>
                <select name="citizent_id" id="citizent_id" class="citizent-select2">
					<option value="">Cari Nama Anak</option>
					@foreach ($citizents as $item)
						<option value="{{ $item->id }}" @selected($item->id == $get_letter->citizent_id)>{{ "$item->name - $item->national_identify_number" }}</option>
					@endforeach
				</select>
                @error('citizent_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col income-input">
                <label for="income" class="text-second mb-1">Pendapatan (Rp)</label>
                <input type="number" class="input-crud" name="income" id="income" value="{{ $get_letter->income }}"
                    placeholder="Masukkan Pendapatan..." />
                @error('income')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="status" class="text-second mb-1">Status</label>
				<select name="status" id="status" class="status-select2">
					<option value="1" @selected($get_letter->status == 1 ? true : false)>Sudah bekerja</option>
					<option value="2" @selected($get_letter->status == 2 ? true : false)>Tidak/belum bekerja</option>
				</select>
                @error('status')
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
				<a href="{{ route('letters.sk-parent-income.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
			</div>
		</form>
	</div>
@endsection

@push('js')
<script>
	let citizent = $(".citizent-select2").select2()
    let status = $(".status-select2").select2()

    if($(".status-select2").val() == 1) {
        console.log("1")
        $(".income-input").removeClass("hidden")
        $(".income-input").addClass("flex")
    } else {
        console.log("2")
        $(".income-input").addClass("hidden")
        $(".income-input").removeClass("flex")
    }

    $(".status-select2").change(function() {
        if($(this).val() == 1) {
            $(".income-input").removeClass("hidden")
            $(".income-input").addClass("flex")
        } else {
            $(".income-input").addClass("hidden")
            $(".income-input").removeClass("flex")
        }
    })
</script>
@endpush
