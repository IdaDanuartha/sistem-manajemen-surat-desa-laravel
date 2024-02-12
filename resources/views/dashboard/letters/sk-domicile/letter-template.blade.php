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
        <img src="{{ public_path('assets/img/letter-header.png') }}" alt="Banner Top" class="image-full">
        <h3 class="title">Surat Keterangan Domisili</h3>
        <div class="content-form">
            <p class="subtitle">Nomor: 374 / VI / Ket / Kel.Sub / 2023</p>
            <p class="description">Yang bertanda tangan di bawah ini,</p>
            <div class="input-group one">
                <label>Nama</label>
                <div>:</div>
                <span>Putu Aditya Prayatna</span>
            </div>
            <div class="input-group two">
                <label>Jabatan</label>
                <div>:</div>
                <span>Lurah Subagan</span>
            </div>
            <div class="input-group three">
                <label>Alamat</label>
                <div>:</div>
                <span>Lingkungan Desa, Kelurahan Subagan,  Kecamatan Karangasem, Kabupaten Karangasem.</span>
            </div>

            <div class="input-group four">
                <label>Pokmas</label>
                <div>:</div>
                <span style="text-transform: uppercase; font-weight: bold;">KETUA BR. ADAT DESA SUBAGAN</span>
            </div>
            <div class="input-group five">
                <label>Nama Ketua</label>
                <div>:</div>
                <span style="text-transform: uppercase; font-weight: bold;">I KETUT MERTA</span>
            </div>
            <div class="input-group six">
                <label>Alamat</label>
                <div>:</div>
                <span>Lingkungan Desa, Kelurahan Subagan,  Kecamatan Karangasem, Kabupaten Karangasem.</span>
            </div>
            <p class="description-caption">Dengan ini menerangkan bahwa :</p>
            <div class="description-other">
                <p class="paragraph-one">Berdasarkan surat pengantar Kepala Lingkungan Desa, No: 167 / LD / VI / 2023, tanggal 21 Juni 2023 menyatakan bahwa  memang benar Banjar Adat Desa Subagan tersebut di atas beralamat/ berlokasi di Lingkungan Desa, Kelurahan Subagan, Kecamatan Karangasem, Kabupaten Karangasem.</p>
                <p class="paragraph-two">Demikian surat keterangan ini kami buat untuk  dapat  dipergunakan sebagaimana mestinya</p>
            </div>
        </div>
        <div class="content-ttd">
            <div class="card-ttd">
                <p>Mengetahui</p>
                <p>Kepala Lingkungan Desa</p>
                <div class="card-canvas">
                    <img src="{{ public_path('assets/banner-top.png') }}" style="width: 100%; height: 100%;">
                </div>
                <p class="other">I Gede Suasta Ardika</p>
            </div>
            <div class="card-ttd">
                <p>Subagan, 22 Pebruari 2023</p>
                <p>A.n, Lurah Subagan</p>
                {{-- <p class="other">Sekretaris</p> --}}
                <div class="card-canvas">
                    <img src="{{ public_path('assets/banner-top.png') }}" style="width: 100%; height: 100%;">
                </div>
            </div>
        </div>
    </div>
</body>
</html>