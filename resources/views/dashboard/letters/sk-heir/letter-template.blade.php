<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .wrapper{
            /*margin: 2cm;*/
        }
        .title-surat{
            font-size: 18px;
            text-decoration: underline;
        }
        .title-surat-wrapper{
            width: 100%;
            text-align: center;
            font-weight: bold;
            margin-top: 30px;
            /* border-bottom: 3px double black; */
            padding-bottom: 3px;
        }
        .content-surat{
            margin-top: 15px;
            font-size: 14px;
        }
        table{
            font-size: 14px;
        }
        .paragraph{
            text-indent: 20px;
        }
        .table-mt{
            margin-top: 20px;
        }
        .last-paragraph{
            margin-top: -10px;
        }
        .ttd-text{
            width: 100%;
            text-align: center;
        }
        .w-full{
            width: 100%;
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
        <h1 class="title-surat">SURAT KUASA</h1>
    </div>
    <div class="content-surat">
        <p   class="paragraph">
            Yang bertanda tangan di bawah ini:
        </p>
        <div class="table-wrapper">
            <div class="table-1">
                <table>
                    <tr>
                        <td style="width: 20px">1</td>
                        <td>Nama</td>
                        <td>:</td>
                        <td><strong>{{ $letter->sk->citizent->name }}</strong></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Umur</td>
                        <td>:</td>
                        <td>{{ Carbon\Carbon::parse($letter->sk->citizent->birth_date)->age }} Tahun</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Pekerjaan</td>
                        <td>:</td>
                        <td>{{ $letter->sk->citizent->work }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>No KTP</td>
                        <td>:</td>
                        <td>{{ $letter->sk->citizent->national_identify_number }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $letter->sk->citizent->address }}.</td>
                    </tr>
                </table>
            </div>
            <div class="table-mt">
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: center;">Selanjutnya di sebut “ <strong>Pemberi Kuasa</strong> ”</td>
                    </tr>
                </table>
            </div>
            <div class="table-2 table-mt">
                <table>
                    <tr>
                        <td style="width: 20px">2</td>
                        <td>Nama</td>
                        <td>:</td>
                        <td><strong>{{ $letter->citizent->name }}</strong></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Umur</td>
                        <td>:</td>
                        <td>{{ Carbon\Carbon::parse($letter->citizent->birth_date)->age }} Tahun</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Pekerjaan</td>
                        <td>:</td>
                        <td>{{ $letter->citizent->work }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>No KTP</td>
                        <td>:</td>
                        <td>{{ $letter->citizent->national_identify_number }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $letter->citizent->address }}.</td>
                    </tr>
                </table>
            </div>
            <div class="table-mt">
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: center;">Selanjutnya di sebut “ <strong>Penerima Kuasa</strong> ”</td>
                    </tr>
                </table>
            </div>
        </div>
        <p class="paragraph">
            Dengan ini menyatakan bahwa kami sebagai pihak Pemberi Kuasa menyatakan memberi kuasa kepada  Penerima Kuasa untuk  Mengurus
            <strong>{{ $letter->purpose }}.</strong>
        </p>
        <p class="paragraph last-paragraph">
            Demikian surat kuasa ini kami buat dengan sebenar-benarnya, untuk dapat dipergunakan sebagaimana mestinya.
        </p>
    </div>
    <div class="" style="margin-top: 30px;">
        <table class="w-full">
            <tr>
                <td class="w-full" style="text-align: center"></td>
                <td class="w-full" style="text-align: center">Subagan,  {{ $letter->sk->created_at->format("d M Y") }}</td>
            </tr>
        </table>
        <table class="w-full">
            <tr class="w-full">
                <td class="ttd-text">Pemberi Kuasa</td>
                <td class="ttd-text">Penerima Kuasa,</td>
            </tr>
            <tr style="text-align: center">
                <td style="height: 60px;">
                    @if ($letter->sk->citizent->user->signature_image)
                        <img width="100" height="auto" src="{{ url('uploads/users/signatures/' . $letter->sk->citizent->user->signature_image) }}">
                    @endif
                </td>
                <td style="height: 60px;">
                    @if ($letter->citizent->user->signature_image)
                        <img width="100" height="auto" src="{{ url('uploads/users/signatures/' . $letter->citizent->user->signature_image) }}">
                    @endif
                </td>
            </tr>
            <tr class="w-full">
                <td class="ttd-text">
                    <strong style="font-size: 14px">{{ $letter->sk->citizent->name }}</strong>
                </td>
                <td class="ttd-text">
                    <strong style="font-size: 14px">
                        {{ $letter->citizent->name }}
                    </strong>
                </td>
            </tr>
        </table>
        <table class="w-full table-mt" style="margin-top: 100px">
            <tr>
                <td class="w-full" style="text-align: center">Mengetahui :</td>
            </tr>
        </table>
        <table class="w-full table-mt">
            <tr class="w-full">
                <td class="ttd-text">Kepala Lingkungan {{ $letter->sk->citizent->environmental->name }}</td>
                <td class="ttd-text">Lurah Subagan,</td>
            </tr>
            <tr style="text-align: center">
                <td style="height: 60px;">
                    @if(isset($letter->sk->environmentalHead))
                        @if ($letter->sk->status_by_environmental_head === 1 && $letter->sk->environmentalHead->user->signature_image)
                            <img width="100" height="auto" src="{{ url('uploads/users/signatures/' . $letter->sk->environmentalHead->user->signature_image) }}">
                        @endif
                    {{-- @elseif (Request::is("letters/sk-heir/$letter->id/preview*"))
                        @if (($user->isEnvironmentalHead() && $user->signature_image) || $letter->sk->environmentalHead)
                            <img width="100" height="auto" src="{{ url('uploads/users/signatures/' . $user->signature_image) }}">
                        @endif --}}
                    @endif 
                </td>
                <td style="height: 60px;">
                    @if(isset($letter->sk->villageHead))
                        @if ($letter->sk->status_by_village_head === 1 && $letter->sk->villageHead->user->signature_image)
                            <div style="position: relative">
                                <img class="cap-kelurahan" src="{{ url("assets/img/cap_kelurahan.png") }}" style="width: 60%; height: auto;" alt="">
                                <img width="100" height="auto" src="{{ url('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image) }}">
                            </div>
                        @endif
                    {{-- @elseif (Request::is("letters/sk-heir/$letter->id/preview*"))
                        @if (($user->isVillageHead() && $user->signature_image) || $letter->sk->villageHead)
                            <img width="100" height="auto" src="{{ url('uploads/users/signatures/' . $user->signature_image) }}">
                        @endif --}}
                    @endif 
                </td>
            </tr>
            <tr class="w-full">
                <td class="ttd-text">
                    @if ($letter->sk->environmentalHead && $letter->sk->status_by_environmental_head === 1)
                        <p style="font-size: 14px;">{{ $letter->sk->environmentalHead->name }}</p>                    
                    @endif
                </td>
                @if ($letter->sk->villageHead && $letter->sk->status_by_village_head === 1)
                <td class="ttd-text" style="font-size: 14px">
                    <span>
                        <p style="font-size: 14px; text-decoration: underline;">{{ $letter->sk->villageHead->name }}</p>                    
                    </span> 
                    <br>
                    NIP : {{ $letter->sk->villageHead->employee_number }}
                </td>
                @endif
            </tr>
        </table>
    </div>
</div>
</body>
</html>