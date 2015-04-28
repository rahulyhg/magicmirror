// JavaScript Document
var firstapp = angular.module('firstapp', [
    'ngRoute',
    'phonecatControllers',
    'templateservicemod',
    'directives.skrollr',
    'Service',
    'ui-rangeSlider',
    'infinite-scroll'
]);

firstapp.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.
        when('/home', {
            templateUrl: 'views/template.html',
            controller: 'home'
        }).
        when('/search/:search', {
            templateUrl: 'views/template.html',
            controller: 'searchpage'
        }).
        when('/wishlist', {
                templateUrl: 'views/template.html',
                controller: 'wishlist'
            })
            .
        when('/comingsoon', {
            templateUrl: 'views/template.html',
            controller: 'comingsoon'
        }).
        when('/xoxo', {
            templateUrl: 'views/template.html',
            controller: 'xoxo'
        }).
        when('/cart', {
            templateUrl: 'views/template.html',
            controller: 'cart'
        }).
        when('/checkout', {
            templateUrl: 'views/template.html',
            controller: 'checkout'
        }).
        when('/lookbook', {
            templateUrl: 'views/template.html',
            controller: 'lookbook'
        }).
        when('/Logout', {
            templateUrl: 'views/template.html',
            controller: 'logout'
        }).
        when('/wholesaler', {
            templateUrl: 'views/template.html',
            controller: 'wholesaler'
        }).
        when('/Login', {
            templateUrl: 'views/template.html',
            controller: 'login'
        }).
        when('/contact', {
            templateUrl: 'views/template.html',
            controller: 'contact'
        }).
        when('/profile', {
            templateUrl: 'views/template.html',
            controller: 'profile'
        }).
        when('/lylaloves', {
            templateUrl: 'views/template.html',
            controller: 'lylaloves'
        }).
        when('/newin', {
            templateUrl: 'views/template.html',
            controller: 'newin'
        }).
        when('/category/:CategoryId', {
            templateUrl: 'views/template.html',
            controller: 'category'
        }).

        when('/product/:ProductId', {
            templateUrl: 'views/template.html',
            controller: 'product'
        }).
        when('/thankyou', {
            templateUrl: 'views/template.html',
            controller: 'thankyou'
        }).
        when('/delivery', {
            templateUrl: 'views/template.html',
            controller: 'delivery'
        }).
        when('/sitemap', {
            templateUrl: 'views/template.html',
            controller: 'sitemap'
        }).
        when('/celebrities', {
            templateUrl: 'views/template.html',
            controller: 'celebrities'
        }).
        when('/feedback', {
            templateUrl: 'views/template.html',
            controller: 'feedback'
        }).
        when('/returns', {
            templateUrl: 'views/template.html',
            controller: 'returns'
        }).
        when('/conditions', {
            templateUrl: 'views/template.html',
            controller: 'conditions'
        }).
        when('/faq', {
            templateUrl: 'views/template.html',
            controller: 'faq'
        }).
        when('/policy', {
            templateUrl: 'views/template.html',
            controller: 'policy'
        }).
        when('/loginwishlist', {
            templateUrl: 'views/template.html',
            controller: 'loginwishlist'
        }).
        when('/contactus', {
            templateUrl: 'views/template.html',
            controller: 'contactus'
        }).
        when('/aboutus', {
            templateUrl: 'views/template.html',
            controller: 'aboutus'
        }).
        when('/collections', {
            templateUrl: 'views/template.html',
            controller: 'collections'
        }).
        when('/resetpassword/:id', {
            templateUrl: 'views/template.html',
            controller: 'resetpassword'
        }).
        when('/myaccount', {
            templateUrl: 'views/template.html',
            controller: 'myaccount'
        }).
        when('/productcare', {
            templateUrl: 'views/template.html',
            controller: 'productcare'
        }).
        when('/forgotpassword', {
            templateUrl: 'views/template.html',
            controller: 'forgotpassword'
        }).
        when('/ship-return', {
            templateUrl: 'views/template.html',
            controller: 'ship-return'
        }).
        otherwise({
            redirectTo: '/home'
        });
    }
]);

firstapp.filter('imagepath', function () {
    return function (input) {
        if (input) {
            input = input.replace("gs://magicmirroruploads/uploads/", "");
            var image = "http://magicmirrornew.appspot.com/showimage?size=300&image=gs://magicmirroruploads/uploads/" + input.trim();
            image = image.replace(" ", "_");
        }
        return image;
    };
});
firstapp.filter('imagepath1', function () {
    return function (input) {

        if (input) {
            input = input.replace("gs://magicmirroruploads/uploads/", "");
            var image = "http://magicmirrornew.appspot.com/showimage?size=300&image=gs://magicmirroruploads/uploads/" + input.trim();
            image = image.replace(" ", "_");
        }
        return image;
    };
});
firstapp.filter('imagepath2', function () {
    return function (input) {

        if (input) {
            input = input.replace("gs://magicmirroruploads/uploads/", "");
            return "img/" + input.trim();
        }
    };

});
firstapp.filter('imagepathbig', function () {
    return function (input) {
        if (input) {
            input = input.replace("gs://magicmirroruploads/uploads/", "");
            var image = "http://magicmirrornew.appspot.com/showimage?size=800&image=gs://magicmirroruploads/uploads/" + input.trim();

            image = image.replace(" ", "_");
        }

        return image;
    };
});

firstapp.filter('convertprice', function () {
    return function (input) {

        var price = parseFloat(input);
        var currencyshow = "Rs";
        if (price < 0) {
            return 0;
        }
        //        else{
        //            return currencyshow + " " + (price).toFixed(2);
        //        }

        for (var i = 0; i < conversionrate.length; i++) {
            if (conversionrate[i].name == currency) {
                //console.log("currency: "+currency+" price ini: "+price+" price new: "+parseFloat(conversionrate[i].conversionrate)*price);
                if (currency == "USD") {
                    currencyshow = "Rs";
                } else if (currency == "EURO") {
                    currencyshow = "€";
                }
                return currencyshow + " " + (parseFloat(conversionrate[i].conversionrate) * price).toFixed(2);
            }
        }
    };
});

function AccordionDemoCtrl($scope) {
    $scope.oneAtATime = true;

    $scope.status = {
        isFirstOpen: true,
        isFirstDisabled: false
    };
}

function CarouselDemoCtrl($scope) {
    $scope.myInterval = 5000;

}