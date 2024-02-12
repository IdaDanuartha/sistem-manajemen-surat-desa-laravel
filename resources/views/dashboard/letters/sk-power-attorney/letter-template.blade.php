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
            top: 38%;
            left: 15.7%;
        }

        .input-group.one div {
            top: 38%;
            left: 28%;
        }

        .input-group.one span {
            top: 38%;
            left: 61.3%;
        }

        .input-group.two label {
            top: 41.5%;
            left: 15.7%;
        }

        .input-group.two div {
            top: 41.5%;
            left: 28%;
        }

        .input-group.two span {
            top: 41.5%;
            left: 61.3%;
        }

        .input-group.three label {
            top: 45%;
            left: 15.7%;
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
            top: 48.5%;
            left: 15.7%;
        }

        .input-group.four div {
            top: 48.5%;
            left: 28%;
        }

        .input-group.four span {
            top: 48.5%;
            left: 61.3%;
        }

        .input-group.five label {
            top: 52%;
            left: 15.7%;
        }

        .input-group.five div {
            top: 52%;
            left: 28%;
        }

        .input-group.five span {
            top: 52%;
            left: 61.3%;
        }

        .card-ttd:first-child p:first-child {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            bottom: 11.7%;
            left: 18%;
            transform: translate(-50%);
        }

        .card-ttd:first-child p:nth-child(2) {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            bottom: 9.8%;
            left: 18%;
            transform: translate(-50%);
        }

        .card-ttd:first-child .card-canvas {
            width: 26%;
            height: 70px;
            position: absolute;
            bottom: 3.7%;
            left: 18%;
            transform: translate(-50%);
            border-bottom: 1px dashed black;
        }

        .card-ttd:first-child p:last-child {
            font-size: 0.875rem;
            width: 26%;
            position: absolute;
            bottom: 0.3%;
            left: 18%;
            transform: translate(-50%);
        }

        .card-ttd:nth-child(2) p:first-child {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            bottom: 11.7%;
            left: 49%;
            transform: translate(-50%);
        }

        .card-ttd:nth-child(2) p:nth-child(2) {
            font-size: 0.913rem;
            width: 26%;
            position: absolute;
            bottom: 9.8%;
            left: 49%;
            transform: translate(-50%);
        }

        .card-ttd:nth-child(2) .card-canvas {
            width: 26%;
            height: 70px;
            position: absolute;
            bottom: 3.7%;
            left: 49%;
            transform: translate(-50%);
            border-bottom: 1px dashed black;
        }

        .card-ttd:nth-child(2) p:last-child {
            font-size: 0.875rem;
            width: 26%;
            position: absolute;
            bottom: 0.3%;
            left: 49%;
            transform: translate(-50%);
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
        <img src="{{ public_path('assets/banner-top.jpg') }}" alt="Banner Top" class="image-full">
        <h3 class="title">EXCUSE LETTER</h3>
        <div class="content-form">
            <p class="subtitle">It is true that this child:</p>
            <div class="input-group one">
                <label>Name</label>
                <div>:</div>
                <span>Putu Aditya Prayatna</span>
            </div>
            <div class="input-group two">
                <label>Class</label>
                <div>:</div>
                <span>XII A Software Engineering</span>
            </div>
            <div class="input-group three">
                <label>Number</label>
                <div>:</div>
                <span>30</span>
            </div>
            <div class="input-group four">
                <label>Subject Hour</label>
                <div>:</div>
                <span>Mathematic</span>
            </div>
            <div class="input-group five">
                <label>Reason</label>
                <div>:</div>
                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae exercitationem quos voluptate delectus quidem repellendus, iusto, architecto nisi illum maxime vero voluptates labore</span>
            </div>
        </div>
        <div class="content-ttd">
            <div class="card-ttd">
                <p>Find out</p>
                <p>Teacher Picket</p>
                <div class="card-canvas"></div>
                <p>NIP.</p>
            </div>
            <div class="card-ttd">
                <p>Find out</p>
                <p>Security Picket</p>
                <div class="card-canvas"></div>
                <p>Satpam Code.</p>
            </div>
            <div class="card-ttd">
                <p>Denpasar, 14 January 2024</p>
                <p>My Respect</p>
                <div class="card-canvas"></div>
                <p>NIS.</p>
            </div>
        </div>
    </div>

</body>
</html>