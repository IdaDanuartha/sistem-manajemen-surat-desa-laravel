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
            top: 49%;
            left: 17.5%;
        }

        .input-group.six div {
            top: 49%;
            left: 28%;
        }

        .input-group.six span {
            top: 49%;
            left: 61.3%;
        }

        .input-group.seven label {
            top: 52%;
            left: 17.5%;
        }

        .input-group.seven div {
            top: 52%;
            left: 28%;
        }

        .input-group.seven span {
            top: 52%;
            left: 61.3%;
        }

        .input-group.eight label {
            top: 55%;
            left: 17.5%;
        }

        .input-group.eight div {
            top: 55%;
            left: 28%;
        }

        .input-group.eight span {
            top: 55%;
            left: 61.3%;
        }

        .input-group.nine label {
            top: 58%;
            left: 17.5%;
        }

        .input-group.nine div {
            top: 58%;
            left: 28%;
        }

        .input-group.nine span {
            top: 58%;
            left: 61.3%;
        }

        .input-group.ten label {
            top: 61%;
            left: 17.5%;
        }

        .input-group.ten div {
            top: 61%;
            left: 28%;
        }

        .input-group.ten span {
            top: 61%;
            left: 61.3%;
        }

        .input-group.eleven label {
            top: 64%;
            left: 17.5%;
        }

        .input-group.eleven div {
            top: 64%;
            left: 28%;
        }

        .input-group.eleven span {
            top: 64%;
            left: 61.3%;
        }

        .input-group.twelve label {
            top: 67%;
            left: 17.5%;
        }

        .input-group.twelve div {
            top: 67%;
            left: 28%;
        }

        .input-group.twelve span {
            top: 67%;
            left: 61.3%;
        }

        .input-group.five label {
            top: 70%;
            left: 17.5%;
        }

        .input-group.five div {
            top: 70%;
            left: 28%;
        }

        .input-group.five span {
            top: 70%;
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

        .description-caption {
            position: relative;
            top: 44%;
            left: 56.5%;
            width: 100%;
            transform: translate(-50%);
            font-size: 0.913rem;
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
        <h3 class="title">Surat Keterangan Bepergian</h3>
        <div class="content-form">
            <p class="subtitle">Nomor: {{ $letter->sk->reference_number }}</p>
            <p class="description">Yang bertanda tangan di bawah ini,</p>
            <div class="input-group one">
                <label>Nama</label>
                <div>:</div>
                <span>{{ $village_head->citizent->name }}</span>
            </div>
            <div class="input-group two">
                <label>Jabatan</label>
                <div>:</div>
                <span>Lurah Subagan</span>
            </div>
            <div class="input-group three">
                <label>Alamat</label>
                <div>:</div>
                <span>{{ $village_head->citizent->address }}</span>
            </div>
            <div class="input-group six">
                <label>Nama</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->name }}</span>
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
                <label>Agama</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->religion->label() }}</span>
            </div>
            <div class="input-group ten">
                <label>Kewarganegaraan</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->citizenship }}</span>
            </div>
            <div class="input-group eleven">
                <label>Pekerjaan</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->work }}</span>
            </div>
            <div class="input-group twelve">
                <label>No. KTP/ SIM</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->national_identify_number }}</span>
            </div>
            <div class="input-group five">
                <label>Alamat</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->address }}</span>
            </div>
            <p class="description-caption">Menerangkan dengan sebenarnya bahwa :</p>
            <div class="description-other">
                <p class="paragraph-one">Berdasarkan surat pengantar Kepala Lingkungan Galiran Kaler Nomor: 285 / GLK / VII/ 2015, Tanggal 02 Juli 2015, memang benar yang bersangkutan melakukan perjalanan <strong>Wisata ke {{ $letter->travel_destination }}</strong></p>
                <p class="paragraph-two">Demikian surat keterangan bepergian ini dikeluarkan untuk dapat dipergunakan sebagai {{ $letter->purpose }}.</p>
            </div>
        </div>
        <div class="content-ttd">
            <div class="card-ttd">
                <p>Subagan, {{ $letter->sk->villageHead ? $letter->sk->updated_at->format("d M Y") : ".........." }}</p>
                <p>A.n, {{ $letter->sk->villageHead ? $letter->sk->villageHead->name : ".........." }}</p>
                <p class="other">Kepala Kelurahan</p>
                <div class="card-canvas">
                    @if (Request::is("letters/sk-traveling/$letter->id/preview*"))
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