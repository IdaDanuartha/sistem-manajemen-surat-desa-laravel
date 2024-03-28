@extends('layouts.main')
@section('title', 'Profile Pengguna')
@section('main')
<div class="mt-[20px] p-0 flex gap-5 lg:flex-row flex-col">
    {{-- <div class="table-wrapper p-[18px] w-full h-fit md:max-w-[300px]">
        @if (isset(auth()->user()->profile_image))
            <img src="{{ asset('uploads/users/' . auth()->user()->profile_image) }}" alt="Profile Image" class="rounded w-full edit-profile-preview-img aspect-square object-cover object-center h-auto"/>
        @else
            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Profile Image" class="edit-profile-preview-img rounded w-full aspect-square object-cover object-center h-auto"/>
        @endif
    </div> --}}
    <div class="table-wrapper w-full">
        <div class="row">
            <div class="col-md-6 col-12 mb-4 flex flex-col">
                <label class="text-second">Nama Lengkap</label>
                <input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->name ?? auth()->user()->authenticatable->citizent->name }}" readonly />
            </div>
            @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Username</label>
                    <input type="text" class="input-crud" value="{{ auth()->user()->username }}" readonly />
                </div>
            @endif
            <div class="col-md-6 col-12 mb-4 flex flex-col">
                <label class="text-second">Email</label>
                <input type="text" class="input-crud" value="{{ auth()->user()->email }}" readonly />
            </div>
            <div class="col-md-6 col-12 mb-4 flex flex-col">
                <label class="text-second">Role</label>
                <input type="text" class="input-crud" value="{{ auth()->user()->role->label() }}" readonly />
            </div>
            @if(auth()->user()->isVillageHead() || auth()->user()->isEnvironmentalHead() || auth()->user()->isSectionHead() || auth()->user()->isCitizent())
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">NIK</label>
                    <input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->national_identify_number ?? auth()->user()->authenticatable->citizent->national_identify_number }}" readonly />
                </div>
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Nomor KK</label>
                    <input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->family_card_number ?? auth()->user()->authenticatable->citizent->family_card_number }}" readonly />
                </div>
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Nomor Telepon</label>
                    <input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->phone_number ?? auth()->user()->authenticatable->citizent->phone_number }}" readonly />
                </div>
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Tempat Lahir</label>
                    <input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->birth_place ?? auth()->user()->authenticatable->citizent->birth_place }}" readonly />
                </div>
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Tanggal Lahir</label>
                    <input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->birth_date ?? auth()->user()->authenticatable->citizent->birth_date->format('d M Y') }}" readonly />
                </div>
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Jenis Kelamin</label>
                    <input type="text" class="input-crud" value="{{ isset(auth()->user()->authenticatable->gender) ? auth()->user()->authenticatable->gender->label() : auth()->user()->authenticatable->citizent->gender->label() }}" readonly />
                </div>
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Golongan Darah</label>
                    <input type="text" class="input-crud" value="{{ isset(auth()->user()->authenticatable->blood_group) ? auth()->user()->authenticatable->blood_group->label() : auth()->user()->authenticatable->citizent->blood_group->label() }}" readonly />
                </div>
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Agama</label>
                    <input type="text" class="input-crud" value="{{ isset(auth()->user()->authenticatable->religion) ? auth()->user()->authenticatable->religion->label() : auth()->user()->authenticatable->citizent->religion->label() }}" readonly />
                </div>
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Status Pernikahan</label>
                    <input type="text" class="input-crud" value="{{ isset(auth()->user()->authenticatable->marital_status) ? auth()->user()->authenticatable->marital_status->label() : auth()->user()->authenticatable->citizent->marital_status->label() }}" readonly />
                </div>
                @endif
            @if (auth()->user()->signature_image)
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">TTE</label>
                    <img src="{{ asset('uploads/users/signatures/' . auth()->user()->signature_image) }}" alt="Signature Image" class="w-[200px]"/>
                </div>
            @endif     
            <div class="col-12">
                <a href="{{ route('profile.edit') }}" class="button btn-main">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
@endsection
