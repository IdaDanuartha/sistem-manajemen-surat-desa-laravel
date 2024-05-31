<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .center-text {
            position: relative;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        table td {
            width: 100%;
            font-size: 0.913rem !important;
            line-height: 130%;
        }

        p {
            font-size: 0.913rem !important;
            line-height: 130%;
        }

        .cap-kelurahan {
            position: absolute;
            top: -30px;
            right: 15px;
        }
    </style>
</head>

<body>
    <main style="width: 100%; height: 100%; position: relative;">
        <div class="wrapper-header" style="width: 100%; position: relative;">
            <img src="{{ url('assets/img/letter-header.png') }}" alt="Banner Top" class="image-full"
                style="border-bottom: 3px solid black; width: 100%;">
            <h1 class="center-text"
                style="text-transform: uppercase; font-size: 1.2rem; border-bottom: 2px solid black; width: 39.5%; margin-top: 24px;">
                Surat Keterangan Hibah</h1>
            <table style="width: 100%; margin-top: 24px;">
                <tr>
                    <td colspan="3" style="padding-bottom: 8px !important;">Yang bertanda tangan di bawah ini,</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Nama</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->sk->citizent->name }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Tempat Tanggal Lahir</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->sk->citizent->birth_place . ', ' . $letter->sk->citizent->birth_date->format('d-m-Y') }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Jenis Kelamin</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->sk->citizent->gender->label() }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Pekerjaan</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->sk->citizent->work }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">No. KTP</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->sk->citizent->national_identify_number }}</td>
                </tr>
            </table>
            <table style="width: 100%; margin-top: 24px;">
                <tr>
                    <td colspan="3" style="padding-bottom: 8px !important;">Dengan ini saya mengibahkan kendaraan
                        dengan data sebagai berikut :</td>
                </tr>
                <tr>
                    <td style="width: 140px;">No. Polisi</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->police_number }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Nama Pemilik</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->owner_name }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Alamat</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->address }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Merk/Type</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->brand }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Jenis</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->type }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Model</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->model }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Tahun Pembuatan</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->production_year }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Isi Selinder</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->cylinder_filling }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">No. Rangka</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->frame_number }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">No. Mesin</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->machine_number }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">No. BPKB</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->bpkb_number }}</td>
                </tr>
            </table>
            <table style="width: 100%; margin-top: 24px;">
                <tr>
                    <td colspan="3" style="padding-bottom: 8px !important;">Yang bertanda tangan di bawah ini,</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Nama</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->citizent->name }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Tempat Tanggal Lahir</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->citizent->birth_place . ', ' . $letter->citizent->birth_date->format('d-m-Y') }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Jenis Kelamin</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->citizent->gender->label() }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Pekerjaan</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->citizent->work }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Alamat</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->citizent->address }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">No. KTP</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->citizent->national_identify_number }}</td>
                </tr>
            </table>
            <img src="{{ url('assets/img/letter-header.png') }}" alt="Banner Top" class="image-full"
                style="border-bottom: 3px solid black; width: 100%;">
            <p style="margin-top: 62px; text-indent: 42px;">Demikian surat pernyataan ini saya buat dengan sebenarnya
                untuk dapat dipergunakan sebagai mana
                mestinya.
            </p>
        </div>
        <div class="wrapper-footer" style="margin-top: 62px;">
            <table style="width: 100%">
                <tr>
                    <td style="width: 100%;">
                        <p style="font-size: 0.875rem !important; text-align: center !important;">Yang menerima Hibah
                        </p>
                        @if ($letter->citizent->user->signature_image)
                            <img src="{{ url('uploads/users/signatures/' . $letter->citizent->user->signature_image) }}"
                                style="width: 100%; height: 100px; object-fit: cover;">
                        @else
                            <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                        @endif
                        <p style="font-size: 0.875rem !important; text-align: center !important;">
                            {{ $letter->citizent->name }}</p>
                    </td>
                    <td style="width: 100%;"></td>
                    <td style="width: 100%;">
                        <p style="font-size: 0.875rem !important; text-align: center !important;">Subagan,
                            {{ $letter->sk->created_at->format('d M Y') }} <br>
                            Yang membuat pernyataan memberi hibah</p>
                        @if (isset($letter->sk->citizent->user->signature_image))
                            <img src="{{ url('uploads/users/signatures/' . $letter->sk->citizent->user->signature_image) }}"
                                style="width: 100%; height: 100px; object-fit: cover;">
                        {{-- @elseif (Request::is("letters/sk-grant/$letter->id/preview*"))
                            @if ($user->isCitizent() && $user->signature_image)
                                <img src="{{ url('uploads/users/signatures/' . $user->signature_image) }}"
                                    style="width: 100%; height: 100px; object-fit: cover;">
                            @else
                                <div class="wrapper-image" style="width: 100%; height: 100px;">
                                </div>
                            @endif --}}
                        @else
                            <div class="wrapper-image" style="width: 100%; height: 100px;">
                            </div>
                        @endif
                        <p style="font-size: 0.875rem !important; text-align: center !important;">
                            {{ $letter->sk->citizent->name }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%;"></td>
                    <td style="width: 100%;">
                        <p style="font-size: 0.875rem !important; text-align: center !important;">Mengetahui, <br> Lurah
                            Subagan
                        </p>
                        @if (isset($letter->sk->villageHead))
                            @if ($letter->sk->status_by_village_head === 1 && $letter->sk->villageHead->user->signature_image)
                                <div style="position: relative">
                                    <img class="cap-kelurahan" src="{{ url("assets/img/cap_kelurahan.png") }}" style="width: 85%; height: auto;" alt="">
                                    <img src="{{ url('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image) }}"
                                        style="width: 100%; height: 100px; object-fit: cover;">
                                </div>
                            @else
                            <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                            @endif
                        {{-- @elseif (Request::is("letters/sk-grant/$letter->id/preview*"))
                            @if (($user->isVillageHead() && $user->signature_image) || $letter->sk->villageHead)
                                <img src="{{ url('uploads/users/signatures/' . $user->signature_image) }}"
                                    style="width: 100%; height: 100px; object-fit: cover;">
                            @else
                                <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                            @endif --}}
                        @else
                            <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                        @endif
                        @if ($letter->sk->villageHead && $letter->sk->status_by_village_head === 1)
                            <p style="font-size: 0.875rem !important; text-align: center !important;">
                                {{ $letter->sk->villageHead->name }} <br> NIP :
                                {{ $letter->sk->villageHead->employee_number }}</p>
                        @else
                            <p style="opacity: 0;">Lorem ipsum dolor sit amet consectetur consectetur</p>
                        @endif
                    </td>
                    <td style="width: 100%;"></td>
                </tr>
            </table>
        </div>
    </main>
</body>

</html>
