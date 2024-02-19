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
            width: 55.5%;
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
            text-indent: 15px;
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
            top: 36%;
            left: 17.5%;
        }

        .input-group.one div {
            top: 36%;
            left: 28%;
        }

        .input-group.one span {
            top: 36%;
            left: 61.3%;
            text-transform: uppercase;
            font-weight: bold;
        }

        .input-group.two label {
            top: 39%;
            left: 17.5%;
        }

        .input-group.two div {
            top: 39%;
            left: 28%;
        }

        .input-group.two span {
            top: 39%;
            left: 61.3%;
        }

        .input-group.three label {
            top: 42%;
            left: 17.5%;
        }

        .input-group.three div {
            top: 42%;
            left: 28%;
        }

        .input-group.three span {
            top: 42%;
            left: 61.3%;
        }

        .input-group.six label {
            top: 45%;
            left: 17.5%;
        }

        .input-group.six div {
            top: 45%;
            left: 28%;
        }

        .input-group.six span {
            top: 45%;
            left: 61.3%;
        }

        .input-group.seven label {
            top: 53%;
            left: 17.5%;
        }

        .input-group.seven div {
            top: 53%;
            left: 28%;
        }

        .input-group.seven span {
            top: 53%;
            left: 61.3%;
        }

        .input-group.eight label {
            top: 56%;
            left: 17.5%;
        }

        .input-group.eight div {
            top: 56%;
            left: 28%;
        }

        .input-group.eight span {
            top: 56%;
            left: 61.3%;
        }

        .input-group.nine label {
            top: 59%;
            left: 17.5%;
        }

        .input-group.nine div {
            top: 59%;
            left: 28%;
        }

        .input-group.nine span {
            top: 59%;
            left: 61.3%;
        }

        .input-group.ten label {
            top: 62%;
            left: 17.5%;
        }

        .input-group.ten div {
            top: 62%;
            left: 28%;
        }

        .input-group.ten span {
            top: 62%;
            left: 61.3%;
        }

        .input-group.eleven label {
            top: 67%;
            left: 17.5%;
        }

        .input-group.eleven div {
            top: 67%;
            left: 28%;
        }

        .input-group.eleven span {
            top: 67%;
            left: 61.3%;
        }

        .input-group.five label {
            top: 48%;
            left: 17.5%;
        }

        .input-group.five div {
            top: 48%;
            left: 28%;
        }

        .input-group.five span {
            top: 48%;
            left: 61.3%;
        }

        .card-ttd p:first-child {
            text-align: center;
            font-size: 0.913rem;
            width: 40%;
            position: absolute;
            bottom: 11.7%;
            left: 80%;
            transform: translate(-50%);
        }

        .card-ttd p:nth-child(2) {
            text-align: center;
            font-size: 0.913rem;
            width: 40%;
            position: absolute;
            bottom: 9.8%;
            left: 80%;
            transform: translate(-50%);
        }

        .card-ttd p.other {
            text-align: center;
            font-size: 0.913rem;
            width: 40%;
            position: absolute;
            bottom: 7.9%;
            left: 80%;
            transform: translate(-50%);
        }

        .card-ttd .card-canvas {
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
            top: 69%;
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
        <h3 class="title">Surat Keterangan Tempat Tinggal</h3>
        <div class="content-form">
            <p class="subtitle">Nomor: 431 / VI / Kpddk / 2022</p>
            <p class="description">Diberikan Kepada:</p>            
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
                <label>Agama</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->religion->label() }}</span>
            </div>
            <div class="input-group six">
                <label>Pekerjaan</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->work }}</span>
            </div>
            <div class="input-group five">
                <label>Alamat</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->address }}</span>
            </div>
            <div class="input-group seven">
                <label>Jenis Kelamin</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->gender->label() }}</span>
            </div>
            <div class="input-group eight">
                <label>Status Perkawinan</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->marital_status->label() }}</span>
            </div>
            <div class="input-group nine">
                <label>Pendidikan</label>
                <div>:</div>
                <span>-</span>
            </div>
            <div class="input-group ten">
                <label>Alamat Asal</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->address }}</span>
            </div>
            <div class="input-group eleven">
                <label>No. KK</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->national_identify_number }}</span>
            </div>
            <div class="description-other">
                <p class="paragraph-one">Berdasarkan Surat Pengantar dari Kepala Lingkungan Desa No: 84 /LD/ VI / 2022, tanggal 16 Juni 2022, memang benar orang tersebut bertempat tinggal di Lingkungan Desa Kelurahan Subagan, Kecamatan Karangasem, Kabupaten Karangasem, Provinsi Bali sejak tahun {{ $letter->year }}.</p>
                <p class="paragraph-two">Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan Sebagaimana mestinya.</p>
            </div>
        </div>
        <div class="content-ttd">
            <div class="card-ttd">
                <p>Subagan, {{ $letter->sk->villageHead ? $letter->sk->updated_at->format("d M Y") : ".........." }}</p>
                <p>A.n, {{ $letter->sk->villageHead ? $letter->sk->villageHead->name : ".........." }}</p>
                <p class="other">Kepala Kelurahan</p>
                <div class="card-canvas">
                    @if (Request::is("letters/sk-residence/$letter->id/preview*"))
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