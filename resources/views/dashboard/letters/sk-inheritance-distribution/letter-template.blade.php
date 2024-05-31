<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .wrapper {
            /*margin: 2cm;*/
        }

        .title-surat {
            font-size: 18px;
            text-decoration: underline;
        }

        .title-surat-wrapper {
            width: 100%;
            text-align: center;
            font-weight: bold;
            margin-top: 30px;
            padding-bottom: 3px;
        }

        .content-surat {
            margin-top: 15px;
            font-size: 14px;
        }

        table {
            font-size: 14px;
        }

        .paragraph {
            text-indent: 20px;
        }

        .table-mt {
            margin-top: 20px;
        }

        .last-paragraph {
            margin-top: 0;
        }

        .ttd-text {
            width: 100%;
            text-align: center;
        }

        .w-full {
            width: 100%;
        }

        .titik-dua {
            width: 40px;
            text-align: center;
        }

        .title-list {
            width: 50px;
        }

        .table-wrapper .table-mt:first-child {
            margin-top: 0;
        }

        .paragraph-content-wrapper .paragraph:first-child {
            margin-top: 20px;
        }

        .paragraph-content-wrapper .paragraph {
            margin-top: -13px;
        }

        .list-warisan {
            list-style-type: none;
        }

        .list-warisan li {
            margin-top: 6px;
        }

        .list-warisan li:first-child {
            margin-top: 0;
        }

        .image-full {
            width: 100%;
            position: relative;
            top: 0;
            left: 0;
            border-bottom: 3px solid black;
        }

        .cap-kelurahan {
            position: absolute;
            top: -30px;
            right: 60px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <img src="{{ url('assets/img/letter-header.png') }}" alt="Banner Top" class="image-full">

        <div class="title-surat-wrapper">
            <h1 class="title-surat">SURAT PERNYATAAN PEMBAGIAN WARIS</h1>
        </div>
        <div class="content-surat">
            <p class="paragraph">
                Yang bertanda tangan dan / atau cap jempol di bawah:
            </p>
            <div class="table-wrapper">
                @foreach ($letter->families as $key => $item)
                    <div class="table-{{ $key + 1 }} table-mt">
                        <table>
                            <tr class="list-data">
                                <td class="title-list">Nama</td>
                                <td class="titik-dua">:</td>
                                <td><strong>{{ $item->citizent->name }}</strong></td>
                            </tr>
                            <tr>
                                <td class="title-list">Umur</td>
                                <td class="titik-dua">:</td>
                                <td>{{ Carbon\Carbon::parse($item->citizent->birth_date)->age }} Tahun</td>
                            </tr>
                            <tr>
                                <td class="title-list">No KTP</td>
                                <td class="titik-dua">:</td>
                                <td>{{ $item->citizent->national_identify_number }}</td>
                            </tr>
                            <tr>
                                <td class="title-list">Alamat</td>
                                <td class="titik-dua">:</td>
                                <td>{{ $item->citizent->address }}.</td>
                            </tr>
                        </table>
                    </div>
                @endforeach
            </div>
            <div class="paragraph-content-wrapper">
                <p class="paragraph">Dengan ini menerangkan:</p>
                {{-- <p class="paragraph">
                    Bahwa kami selaku ahli waris dari almarhum {{ $letter->citizent->name }} telah sepakat untuk membagi
                    bidang tanah warisan seluas {{ $letter->surface_area }} M2 sesuai dengan data luas tanah yang
                    tercantum dalam Sertifikat Hak Milik no {{ $letter->certificate_number }} / Kel Subagan dengan
                    pembagian sebagai berikut :
                </p> --}}
                <p class="paragraph">
                    Bahwa kami selaku ahli waris telah sepakat untuk membagi
                    bidang tanah warisan seluas {{ $letter->surface_area }} M2 sesuai dengan data luas tanah yang
                    tercantum dalam Sertifikat Hak Milik No {{ $letter->certificate_number }} / Kel Subagan dengan
                    pembagian sebagai berikut :
                </p>
                <ul class="list-warisan">
                    @foreach ($letter->families as $item)
                        <li>Untuk atas nama {{ $item->citizent->name }} dengan luas {{ $item->area }} M2</li>
                    @endforeach
                </ul>
            </div>
            <p class="paragraph last-paragraph">
                Demikian pernyataan pembagian waris kami buat dengan sebenarnya tanpa tekanan atau paksaaan dari
                siapapun, apabila ternyata dikemudian hari isi pernyataan ini tidak benar, maka kami masing-masing para
                ahli waris bersedia mempertanggung jawabkan sesuai ketentuan hukum yang berlaku.
            </p>
        </div>
        <table class="w-full">
            <tr>
                <td class="w-full" style="text-align: center"></td>
                <td class="w-full" style="text-align: center">Subagan, {{ $letter->sk->created_at->format('d M Y') }}
                </td>
            </tr>
        </table>
        <div class="w-full">
            <p style="text-align: center; font-size: 14px"><strong>Dibuat oleh kami para ahli waris,</strong></p>
        </div>
        <table class="w-full">
            @foreach ($letter->families as $item)
                <tr class="ahli-waris-name-wrapper">
                    <td style="width: 30px">{{ $loop->iteration }}.</td>
                    <td style="width: 200px">{{ $item->citizent->name }}</td>
                    <td class="w-full">
                        @if ($item->citizent->user->signature_image)
                            <img width="100px" height="auto"
                                src="{{ url('uploads/users/signatures/' . $item->citizent->user->signature_image) }}"
                                alt="">
                        @endif
                        <div style="border-bottom: 1px dashed black; width: 120px; margin-bottom: 8px;"></div>
                    </td>
                </tr>
            @endforeach
            {{-- <tr class="ahli-waris-name-wrapper">
            <td style="width: 30px">10.</td>
            <td style="width: 200px">Sapiah</td>
            <td class="w-full"> <img width="100px" height="auto" src="{{url('assets/ttd.png')}}" alt=""></td>
        </tr>
        <tr class="ahli-waris-name-wrapper">
            <td style="width: 30px">100.</td>
            <td style="width: 200px">Sapiah</td>
            <td class="w-full"> <img width="100px" height="auto" src="{{url('assets/ttd.png')}}" alt=""></td>
        </tr> --}}
        </table>
        <div class="" style="margin-top: 250px;">
            <table class="w-full">
                <tr>
                    <td class="w-full" style="text-align: center">Saksi - Saksi</td>
                </tr>
            </table>
            <table class="w-full">
                <tr class="w-full">
                    {{-- <td class="ttd-text">Pemberi Kuasa</td> --}}
                    <td class="ttd-text">Kepala Lingkungan {{ $letter->sk->citizent->environmental->name }},</td>
                    <td class="ttd-text">Klian Adat {{ $letter->sk->citizent->environmental->name }},</td>
                </tr>
                <tr style="text-align: center">
                    {{-- <td style="height: 60px;">
                        @if ($letter->sk->citizent->user->signature_image)
                            <img width="100" height="auto"
                                src="{{ url('uploads/users/signatures/' . $letter->sk->citizent->user->signature_image) }}">
                        @endif
                    </td> --}}
                    <td style="height: 60px;">
                        @if(isset($letter->sk->environmentalHead))
                            @if ($letter->sk->status_by_environmental_head === 1 && isset($letter->sk->environmentalHead->user->signature_image))
                                <img width="100" height="auto" src="{{ url('uploads/users/signatures/' . $letter->sk->environmentalHead->user->signature_image) }}"> 
                            @endif
                        @endif
                    </td>
                    <td style="height: 60px;">
                        
                    </td>
                </tr>
                <tr class="w-full">
                    {{-- <td class="ttd-text">
                        <strong style="font-size: 14px">{{ $letter->sk->citizent->name }}</strong>
                    </td> --}}
                    <td class="ttd-text">
                        @if(isset($letter->sk->environmentalHead))
                            @if ($letter->sk->status_by_environmental_head === 1 && isset($letter->sk->environmentalHead->user->signature_image))
                                <strong style="font-size: 14px">
                                    {{ $letter->sk->environmentalHead->name }}
                                </strong>
                            @endif
                        @endif
                    </td>
                </tr>
            </table>
            <table class="w-full table-mt">
                <tr>
                    <td class="w-full" style="text-align: center">Mengetahui / Menguatkan </td>
                </tr>
            </table>
            <table class="w-full table-mt" style="margin-top: 100px">
                <tr class="w-full">
                    <td class="ttd-text">
                        Mengetahui <br>
                        Lurah Subagan
                    </td>
                    <td class="ttd-text">
                        Mengetahui <br>
                        Camat Karangasem
                    </td>
                </tr>
                <tr style="text-align: center">
                    <td style="height: 60px;">
                        @if (isset($letter->sk->villageHead))
                            @if ($letter->sk->status_by_village_head === 1 && $letter->sk->villageHead->user->signature_image)
                                <div style="position: relative">
                                    <img class="cap-kelurahan" src="{{ url("assets/img/cap_kelurahan.png") }}" style="width: 60%; height: auto;" alt="">
                                    <img width="100" height="auto"
                                    src="{{ url('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image) }}">
                                </div>
                            @endif
                        {{-- @elseif (Request::is("letters/sk-inheritance-distribution/$letter->id/preview*"))
                            @if (($user->isVillageHead() && $user->signature_image) || $letter->sk->villageHead)
                                <img width="100" height="auto"
                                    src="{{ url('uploads/users/signatures/' . $user->signature_image) }}">
                            @endif --}}
                        @endif
                    </td>
                    <td style="height: 60px;">
                        @if (isset($subdistrictHead->signature_image))
                            <img src="{{ url('uploads/users/signatures/' . $subdistrictHead->signature_image) }}"
                                style="width: 100; height: auto;">
                        @endif
                    </td>
                </tr>
                <tr class="w-full">
                    <td class="ttd-text">
                        @if ($letter->sk->villageHead && $letter->sk->status_by_village_head === 1)
                            <p>
                                <span style="text-decoration: underline">{{ $letter->sk->villageHead->name }}</span>
                                <br>
                                NIP : {{ $letter->sk->villageHead->employee_number }}
                            </p>
                        @endif
                    </td>
                    <td class="ttd-text" style="font-size: 14px">
                        <p>
                            <span style="text-decoration: underline">{{ $subdistrictHead->name }}</span> <br>
                            NIP : {{ $subdistrictHead->employee_number }}
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
