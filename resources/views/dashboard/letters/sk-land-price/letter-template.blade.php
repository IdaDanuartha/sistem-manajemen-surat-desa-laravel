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
            width: 51%;
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
            top: 30.5%;
            left: 50%;
            width: 92%;
            transform: translate(-50%);
        }

        .paragraph-one {
            font-size: 1rem;
            line-height: 180%;
            text-indent: 42px;
        }

        .paragraph-two {
            font-size: 1rem;
            line-height: 150%;
            text-indent: 42px;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <img src="{{ public_path('assets/banner-top.png') }}" alt="Banner Top" class="image-full">
        <img src="{{ public_path('assets/border-top.png') }}" alt="Border Top" class="border-full">
        <h3 class="title">Surat Keterangan Harga Tanah</h3>
        <div class="content-form">
            <p class="subtitle">Nomor: 03 / III / Ket / Kel. Sub / 2019</p>
            <div class="description-other">
                <p class="paragraph-one">Yang bertanda tangan di bawah ini, Lurah subagan, Kecamatan Karangasem, Kabupaten Karangasem. Berdasarkan Surat Pengantar Kepala Lingkungan Telagamas, Nomor: 76 / TLGMS / III / 2019, tanggal 19 Maret 2019, dengan ini menerangkan dengan sebenarnya bahwa sepanjang pengetahuan kami harga tanah dengan Nomor Obyek Pajak (NOP) : 51.07.040.036.015-0032.0 atas nama SY HADIJAH yang berlokasi  di Jl.Nenas Lingkungan Telagamas, Kelurahan Subagan, Kecamatan Karangasem, Kabupaten Karangasem. Harga saat ini adalah berkisaran Rp 150.000.000-/are.</p>
                <p class="paragraph-two">Demikian surat keterangan ini kami buat dengan sebenarnya untuk dapat dipergunakan sebagai Administrasi Kredit di bank.</p>
            </div>
        </div>
        <div class="content-ttd">
            <div class="card-ttd">
                <p>Subagan, 22 Pebruari 2023</p>
                <p>Lurah Subagan</p>
                {{-- <p class="other">Sekretaris</p> --}}
                <div class="card-canvas">
                    <img src="{{ public_path('assets/banner-top.png') }}" style="width: 100%; height: 100%;">
                </div>
            </div>
        </div>
    </div>
</body>
</html>