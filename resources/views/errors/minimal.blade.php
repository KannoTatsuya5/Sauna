<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <style>
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            background-color: white;
        }

        .container {
            width: 80%;
            margin: 100px auto 0;
            text-align: center;
        }

        .image {
            background-size: cover;
            padding: 200px;
            background-position: bottom;
            background-repeat: no-repeat;
            background-image: url("upload/hokuo.png");
        }

        .backButton {
            width: 250px;
            height: 50px;
            border-radius: 5px;
            background-color: green;
            font-size: 20px;
            color: white;
            margin-top: 30px;
        }

        .backButton:hover {
            cursor: pointer;
            opacity: 0.8;
        }

    </style>
</head>

<body class="antialiased">
    <div class="container">
        {{-- <div class="image">
            <img src="upload/hokuo.png">
        </div> --}}
        <div class="image">
            <p class="message">予期せぬ処理が発生しました。<br>恐れ入りますが、もう一度やり直していただきますようお願い致します。</p>
        </div>
        <input class="backButton" type="button" onclick="location.href='./'" value="トップページに戻る">


    </div>
</body>

</html>
