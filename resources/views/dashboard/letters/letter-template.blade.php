<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Desa</title>

    <style>
        .image-full {
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .page-break {
            page-break-after: always;
        }
        
        .content-form .header-line {
            width: 100%;
            height: 2px;
            background: #222 !important;
            border: 1px solid black;
        }

        .title {
            position: absolute;
            top: 26%;
            left: 50%;
            transform: translate(-50%);
        }

        .subtitle {
            position: absolute;
            top: 34%;
            left: 50%;
            transform: translate(-50%);
            width: 91%;
            font-size: 0.913rem;
        }

        .content-form {
            position: relative;
            top: -100px;
        }

        .content-form .input-group label {
            width: 22% !important;
            position: absolute;
            transform: translate(-50%);
            font-size: 0.913rem !important;
        }

        .content-form .input-group div {
            width: 5% !important;
            position: absolute;
            transform: translate(-50%);
            font-size: 0.913rem !important;
        }

        .content-form .input-group span {
            width: 67% !important;
            position: absolute;
            transform: translate(-50%);
            font-size: 0.913rem !important;
        }

        .content-form .input-group.one label {
            top: 38%;
            left: 15.7%;
        }

        .content-form .input-group.one div {
            top: 38%;
            left: 23%;
        }

        .content-form .input-group.one span {
            top: 38%;
            left: 56.3%;
        }

        .content-form .input-group.two label {
            top: 41.5%;
            left: 15.7%;
        }

        .content-form .input-group.two div {
            top: 41.5%;
            left: 23%;
        }

        .content-form .input-group.two span {
            top: 41.5%;
            left: 56.3%;
        }

        .content-form .input-group.three label {
            top: 45%;
            left: 15.7%;
        }

        .content-form .input-group.three div {
            top: 45%;
            left: 23%;
        }

        .content-form .input-group.three span {
            top: 45%;
            left: 56.3%;
        }

        .content-form .input-group.four label {
            top: 48.5%;
            left: 15.7%;
        }

        .content-form .input-group.four div {
            top: 48.5%;
            left: 23%;
        }

        .content-form .input-group.four span {
            top: 48.5%;
            left: 56.3%;
        }

        .content-letter {
            position: relative;
            top: 400px;
            padding: 30px;
        }

        .content-letter.content-ttd {
            position: absolute;
            right: 0;
            top: 850px;
        }
        .content-letter.content-ttd .card-canvas {
            position: absolute;
            right: 40px;
        }

        .content-letter.content-ttd .signature {
            position: absolute;
            top: 90px;
            right: 50px;
        }

        .content-invitation-attachment {
            padding: 30px;
        }

        .card-ttd:last-child p:first-child {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            bottom: 11.7%;
            left: 80%;
            transform: translate(-50%);
        }

        .card-ttd:last-child p:nth-child(2) {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            bottom: 9.8%;
            left: 80%;
            transform: translate(-50%);
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
        }
    </style>
</head>
<body>

<div class="container">
    <img src="{{ public_path('assets/img/letter-header.png') }}" alt="Banner Top" class="image-full">
    <div class="content-form">
        <div class="header-line"></div>
        <div class="input-group one">
            <label>Nomor</label>
            <div>:</div>
            <span>{{ $letter->reference_number }}</span>
        </div>
        <div class="input-group two">
            <label>Lampiran</label>
            <div>:</div>
            <span>{{ $letter->attachment }}</span>
        </div>
        <div class="input-group three">
            <label>Perihal</label>
            <div>:</div>
            <span>{{ $letter->regarding }}</span>
        </div>
        <div class="input-group four">
            <label>Yth</label>
            <div>:</div>
            <span>{{ $letter->dear }}</span>
        </div>
    </div>
    <div class="content-letter">
        <p>{!! $letter->message !!}</p>
    </div>
    <div class="content-letter content-ttd">
        <p style="margin-bottom: 100px;">Amlapura, {{ $letter->approved_by_village_head ? $letter->updated_at->format('d M Y') : "..........." }}</p>
        @if ($letter->approved_by_village_head)
            <div class="signature">
                <img src="{{ public_path("uploads/users/signatures/" . $letter->villageHead->user->signature_image) }}" width="100" alt="">
            </div>
        @endif
        <div class="card-canvas">
            {{ $letter->approved_by_village_head ? $letter->villageHead->citizent->name : "Kepala Kelurahan" }}
        </div>
    </div>
    <div class="page-break"></div>
    <div class="content-invitation-attachment">
        <h4>Tembusan disampaikan :</h4>
        <p>{!! $letter->copy_submitted   !!}</p>
    </div>
    <div class="content-invitation-attachment">
        <h4>Lampiran Surat Undangan</h4>
        <div style="margin-bottom: 10px;">
            <label>Nomor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>:</span>&nbsp;&nbsp;&nbsp; {{ $letter->reference_number }}</label>
        </div>
        <div style="margin-bottom: 20px;">
            <label>Lampiran &nbsp;&nbsp;&nbsp;<span>:</span>&nbsp;&nbsp;&nbsp; {{ $letter->attachment }}<</label>
        </div>
        <p>{!! $letter->invitation_attachment !!}</p>
    </div>
</div>

</body>
</html>