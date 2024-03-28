@extends('layouts.main')
@section('title', 'Detail Pengguna')
@section('main')
	<div class="table-wrapper mt-[20px] input-teacher">
		<form class="grid grid-cols-12 gap-4">						
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="code" class="text-second mb-1">Kode Lingkungan</label>
                <input type="text" disabled class="input-crud" id="code" value="{{ $environmental->code }}">
            </div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" disabled class="input-crud" id="name" value="{{ $environmental->name }}">
            </div>
			<div class="col-span-12 flex items-center gap-3 mt-2">				
				<a href="{{ route('environmentals.index') }}" class="button btn-second text-white" type="reset">Kembali</a>
			</div>
		</form>
	</div>
@endsection
