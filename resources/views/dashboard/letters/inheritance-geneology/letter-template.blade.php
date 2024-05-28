<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
            top: -40px;
            right: 15px;
        }
    </style>
    {{-- <style>
        .title-surat {
            font-size: 18px;
            text-decoration: underline;
        }

        .title-surat-wrapper {
            width: 100%;
            text-align: center;
            font-weight: bold;
            margin-top: 30px;
            border-bottom: 3px double black;
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
            margin-top: -10px;
        }

        .ttd-text {
            width: 100%;
            text-align: center;
        }

        .w-full {
            width: 100%;
        }

        .title-list {
            width: 150px;
        }

        .table-title tr td {
            font-weight: normal;
        }

        .table-title tr td:nth-child(2) {
            text-align: right;
        }

        .table-title tr td:last-child {
            text-transform: uppercase;
        }

        .flex {
            display: flex;
        }

        .image-full {
            width: 100%;
            position: relative;
            top: 0;
            left: 0;
            border-bottom: 3px solid black;
        }
    </style> --}}
</head>

<body>
    <main style="width: 100%; height: 100%; position: relative;">
        <div class="wrapper-header" style="width: 100%; position: relative;">
            <img src="{{ url('assets/img/letter-header.png') }}" alt="Banner Top" class="image-full"
                style="border-bottom: 3px solid black; width: 100%;">
            <h1 class="center-text"
                style="text-transform: uppercase; font-size: 1.2rem; border-bottom: 2px solid black; width: 23%; margin-top: 24px;">
                Silsilah Waris</h1>
            <table style="width: 100%; margin-top: 32px; padding-bottom: 12px; border-bottom: 1px solid black;">
                <tr>
                    <td style="width: 140px;">Nama</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->citizent->name }} (ALM)</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Dusun/ Lingkungan/ Br</td>
                    <td style="width: 12px;">:</td>
                    <td>Desa</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Desa/ Kelurahan</td>
                    <td style="width: 12px;">:</td>
                    <td>Subagan</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Kecamatan</td>
                    <td style="width: 12px;">:</td>
                    <td>Karangasem</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Kabupaten</td>
                    <td style="width: 12px;">:</td>
                    <td>Karangasem</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Provinsi</td>
                    <td style="width: 12px;">:</td>
                    <td>Bali</td>
                </tr>
            </table>
            <img style="left: 50%; transform: translateX(-50%); position: relative; margin-top: 24px; height: 140px;"
                src="{{ url('uploads/letters/inheritance-geneologies/' . $letter->inheritance_image) }}" alt="">
            <div class="" style="margin-top: 16px;">
                <img src="{{ url('assets/img/keterangan.png') }}" style="width: 330px;" height="auto" alt="">
            </div>
            <p style="margin-top: 24px; text-indent: 42px;">Demikianlah Silsilah Keturunan / waris ini saya buat dengan
                sebenarnya, saya menjamin tidak ada
                keturunan/ahli waris lain selain yang saya sebutkan diatas dan saya bersedia menanggung akibat hukum
                apabila dikemudian hari terjadi silsilah yang saya buat salah/tidak benar serta tanpa melibatkan para
                pejabat yang melegalisir/mengetahui dibawah ini, dipergunakan sebagaimana mestinya.
            </p>
        </div>
        <div class="wrapper-footer" style="margin-top: 12px;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 100%;">
                        <p style="font-size: 0.875rem !important; text-align: center !important;">Mengetahui <br>
                            Kepala Lingkungan {{ $letter->sk->citizent->environmental->name }}
                        </p>
                        @if (isset($letter->sk->environmentalHead))
                            @if ($letter->sk->status_by_village_head === 1 && $letter->sk->environmentalHead->user->signature_image)
                                <img src="{{ url('uploads/users/signatures/' . $letter->sk->environmentalHead->user->signature_image) }}"
                                    style="width: 100%; height: 100px; object-fit: cover;">
                            @else
                                <div class="wrapper-image" style="width: 100%; height: 100px;">
                                </div>
                            @endif
                        {{-- @elseif (Request::is("letters/inheritance-geneology/$letter->id/preview*"))
                            @if (($user->isEnvironmentalHead() && $user->signature_image) || $letter->sk->environmentalHead)
                                <img src="{{ url('uploads/users/signatures/' . $user->signature_image) }}"
                                    style="width: 100%; height: 100px; object-fit: cover;">
                            @else
                                <div class="wrapper-image" style="width: 100%; height: 100px;">
                                </div>
                            @endif --}}
                        @else
                            <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                        @endif
                        <p style="font-size: 0.875rem !important; text-align: center !important;">
                            {{ $letter->sk->environmentalHead && $letter->sk->status_by_environmental_head === 1 ? $letter->sk->environmentalHead->name : '..............' }}
                        </p>
                    </td>
                    <td style="width: 100%;"></td>
                    <td style="width: 100%;">
                        <p style="font-size: 0.875rem !important; text-align: center !important;">Subagan,
                            {{ $letter->sk->created_at->format('d M Y') }} <br> Saya yang membuat
                            Silsilah Keluarga
                        </p>
                        @if ($letter->sk->citizent->user->signature_image)
                            <img src="{{ url('uploads/users/signatures/' . $letter->sk->citizent->user->signature_image) }}"
                                style="width: 100%; height: 100px; object-fit: cover;">
                        @else
                            <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                        @endif
                        <p style="font-size: 0.875rem !important; text-align: center !important;">
                            {{ $letter->sk->citizent->name ? $letter->sk->citizent->name : '..............' }}</p>
                    </td>
                </tr>
            </table>
            <table style="width: 100%; margin-top: 24px;">
                <tr>
                    <td style="width: 100%;">
                        <p style="font-size: 0.875rem !important; text-align: center !important;">Mengetahui <br>
                            Lurah Subagan
                        </p>
                        @if (isset($letter->sk->villageHead))
                            @if ($letter->sk->status_by_village_head === 1 && $letter->sk->villageHead->user->signature_image)
                                <div style="position: relative">
                                    <img class="cap-kelurahan" src="{{ url("assets/img/cap_kelurahan.png") }}" style="width: 85%; height: auto;" alt="">
                                    <img src="{{ url('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image) }}"
                                    style="width: 100%; height: 100px; object-fit: cover;">
                                </div>
                                <p style="font-size: 0.875rem !important; text-align: center !important;">
                                    {{ $letter->sk->villageHead->name }} <br> NIP:
                                    {{ $letter->sk->villageHead->employee_number }}
                                </p>
                            @else
                                <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                                <p style="font-size: 0.875rem !important; text-align: center !important;">
                                    ..............
                                </p>
                            @endif
                        @else
                            <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                            <p style="font-size: 0.875rem !important; text-align: center !important;">
                                ..............
                            </p>
                        @endif
                    </td>
                    <td style="width: 100%;"></td>
                    <td style="width: 100%;">
                        <p style="font-size: 0.875rem !important; text-align: center !important;">Mengetahui <br>
                            Camat Karangasem
                        </p>
                        @if (isset($subdistrictHead->signature_image))
                            <img src="{{ url('uploads/users/signatures/' . $subdistrictHead->signature_image) }}"
                                style="width: 100%; height: 100px; object-fit: cover;">
                            <p style="font-size: 0.875rem !important; text-align: center !important;">
                                {{ $subdistrictHead->name }} <br>
                                NIP: {{ $subdistrictHead->employee_number }}
                            </p>
                        @else
                            <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                            {{-- <p style="font-size: 0.875rem !important; text-align: center !important;">
                                ..............
                            </p> --}}
                        @endif
                        <p style="font-size: 0.875rem !important; text-align: center !important;">
                            {{ $subdistrictHead->name }} <br>
                            NIP: {{ $subdistrictHead->employee_number }}
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>

</html>
