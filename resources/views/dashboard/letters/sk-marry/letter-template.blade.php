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
            width: 55%;
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
        <img src="{{ public_path('assets/banner-top.png') }}" alt="Banner Top" class="image-full">
        <img src="{{ public_path('assets/border-top.png') }}" alt="Border Top" class="border-full">
        <h3 class="title">Surat Keterangan Sudah Menikah</h3>
        <div class="content-form">
            <p class="subtitle">Nomor : 474.2 / 53 / III / Ket / Kppdk / 2022</p>
            <p class="description">Yang bertanda tangan dibawah ini Lurah Subagan, Kecamatan Karangasem, Kabupaten  Karangasem dengan ini menerangkan bahwa :</p>
            <div class="input-group one">
                <label>Nama</label>
                <div>:</div>
                <span>Putu Aditya Prayatna</span>
            </div>
            <div class="input-group two">
                <label>Tempat Tanggal Lahir</label>
                <div>:</div>
                <span>Subagan, 04-06-1976</span>
            </div>
            <div class="input-group three">
                <label>Jenis Kelamin</label>
                <div>:</div>
                <span>Laki-Laki</span>
            </div>
            <div class="input-group four">
                <label>Agama</label>
                <div>:</div>
                <span>Hindu</span>
            </div>
            <div class="input-group six">
                <label>Kewarganegaraan</label>
                <div>:</div>
                <span>Indonesia</span>
            </div>
            <div class="input-group nine">
                <label>Status</label>
                <div>:</div>
                <span>Kawin</span>
            </div>
            <div class="input-group seven">
                <label>Pekerjaan</label>
                <div>:</div>
                <span>Wiraswasta</span>
            </div>
            <div class="input-group eight">
                <label>No KK/ KTP</label>
                <div>:</div>
                <span>5107040406760007</span>
            </div>
            <div class="input-group five">
                <label>Alamat</label>
                <div>:</div>
                <span>Lingkungan Desa, Kelurahan Subagan,  Kecamatan Karangasem, Kabupaten Karangasem.</span>
            </div>
            <div class="description-other">
                <p class="paragraph-one">Berdasarkan surat pengantar dari Kepala Lingkungan Desa, No: 53/ LD / III / 2022, tanggal 18 Maret 2022, Sepanjang pengetahuan kami bahwa memang benar orang tersebut di atas <strong>Belum Menikah / Kawin Sebelum Tanggal 07 Maret 2022.</strong></p>
                <p class="paragraph-two">Demikian surat keterangan ini kami buat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
            </div>
        </div>
        <div class="content-ttd">
            <div class="card-ttd">
                <p>Subagan, 22 Pebruari 2023</p>
                <p>A.n, Lurah Subagan</p>
                <p class="other">Kasi Pelum</p>
                <div class="card-canvas">
                    <img src="{{ public_path('assets/banner-top.png') }}" style="width: 100%; height: 100%;">
                </div>
            </div>
        </div>
    </div>
</body>
</html>