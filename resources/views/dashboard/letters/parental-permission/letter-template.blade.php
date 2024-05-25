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
    </style>
</head>

<body>
    <main style="width: 100%; height: 100%; position: relative;">
        <div class="wrapper-header" style="width: 100%; position: relative;">
            <img src="{{ url('assets/img/letter-header.png') }}" alt="Banner Top" class="image-full"
                style="border-bottom: 3px solid black; width: 100%;">
            <h1 class="center-text"
                style="text-transform: uppercase; font-size: 1.2rem; border-bottom: 2px solid black; width: 53%; margin-top: 24px;">
                Surat Pernyataan Ijin Keluarga</h1>
            <table style="width: 100%; margin-top: 32px;">
                <tr>
                    <td colspan="3" style="padding-bottom: 8px !important;">Yang bertanda tangan di bawah ini,</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Nama</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->sk->citizent->name }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Umur</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->sk->citizent->birth_date->diffInYears(now()->endOfYear()) }} Tahun</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Pekerjaan</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->sk->citizent->work }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Alamat</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->sk->citizent->address }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">No. HP</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->sk->citizent->phone_number }}</td>
                </tr>
            </table>
            <table style="width: 100%; margin-top: 24px;">
                <tr>
                    <td colspan="3" style="padding-bottom: 8px !important;">Selaku
                        {{ $letter->relationship_status->label() }} dari yang dibawah ini :</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Nama</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->citizent->name }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Umur</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->citizent->birth_date->diffInYears(now()->endOfYear()) }} Tahun</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Pekerjaan</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->citizent->work }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Status</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->citizent->marital_status->label() }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;">Alamat</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->citizent->address }}</td>
                </tr>
            </table>
            <p style="margin-top: 32px; text-indent: 42px;">Berdasarkan Surat Pengantar Kepala Lingkungan
                {{ $letter->sk->citizent->environmental->name }} No: {{ $letter->sk->cover_letter_number }}, tanggal
                {{ $letter->sk->created_at->format('d M Y') }} menyatakan bahwa memang benar orang tersebut diatas
                memberikan Ijin Kepada @if ($letter->relationship_status->value === 1 || $letter->relationship_status->value === 2)
                    Anaknya
                @elseif($letter->relationship_status->value === 3)
                    Istrinya
                @else
                    Suaminya
                @endif Atas Nama : {{ $letter->citizent->name }} untuk {{ $letter->description }}
            </p>
            <p style="margin-top: 12px; text-indent: 42px;">Demikian surat Pernyataan ini, saya buat dengan penuh
                tanggung jawab dan benar.
            </p>
        </div>
        <div class="wrapper-footer" style="position: absolute; width: 100%; bottom: 0; left: 0; right: 0;">
            <table>
                <tr>
                    <td style="width: 100%;">
                        <p style="font-size: 0.875rem !important; text-align: center !important;">Calon PMI memohon Ijin
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
                    <td style="width: 100%;">
                        <p style="font-size: 0.875rem !important; text-align: center !important;">Mengetahui, <br> Lurah
                            Subagan
                        </p>
                        @if (isset($letter->sk->villageHead))
                            @if ($letter->sk->status_by_village_head === 1 && isset($letter->sk->villageHead->user->signature_image))
                                <img src="{{ url('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image) }}"
                                    style="width: 100%; height: 100px; object-fit: cover;">
                            @else
                                <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                            @endif
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
                    <td style="width: 100%;">
                        <p style="font-size: 0.875rem !important; text-align: center !important;">Subagan,
                            {{ $letter->sk->created_at->format('d M Y') }} <br>
                            Yang Membuat Pernyataan/ yang memberikan Ijin</p>
                        @if ($letter->sk->citizent->user->signature_image)
                            <img src="{{ url('uploads/users/signatures/' . $letter->sk->citizent->user->signature_image) }}"
                                style="width: 100%; height: 100px; object-fit: cover;">
                        @elseif (Request::is("letters/parental-permission/$letter->id/preview*"))
                            @if (($user->isCitizent() && $user->signature_image) || $letter->sk->citizent->user->signature_image)
                                <img src="{{ url('uploads/users/signatures/' . $user->signature_image) }}"
                                    style="width: 100%; height: 100px; object-fit: cover;">
                            @else
                                <div class="wrapper-image" style="width: 100%; height: 100px;">
                                </div>
                            @endif
                        @else
                            <div class="wrapper-image" style="width: 100%; height: 100px;">
                            </div>
                        @endif
                        <p style="font-size: 0.875rem !important; text-align: center !important;">
                            {{ $letter->sk->citizent->name }}</p>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>

</html>
