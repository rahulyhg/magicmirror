// JavaScript Document
var firstapp = angular.module('firstapp', [
    'ngRoute',
    'phonecatControllers',
    'templateservicemod',
    'ngAnimate',
    'Service',
    'ui.bootstrap',
    'ImageZoom',
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
        otherwise({
            redirectTo: '/home'
        });
    }
]);

firstapp.filter('imagepath', function () {
    return function (input) {
        return "http://magicmirrornew.appspot.com/showimage?size=300&image=gs://magicmirroruploads/uploads/"+input.trim();
    };
});
firstapp.filter('imagepath1', function () {
    return function (input) {
        return "http://magicmirrornew.appspot.com/showimage?size=300&image=gs://magicmirroruploads/uploads/"+input.trim();

    };
});
firstapp.filter('imagepath2', function () {
    return function (input) {
        return "img/" + input.trim();
    };
});
firstapp.filter('imagepathbig', function () {
    return function (input) {
        return "http://magicmirrornew.appspot.com/showimage?size=800&image=gs://magicmirroruploads/uploads/"+input.trim();
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
    /*
  $scope.groups = [
    {
      title: 'Dynamic Group Header - 1',
      content: 'Dynamic Group Body - 1'
    },
    {
      title: 'Dynamic Group Header - 2',
      content: 'Dynamic Group Body - 2'
    }
  ];

  $scope.items = ['Item 1', 'Item 2', 'Item 3'];

  $scope.addItem = function() {
    var newItemNo = $scope.items.length + 1;
    $scope.items.push('Item ' + newItemNo);
  };
*/
    $scope.status = {
        isFirstOpen: true,
        isFirstDisabled: false
    };
}

function CarouselDemoCtrl($scope) {
    $scope.myInterval = 5000;
    //var slides = $scope.slides = [];
    /*
  $scope.addSlide = function() {
    var newWidth = 600 + slides.length;
    /*
	slides.push({
      image: 'http://placekitten.com/' + newWidth + '/300',
      text: ['More','Extra','Lots of','Surplus'][slides.length % 4] + ' ' +
        ['Cats', 'Kittys', 'Felines', 'Cutes'][slides.length % 4]
    });
  };*/
    /*
  for (var i=0; i<4; i++) {
    $scope.addSlide();
  }*/
}



firstapp.directive('wrapOwlcarousel', function () {
    return {
        restrict: 'E',
        link: function (scope, element, attrs) {
            var options = scope.$eval($(element).attr('data-options'));
            $(element).owlCarousel(options);
        }
    };
});
