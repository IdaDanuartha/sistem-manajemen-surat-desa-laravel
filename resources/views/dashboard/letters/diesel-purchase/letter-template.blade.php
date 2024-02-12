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
            width: 78.5%;
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
    </style>
</head>
<body>
    
    <div class="container">
        <img src="{{ public_path('assets/banner-top.png') }}" alt="Banner Top" class="image-full">
        <img src="{{ public_path('assets/border-top.png') }}" alt="Border Top" class="border-full">
        <h3 class="title">Surat Keterangan Rekomendasi Pembelian Solar</h3>
        <div class="content-form">
            <p class="subtitle">Nomor : 517 / 18 / I / Ket / Kel. Subagan / 2023</p>
            <p class="description">Yang bertanda tangan dibawah ini  Lurah Subagan, Kecamatan Karangasem, Kabupaten Karangasem dengan ini memberikan Rekomendasi Pembelian BBM di SPBU Kesesi kepada:</p>
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
                <label>Agama</label>
                <div>:</div>
                <span>hindu</span>
            </div>
            <div class="input-group four">
                <label>Alamat</label>
                <div>:</div>
                <span>Lingkungan Desa, Kelurahan Subagan,  Kecamatan Karangasem, Kabupaten Karangasem.</span>
            </div>
            <div class="input-group five">
                <label>Alamat Usaha</label>
                <div>:</div>
                <span>Lingkungan Desa, Kelurahan Subagan,  Kecamatan Karangasem, Kabupaten Karangasem.</span>
            </div>
            <div class="input-group six">
                <label>Keperluan BBM</label>
                <div>:</div>
                <span>Pertanian/ Menjalankan Mesin Traktor Sawah</span>
            </div>
            <div class="input-group seven">
                <label>Kebutuhan BBM</label>
                <div>:</div>
                <span>Solar 5 Liter/ Hari</span>
            </div>
            <div class="input-group eight">
                <label>Tempat Beli BBM</label>
                <div>:</div>
                <span>SPBU Subagan</span>
            </div>
            <div class="input-group nine">
                <label>Masa Berlaku</label>
                <div>:</div>
                <span>-</span>
            </div>
            <div class="input-group ten">
                <label>Keterangan</label>
                <div>:</div>
                <span>Menerangkan bahwa orang tersebut diatas memang benar beralamat di Lingkungan Br. Desa Kelurahan Subagan, Kecamatan Karangasem, Kabupaten Karangasem, dan memiliki mesin traktor.</span>
            </div>
            <div class="description-other">
                <p class="paragraph-one">Berdasarkan Surat Pengatar Kepala Lingkungan Desa, Nomor: 07 / LD / I /2023, tanggal 17 Januari 2023, memang benar yang bersangkutan memiliki <strong>Usaha Pertanian/ Menjalankan Mesin Traktor Sawah.</strong></p>
                <p class="paragraph-two">Demikian surat keterangan ini kami buat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
            </div>
        </div>
        <div class="content-ttd">
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