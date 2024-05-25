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
                    <input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->name }}" readonly />
                </div>
                @if (auth()->user()->isSectionHead() || auth()->user()->isVillageHead())
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label class="text-second">NIP</label>
                        <input type="text" class="input-crud"
                            value="{{ auth()->user()->authenticatable->employee_number }}" readonly />
                    </div>
                @endif
                @if (auth()->user()->isSectionHead())
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label class="text-second">Jabatan</label>
                        <input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->position }}"
                            readonly />
                    </div>
                @endif
                @if (auth()->user()->isEnvironmentalHead() || auth()->user()->isCitizent())
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Lingkungan</label>
                    <input type="text" class="input-crud"
                        value="{{ auth()->user()->authenticatable->environmental->name . ' (' . auth()->user()->authenticatable->environmental->code . ')' }}"
                        readonly />
                </div>
                @endif
                @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
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
                @if (auth()->user()->isEnvironmentalHead())
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label class="text-second">Nomor Telepon</label>
                        <input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->phone ?? "-" }}" readonly />
                    </div>
                @endif
                @if (auth()->user()->isCitizent())
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label class="text-second">NIK</label>
                        <input type="text" class="input-crud"
                            value="{{ auth()->user()->authenticatable->national_identify_number }}" readonly />
                    </div>
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label class="text-second">Nomor KK</label>
                        <input type="text" class="input-crud"
                            value="{{ auth()->user()->authenticatable->family_card_number }}" readonly />
                    </div>
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label class="text-second">Nomor Telepon</label>
                        <input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->phone_number }}"
                            readonly />
                    </div>
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label class="text-second">Tempat Lahir</label>
                        <input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->birth_place }}"
                            readonly />
                    </div>
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label class="text-second">Tanggal Lahir</label>
                        <input type="text" class="input-crud" value="{{ auth()->user()->authenticatable->birth_date }}"
                            readonly />
                    </div>
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label class="text-second">Jenis Kelamin</label>
                        <input type="text" class="input-crud"
                            value="{{ auth()->user()->authenticatable->gender->label() }}" readonly />
                    </div>
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label class="text-second">Golongan Darah</label>
                        <input type="text" class="input-crud"
                            value="{{ auth()->user()->authenticatable->blood_group->label() }}" readonly />
                    </div>
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label class="text-second">Agama</label>
                        <input type="text" class="input-crud"
                            value="{{ auth()->user()->authenticatable->religion->label() }}" readonly />
                    </div>
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label class="text-second">Status Pernikahan</label>
                        <input type="text" class="input-crud"
                            value="{{ auth()->user()->authenticatable->marital_status->label() }}" readonly />
                    </div>
                @endif
                @if (auth()->user()->signature_image)
                    <div class="col-12 mb-4 flex flex-col">
                        <label class="text-second">TTE</label>
                        <img src="{{ asset('uploads/users/signatures/' . auth()->user()->signature_image) }}"
                            alt="Signature Image" class="w-[250px]" />
                    </div>
                @endif
                @if (auth()->user()->isCitizent())
                    @if (auth()->user()->authenticatable->id_card_file)
                        <div class="col-12 mb-4 flex flex-col">
                            <label class="text-second">Kartu Tanda Penduduk</label>
                            <img src="{{ asset('uploads/users/id_cards/' . auth()->user()->authenticatable->id_card_file) }}"
                                alt="ID Card Image" class="w-[250px]" />
                        </div>
                    @endif
                    @if (auth()->user()->authenticatable->family_card_file)
                        <div class="col-12 mb-4 flex flex-col">
                            <label class="text-second">Kartu Keluarga</label>
                            <img src="{{ asset('uploads/users/family_cards/' . auth()->user()->authenticatable->family_card_file) }}"
                                alt="Family Card Image" class="w-[250px]" />
                        </div>
                    @endif
                    @if (auth()->user()->authenticatable->birth_certificate_file)
                        <div class="col-12 mb-4 flex flex-col">
                            <label class="text-second">Akta Kelahiran</label>
                            <img src="{{ asset('uploads/users/birth_certificates/' . auth()->user()->authenticatable->birth_certificate_file) }}"
                                alt="Birth Certificate Image" class="w-[250px]" />
                        </div>
                    @endif
                    @if (auth()->user()->authenticatable->marriage_certificate_file)
                        <div class="col-12 mb-4 flex flex-col">
                            <label class="text-second">Kartu Nikah</label>
                            <img src="{{ asset('uploads/users/marriage_certificates/' . auth()->user()->authenticatable->marriage_certificate_file) }}"
                                alt="Marriage Certificate Image" class="w-[250px]" />
                        </div>
                    @endif
                    @if (auth()->user()->authenticatable->land_certificate_file)
                        <div class="col-12 mb-4 flex flex-col">
                            <label class="text-second">Akta Tanah</label>
                            <img src="{{ asset('uploads/users/land_certificates/' . auth()->user()->authenticatable->land_certificate_file) }}"
                                alt="Land Certificate Image" class="w-[250px]" />
                        </div>
                    @endif
                @endif
                <div class="col-12 mt-5">
                    <a href="{{ route('profile.edit') }}" class="button btn-main">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection
