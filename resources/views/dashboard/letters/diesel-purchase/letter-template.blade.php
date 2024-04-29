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
            width: 65.5%;
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
            top: 42.5%;
            left: 17.5%;
        }

        .input-group.two div {
            top: 42.5%;
            left: 28%;
        }

        .input-group.two span {
            top: 42.5%;
            left: 61.3%;
        }

        .input-group.three label {
            top: 45%;
            left: 17.5%;
        }

        .input-group.three div {
            top: 45%;
            left: 28%;
        }

        .input-group.three span {
            top: 45%;
            left: 61.3%;
        }

        .input-group.four label {
            top: 47.5%;
            left: 17.5%;
        }

        .input-group.four div {
            top: 47.5%;
            left: 28%;
        }

        .input-group.four span {
            top: 47.5%;
            left: 61.3%;
        }

        .input-group.five label {
            top: 52%;
            left: 17.5%;
        }

        .input-group.five div {
            top: 52%;
            left: 28%;
        }

        .input-group.five span {
            top: 52%;
            left: 61.3%;
        }

        .input-group.six label {
            top: 56.5%;
            left: 17.5%;
        }

        .input-group.six div {
            top: 56.5%;
            left: 28%;
        }

        .input-group.six span {
            top: 56.5%;
            left: 61.3%;
        }

        .input-group.seven label {
            top: 59%;
            left: 17.5%;
        }

        .input-group.seven div {
            top: 59%;
            left: 28%;
        }

        .input-group.seven span {
            top: 59%;
            left: 61.3%;
        }

        .input-group.eight label {
            top: 61.5%;
            left: 17.5%;
        }

        .input-group.eight div {
            top: 61.5%;
            left: 28%;
        }

        .input-group.eight span {
            top: 61.5%;
            left: 61.3%;
        }

        .input-group.nine label {
            top: 64%;
            left: 17.5%;
        }

        .input-group.nine div {
            top: 64%;
            left: 28%;
        }

        .input-group.nine span {
            top: 64%;
            left: 61.3%;
        }

        .input-group.ten label {
            top: 66.5%;
            left: 17.5%;
        }

        .input-group.ten div {
            top: 66.5%;
            left: 28%;
        }

        .input-group.ten span {
            top: 66.5%;
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
            top: 72%;
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

        .card-canvas .name {
            position: absolute;
            width: 100%;
            top: 70%;
            right: 30%;
        }

        .card-canvas .name p:first-child {
            width: 100%;
            text-decoration: underline;
        }

        .card-canvas .name p:last-child {
            width: 100%;
            bottom: -15%;
        }
    </style>
</head>

<body>

    <div class="container">
        <img src="{{ url('assets/img/letter-header.png') }}" alt="Banner Top" class="image-full">
        <h3 class="title">Surat Keterangan Pembelian BBM di SPBU</h3>
        <div class="content-form">
            <p class="subtitle">Nomor : {{ $letter->sk->reference_number }}</p>
            <p class="description">Yang bertanda tangan dibawah ini Lurah Subagan, Kecamatan Karangasem, Kabupaten
                Karangasem dengan ini memberikan Rekomendasi Pembelian BBM di SPBU Kesesi kepada:</p>
            <div class="input-group one">
                <label>Nama</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->name }}</span>
            </div>
            <div class="input-group two">
                <label>Tempat Tanggal Lahir</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->birth_place . ', ' . $letter->sk->citizent->birth_date->format('d-m-Y') }}</span>
            </div>
            <div class="input-group three">
                <label>Agama</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->religion->label() }}</span>
            </div>
            <div class="input-group four">
                <label>Alamat</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->address }}</span>
            </div>
            <div class="input-group five">
                <label>Alamat Usaha</label>
                <div>:</div>
                <span>{{ $letter->business_address }}</span>
            </div>
            <div class="input-group six">
                <label>Keperluan BBM</label>
                <div>:</div>
                <span>{{ $letter->purpose }}</span>
            </div>
            <div class="input-group seven">
                <label>Kebutuhan BBM</label>
                <div>:</div>
                <span>{{ $letter->requirement }}</span>
            </div>
            <div class="input-group eight">
                <label>Tempat Beli BBM</label>
                <div>:</div>
                <span>{{ $letter->purchase_place }}</span>
            </div>
            <div class="input-group nine">
                <label>Masa Berlaku</label>
                <div>:</div>
                <span>{{ $letter->start_expired_date->format('d M Y') . ' s/d ' . $letter->end_expired_date->format('d M Y') }}</span>
            </div>
            <div class="input-group ten">
                <label>Keterangan</label>
                <div>:</div>
                <span>Menerangkan bahwa orang tersebut diatas memang benar beralamat di
                    {{ $letter->sk->citizent->address }}, dan memiliki {{ $letter->purpose }}</span>
            </div>
            <div class="description-other">
                <p class="paragraph-one">Berdasarkan Surat Pengatar Kepala Lingkungan
                    {{ $letter->sk->citizent->environmental->name }}, Nomor: {{ $letter->sk->cover_letter_number }},
                    tanggal {{ $letter->sk->created_at->format('d M Y') }}, memang benar yang bersangkutan memiliki
                    <strong>Usaha {{ $letter->purpose }}</strong></p>
                <p class="paragraph-two">Demikian surat keterangan ini kami buat dengan sebenarnya untuk dapat
                    dipergunakan sebagaimana mestinya.</p>
            </div>
        </div>
        <div class="content-ttd">
            <div class="card-ttd">
                <p>Subagan, {{ $letter->sk->villageHead ? $letter->sk->updated_at->format('d M Y') : '..........' }}
                </p>
                <p>Lurah Subagan</p>
                <div class="card-canvas">
                    @if (isset($letter->sk->villageHead))
                        @if ($letter->sk->status_by_village_head === 1 && isset($letter->sk->villageHead->user->signature_image))
                            <img src="{{ url('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image) }}"
                                style="width: 100%; height: 100%;">
                            <div class="name">
                                <p>{{ $letter->sk->villageHead->name }}</p>
                                <p>NIP : {{ $letter->sk->villageHead->employee_number }}</p>
                            </div>
                        @endif
                    {{-- @elseif (Request::is("letters/diesel-purchase/$letter->id/preview*"))
                        @if (($user->isVillageHead() && $user->signature_image) || $letter->sk->villageHead)
                            <img src="{{ url('uploads/users/signatures/' . $user->signature_image) }}"
                                style="width: 100%; height: 100%;">
                            <div class="name">
                                <p>{{ $letter->sk->villageHead->name }}</p>
                                <p>NIP : {{ $letter->sk->villageHead->employee_number }}</p>
                            </div>
                        @endif --}}
                    @endif
                </div>
                @if ($letter->sk->villageHead && $letter->sk->status_by_village_head === 1)
                    <p style="text-transform: uppercase;">{{ $letter->sk->villageHead->name }}</p>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
