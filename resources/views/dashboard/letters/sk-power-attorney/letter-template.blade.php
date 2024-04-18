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
        .subtitle-surat{
            font-size: 14px;
            margin-top: 0;
        }
        .title-surat-wrapper{
            width: 100%;
            text-align: center;
            font-weight: bold;
            margin-top: 30px;
        }
        .content-surat{
            margin-top: -14px;
            font-size: 14px;
        }
        table{
            font-size: 14px;
        }
        .paragraph{
            text-indent: 20px;
        }
        .table-mt{
            margin-top: 30px;
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
    </style>
</head>
<body>
    <div class="wrapper">
        <img src="{{ public_path('assets/img/letter-header.png') }}" class="image-full" alt="">
        <div class="title-surat-wrapper">
            <h1 class="title-surat">SURAT KETERANGAN AHLI WARIS</h1>
            <h5 class="subtitle-surat">Nomor : {{ $letter->sk->reference_number }}</h5>
        </div>
        <div class="content-surat">
            <p   class="paragraph">
                Yang bertanda tangan di bawah ini Lurah Subagan, Kecamatan Karangasem, Kabupaten Karangasem, Provinsi Bali, menerangkan dengan sebenarnya bahwa :
            </p>
            <div class="table-wrapper">
                @foreach ($letter->families as $key => $item)
                    <div class="table-{{ $key+1 }} {{ $key+1 > 1 ? "table-mt":"" }}">
                        <table>
                            <tr>
                                <td>Nama {{ $item->relationship_status->label() }}</td>
                                <td>:</td>
                                <td><strong>{{ $item->citizent->name }}</strong></td>
                            </tr>
                            <tr>
                                <td>Tempat /tanggal lahir  </td>
                                <td>:</td>
                                <td>{{ $item->citizent->birth_place . ", " . $item->citizent->birth_date->format("d-m-Y") }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ $item->citizent->gender->label() }}</td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td>{{ $item->citizent->religion->label() }}</td>
                            </tr>
                            <tr>
                                <td>No KTP/KK</td>
                                <td>:</td>
                                <td>{{ $item->citizent->national_identify_number }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $item->citizent->address }}.</td>
                            </tr>
                        </table>
                    </div>
                @endforeach
                {{-- <div class="table-2 table-mt">
                    <table>
                        <tr>
                            <td>Nama Anak </td>
                            <td>:</td>
                            <td><strong>Kadek Adi</strong></td>
                        </tr>
                        <tr>
                            <td>Tempat /tanggal lahir  </td>
                            <td>:</td>
                            <td>Subagan, 31-12-1960</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>Perempuan</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td>Hindu</td>
                        </tr>
                        <tr>
                            <td>No KTP/KK</td>
                            <td>:</td>
                            <td>5107047112600242</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>Lingkungan Desa  Kelurahan Subagan, Kecamatan Karangasem, Kabupaten Karangasem.</td>
                        </tr>
                    </table>
                </div>
                <div class="table-3 table-mt">
                    <table>
                        <tr>
                            <td>Nama Anak </td>
                            <td>:</td>
                            <td><strong>Komang Sentosa</strong></td>
                        </tr>
                        <tr>
                            <td>Tempat /tanggal lahir  </td>
                            <td>:</td>
                            <td>Subagan, 31-12-1960</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>Perempuan</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td>Hindu</td>
                        </tr>
                        <tr>
                            <td>No KTP/KK</td>
                            <td>:</td>
                            <td>5107047112600242</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>Lingkungan Desa  Kelurahan Subagan, Kecamatan Karangasem, Kabupaten Karangasem.</td>
                        </tr>
                    </table>
                </div> --}}
            </div>
            <p class="paragraph">
                Berdasarkan surat pengantar Kepala Lingkungan {{ $letter->sk->citizent->environmental->name }},  Nomor :  {{ $letter->sk->cover_letter_number }},  Tanggal {{ $letter->sk->created_at->format("d M Y") }},  Bahwa memang benar yang bersangkutan adalah {{ $letter->families[0]->relationship_status->label() }} sekaligus Ahli Waris dari
                <strong>{{ $letter->citizent->name }} (Alm)</strong> yang meninggal dunia pada Tanggal {{ $letter->date_of_death->format("d-m-Y") }}.
            </p>
            <p class="paragraph last-paragraph">
                Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagai {{ $letter->purpose }}.
            </p>
        </div>
        <div class="" style="margin-top: 30px;">
            <table class="w-full">
                <tr class="w-full">
                    <td class="ttd-text">Mengetahui</td>
                    <td class="ttd-text">Mengetahui</td>
                    <td class="ttd-text">Subagan, {{ $letter->sk->villageHead ? $letter->sk->updated_at->format("d M Y") : ".........." }}</td>
                </tr>
                <tr class="w-full">
                    <td class="ttd-text">Camat Karangasem</td>
                    <td class="ttd-text">Kepala Lingkungan {{ $letter->sk->environmentalHead ? $letter->sk->citizent->environmental->name : ".........." }}</td>
                    <td class="ttd-text">Lurah Subagan</td>
                </tr>
                <tr style="text-align: center">
                    <td style="height: 60px;">
                        @if(isset($letter->sk->environmentalHead))
                            @if ($letter->sk->status_by_village_head === 1)
                                <img width="100" height="auto" src="{{ public_path('uploads/users/signatures/' . $letter->sk->environmentalHead->user->signature_image) }}">
                            @endif
                        @elseif (Request::is("letters/sk-power-attorney/$letter->id/preview*"))
                            @if (($user->isEnvironmentalHead() && $user->signature_image) || $letter->sk->environmentalHead)
                                <img width="100" height="auto" src="{{ public_path('uploads/users/signatures/' . $user->signature_image) }}">
                            @endif
                        @endif 
                    </td>
                    <td style="height: 60px;">
                        @if(isset($letter->sk->environmentalHead))
                            @if ($letter->sk->status_by_village_head === 1)
                                <img width="100" height="auto" src="{{ public_path('uploads/users/signatures/' . $letter->sk->environmentalHead->user->signature_image) }}">
                            @endif
                        @elseif (Request::is("letters/sk-power-attorney/$letter->id/preview*"))
                            @if (($user->isEnvironmentalHead() && $user->signature_image) || $letter->sk->environmentalHead)
                                <img width="100" height="auto" src="{{ public_path('uploads/users/signatures/' . $user->signature_image) }}">
                            @endif
                        @endif 
                    </td>
                    <td style="height: 60px;">
                        @if(isset($letter->sk->villageHead))
                            @if ($letter->sk->status_by_village_head === 1)
                                <img width="100" height="auto" src="{{ public_path('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image) }}">
                            @endif
                        @elseif (Request::is("letters/sk-power-attorney/$letter->id/preview*"))
                            @if (($user->isVillageHead() && $user->signature_image) || $letter->sk->villageHead)
                                <img width="100" height="auto" src="{{ public_path('uploads/users/signatures/' . $user->signature_image) }}">
                            @endif
                        @endif 
                    </td>
                </tr>
                <tr class="w-full">
                    <td class="ttd-text">
                        <strong style="font-size: 14px;">{{ $subdistrictHead->name }}</strong>                    
                    </td>
                    <td class="ttd-text">
                        @if ($letter->sk->environmentalHead && $letter->sk->status_by_environmental_head === 1)
                            <strong style="font-size: 14px;">{{ $letter->sk->environmentalHead->name }}</strong>                    
                        @endif
                    </td>
                    <td class="ttd-text">
                        @if ($letter->sk->villageHead && $letter->sk->status_by_village_head === 1)
                            <strong style="font-size: 14px;">{{ $letter->sk->villageHead->name }}</strong>                    
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>