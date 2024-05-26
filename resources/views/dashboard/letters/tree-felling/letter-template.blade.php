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
    </style>
</head>

<body>
    <main style="width: 100%; height: 100%; position: relative;">
        <div class="wrapper-header" style="width: 100%; position: relative;">
            <img src="{{ url('assets/img/letter-header.png') }}" alt="Banner Top" class="image-full"
                style="border-bottom: 3px solid black; width: 100%;">
            <table style="width: 100%; margin-top: 24px;">
                <tr>
                    <td style="width: 100%;">Hal:
                        {{ $letter->regarding }}</td>
                    <td style="width: 100%;">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 30%;">Yth,</td>
                                <td>Subagan, {{ $letter->sk->created_at->format('d M Y') }} <br> Kepada, <br> Kepala
                                    Dinas Lingkungan {{ $letter->sk->citizent->environmental->name }}
                                    Kabupaten Karangasem di <u>Amlapura</u></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table style="width: 100%; margin-top: 24px;">
                <tr>
                    <td colspan="3" style="padding-bottom: 8px !important;">Dengan hormat, <br>
                        Yang bertanda tangan dibawah ini :</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Nama</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->sk->citizent->name }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Pekerjaan</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->sk->citizent->work }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Alamat</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->sk->citizent->address }}.</td>
                </tr>
                <tr>
                    <td style="width: 140px;">No. HP</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->sk->citizent->phone_number }}</td>
                </tr>
            </table>
            <p style="margin-top: 32px; text-indent: 42px;">Dalam rangka mengantisipasi dan meminimalisasi terjadinya
                bencana dan musibah yang diakibatkan oleh
                pohon perindang serta pohon lainnya, maka dengan ini kami mohon bantuan Bapak untuk menata pohon
                perindang yang ada di {{ $letter->description }}.
            </p>
            <p style="margin-top: 12px; text-indent: 42px;">Demikian kami sampaikan atas bantuan dan kerjasamanya kami
                ucapkan banyak terimakasih.
            </p>
        </div>
        <div class="wrapper-footer" style="position: absolute; width: 100%; bottom: 0; left: 0; right: 0;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 100%;">
                        <p style="font-size: 0.875rem !important; text-align: center !important;">Mengetahui <br>
                            Kepala Lingkungan Jasri Kelod
                        </p>
                        @if (isset($letter->sk->environmentalHead))
                            @if ($letter->sk->status_by_environmental_head === 1 && $letter->sk->environmentalHead->user->signature_image)
                                <img src="{{ url('uploads/users/signatures/' . $letter->sk->environmentalHead->user->signature_image) }}"
                                    style="width: 120px; position: relative; left: 120px; height: 100px; object-fit: cover;">
                            @else
                                <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                            @endif
                        {{-- @elseif (Request::is("letters/tree-felling/$letter->id/preview*"))
                            @if (($user->isenvironmentalHead() && $user->signature_image) || $letter->sk->environmentalHead)
                                <img src="{{ url('uploads/users/signatures/' . $user->signature_image) }}"
                                    style="width: 100%; height: 100px; object-fit: cover;">
                            @else
                                <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                            @endif --}}
                        @else
                            <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                        @endif
                        @if ($letter->sk->environmentalHead && $letter->sk->status_by_environmental_head === 1)
                            <p style="font-size: 0.875rem !important; text-align: center !important;">
                                {{ $letter->sk->environmentalHead->name }}</p>
                        @else
                            <p style="font-size: 0.875rem !important; text-align: center !important;">
                                ..................</p>
                        @endif
                    </td>
                    <td style="width: 100%;">
                        <p style="font-size: 0.875rem !important; text-align: center !important;">Pemohon</p>
                        @if ($user->isCitizent() && $user->signature_image)
                            <img src="{{ url('uploads/users/signatures/' . $user->signature_image) }}"
                                style="width: 120px; height: auto; object-fit: cover; position: relative; right: -120px;">
                        @elseif(isset($letter->sk->citizent->user->signature_image))
                            <img src="{{ url('uploads/users/signatures/' . $letter->sk->citizent->user->signature_image) }}"
                                style="width: 120px; height: auto; object-fit: cover;">
                        @else
                            <div class="wrapper-image" style="width: 100%; height: 100px;">
                            </div>
                        @endif
                        @if ($letter->sk->citizent->name)
                            <p style="font-size: 0.875rem !important; text-align: center !important;">
                                {{ $letter->sk->citizent->name }}</p>
                        @else
                            <p style="font-size: 0.875rem !important; text-align: center !important;">
                                ..................</p>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </main>

    {{-- <img src="{{ url('assets/img/letter-header.png') }}" class="image-full" alt="">
    <div class="wrapper">
        <p>Subagan, {{ $letter->sk->created_at->format('d M Y') }}</p>
        <p style="margin-top: -10px;">Kepada,</p>
        <p style="margin-top: -10px;">Yth. <br>Kepala Dinas Lingkungan {{ $letter->sk->citizent->environmental->name }}
            Kabupaten Karangasem di <u>Amlapura</u></p>
        <table class="table-hal" style="margin-top: -10px; text-align: left">
            <tr>
                <td>Hal</td>
                <td>:</td>
                <td>
                    {{ $letter->regarding }}
                </td>
            </tr>
        </table>
    </div> --}}
</body>

</html>
