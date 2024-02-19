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
        p{
            font-size: 14px;
        }
        .table-content tr td:first-child{
            width: 60px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <p>Subagan, {{ $letter->sk->created_at->format('d M Y') }}</p>
    <p style="margin-top: -10px;">Kepada,</p>
    <p style="margin-top: -10px;">Yth. <br>Kepala Dinas Lingkungan Hidup Kabupaten Karangasem di <u>Amlapura</u></p>
    <table class="table-hal" style="margin-top: -10px; text-align: left">
        <tr>
            <td>Hal</td>
            <td>:</td>
            <td>
                {{ $letter->regarding }}
            </td>
        </tr>
    </table>
    <div class="content-surat" style="margin-top: 4px;">
        <p   class="">
            Dengan hormat, <br>
            Yang bertanda tangan dibawah ini :

        </p>
        <div class="table-wrapper" style="margin-top: -10px;">
            <div class="table-1">
                <table class="table-content">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $letter->sk->citizent->name }}</td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td>:</td>
                        <td>{{ $letter->sk->citizent->work }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>
                            {{ $letter->sk->citizent->address }}.
                        </td>
                    </tr>
                    <tr>
                        <td>No. HP</td>
                        <td>:</td>
                        <td>
                            {{ $letter->sk->citizent->phone_number }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <p class="paragraph">
            {!! $letter->description !!}
        </p>
        <p class="paragraph last-paragraph">
            Demikian kami sampaikan atas bantuan dan kerjasamanya kami ucapkan banyak terimakasih.
        </p>
    </div>
    <div class="" style="margin-top: 30px;">
        <table class="w-full">
            <tr class="w-full">
                <td class="ttd-text">Mengetahui</td>
            </tr>
            <tr class="w-full">
                <td class="ttd-text">Kepala Lingkungan Desa</td>
                <td class="ttd-text">Pemohon</td>
            </tr>
            <tr style="text-align: center">
                <td style="height: 60px;">
                    @if(isset($letter->sk->environmentalHead))
                        @if ($letter->sk->status_by_environmental_head === 1)
                            <img width="100" height="auto" src="{{ public_path('uploads/users/signatures/' . $letter->sk->environmentalHead->user->signature_image) }}">
                        @endif
                    @elseif (Request::is("letters/tree-felling/$letter->id/preview*"))
                        @if (($user->isenvironmentalHead() && $user->signature_image) || $letter->sk->environmentalHead)
                            <img width="100" height="auto" src="{{ public_path('uploads/users/signatures/' . $user->signature_image) }}">
                        @endif
                    @endif 
                </td>
                <td style="height: 60px;">
                    @if (($user->isCitizent() && $user->signature_image))
                        <img width="100" height="auto" src="{{ public_path('uploads/users/signatures/' . $user->signature_image) }}">
                    @elseif(isset($letter->sk->citizent->user->signature_image))
                        <img width="100" height="auto" src="{{ public_path('uploads/users/signatures/' . $letter->sk->citizent->user->signature_image) }}">
                    @endif
                </td>
            </tr>
            <tr class="w-full">
                <td class="ttd-text">
                    @if ($letter->sk->environmentalHead && $letter->sk->status_by_environmental_head === 1)
                        <strong style="font-size: 14px;">{{ $letter->sk->environmentalHead->citizent->name }}</strong>                    
                    @endif
                </td>
                <td class="ttd-text">
                    @if ($letter->sk->citizent->name)
                        <strong style="font-size: 14px;">{{ $letter->sk->citizent->name }}</strong>                    
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>