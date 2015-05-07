<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="firstapp">

<head ng-controller="headerctrl">
    <title ng-bind="template.title">Magic Mirror</title>
    <meta name="name" content="Magic Mirror">
    <meta name="description" content="{{template.metadescription}}">
    <meta name="keywords" content="{{template.keywords}}">
    <base href="/">
    <script>
        var hostname = window.location.hostname;
        if (hostname == "www.magicmirror.in") {
            console.log(hostname);
            window.location.replace("http://magicmirror.in/");
        } else {
            console.log("other " + hostname);
        }
    </script>
    <script>
        var isMobile = {
            Android: function () {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function () {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function () {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function () {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function () {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function () {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };

        if (isMobile.any()) {
            window.location = "http://m.magicmirror.in/" + window.location.hash;
        }
    </script>

    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="lib/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="lib/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/range/angular.rangeSlider.css" rel="stylesheet">
    <link href="lib/css/custom.css" rel="stylesheet">
    <link href="lib/css/ngDialog.css" rel="stylesheet">
    <link href="lib/css/FUTURAL.TTF" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="lib/js/jquery-1.11.1.min.js"></script>
    <script src="lib/js/angular.min.js"></script>
    
<!--    <script src="lib/js/ngDialog.js"></script>-->
    <!--    <script src="lib/js/angular-animate.js"></script>-->
    <script src="lib/js/angular-route.min.js"></script>
    <!--    <script src="lib/js/angular-resource.min.js"></script>-->
    <!--
    <script src="lib/js/bootstrap.min.js"></script>
    <script src="lib/js/ui-bootstrap-tpls-0.11.0.min.js"></script>
-->
    <script src="lib/js/skrollr.js"></script>
    <script src="lib/js/skrollr.dir.js"></script>
   <script src="lib/js/jstorage.js "></script>
   <script src="lib/js/ngDialog.js"></script>
   
    <script src="lib/js/underscore-min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/controllers.js"></script>
    <script src="js/templateservice.js"></script>
    <script src="js/services.js"></script>

    <script src="lib/range/angular.rangeSlider.js "></script>
    <script src="lib/js/ng-infinite-scroll.min.js "></script>
    <!--  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
</head>

<body>

    <div>
        <div ng-view></div>
    </div>

</body>

</html>