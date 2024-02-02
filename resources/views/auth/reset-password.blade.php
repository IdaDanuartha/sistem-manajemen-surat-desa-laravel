@extends('layouts.auth')
@section('title', 'Reset Password Page')

@section('main')
<form id="formAuthentication" class="mb-3" action="{{ route('reset-password.post') }}" method="POST">
  @csrf
  <input type="hidden" name="token" value="{{ $token }}">
<h1 class="font-extrabold text-6xl text-second">Reset Password</h1>
<div class="mb-3 form-password-toggle">
    <div class="d-flex justify-content-between">
      <label class="text-second" for="password">Password</label>
    </div>
    <div class=" flex items-center">
      <input
        type="password"
        id="password"
        class="input-crud bg-white border-r-0 rounded-r-none w-full"
        name="password"
        placeholder="Masukkan password"
        aria-describedby="password" />
      <span class="pr-4 flex mt-1 justify-center items-center border-r border-t border-b cursor-pointer rounded-l-none h-[54px] rounded-[0.25rem]"><i class="bx bx-hide"></i></span>
    </div>
    @error('password')
      <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3 form-password-toggle">
    <div class="d-flex justify-content-between">
      <label class="text-second" for="password_confirmation">Konfirmasi Password</label>
    </div>
    <div class=" flex items-center">
      <input
        type="password"
        id="password_confirmation"
        class="input-crud bg-white border-r-0 rounded-r-none w-full"
        name="password_confirmation"
        placeholder="Masukkan konfirmasi password"
        aria-describedby="password_confirmation" />
      <span class="pr-4 flex mt-1 justify-center items-center border-r border-t border-b cursor-pointer rounded-l-none h-[54px] rounded-[0.25rem]"><i class="bx bx-hide"></i></span>
    </div>
    @error('password_confirmation')
      <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <button class="button btn-main w-full" type="submit">Ubah Password</button>
  </div>
</form>
@endsection
