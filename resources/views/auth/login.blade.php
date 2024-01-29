@extends('layouts.auth')
@section('title') Login Page @endsection

@section('main')
<form id="formAuthentication" class="mb-3" action="{{ route('authenticate') }}" method="POST">
  @csrf
	<h1 class="font-extrabold text-6xl text-second">Login</h1>
  <div class="mb-3 flex flex-col">
    <label for="username" class="text-second">Username</label>
    <input
      type="text"
      class="input-crud bg-white"
      id="username"
      name="username"
      placeholder="masukkan username"
      required
      value="{{ old('username') }}"
      autofocus />
    @error('username')
      <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
  </div>
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
        placeholder="masukkan password"
        aria-describedby="password" />
      <span class="pr-4 flex mt-1 justify-center items-center border-r border-t border-b cursor-pointer rounded-l-none h-[54px] rounded-[0.25rem]"><i class="bx bx-hide"></i></span>
    </div>
    @error('password')
      <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="remember_me" id="remember-me" />
      <label class="form-check-label" for="remember-me"> Remember Me </label>
    </div>
  </div>
  <div class="mb-3">
    <button class="button btn-main w-full" type="submit">Sign in</button>
  </div>
</form>
@endsection
