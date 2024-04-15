<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .title {
            text-align: center;
            width: 53%;
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
            top: 14%;
            left: 17.5%;
        }

        .input-group.two div {
            top: 14%;
            left: 28%;
        }

        .input-group.two span {
            top: 14%;
            left: 61.3%;
        }

        .input-group.three label {
            top: 17%;
            left: 17.5%;
        }

        .input-group.three div {
            top: 17%;
            left: 28%;
        }

        .input-group.three span {
            top: 17%;
            left: 61.3%;
        }

        .input-group.four label {
            top: 23%;
            left: 17.5%;
        }

        .input-group.four div {
            top: 23%;
            left: 28%;
        }

        .input-group.four span {
            top: 23%;
            left: 61.3%;
        }

        .input-group.six label {
            top: 33%;
            left: 17.5%;
        }

        .input-group.six div {
            top: 33%;
            left: 28%;
        }

        .input-group.six span {
            top: 33%;
            left: 61.3%;
        }

        .input-group.seven label {
            top: 36%;
            left: 17.5%;
        }

        .input-group.seven div {
            top: 36%;
            left: 28%;
        }

        .input-group.seven span {
            top: 36%;
            left: 61.3%;
        }

        .input-group.eight label {
            top: 39%;
            left: 17.5%;
        }

        .input-group.eight div {
            top: 39%;
            left: 28%;
        }

        .input-group.eight span {
            top: 39%;
            left: 61.3%;
        }

        .input-group.nine label {
            top: 42%;
            left: 17.5%;
        }

        .input-group.nine div {
            top: 42%;
            left: 28%;
        }

        .input-group.nine span {
            top: 42%;
            left: 61.3%;
        }

        .input-group.ten label {
            top: 45%;
            left: 17.5%;
        }

        .input-group.ten div {
            top: 45%;
            left: 28%;
        }

        .input-group.ten span {
            top: 45%;
            left: 61.3%;
        }

        .input-group.five label {
            top: 20%;
            left: 17.5%;
        }

        .input-group.five div {
            top: 20%;
            left: 28%;
        }

        .input-group.five span {
            top: 20%;
            left: 61.3%;
        }

        .card-ttd:first-child p:first-child {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            top: 11.7%;
            left: 18%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:first-child p:nth-child(2) {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            top: 9.8%;
            left: 18%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:first-child .card-canvas {
            width: 26%;
            height: 70px;
            position: absolute;
            top: 3.7%;
            left: 18%;
            transform: translate(-50%);
            text-align: center;
            border-bottom: 1px dashed black;
        }

        .card-ttd:first-child p:last-child {
            font-size: 0.875rem;
            width: 26%;
            position: absolute;
            top: 0.3%;
            left: 18%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:nth-child(2) p:first-child {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            top: 11.7%;
            left: 49%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:nth-child(2) p:nth-child(2) {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            top: 9.8%;
            left: 49%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:nth-child(2) .card-canvas {
            width: 26%;
            height: 70px;
            position: absolute;
            top: 3.7%;
            left: 49%;
            transform: translate(-50%);
            text-align: center;
            border-bottom: 1px dashed black;
        }

        .card-ttd:nth-child(2) p:last-child {
            font-size: 0.875rem;
            width: 26%;
            position: absolute;
            top: 0.3%;
            left: 49%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:last-child p:first-child {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            top: 13.7%;
            left: 80%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:last-child p:nth-child(2) {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            top: 9.8%;
            left: 80%;
            transform: translate(-50%);
            text-align: center;
        }

        .card-ttd:last-child .card-canvas {
            width: 26%;
            height: 70px;
            position: absolute;
            top: 3.7%;
            left: 80%;
            transform: translate(-50%);
            border-bottom: 1px dashed black;
        }

        .card-ttd:last-child p:last-child {
            font-size: 0.875rem;
            width: 26%;
            position: absolute;
            top: 0.3%;
            left: 80%;
            transform: translate(-50%);
            text-align: center;
        }

        .description-caption {
            position: relative;
            top: 35%;
            left: 56.5%;
            width: 100%;
            transform: translate(-50%);
            font-size: 0.913rem;
        }

        .description-other {
            position: relative;
            top: 60%;
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

        .image-full {
            width: 100%;
            position: relative;
            top: 0;
            left: 0;
            border-bottom: 3px solid black;
        }

        .page_break { page-break-before: always; }

    </style>
</head>
<body>
    
    <img src="{{ public_path('assets/img/letter-header.png') }}" alt="Banner Top" class="image-full">
    <div class="container" style="position: relative">
        <h3 class="title">Surat Pernyataan Ijin Keluarga</h3>
        <div class="content-form">
            <p class="description">Yang bertanda tangan di bawah ini,</p>
            <div class="input-group one">
                <label>Nama</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->name }}</span>
            </div>
            <div class="input-group two">
                <label>Umur</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->birth_date->diffInYears(now()->endOfYear()) }} Tahun</span>
            </div>
            <div class="input-group three">
                <label>Pekerjaan</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->work }}</span>
            </div>
            <div class="input-group four">
                <label>No. HP</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->phone_number }}</span>
            </div>
            <div class="input-group six">
                <label>Nama</label>
                <div>:</div>
                <span>{{ $letter->citizent->name }}</span>
            </div>
            <div class="input-group seven">
                <label>Umur</label>
                <div>:</div>
                <span>{{ $letter->citizent->birth_date->diffInYears(now()->endOfYear()) }} Tahun</span>
            </div>
            <div class="input-group eight">
                <label>Pekerjaan</label>
                <div>:</div>
                <span>{{ $letter->citizent->work }}</span>
            </div>
            <div class="input-group nine">
                <label>Status</label>
                <div>:</div>
                <span>{{ $letter->citizent->marital_status->label() }}</span>
            </div>
            <div class="input-group ten">
                <label>Alamat</label>
                <div>:</div>
                <span>{{ $letter->citizent->address }}</span>
            </div>
            <div class="input-group five">
                <label>Alamat</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->address }}</span>
            </div>
            <p class="description-caption">Selaku {{ $letter->relationship_status->label() }} dari yang dibawah ini :</p>
            <div class="description-other">
                <p class="paragraph-one">Berdasarkan Surat Pengantar Kepala Lingkungan {{ $letter->sk->citizent->environmental->name }} No: {{ $letter->sk->cover_letter_number }}, tanggal {{ $letter->sk->created_at->format("d M Y") }} menyatakan bahwa memang benar orang tersebut diatas memberikan Ijin Kepada @if($letter->relationship_status->value === 1 || $letter->relationship_status->value === 2) Anaknya @elseif($letter->relationship_status->value === 3) Istrinya @else Suaminya @endif  Atas Nama : {{ $letter->citizent->name }} untuk {{ $letter->description }}
                <p class="paragraph-two">Demikian surat Pernyataan ini, saya buat dengan penuh tanggung jawab dan benar.</p>
            </div>
        </div>
        <div class="page_break"></div>
        <div class="content-ttd">
            <div class="card-ttd">
                <p> Calon PMI memohon Ijin</p>
                <div class="card-canvas">
                    @if ($letter->citizent->user->signature_image)
                        <img src="{{ public_path('uploads/users/signatures/' . $letter->citizent->user->signature_image) }}" style="width: 100%; height: 100%;">
                    @endif
                </div>
                <p style="text-transform: uppercase;">{{ $letter->citizent->name }}</p>
            </div>
            <div class="card-ttd">
                <p>Mengetahui</p>
                <p>Lurah Subagan</p>
                <div class="card-canvas">
                    @if(isset($letter->sk->villageHead))
                        @if ($letter->sk->status_by_village_head === 1)
                            <img src="{{ public_path('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image) }}" style="width: 100%; height: 100%;">
                        @endif
                    @elseif (Request::is("letters/parental-permission/$letter->id/preview*"))
                        @if (($user->isVillageHead() && $user->signature_image) || $letter->sk->villageHead)
                            <img src="{{ public_path('uploads/users/signatures/' . $user->signature_image) }}" style="width: 100%; height: 100%;">
                        @endif
                    @endif 
                </div>
                @if ($letter->sk->villageHead && $letter->sk->status_by_village_head === 1)
                    <p style="text-transform: uppercase;">{{ $letter->sk->villageHead->name }}</p>                    
                @endif
            </div>
            <div class="card-ttd">
                <p>Denpasar, {{ $letter->sk->created_at->format("d M Y") }}</p>
                <p>Yang Membuat Pernyataan /yang
                    memberikan Ijin</p>
                <div class="card-canvas">
                    @if($letter->sk->citizent->user->signature_image)
                        <img src="{{ public_path('uploads/users/signatures/' . $letter->sk->citizent->user->signature_image) }}" style="width: 100%; height: 100%;">
                    @elseif (Request::is("letters/parental-permission/$letter->id/preview*"))
                        @if (($user->isCitizent() && $user->signature_image) || $letter->sk->citizent->user->signature_image)
                            <img src="{{ public_path('uploads/users/signatures/' . $user->signature_image) }}" style="width: 100%; height: 100%;">
                        @endif
                    @endif 
                </div>
                <p style="text-transform: uppercase;">{{ $letter->sk->citizent->name }}</p>
            </div>
        </div>
    </div>
</body>
</html>