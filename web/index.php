<!DOCTYPE html>
<html>
<head>
    <title>GaSSkull</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link href="res/css/site/style.css" rel="stylesheet" media="screen">
    <link href="res/css/style.css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="res/js/jquery.min.js"></script>

    <script type="text/javascript">

        var isHeaderNarrow = false;

        function narrowHeader() {
            if (!isHeaderNarrow) {
                $('.header-background-big').removeClass('header-background-big').addClass('header-background');
                isHeaderNarrow = true;
            }
        }

        function openHeader() {
            if (isHeaderNarrow) {
                $('.header-background').removeClass('header-background').addClass('header-background-big');
                isHeaderNarrow = false;
            }
        }

        $(document).on('scroll', function (e) {
            if ($(document).scrollTop() < 5) {
                openHeader();
            }
            else {
                narrowHeader();
            }
        });

    </script>
</head>

<body>

<div class="header-background-big animated-element">
    <div class="image-top-logo"></div>
    <div class="text-top-left">Высокая гора</div>
    <div class="text-top-right">Казань</div>
    <div class="text-phone">+7(945)2345435</div>
</div>

<div class="gradient">
    <div class="header-margin"></div>

    <h1 class="text-main center">Автосервис Казань</h1>
    <div style="margin: 0 0 10px 30px" class="text-site">Наш адрес: Большая красная 35а, Высокая Гора.</div>
</div>


<div id="map"></div>

<div style="padding: 30px 0" class="gradient">
    <div class="text-site center">Вы наш постоянный клиент? Узнайте о накопленных баллах, и на что их можно потратить
    </div>
    <a class="button-primary center" href="admin">Узнать</a>
</div>

<div class="container center">
    <button class="button-secondary">Прайс-лист</button>
    <button class="button-secondary">Записаться</button>
    <button class="button-secondary">Написать</button>
    <button class="button-secondary">Приложение</button>
</div>

<div class="footer">
    <div class="text-site center">Низкие цены, высокое качество.</div>
</div>

<div class="image-bottom-logo center"></div>
<!-- /container -->

<script src="res/js/map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbByzdPWzdq1FU3u9vrOWcjOUpPaGJfMA&callback=initMap"
        async defer></script>
</body>
</html>