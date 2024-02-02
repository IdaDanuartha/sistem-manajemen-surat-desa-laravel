@extends('layouts.auth')
@section('title') Reset Password Page @endsection

@section('main')
<form id="formAuthentication" class="mb-3" action="{{ route('forgot-password.post') }}" method="POST">
  @csrf
<h1 class="font-extrabold text-6xl text-second">Forgot Password</h1>
  <div class="mb-3 flex flex-col">
    <label for="email" class="text-second">Email</label>
    <input
      type="text"
      class="input-crud bg-white"
      id="email"
      name="email"
      placeholder="Masukkan email"
      required
      autofocus />
    @error('email')
      <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <button class="button btn-main w-full" type="submit">Kirim Email</button>
  </div>
</form>
@endsection
