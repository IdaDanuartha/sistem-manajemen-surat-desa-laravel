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
            width: 51%;
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

        .input-group.seven label {
            top: 46%;
            left: 17.5%;
        }

        .input-group.seven div {
            top: 46%;
            left: 28%;
        }

        .input-group.seven span {
            top: 46%;
            left: 61.3%;
        }

        .input-group.eight label {
            top: 49%;
            left: 17.5%;
        }

        .input-group.eight div {
            top: 49%;
            left: 28%;
        }

        .input-group.eight span {
            top: 49%;
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

        .input-group.nine label {
            top: 68%;
            left: 17.5%;
        }

        .input-group.nine div {
            top: 68%;
            left: 28%;
        }

        .input-group.nine span {
            top: 68%;
            left: 61.3%;
        }

        .input-group.ten label {
            top: 71%;
            left: 17.5%;
        }

        .input-group.ten div {
            top: 71%;
            left: 28%;
        }

        .input-group.ten span {
            top: 71%;
            left: 61.3%;
        }

        .input-group.eleven label {
            top: 74%;
            left: 17.5%;
        }

        .input-group.eleven div {
            top: 74%;
            left: 28%;
        }

        .input-group.eleven span {
            top: 74%;
            left: 61.3%;
        }

        .input-group.twelve label {
            top: 77%;
            left: 17.5%;
        }

        .input-group.twelve div {
            top: 77%;
            left: 28%;
        }

        .input-group.twelve span {
            top: 77%;
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

        .description-other-bottom {
            position: relative;
            top: 70.5%;
            left: 50%;
            width: 92%;
            transform: translate(-50%);
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
        <h3 class="title">Surat Keterangan Tidak Mampu</h3>
        <div class="content-form">
            <p class="subtitle">Nomor: {{ $letter->sk->reference_number }}</p>
            <p class="description">Yang bertanda tangan di bawah ini, Lurah Subagan, Kecamatan Karangasem, Kabupaten Karangasem, Propinsi Bali, menerangkan dengan sebenarnya bahwa :</p>
            @if($letter->sktm_type->value == 4 || $letter->sktm_type->value == 5)
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
                <div class="input-group seven">
                    <label>Pekerjaan</label>
                    <div>:</div>
                    <span>{{ $letter->sk->citizent->work }}</span>
                </div>
                <div class="input-group eight">
                    <label>Agama</label>
                    <div>:</div>
                    <span>{{ $letter->sk->citizent->religion->label() }}</span>
                </div>
                <div class="input-group five">
                    <label>Alamat</label>
                    <div>:</div>
                    <span>{{ $letter->sk->citizent->address }}.</span>
                </div>
            @else
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
                {{-- <div class="input-group four">
                    <label>Jenis Kelamin</label>
                    <div>:</div>
                    <span>{{ $letter->sk->citizent->gender->label() }}</span>
                </div>
                <div class="input-group four">
                    <label>Agama</label>
                    <div>:</div>
                    <span>{{ $letter->sk->citizent->religion->label() }}</span>
                </div> --}}
                <div class="input-group seven">
                    <label>Pekerjaan</label>
                    <div>:</div>
                    <span>{{ $letter->sk->citizent->work }}</span>
                </div>
                <div class="input-group eight">
                    <label>No KK/ KTP</label>
                    <div>:</div>
                    <span>{{ $letter->sk->citizent->national_identify_number }}</span>
                </div>
                <div class="input-group five">
                    <label>Alamat</label>
                    <div>:</div>
                    <span>{{ $letter->sk->citizent->address }}</span>
                </div>
            @endif
            <div class="description-other">
                @if ($letter->sktm_type->value === 1)
                    <p class="paragraph-one">Berdasarkan surat pengantar Kepala Lingkungan Galiran Kaler,  No:  92 / GLK / II / 2016, tanggal  15 Pebruari  2016,  Sepanjang pengetahuan kami memang benar orang tersebut di atas tidak mampu untuk membayar proses sidang perceraian.</p>
                @elseif ($letter->sktm_type->value === 2)
                    <p class="paragraph-one">Berdasarkan Surat Pengantar dari Kepala Lingkungan Desa, No. 04 / LD / I / 2023  tanggal 05 Januari 2024, memang benar orang tersebut diatas kurang mampu, untuk Membiayai Sekolah Anaknya, Atas Nama: </p>
                @elseif ($letter->sktm_type->value === 3)
                    <p class="paragraph-one">Berdasarkan surat pengantar Kepala Lingkungan Desa,  No:  211 / LD /  X / 2023,  tanggal 27 Oktober 2023,  sepanjang pengetahuan kami memang benar orang tersebut di atas Kurang Mampu dan Memohon Bantuan Bedah Rumah.</p>
                @elseif ($letter->sktm_type->value === 4)
                    <p class="paragraph-one">Berdasarkan surat pengantar Kepala Lingkungan Jasri Kelod No : 153/ LJK /  III / 2019, tanggal 19 Maret 2019 menyatakan dengan sebenarnya bahwa memang benar orang tersebut diatas Tidak mampu/miskin dan Disabilitas</p>
                @elseif ($letter->sktm_type->value === 5)
                    <p class="paragraph-one">Berdasarkan surat pengantar Kepala Lingkungan Desa No : 107/ LJK  /  IV / 2023,    tanggal 05 April 2023 menyatakan dengan sebenarnya bahwa memang benar orang tersebut diatas Tidak mampu / Miskin.</p>
                @else
                    <p class="paragraph-one">Berdasarkan Surat Pengantar dari Kepala Lingkungan Desa, No: 430 /LD / VIII / 2021  tanggal  19 Agustus 2021 ,menyatakan bahwa memang benar orang tersebut diatas kurang mampu / miskin dan lansia .</p>
                @endif
                {{-- @if (!$letter->sktm_type->value === 2) --}}
                    <p class="paragraph-two">Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan {{ $letter->purpose === "-" ? "sebagai mana mestinya" : "sebagai " .$letter->purpose }}.</p>
                {{-- @endif --}}
            </div>
            @if ($letter->sktm_type->value === 2)
                <div class="input-group nine">
                    <label>Nama</label>
                    <div>:</div>
                    <span>{{ $letter->sktmSchool->citizent->name }}</span>
                </div>
                <div class="input-group ten">
                    <label>Tempat Tanggal Lahir</label>
                    <div>:</div>
                    <span>{{ $letter->sktmSchool->citizent->birth_place . ", " . $letter->sktmSchool->citizent->birth_date->format("d-m-Y") }}</span>
                </div>
                <div class="input-group eleven">
                    <label>Jenis Kelamin</label>
                    <div>:</div>
                    <span>{{ $letter->sktmSchool->citizent->gender->label() }}</span>
                </div>
                <div class="input-group twelve">
                    <label>Sekolah</label>
                    <div>:</div>
                    <span>{{ $letter->sktmSchool->school_name }}</span>
                </div>
            @endif
            {{-- @if ($letter->sktm_type->value === 2)
                <div class="description-other-bottom">
                    <p class="paragraph-two">Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan {{ $letter->purpose === "-" ? "sebagai mana mestinya" : "sebagai " .$letter->purpose }}.</p>
                </div>
            @endif --}}
        </div>
        <div class="content-ttd">
            @if ($letter->sktm_type->value === 2)
                <div class="card-ttd">
                    <p>Mengetahui</p>
                    <p>Camat Karangasem</p>                
                    <div class="card-canvas">
                        {{-- <img src="{{ public_path('assets/banner-top.png') }}" style="width: 100%; height: 100%;"> --}}
                    </div>
                </div>
            @endif
            <div class="card-ttd">
                <p>Subagan, {{ $letter->sk->villageHead && $letter->sk->status_by_village_head === 1 ? $letter->sk->updated_at->format("d M Y") : ".........." }}</p>
                <p>A.n, {{ $letter->sk->villageHead && $letter->sk->status_by_village_head === 1 ? $letter->sk->villageHead->name : ".........." }}</p>
                <p class="other">Kasi Pem dan Kesos</p>
                <div class="card-canvas">
                    @if(isset($letter->sk->villageHead))
                        @if ($letter->sk->status_by_village_head === 1)
                            <img src="{{ public_path('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image) }}" style="width: 100%; height: 100%;">
                        @endif
                    @elseif (Request::is("letters/sktm/$letter->id/preview*"))
                        @if (($user->isVillageHead() && $user->signature_image) || $letter->sk->villageHead)
                            <img src="{{ public_path('uploads/users/signatures/' . $user->signature_image) }}" style="width: 100%; height: 100%;">
                        @endif
                    @endif         
                </div>
            </div>
        </div>
    </div>
</body>
</html>