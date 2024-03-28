@extends('layouts.main')
@section('title', 'Detail Pengguna')
@section('main')
	<div class="table-wrapper mt-[20px] input-teacher">
		<form class="grid grid-cols-12 gap-4">						
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" disabled class="input-crud" id="name" value="{{ $environmentalHead->name }}">
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="environmental_id" class="text-second mb-2">Lingkungan</label>
                <input type="text" disabled class="input-crud" id="name" value="{{ $citizent->environmental ? ($environmentalHead->environmental->name . " (" . $citizent->environmental->code . ")") : "-" }}">
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="email" class="text-second mb-1">Email</label>
                <input type="email" disabled class="input-crud" id="email"
                    value="{{ $environmentalHead->user->email }}" required>
            </div>
            <div class="col-span-12 flex flex-col">
                <p class="text-second mb-1">Status Akun</p>
                <label class="switch">
                    <input type="checkbox" disabled name="user[status]" @checked($environmentalHead->user->status->value == 1 ? 'on' : '')>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="signature_image" class="text-second mb-1">Foto TTE</label>
                <label for="signature_image" class="d-block mb-3">
                    @if ($environmentalHead->user->signature_image)
                        <img src="{{ asset('uploads/users/signatures/' . $environmentalHead->user->signature_image) }}" class="edit-tte-preview-img border"
                            width="300" alt="">
                    @else
                        <img src="{{ asset('assets/img/upload-image.jpg') }}" class="edit-tte-preview-img border"
                            width="300" alt="">
                    @endif
                </label>
            </div>
			<div class="col-span-12 flex items-center gap-3 mt-2">				
				<a href="{{ route('environmental-heads.index') }}" class="button btn-second text-white" type="reset">Kembali</a>
			</div>
		</form>
	</div>
@endsection
