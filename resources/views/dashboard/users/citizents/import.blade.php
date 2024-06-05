@extends('layouts.main')
@section('title', 'Import Data Warga')
@section('main')
    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ route('citizents.import') }}" method="post" enctype="multipart/form-data"
            class="grid grid-cols-12 gap-4">
            @csrf
            <div class="col-span-12 sm:col-span-4 flex flex-col">
                <label for="file" class="text-second">Import Data (.csv)</label>
                <a href="{{ asset('assets/citizent_examples.xlsx') }}" download="examples" class="mb-3">Download Contoh Format</a>
                <input type="file" id="file" name="file"
                    class="input-crud py-2" />
                @error('file')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Import Data</button>
                <a href="{{ route('citizents.index') }}" class="button btn-second text-white">Batal Import</a>
            </div>
        </form>
    </div>
@endsection