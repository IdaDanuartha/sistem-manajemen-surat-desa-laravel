@extends('layouts.main')
@section('title', 'Edit Pengguna')
@section('main')

    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ route('environmentals.update', $environmental->id) }}"
            method="POST" class="grid grid-cols-12 gap-4">
            @csrf
            @method('PUT')
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="code" class="text-second mb-1">Kode Lingkungan</label>
                <input type="text" class="input-crud" name="code" id="code" value="{{ $environmental->code }}"
                    placeholder="Masukkan Kode Lingkungan..." required />
                @error('code')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" name="name" id="name" value="{{ $environmental->name }}"
                    placeholder="Masukkan Nama..." required />
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Edit Pengguna</button>
                <a href="{{ route('environmentals.index') }}" class="button btn-second text-white"
                    type="reset">Batal Edit</a>
            </div>
        </form>
    </div>
@endsection
