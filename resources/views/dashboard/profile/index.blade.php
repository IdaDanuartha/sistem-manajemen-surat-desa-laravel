@extends('layouts.main')
@section('title', 'Profile Pengguna')
@section('main')
<div class="table-wrapper mt-[20px] p-0 rounded-b-[0px]">
    <div class="square h-[240px] bg-[#5F84E9] rounded-t-[10px]"></div>
    <div class="profile-wrapper relative py-[24px] ps-[24px] md:ps-[222px]">
        @if (auth()->user()->authenticatable->profile_image)
					<img src="{{ asset('uploads/users/' . auth()->user()->authenticatable->profile_image) }}" alt="Profile Image" class="hidden md:inline-block object-cover object-center rounded-circle w-[158px] h-[158px] absolute top-[-79px] left-[32px]"/>
				@else
					<img src="{{ asset('assets/img/avatars/1.png') }}" alt="Profile Image" class="hidden md:inline-block rounded-circle w-[158px] h-[158px] object-cover object-center absolute top-[-79px] left-[32px]"/>
				@endif
        <h2 class="text-[1.75rem] font-bold text-[#282421] mb-[6px]">{{ auth()->user()->authenticatable->name }}</h2>
        <p class="text-[0.913rem] text-[rgba(40, 36, 33, 52%)] mb-0">{{ auth()->user()->role->label() }}</p>
    </div>
</div>
<div class="table-wrapper rounded-t-[0px]">
    <div class="row">
			<div class="col-6 mb-4 flex flex-col">
				<label class="text-second">Nama Lengkap</label>
				<input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->name }}" readonly />
			</div>
			@if(auth()->user()->isAdmin())
			<div class="col-6 mb-4 flex flex-col">
				<label class="text-second">Username</label>
				<input type="text" class="input-crud" value="{{ auth()->user()->username }}" readonly />
			</div>
			@endif
			<div class="col-6 mb-4 flex flex-col">
				<label class="text-second">Email</label>
				<input type="text" class="input-crud" value="{{ auth()->user()->email }}" readonly />
			</div>
			<div class="col-6 mb-4 flex flex-col">
				<label class="text-second">Role</label>
				<input type="text" class="input-crud" value="{{ auth()->user()->role->label() }}" readonly />
			</div>
			@if(!auth()->user()->isAdmin())
				<div class="col-6 mb-4 flex flex-col">
					<label class="text-second">NIK</label>
					<input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->national_identify_number }}" readonly />
				</div>
				<div class="col-6 mb-4 flex flex-col">
					<label class="text-second">Nomor KK</label>
					<input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->family_card_number }}" readonly />
				</div>
				<div class="col-6 mb-4 flex flex-col">
					<label class="text-second">Nomor Telepon</label>
					<input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->phone_number }}" readonly />
				</div>
				<div class="col-6 mb-4 flex flex-col">
					<label class="text-second">Tempat Lahir</label>
					<input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->birth_place }}" readonly />
				</div>
				<div class="col-6 mb-4 flex flex-col">
					<label class="text-second">Tanggal Lahir</label>
					<input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->birth_date->format('d M Y') }}" readonly />
				</div>
				<div class="col-6 mb-4 flex flex-col">
					<label class="text-second">Jenis Kelamin</label>
					<input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->gender->label() }}" readonly />
				</div>
				<div class="col-6 mb-4 flex flex-col">
					<label class="text-second">Golongan Darah</label>
					<input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->blood_group->label() }}" readonly />
				</div>
				<div class="col-6 mb-4 flex flex-col">
					<label class="text-second">Agama</label>
					<input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->religion->label() }}" readonly />
				</div>
				<div class="col-6 mb-4 flex flex-col">
					<label class="text-second">Status Pernikahan</label>
					<input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->marital_status->label() }}" readonly />
				</div>
			@endif
			<div class="col-12">
				<a href="{{ route('profile.edit') }}" class="button btn-main">Edit Profile</a>
			</div>
    </div>
</div>
@endsection
