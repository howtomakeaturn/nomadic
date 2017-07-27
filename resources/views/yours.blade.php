<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        #<meta property="og:url" content="{{url('/shop/' . $cafe->id)}}" />
        ?>
        <meta property="og:url" content="{{Layout::openGraphImage()}}" />
        <meta property="og:image" content="{{Layout::openGraphImage()}}" />
        <meta property="og:updated_time" content="<?=time()?>" />

    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <p>Hello world! This is HTML5 Boilerplate.</p>
        <p>{{$pingUrl}}</p>
    </body>
</html>
