<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        u+#body a {
            color: white;
            text-decoration: none;
        }

        u+#body .link {
            color: #DDCCAA;

        }

        #body {
            background: linear-gradient(187.16deg, #181623 0.07%, #191725 51.65%, #0D0B14 98.75%);
            color: white;
            padding: 0 195px;
            padding-bottom: 110px;
        }

        .top-logo {
            width: 100%;
            text-align: center;
            padding-top: 79px;
        }

        .top-text {
            color: #DDCCAA;
            text-align: center;
            widows: 100%;
            margin-bottom: 72px;
            font-size: 12px;
            line-height: 150%;
        }

        h1 {
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 150%;
            color: white;

        }

        .red-button {
            background: #E31221;
            border-radius: 4px;
            padding: 7px 13px;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .email-photo {
            width: 22px;
            height: 20.53px;
            margin-bottom: 10px;
        }

        .middle-text {
            margin-top: 24px;
            margin-bottom: 32px;
            color: white;

        }

        .text-after-button {
            margin-top: 40px;
            color: white;

        }

        .bottom-text {
            text-decoration: none;
            margin-top: 40px;
            margin-bottom: 24px;
            color: white;

        }

        .website {
            text-decoration: none;
            color: white;
        }

        .link {
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 150%;
            text-decoration: none;
            color: #DDCCAA;
        }

        @media (max-width: 600px) {
            #body {
                padding: 0 35px;
                padding-bottom: 90px;
            }
        }
    </style>
</head>

<body id="body">
    <p class="top-text">Image Echoes</p>

    <h1>Hello {{ $name }}</h1>

    <h1 class="middle-text">Please click the button below to update email of your account:
    </h1>

    <a href={{ $route }} class="red-button">Update email</a>

    <h1 class="bottom-text">If you have any problems, please contact us: <a href="imageechoes.ge"
            class="website">support@imageechoes.ge</a></h1>

    <h1>Image Echoes Crew</h1>
</body>

</html>