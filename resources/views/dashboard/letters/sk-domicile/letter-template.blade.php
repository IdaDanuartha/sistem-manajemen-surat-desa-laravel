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

        .input-group.four label {
            top: 51%;
            left: 17.5%;
        }

        .input-group.four div {
            top: 51%;
            left: 28%;
        }

        .input-group.four span {
            top: 51%;
            left: 61.3%;
        }

        .input-group.five label {
            top: 54%;
            left: 17.5%;
        }

        .input-group.five div {
            top: 54%;
            left: 28%;
        }

        .input-group.five span {
            top: 54%;
            left: 61.3%;
        }

        .input-group.six label {
            top: 57%;
            left: 17.5%;
        }

        .input-group.six div {
            top: 57%;
            left: 28%;
        }

        .input-group.six span {
            top: 57%;
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
            bottom: -0.5%;
            left: 20%;
            transform: translate(-50%);
        }

        .card-ttd:first-child .card-canvas {
            width: 30%;
            height: 70px;
            position: absolute;
            bottom: 3.3%;
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

        .description-caption {
            position: relative;
            top: 45%;
            left: 56.5%;
            width: 100%;
            transform: translate(-50%);
            font-size: 0.913rem;
        }

        .description-other {
            position: relative;
            top: 56%;
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
        <img src="{{ url('assets/img/letter-header.png') }}" alt="Banner Top" class="image-full">
        <h3 class="title">Surat Keterangan Domisili</h3>
        <div class="content-form">
            <p class="subtitle">Nomor: {{ $letter->sk->reference_number }}</p>
            <p class="description">Yang bertanda tangan di bawah ini,</p>
            <div class="input-group one">
                <label>Nama</label>
                <div>:</div>
                <span>{{ $village_head->authenticatable->name }}</span>
            </div>
            <div class="input-group two">
                <label>Jabatan</label>
                <div>:</div>
                <span>Lurah Subagan</span>
            </div>
            <div class="input-group three">
                <label>Alamat</label>
                <div>:</div>
                <span>{{ $village_head->authenticatable->address ?? "-" }}</span>
            </div>

            <div class="input-group four">
                <label>Pokmas</label>
                <div>:</div>
                <span style="text-transform: uppercase; font-weight: bold;">{{ $letter->position . " " . $letter->community_group }}</span>
            </div>
            <div class="input-group five">
                <label>Nama {{ $letter->position }}</label>
                <div>:</div>
                <span style="text-transform: uppercase; font-weight: bold;">{{ $letter->citizent->name }}</span>
            </div>
            <div class="input-group six">
                <label>Alamat</label>
                <div>:</div>
                <span>{{ $letter->citizent->address }}</span>
            </div>
            <p class="description-caption">Dengan ini menerangkan bahwa :</p>
            <div class="description-other">
                <p class="paragraph-one">Berdasarkan surat pengantar Kepala Lingkungan {{ $letter->sk->citizent->environmental->name }}, No: {{ $letter->sk->cover_letter_number }}, tanggal {{ $letter->sk->created_at->format("d M Y") }} menyatakan bahwa  memang benar Banjar Adat Desa Subagan tersebut di atas beralamat/ berlokasi di {{ $letter->citizent->address }}.</p>
                <p class="paragraph-two">Demikian surat keterangan ini kami buat untuk  dapat  dipergunakan sebagaimana mestinya</p>
            </div>
        </div>
        <div class="content-ttd">
            <div class="card-ttd">
                <p>Mengetahui</p>
                <p>Kepala Lingkungan Desa</p>
                <div class="card-canvas">
                    @if(isset($letter->sk->environmentalHead))
                        @if ($letter->sk->status_by_environmental_head === 1)
                            <img src="{{ url('uploads/users/signatures/' . $letter->sk->environmentalHead->user->signature_image) }}" style="width: 100%; height: 100%;">
                        @endif
                    @elseif (Request::is("letters/sk-domicile/$letter->id/preview*"))
                        @if (($user->isEnvironmentalHead() && $user->signature_image) || $letter->sk->environmentalHead)
                            <img src="{{ url('uploads/users/signatures/' . $user->signature_image) }}" style="width: 100%; height: 100%;">
                        @endif
                    @endif
                </div>
                @if ($letter->sk->environmentalHead && $letter->sk->status_by_environmental_head === 1)
                    <p class="other" style="text-transform: uppercase;">{{ $letter->sk->environmentalHead->name }}</p>                    
                @endif           
            </div>
            <div class="card-ttd">
                <p>Subagan, {{ $letter->sk->villageHead ? $letter->sk->updated_at->format("d M Y") : ".........." }}</p>
                <p>Lurah Subagan</p>
                <div class="card-canvas">
                    @if(isset($letter->sk->villageHead))
                        @if ($letter->sk->status_by_village_head === 1)
                            <img src="{{ url('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image) }}" style="width: 100%; height: 100%;">
                        @endif
                    @elseif (Request::is("letters/sk-domicile/$letter->id/preview*"))
                        @if (($user->isVillageHead() && $user->signature_image) || $letter->sk->villageHead)
                            <img src="{{ url('uploads/users/signatures/' . $user->signature_image) }}" style="width: 100%; height: 100%;">
                        @endif
                    @endif 
                </div> 
            </div>
        </div>
    </div>
</body>
</html>