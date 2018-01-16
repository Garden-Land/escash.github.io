<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <meta name=viewport content="width=device-width,initial-scale=1">
    <title>{{$config->namesite}} — Интернет-магазин кейсов с деньгами {{$config->namesite}}</title>
    <link rel=icon type=image/png sizes=32x32 href=/favicon-32x32.png>
    <link rel=icon type=image/png sizes=192x192
          href=/assets/icons-1f0421099521e0db29606161b92538e1/android-chrome-192x192.png>
    <link rel=icon type=image/png sizes=16x16 href=/favicon-16x16.png>
    <link rel="shortcut icon" href=/assets/icons-1f0421099521e0db29606161b92538e1/favicon.ico>
    <link href=/assets/css/app.css rel=stylesheet>
</head>
<body>
<script>
    var domain = '{{$config->namesite}}';
    var ref_sum = '{{$config->ref_sum}}';
</script>
<div id=app>
    <div class=loader>
        <div class=ball-pulse>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<script type=text/javascript src=/assets/js/vendor.js></script>
<script type=text/javascript src=/assets/js/app.js></script>
</body>
</html>