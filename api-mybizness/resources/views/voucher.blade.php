<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        .text-white {
            color: #FFFFFF;
        }

        .font-bold {
            font-weight: bold;
        }

        .col-8 {
            margin-left: 220px;
            margin-top: 20px;
        }

        .col-4 {
            position: absolute;
            margin-left: 470px;
        }

        .img-theme {
            height: 350px;
            width: 200px;
            border-radius: 20px;
            position: absolute;
            margin-left: 10px
        }

        .br-20 {
            border-radius: 20px
        }

        .br-15 {
            border-radius: 15px
        }

        .w100 {
            width: 100%;
        }

        .bg-primary {
            background-color: #04153b
        }

        .text-primary {
            color: #04153b
        }

        .bg-second {
            background-color: #FFFFFF
        }

        .card-text {
            font-size: 12px
        }

        .card-title {
            font-size: 16px
        }

        .list-group-item {
            list-style-type: circle;
        }

        hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            border-style: inset;
            border-width: 1px;
            color: #FFFFFF;
            width: 380px
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container-fluid">

        <div class="card bg-primary w100 br-20" style="height:380px">

            <img src="https://lh3.googleusercontent.com/Kw1ECouosamsscGTfG-BjnXJTg1wklDYUaDozZ5x_DQb4NTQ2xntYd6ERgA5pHEsEwRzNVBv8X8eeIx6=s0"
                class="rounded-start mt-3 img-theme" alt="...">

            <div class="col-8">
                <div class="card-body" style="position: absolute;">
                    <h5 class="card-title text-white">Bon Cadeau N° af169dd9-d31b-4910-bf46-e7cb7ecc169e</h5>
                    <p class="card-text text-white">Félicitation Xxxxxxxx,</p>
                    <p class="card-text text-white">Nous avons le plaisir de vous acceuillir pour :</p>

                    <div class="card bg-second br-15  text-primary " style="height:120px; width:240px;">
                        <ul class="list-group text-center pt-2" style="font-size: 13px;">
                            <li>An item</li>
                            <li>A second item</li>
                            <li>A third item</li>
                            <li>A fourth item</li>
                            <li>And a fifth one</li>
                        </ul>
                    </div>

                    <p class="card-text text-white mt-4 mb-2">Votre bon est valide jusqu'au :</p>

                    <div class="card bg-second br-15 px-1 py-1 text-center" style="height:28px; width:240px ">
                        <p class="card-text text-primary mt-1" style="font-size: 14px;">12-12-2022</p>
                    </div>

                    <p class="card-text mt-4 mb-2">
                        <small class=" text-white" style="margin-left:60px; font-size:11px">
                            Pour profiter de votre cadeau, Réservez vite au 0692 725 584
                        </small>
                    </p>
                    <hr>
                </div>
            </div>
            <div class="col-4">
                <img style="width:150px;margin-top:15px; margin-left:78px" src="{{ public_path('assets/logoCfg.png') }}"
                    alt="logo cfg" />
                <div class="card bg-second br-15" style="height:83px; width:83px;margin-left:130px">
                    <img style="margin-left: 6px; margin-top:6px" src={{ $qrcode }} />
                </div>
                <div class="card bg-second br-15 mt-3 pt-2" style="height:94px; width: 200px; margin-left:10px">
                    <p class="card-text text-primary" style="margin-left:10px; margin-right:10px; font-size:13px">
                        Pour profiter de votre cadeau, Réservez vite au 0692 725 584, Réservez vite au 0692 725 584
                    </p>
                </div>

                <p class="card-text" style="margin-top:25px">
                    <small class="text-white" style="margin-left:155px">
                        www.cfg.re
                    </small>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
