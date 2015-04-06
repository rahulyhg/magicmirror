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
            window.location = "http://mobile.magicmirror.in/" + window.location.hash;
        }
    </script>
    <!--
    <script type="text/javascript">
        var _clt = _clt || [];
        _clt["custId"] = "{{email}}";
        _clt["siteId"] = "40606bc583";
        _clt["ref"] = encodeURIComponent(document.referrer);
        (function () {
            var cl = document.createElement('script');
            cl.type = 'text/javascript';
            cl.async = true;
            cl.src = 'https:' == document.location.protocol ? 'https://lib.canopylabs.com:8889/js/cl_ga4.js' : 'http://lib.canopylabs.com:8888/js/cl_ga4.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(cl, s);
        })();
    </script>
-->


    <link rel="shortcut icon" href="img/fashionlg.png" />
    <link href="lib/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="lib/css/animate.css" rel="stylesheet" type="text/css">
    <link href="lib/css/image-zoom.min.css" rel="stylesheet">
    <link href="lib/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/range/angular.rangeSlider.css" rel="stylesheet">
    <link href="https://checkout.stripe.com/v3/checkout/button.css" rel="stylesheet">
    <link href="lib/css/custom.css" rel="stylesheet">
    <link href="lib/css/FUTURAL.TTF" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/css/owl.carousel.css" rel="stylesheet">
    <link href="lib/css/owl.theme.css" rel="stylesheet">


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="lib/js/jquery-1.11.1.min.js"></script>
    <script src="lib/js/angular.min.js"></script>
    <script src="lib/js/angular-animate.js"></script>
    <script src="lib/js/angular-route.min.js"></script>
    <script src="lib/js/angular-resource.min.js"></script>
    <script src="lib/js/parallax.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js"></script>
    <script src="lib/js/bootstrap.min.js"></script>
    <script src="lib/js/ui-bootstrap-tpls-0.11.0.min.js"></script>
    <script src="lib/js/jquery.bxslider.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/controllers.js"></script>
    <script src="js/templateservice.js"></script>
    <script src="js/services.js"></script>
    <script src="lib/js/owl.carousel.js"></script>
    <script src="lib/js/isotope.js"></script>
    <script src="lib/js/main.js"></script>
    <script src="lib/js/image-zoom.js"></script>
    <script src="lib/js/jquery.elevatezoom.min.js"></script>
    <script src="lib/js/wow.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.0/ScrollMagic.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.0/plugins/addIndicators.min.js"></script>

    <script src=" lib/js/skrollr.js "></script>
    <script src="lib/js/skrollr.dir.js "></script>
    <script src="lib/range/angular.rangeSlider.js "></script>
    <script src="lib/js/ng-infinite-scroll.min.js "></script>
    <script src="lib/js/jstorage.js "></script>
    <!--    <script src="https://checkout.stripe.com/checkout.js "></script>-->
    <script src="https://maps.googleapis.com/maps/api/js "></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular.min.js"></script>
</head>

<body>
    <!--    <div class="top-bar barheight ">-->

    <!--
        <div class="row ">
            <div class="col-xs-2 ">
 <div class="input-group headsearch " ng-controller="search ">
                    <span class="input-group-addon icon "><span class="glyphicon glyphicon-search "></span></span>
                    <input type="text " class="form-control inputbox " ng-model="searchpro " placeholder="Search " ng-change="search(searchpro) ">
                </div>

            
            </div>
            <div class="col-xs-7 padder " ng-controller="newsletter ">
                <p style="text-align:center; ">Sign up for our newsletter and get free delivery on your first order! &nbsp;&nbsp;&nbsp;
                    <input type="email " class="form-control newsletteremail " ng-model="uemail " placeholder=" " required> <a style="color:black; " class="btn btn-primary " ng-click="newsletter(uemail) ">SIGN UP</a>
                </p>
            </div>

            <div class="col-xs-3 ">
                
                   
                <div class="pull-right " style="margin-right:15px; " ng-controller="badge ">

                    <a href="#/Login " class="fadeInRight wow topicon " ng-class="firstloadclass wow ">
                        <img src="img/account.png ">
                    </a>

                    <a href="# " class="badge newbadge " ng-show="template.totalproducts!=0 ">{{template.totalproducts}}</a>
                    <a href="#/cart " class="topicon {{template.cartclicked}} ">
                        <img src="img/cart.png ">
                    </a>

                    <a href="#/wishlist " class="fadeInRight wow topicon " ng-class="firstloadclass wow ">
                        <img src="img/wishlist.png ">
                    </a>
                </div>



            </div>
        </div>
-->
    <!--    </div>-->
    <!--    <div class="barheight "></div>-->
    <div>
        <!--        <div ng-view skrollr-tag></div>-->
        <div ng-view></div>
    </div>

    <script>
        var issearch = false;

        $(document).ready(function () {


            $(".headsearch .icon ").click(function () {

                if (issearch) {
                    issearch = false;
                    $(".headsearch .inputbox ").removeClass("showit ");
                    $(".headsearch .icon ").removeClass("showit ");
                } else {
                    issearch = true;
                    $(".headsearch .inputbox ").addClass("showit ");
                    $(".headsearch .icon ").addClass("showit ");
                }
            });
        });
    </script>


    <script type="text/javascript ">
        (function (d, t) {
            if (window.location.hash != '#gleam' && ('' + document.cookie).match(/(^|;)\s*GleamaaA2s=X($|;)/)) {
                return;
            }
            var g = d.createElement(t),
                s = d.getElementsByTagName(t)[0];
            g.src = "https://js.gleam.io/aaA2s/ol.js ";
            s.parentNode.insertBefore(g, s);
        }(document, "script "));
    </script>
    <script>
        window.addEventListener("beforeunload ", function (e) {
            alert("See You ");
            return false;
        });
    </script>
</body>

</html>