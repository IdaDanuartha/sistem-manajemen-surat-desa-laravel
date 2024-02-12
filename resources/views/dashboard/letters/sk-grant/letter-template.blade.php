<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .title {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%);
            text-transform: uppercase;
            font-size: 1.2rem;
            border-bottom: 2px solid black;
        }

        .description {
            position: absolute;
            top: 6%;
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
            top: 11%;
            left: 17.5%;
        }

        .input-group.one div {
            top: 11%;
            left: 28%;
        }

        .input-group.one span {
            top: 11%;
            left: 61.3%;
            text-transform: uppercase;
            font-weight: bold;
        }

        .input-group.two label {
            top: 13.5%;
            left: 17.5%;
        }

        .input-group.two div {
            top: 13.5%;
            left: 28%;
        }

        .input-group.two span {
            top: 13.5%;
            left: 61.3%;
        }

        .input-group.three label {
            top: 16%;
            left: 17.5%;
        }

        .input-group.three div {
            top: 16%;
            left: 28%;
        }

        .input-group.three span {
            top: 16%;
            left: 61.3%;
        }

        .input-group.four label {
            top: 22.5%;
            left: 17.5%;
        }

        .input-group.four div {
            top: 22.5%;
            left: 28%;
        }

        .input-group.four span {
            top: 22.5%;
            left: 61.3%;
        }

        .input-group.six label {
            top: 25%;
            left: 17.5%;
        }

        .input-group.six div {
            top: 25%;
            left: 28%;
        }

        .input-group.six span {
            top: 25%;
            left: 61.3%;
        }

        .input-group.seven label {
            top: 31%;
            left: 17.5%;
        }

        .input-group.seven div {
            top: 31%;
            left: 28%;
        }

        .input-group.seven span {
            top: 31%;
            left: 61.3%;
        }

        .input-group.eight label {
            top: 33.5%;
            left: 17.5%;
        }

        .input-group.eight div {
            top: 33.5%;
            left: 28%;
        }

        .input-group.eight span {
            top: 33.5%;
            left: 61.3%;
        }

        .input-group.nine label {
            top: 36%;
            left: 17.5%;
        }

        .input-group.nine div {
            top: 36%;
            left: 28%;
        }

        .input-group.nine span {
            top: 36%;
            left: 61.3%;
        }

        .input-group.ten label {
            top: 40%;
            left: 17.5%;
        }

        .input-group.ten div {
            top: 40%;
            left: 28%;
        }

        .input-group.ten span {
            top: 40%;
            left: 61.3%;
        }

        .input-group.eleven label {
            top: 42.5%;
            left: 17.5%;
        }

        .input-group.eleven div {
            top: 42.5%;
            left: 28%;
        }

        .input-group.eleven span {
            top: 42.5%;
            left: 61.3%;
        }

        .input-group.twelve label {
            top: 45%;
            left: 17.5%;
        }

        .input-group.twelve div {
            top: 45%;
            left: 28%;
        }

        .input-group.twelve span {
            top: 45%;
            left: 61.3%;
        }

        .input-group.thirteen label {
            top: 47.5%;
            left: 17.5%;
        }

        .input-group.thirteen div {
            top: 47.5%;
            left: 28%;
        }

        .input-group.thirteen span {
            top: 47.5%;
            left: 61.3%;
        }

        .input-group.fourteen label {
            top: 50%;
            left: 17.5%;
        }

        .input-group.fourteen div {
            top: 50%;
            left: 28%;
        }

        .input-group.fourteen span {
            top: 50%;
            left: 61.3%;
        }

        .input-group.fifteen label {
            top: 52.5%;
            left: 17.5%;
        }

        .input-group.fifteen div {
            top: 52.5%;
            left: 28%;
        }

        .input-group.fifteen span {
            top: 52.5%;
            left: 61.3%;
        }

        .input-group.sixteen label {
            top: 55%;
            left: 17.5%;
        }

        .input-group.sixteen div {
            top: 55%;
            left: 28%;
        }

        .input-group.sixteen span {
            top: 55%;
            left: 61.3%;
        }

        .input-group.seventeen label {
            top: 57.5%;
            left: 17.5%;
        }

        .input-group.seventeen div {
            top: 57.5%;
            left: 28%;
        }

        .input-group.seventeen span {
            top: 57.5%;
            left: 61.3%;
        }

        .input-group.eightteen label {
            top: 63%;
            left: 17.5%;
        }

        .input-group.eightteen div {
            top: 63%;
            left: 28%;
        }

        .input-group.eightteen span {
            top: 63%;
            left: 61.3%;
        }

        .input-group.nineteen label {
            top: 65.5%;
            left: 17.5%;
        }

        .input-group.nineteen div {
            top: 65.5%;
            left: 28%;
        }

        .input-group.nineteen span {
            top: 65.5%;
            left: 61.3%;
        }

        .input-group.twenty label {
            top: 68%;
            left: 17.5%;
        }

        .input-group.twenty div {
            top: 68%;
            left: 28%;
        }

        .input-group.twenty span {
            top: 68%;
            left: 61.3%;
        }

        .input-group.twentyone label {
            top: 70.5%;
            left: 17.5%;
        }

        .input-group.twentyone div {
            top: 70.5%;
            left: 28%;
        }

        .input-group.twentyone span {
            top: 70.5%;
            left: 61.3%;
        }

        .input-group.twentytwo label {
            top: 73%;
            left: 17.5%;
        }

        .input-group.twentytwo div {
            top: 73%;
            left: 28%;
        }

        .input-group.twentytwo span {
            top: 73%;
            left: 61.3%;
        }

        .input-group.twentythree label {
            top: 76.5%;
            left: 17.5%;
        }

        .input-group.twentythree div {
            top: 76.5%;
            left: 28%;
        }

        .input-group.twentythree span {
            top: 76.5%;
            left: 61.3%;
        }

        .input-group.five label {
            top: 18.5%;
            left: 17.5%;
        }

        .input-group.five div {
            top: 18.5%;
            left: 28%;
        }

        .input-group.five span {
            top: 18.5%;
            left: 61.3%;
        }

        .card-ttd:first-child p:first-child {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            bottom: 11.7%;
            left: 18%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:first-child p:nth-child(2) {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            bottom: 9.8%;
            left: 18%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:first-child .card-canvas {
            width: 26%;
            height: 70px;
            position: absolute;
            bottom: 3.7%;
            left: 18%;
            transform: translate(-50%);
            text-align: center;
            border-bottom: 1px dashed black;
        }

        .card-ttd:first-child p:last-child {
            font-size: 0.875rem;
            width: 26%;
            position: absolute;
            bottom: 0.3%;
            left: 18%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:nth-child(2) p:first-child {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            bottom: 11.7%;
            left: 49%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:nth-child(2) p:nth-child(2) {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            bottom: 9.8%;
            left: 49%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:nth-child(2) .card-canvas {
            width: 26%;
            height: 70px;
            position: absolute;
            bottom: 3.7%;
            left: 49%;
            transform: translate(-50%);
            text-align: center;
            border-bottom: 1px dashed black;
        }

        .card-ttd:nth-child(2) p:last-child {
            font-size: 0.875rem;
            width: 26%;
            position: absolute;
            bottom: 0.3%;
            left: 49%;
            transform: translate(-50%);
            text-align: center;
        }

        /* .card-ttd:nth-child(2) span.other {
            font-size: 0.875rem;
            width: 26%;
            position: absolute;
            bottom: -1%;
            left: 49%;
            transform: translate(-50%);
            text-align: center;
        } */

        .card-ttd:last-child p:first-child {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            bottom: 13.7%;
            left: 80%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:last-child p:nth-child(2) {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            bottom: 9.8%;
            left: 80%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:last-child .card-canvas {
            width: 26%;
            height: 70px;
            position: absolute;
            bottom: 3.7%;
            left: 80%;
            transform: translate(-50%);
            border-bottom: 1px dashed black;
        }

        .card-ttd:last-child p:last-child {
            font-size: 0.875rem;
            width: 26%;
            position: absolute;
            bottom: 0.3%;
            left: 80%;
            transform: translate(-50%);
            text-align: center;
        }

        .description-caption {
            position: relative;
            top: 27%;
            left: 56.5%;
            width: 100%;
            transform: translate(-50%);
            font-size: 0.913rem;
        }

        .description-caption-two {
            position: relative;
            top: 56%;
            left: 56.5%;
            width: 100%;
            transform: translate(-50%);
            font-size: 0.913rem;
        }

        .description-other {
            position: relative;
            top: 70%;
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
        <h3 class="title">Surat Keterangan Hibah</h3>
        <div class="content-form">
            <p class="description">Yang bertanda tangan di bawah ini:</p>
            <div class="input-group one">
                <label>Nama</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->name }}</span>
            </div>
            <div class="input-group two">
                <label>Tempat Tanggal Lahir</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->birth_place . ', ' . $letter->sk->citizent->birth_date->format("d-m-Y") }}</span>
            </div>
            <div class="input-group three">
                <label>Jenis Kelamin</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->gender->label() }}</span>
            </div>
            <div class="input-group four">
                <label>Pekerjaan</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->work }}</span>
            </div>
            <div class="input-group six">
                <label>No.KTP</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->national_identify_number }}</span>
            </div>
            <div class="input-group seven">
                <label>No. polisi</label>
                <div>:</div>
                <span>{{ $letter->police_number }}</span>
            </div>
            <div class="input-group eight">
                <label>Nama Pemilik</label>
                <div>:</div>
                <span>{{ $letter->owner_name }}</span>
            </div>
            <div class="input-group nine">
                <label>Alamat</label>
                <div>:</div>
                <span>{{ $letter->address }}</span>
            </div>
            <div class="input-group ten">
                <label>Merk/Type</label>
                <div>:</div>
                <span>{{ $letter->brand }}</span>
            </div>
            <div class="input-group eleven">
                <label>Jenis</label>
                <div>:</div>
                <span>{{ $letter->type }}</span>
            </div>
            <div class="input-group twelve">
                <label>Model</label>
                <div>:</div>
                <span>{{ $letter->model }}</span>
            </div>
            <div class="input-group thirteen">
                <label>Tahun Pembuatan</label>
                <div>:</div>
                <span>{{ $letter->production_year }}</span>
            </div>
            <div class="input-group fourteen">
                <label>Isi Selinder</label>
                <div>:</div>
                <span>{{ $letter->cylinder_filling }}</span>
            </div>
            <div class="input-group fifteen">
                <label>No. Rangka</label>
                <div>:</div>
                <span>{{ $letter->frame_number }}</span>
            </div>
            <div class="input-group sixteen">
                <label>No. Mesin</label>
                <div>:</div>
                <span>{{ $letter->machine_number }}</span>
            </div>
            <div class="input-group seventeen">
                <label>No. BPKB</label>
                <div>:</div>
                <span>{{ $letter->bpkb_number }}</span>
            </div>
            <div class="input-group five">
                <label>Alamat</label>
                <div>:</div>
                <span>{{ $letter->address }}</span>
            </div>
            <div class="input-group eightteen">
                <label>Nama</label>
                <div>:</div>
                <span>{{ $letter->citizent->name }}</span>
            </div>
            <div class="input-group nineteen">
                <label>Tempat Tanggal Lahir</label>
                <div>:</div>
                <span>{{ $letter->citizent->birth_place . ", " . $letter->citizent->birth_date->format("d-m-Y") }}</span>
            </div>
            <div class="input-group twenty">
                <label>Jenis Kelamin</label>
                <div>:</div>
                <span>{{ $letter->citizent->gender->label() }}</span>
            </div>
            <div class="input-group twentyone">
                <label>Pekerjaan</label>
                <div>:</div>
                <span>{{ $letter->citizent->work }}</span>
            </div>
            <div class="input-group twentytwo">
                <label>Alamat</label>
                <div>:</div>
                <span>{{ $letter->citizent->address }}</span>
            </div>
            <div class="input-group twentythree">
                <label>No. KTP</label>
                <div>:</div>
                <span>{{ $letter->citizent->national_identify_number }}</span>
            </div>
            <p class="description-caption">Dengan ini saya mengibahkan kendaraan dengan data sebagai berikut :</p>
            <p class="description-caption-two">Dihibahkan kepada Anak Saya dengan Identitas sebagai berikut :</p>
            <div class="description-other">
                <p class="paragraph-one">Demikian surat pernyataan ini saya buat dengan sebenarnya untuk dapat dipergunakan sebagai mana mestinya.</p>
            </div>
        </div>
        <div class="content-ttd">
            <div class="card-ttd">
                {{-- <p>Find out</p> --}}
                <p>Yang menerima Hibah</p>
                <div class="card-canvas">
                    {{-- <img src="{{ public_path('assets/banner-top.png') }}" style="width: 100%; height: 100%;"> --}}
                </div>
                <p style="text-transform: uppercase;">{{ $letter->citizent->name }}</p>
            </div>
            <div class="card-ttd">
                <p>Mengetahui</p>
                <p>Lurah Subagan</p>
                <div class="card-canvas">
                    @if (Request::is("letters/sk-marry/$letter->id/preview*"))
                        @if (($user->isVillageHead() && $user->signature_image) || $letter->sk->villageHead)
                            <img src="{{ public_path('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image ?? $user->signature_image) }}" style="width: 100%; height: 100%;">
                        @endif
                    @elseif(isset($letter->sk->villageHead))
                        <img src="{{ public_path('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image) }}" style="width: 100%; height: 100%;">
                    @endif
                </div>
                <p><span style="text-transform: uppercase; text-decoration: underline;">{{ $letter->sk->villageHead ? $letter->sk->villageHead->citizent->name : "" }}</span></p>
            </div>
            <div class="card-ttd">
                <p>Subagan, {{ $letter->sk->created_at->format('d M Y') }}</p>
                <p>Yang membuat pernyataan memberi hibah</p>
                <div class="card-canvas">
                    {{-- <img src="{{ public_path('assets/banner-top.png') }}" style="width: 100%; height: 100%;"> --}}
                </div>
                <p style="text-transform: uppercase;">{{ $letter->sk->citizent->name }}</p>
            </div>
        </div>
    </div>
</body>
</html>