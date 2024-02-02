@extends('layouts.auth')
@section('title') Login Page @endsection

@section('main')
<form id="formAuthentication" class="mb-3" action="{{ route('authenticate') }}" method="POST">
  @csrf
  <div class="border border-[#6562E83D] bg-[#6562E814] w-fit rounded-sm px-[20px] py-[12px] text-primary text-sm font-medium">Login Account</div>
	<h1 class="font-extrabold text-5xl text-second mt-3">
      Log in to Our <br>
      System Management
    </h1>
  <div class="mb-3 flex flex-col">
    <label for="email" class="text-second">Email</label>
    <input
      type="text"
      class="input-crud bg-white"
      id="email"
      name="email"
      placeholder="Masukkan email"
      required
      @if (isset($_COOKIE["email"]))
        value="{{ $_COOKIE['email'] }}"
      @else
        value="{{ old('email') }}"
      @endif
      autofocus />
    @error('email')
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
        @if (isset($_COOKIE["password"]))
          value="{{ $_COOKIE['password'] }}"
        @else
          value="{{ old('password') }}"
        @endif
        placeholder="Masukkan password"
        aria-describedby="password" />
      <span class="pr-4 flex mt-1 justify-center items-center border-r border-t border-b cursor-pointer rounded-l-none h-[54px] rounded-[0.25rem]"><i class="bx bx-hide"></i></span>
    </div>
    @error('password')
      <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3 flex justify-content-between">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="remember" id="remember-me" checked />
      <label class="form-check-label" for="remember-me"> Remember Me </label>
    </div>
    <div class="form-check">
      <a href="{{ route('forgot-password') }}" class="form-check-label text-xs">Forgot Password?</a>
    </div>
  </div>
  <div class="mb-3">
    <button class="button btn-main w-full justify-center py-3 flex gap-3 items-center" type="submit">
      Login Account
      <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_379_1053)">
          <path d="M3.25117 0.488306C3.07459 0.534445 2.91609 0.608 2.79831 0.756695C2.60092 1.00583 2.59678 1.36764 2.79573 1.6172C2.83423 1.6655 2.87678 1.71092 2.9205 1.75464C4.13789 2.97253 5.35562 4.19006 6.57362 5.40731C6.60109 5.43475 6.63228 5.45847 6.69631 5.51378C6.64737 5.54256 6.60748 5.55633 6.58059 5.58317C5.35264 6.80895 4.12636 8.03636 2.89845 9.26217C2.68198 9.47828 2.59137 9.72564 2.68414 10.0261C2.82206 10.4726 3.39192 10.6539 3.76203 10.3687C3.80326 10.3369 3.84273 10.3023 3.87953 10.2655C5.29123 8.85453 6.7027 7.44333 8.1137 6.03161C8.37739 5.76778 8.43142 5.43989 8.25612 5.14231C8.21375 5.07042 8.15456 5.0065 8.09506 4.94695C6.72151 3.57158 5.34606 2.19814 3.97353 0.821778C3.82142 0.66925 3.66448 0.533167 3.44687 0.48825C3.38164 0.488305 3.31639 0.488306 3.25117 0.488306Z" fill="white"/>
        </g>
        <defs>
          <clipPath id="clip0_379_1053">
            <rect width="10" height="10" fill="white" transform="matrix(1 0 0 -1 0.5 10.5)"/>
          </clipPath>
        </defs>
      </svg>

    </button>
  </div>
</form>
@endsection
