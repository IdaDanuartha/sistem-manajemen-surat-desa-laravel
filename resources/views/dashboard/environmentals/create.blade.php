@extends('layouts.main')
@section('title', 'Tambah Lingkungan')
@section('main')

    <div class="table-wrapper mt-[20px]">
        <form action="{{ route('environmentals.store') }}" method="post"
            class="grid grid-cols-12 gap-4">
            @csrf
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="code" class="text-second mb-1">Kode Lingkungan</label>
                <input type="text" class="input-crud" name="code" id="code" value="{{ old('code') }}"
                    placeholder="Masukkan Kode Lingkungan..." required />
                @error('code')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" name="name" id="name" value="{{ old('name') }}"
                    placeholder="Masukkan Nama Lingkungan..." required />
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Tambah Lingkungan</button>
                <a href="{{ route('environmental-heads.index') }}"
                    class="button btn-second text-white" type="reset">Batal
                    Tambah</a>
            </div>
        </form>
    </div>
@endsection
