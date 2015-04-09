<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="firstapp">

<head ng-controller="headerctrl">
    <title ng-bind="'Magic Mirror - '+template.title">Magic Mirror</title>
    <meta name="name" content="Magic Mirror">
    <meta name="description" content="">
    <meta name="keywords" content="Jewelry, Fashion Jewelry, Statement Necklaces, Earrings, Rings, Cuff Bracelets.">
    <script>
        var hostname = window.location.hostname;
        if (hostname == "lylaloves.co.uk") {
            console.log(hostname);
        } else {
            console.log("other " + hostname);
        }
    </script>
    <script>
        var isMobile = {
            Android: function() {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };

        if (isMobile.any()) {
            window.location = "http://mobile.magicmirror.in/" + window.location.hash;
        }
    </script>


    <link rel="shortcut icon" href="img/fashionlg.png" />
    <link href="lib/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="lib/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/range/angular.rangeSlider.css" rel="stylesheet">
    <link href="lib/css/custom.css" rel="stylesheet">
    <link href="lib/css/FUTURAL.TTF" rel="stylesheet">


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="lib/js/jquery-1.11.1.min.js"></script>
    <script src="lib/js/angular.min.js"></script>
<!--    <script src="lib/js/angular-animate.js"></script>-->
    <script src="lib/js/angular-route.min.js"></script>
<!--    <script src="lib/js/angular-resource.min.js"></script>-->
<!--
    <script src="lib/js/bootstrap.min.js"></script>
    <script src="lib/js/ui-bootstrap-tpls-0.11.0.min.js"></script>
-->
    <script src="js/app.js"></script>
    <script src="js/controllers.js"></script>
    <script src="js/templateservice.js"></script>
    <script src="js/services.js"></script>

    <script src="lib/range/angular.rangeSlider.js "></script>
    <script src="lib/js/ng-infinite-scroll.min.js "></script>
    <script src="lib/js/jstorage.js "></script>
</head>

<body>
    
    <div>
        <div ng-view></div>
    </div>

</body>

</html>