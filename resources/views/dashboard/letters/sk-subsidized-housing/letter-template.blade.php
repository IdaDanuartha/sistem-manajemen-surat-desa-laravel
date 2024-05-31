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

        .input-group.seven label {
            top: 55%;
            left: 17.5%;
        }

        .input-group.seven div {
            top: 55%;
            left: 28%;
        }

        .input-group.seven span {
            top: 55%;
            left: 61.3%;
        }

        .input-group.eight label {
            top: 58%;
            left: 17.5%;
        }

        .input-group.eight div {
            top: 58%;
            left: 28%;
        }

        .input-group.eight span {
            top: 58%;
            left: 61.3%;
        }

        .input-group.five label {
            top: 61%;
            left: 17.5%;
        }

        .input-group.five div {
            top: 61%;
            left: 28%;
        }

        .input-group.five span {
            top: 61%;
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
            top: 65%;
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

        .cap-kelurahan {
            position: absolute;
            top: -50px;
            right: 15px;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <img src="{{ url('assets/img/letter-header.png') }}" alt="Banner Top" class="image-full">
        <h3 class="title">Surat Keterangan</h3>
        <div class="content-form">
            <p class="subtitle">Nomor: {{ $letter->sk->reference_number }}</p>
            <p class="description">Yang bertanda tangan dibawah ini Lurah Subagan, Kecamatan Karangasem, Kabupaten  Karangasem dengan ini menerangkan bahwa :</p>
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
            <div class="input-group three">
                <label>Jenis Kelamin</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->gender->label() }}</span>
            </div>
            <div class="input-group four">
                <label>Agama</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->religion->label() }}</span>
            </div>
            <div class="input-group six">
                <label>Kewarganegaraan</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->citizenship }}</span>
            </div>
            <div class="input-group seven">
                <label>Pekerjaan</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->work }}</span>
            </div>
            <div class="input-group eight">
                <label>No KK/ KTP</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->family_card_number }}</span>
            </div>
            <div class="input-group five">
                <label>Alamat</label>
                <div>:</div>
                <span>{{ $letter->sk->citizent->address }}</span>
            </div>
            <div class="description-other">
                <p class="paragraph-one">Berdasarkan surat pengantar Kepala Lingkungan {{ $letter->sk->citizent->environmental->name }}, No : {{ $letter->sk->cover_letter_number }}, menerangkan bahwa memang benar orang tersebut diatas tidak Memiliki Tempat Tinggal/ Rumah, selama ini menumpang di Rumah Orang Tua.</p>
                <p class="paragraph-two">Demikian surat keterangan ini kami buat untuk  dapat  dipergunakan sebagai Administrasi Permohonan Rumah Bersubsidi.</p>
            </div>
        </div>
        <div class="content-ttd">
            <div class="card-ttd">
                <p>Subagan, {{ ($letter->sk->sectionHead || $letter->sk->villageHead) && ($letter->sk->status_by_section_head === 1 || $letter->sk->status_by_village_head === 1) ? $letter->sk->updated_at->format("d M Y") : ".........." }}</p>
                <p>A.n, Lurah Subagan</p>
                <p class="other">{{ $letter->sk->sectionHead ? $letter->sk->sectionHead->position : "" }}</p>
                <div class="card-canvas">
                    @if (isset($letter->sk->sectionHead))
                        @if ($letter->sk->status_by_section_head === 1 && isset($letter->sk->sectionHead->user->signature_image))
                            <img class="cap-kelurahan" src="{{ url("assets/img/cap_kelurahan.png") }}" style="width: 85%; height: auto;" alt="">
                            <img src="{{ url('uploads/users/signatures/' . $letter->sk->sectionHead->user->signature_image) }}" style="width: 100%; height: 100%;">
                            <div class="name">
                                <p>{{ $letter->sk->sectionHead->name }}</p>    
                                <p>NIP : {{ $letter->sk->sectionHead->employee_number }}</p>    
                            </div>  
                        @endif  
                    @else
                        @if(isset($letter->sk->villageHead))
                            @if ($letter->sk->status_by_village_head === 1 && isset($letter->sk->villageHead->user->signature_image))
                                <img class="cap-kelurahan" src="{{ url("assets/img/cap_kelurahan.png") }}" style="width: 85%; height: auto;" alt="">
                                <img src="{{ url('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image) }}" style="width: 100%; height: 100%;">
                                <div class="name">
                                    <p>{{ $letter->sk->villageHead->name }}</p>    
                                    <p>NIP : {{ $letter->sk->villageHead->employee_number }}</p>    
                                </div>  
                            @endif
                        @endif   
                    @endif      
                </div>
            </div>
        </div>
    </div>
</body>
</html>