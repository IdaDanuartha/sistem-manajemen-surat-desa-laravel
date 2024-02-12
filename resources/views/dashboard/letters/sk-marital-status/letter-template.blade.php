<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .image-full {
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            border-bottom: 3px solid black;
        }

        .title {
            text-align: center;
            position: absolute;
            top: 24%;
            left: 50%;
            transform: translate(-50%);
            text-transform: uppercase;
            font-size: 1.2rem;
            border-bottom: 2px solid black;
        }

        .subtitle {
            position: absolute;
            top: 28.5%;
            left: 50%;
            transform: translate(-50%);
            font-size: 0.913rem;
        }

        .description {
            position: absolute;
            top: 31.5%;
            left: 50%;
            width: 92%;
            transform: translate(-50%);
            font-size: 0.913rem;
            line-height: 150%;
            text-indent: 42px;
        }

        .input-group label {
            width: 22% !important;
            position: absolute;
            transform: translate(-50%);
            font-size: 0.913rem !important;
        }

        .input-group div {
            width: 5% !important;
            position: absolute;
            transform: translate(-50%);
            font-size: 0.913rem !important;
        }

        .input-group span {
            width: 67% !important;
            position: absolute;
            transform: translate(-50%);
            font-size: 0.913rem !important;
        }

        .input-group.one label {
            top: 40%;
            left: 17.5%;
        }

        .input-group.one div {
            top: 40%;
            left: 28%;
        }

        .input-group.one span {
            top: 40%;
            left: 61.3%;
            text-transform: uppercase;
            font-weight: bold;
        }

        .input-group.two label {
            top: 43%;
            left: 17.5%;
        }

        .input-group.two div {
            top: 43%;
            left: 28%;
        }

        .input-group.two span {
            top: 43%;
            left: 61.3%;
        }

        .input-group.three label {
            top: 46%;
            left: 17.5%;
        }

        .input-group.three div {
            top: 46%;
            left: 28%;
        }

        .input-group.three span {
            top: 46%;
            left: 61.3%;
        }

        .input-group.four label {
            top: 49%;
            left: 17.5%;
        }

        .input-group.four div {
            top: 49%;
            left: 28%;
        }

        .input-group.four span {
            top: 49%;
            left: 61.3%;
        }

        .input-group.six label {
            top: 52%;
            left: 17.5%;
        }

        .input-group.six div {
            top: 52%;
            left: 28%;
        }

        .input-group.six span {
            top: 52%;
            left: 61.3%;
        }

        .input-group.nine label {
            top: 55%;
            left: 17.5%;
        }

        .input-group.nine div {
            top: 55%;
            left: 28%;
        }

        .input-group.nine span {
            top: 55%;
            left: 61.3%;
        }

        .input-group.seven label {
            top: 58%;
            left: 17.5%;
        }

        .input-group.seven div {
            top: 58%;
            left: 28%;
        }

        .input-group.seven span {
            top: 58%;
            left: 61.3%;
        }

        .input-group.eight label {
            top: 61%;
            left: 17.5%;
        }

        .input-group.eight div {
            top: 61%;
            left: 28%;
        }

        .input-group.eight span {
            top: 61%;
            left: 61.3%;
        }

        .input-group.five label {
            top: 64%;
            left: 17.5%;
        }

        .input-group.five div {
            top: 64%;
            left: 28%;
        }

        .input-group.five span {
            top: 64%;
            left: 61.3%;
        }

        .card-ttd:first-child p:first-child {
            text-align: center;
            font-size: 0.913rem;
            width: 40%;
            position: absolute;
            bottom: 11.7%;
            left: 20%;
            transform: translate(-50%);
        }

        .card-ttd:first-child p:nth-child(2) {
            text-align: center;
            font-size: 0.913rem;
            width: 40%;
            position: absolute;
            bottom: 9.8%;
            left: 20%;
            transform: translate(-50%);
        }

        .card-ttd:first-child p.other {
            text-align: center;
            font-size: 0.913rem;
            width: 40%;
            position: absolute;
            bottom: 7.9%;
            left: 20%;
            transform: translate(-50%);
        }

        .card-ttd:first-child .card-canvas {
            width: 30%;
            height: 70px;
            position: absolute;
            bottom: 1%;
            left: 20%;
            transform: translate(-50%);
            border-bottom: 1px dashed black;
        }

        .card-ttd:last-child p:first-child {
            text-align: center;
            font-size: 0.913rem;
            width: 40%;
            position: absolute;
            bottom: 11.7%;
            left: 80%;
            transform: translate(-50%);
        }

        .card-ttd:last-child p:nth-child(2) {
            text-align: center;
            font-size: 0.913rem;
            width: 40%;
            position: absolute;
            bottom: 9.8%;
            left: 80%;
            transform: translate(-50%);
        }

        .card-ttd:last-child p.other {
            text-align: center;
            font-size: 0.913rem;
            width: 40%;
            position: absolute;
            bottom: 7.9%;
            left: 80%;
            transform: translate(-50%);
        }

        .card-ttd:last-child .card-canvas {
            width: 30%;
            height: 70px;
            position: absolute;
            bottom: 1%;
            left: 80%;
            transform: translate(-50%);
            border-bottom: 1px dashed black;
        }

        .description-other {
            position: relative;
            top: 68%;
            left: 50%;
            width: 92%;
            transform: translate(-50%);
        }

        .paragraph-one {
            font-size: 0.913rem;
            line-height: 150%;
            text-indent: 42px;
        }

        .paragraph-two {
            font-size: 0.913rem;
            line-height: 150%;
            text-indent: 42px;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <img src="{{ public_path('assets/img/letter-header.png') }}" alt="Banner Top" class="image-full">
        <h3 class="title">Surat Keterangan @if($letter->status == 1) Duda @elseif($letter->status == 2) Janda @else Cerai @endif</h3>
        <div class="content-form">
            <p class="subtitle">Nomor : {{ $letter->sk->reference_number }}</p>
            <p class="description">Yang bertanda tangan di bawah ini, Lurah Subagan, Kecamatan Karangasem, Kabupaten Karangasem, Propinsi Bali, menerangkan dengan sebenarnya bahwa :</p>
            <div class="input-group one">
                <label>Nama</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->name }}</span>
            </div>
            <div class="input-group two">
                <label>Tempat Tanggal Lahir</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->birth_place . ", " . $letter->sk->citizent->birth_date->format("d-m-Y") }}</span>
            </div>
            <div class="input-group three">
                <label>Jenis Kelamin</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->gender->label() }}</span>
            </div>
            <div class="input-group four">
                <label>Agama</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->religion->label() }}</span>
            </div>
            <div class="input-group six">
                <label>Kewarganegaraan</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->citizenship }}</span>
            </div>
            <div class="input-group nine">
                <label>Status</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->marital_status->label() }}</span>
            </div>
            <div class="input-group seven">
                <label>Pekerjaan</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->work }}</span>
            </div>
            <div class="input-group eight">
                <label>No KK/ KTP</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->family_card_number }}</span>
            </div>
            <div class="input-group five">
                <label>Alamat</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->address }}</span>
            </div>
            <div class="description-other">
                @if ($letter->status == 1)
                    <p class="paragraph-one">Berdasarkan surat pengantar Kepala Lingkungan Desa, Nomor : 278 / LJK / VII/ 2020, Tanggal 09 Juli 2020, memang benar yang bersangkutan adalah <strong>Duda dari Istri {{ $letter->citizent->name }}</strong> (Alm) Meninggal pada Tanggal {{ $letter->date->format("d M Y") }}</p>
                @elseif($letter->status == 2)
                    <p class="paragraph-one">Berdasarkan surat pengantar Kepala Lingkungan Desa, Nomor : 05 / LD / I / 2023, Tanggal 09 Januari 2023, memang benar yang bersangkutan adalah <strong>Janda dari Suami {{ $letter->citizent->name }}</strong> (Alm) Meninggal pada Tanggal {{ $letter->date->format("d M Y") }}</p>
                @else
                    <p class="paragraph-one">Berdasarkan  dengan surat pengantar dari Kepala Lingkungan Jasri Kelod, tertanggal 19  Juli 2019, Nomor : / LJK / 2019, yang bersangkutan memang benar telah Cerai dengan <strong style="text-transform: uppercase;">{{ $letter->citizent->name }}</strong> pada tahun {{ $letter->date->format("Y") }} di Lingkungan Jasri Kelod, Kelurahan Subagan Kecamatan Karangasem, Kabupaten Karangasem.</p>
                    @endif
                <p class="paragraph-two">Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan untuk melengkapi Administrasi Pensiunan.</p>
            </div>
        </div>
        <div class="content-ttd">
            {{-- <div class="card-ttd">
                <p>Mengetahui</p>
                <p>Camat Karangasem</p>                
                <div class="card-canvas">
                    <img src="{{ public_path('assets/banner-top.png') }}" style="width: 100%; height: 100%;">
                </div>
            </div> --}}
            <div class="card-ttd">
                <p>Subagan, {{ $letter->sk->villageHead ? $letter->sk->updated_at->format("d M Y") : ".........." }}</p>
                <p>A.n, {{ $letter->sk->villageHead ? $letter->sk->villageHead->citizent->name : ".........." }}</p>
                <p class="other">Kepala Kelurahan</p>
                <div class="card-canvas">
                    @if (Request::is("letters/sk-marital-status/$letter->id/preview*"))
                        @if (($user->isVillageHead() && $user->signature_image) || $letter->sk->villageHead)
                            <img src="{{ public_path('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image ?? $user->signature_image) }}" style="width: 100%; height: 100%;">
                        @endif
                    @elseif(isset($letter->sk->villageHead))
                        <img src="{{ public_path('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image) }}" style="width: 100%; height: 100%;">
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>