// JavaScript Document
var firstapp = angular.module('firstapp', [
  'ngRoute',
  'phonecatControllers',
  'templateservicemod',
  'ngAnimate',
  'Service',
  'ui.bootstrap',
  'ImageZoom',
'directives.skrollr',
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
        when('/returns', {
            templateUrl: 'views/template.html',
            controller: 'returns'
        }).
        when('/loginwishlist', {
            templateUrl: 'views/template.html',
            controller: 'loginwishlist'
        }).
        otherwise({
            redirectTo: '/home'
        });
  }]);

firstapp.filter('imagepath', function () {
    return function (input) {
        return "http://www.lylaloves.co.uk/showimage?size=300&image="+input;
        
    };
});
firstapp.filter('imagepathbig', function () {
    return function (input) {
        return "http://www.lylaloves.co.uk/showimage?size=800&image="+input;
       
    };
});

firstapp.filter('convertprice', function () {
    return function (input) {
        
        var price=parseFloat(input);
        if(price<0)
        {
            return 0;
        }
        var currencyshow="£";
        for(var i=0;i<conversionrate.length;i++)
        {
            if(conversionrate[i].name==currency)
            {
                //console.log("currency: "+currency+" price ini: "+price+" price new: "+parseFloat(conversionrate[i].conversionrate)*price);
                if(currency=="USD")
                {
                    currencyshow="$";
                }
                else if(currency=="EURO")
                {
                    currencyshow="€";
                }
                return currencyshow+" "+(parseFloat(conversionrate[i].conversionrate)*price).toFixed(2);
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

function ScrollCtrl($scope, $location, $anchorScroll) {
    $scope.gotopropertydetails = function () {
        // set the location.hash to the id of
        // the element you wish to scroll to.
        $location.hash('property-details');

        // call $anchorScroll()
        $anchorScroll();
    };
    $scope.gotoflats = function () {
        // set the location.hash to the id of
        // the element you wish to scroll to.
        $location.hash('flat-details');

        // call $anchorScroll()
        $anchorScroll();
    };
    $scope.gotoflats = function () {
        // set the location.hash to the id of
        // the element you wish to scroll to.
        $location.hash('flat-details');

        // call $anchorScroll()
        $anchorScroll();
    };
    $scope.gotolocation = function () {
        // set the location.hash to the id of
        // the element you wish to scroll to.
        $location.hash('location-details');

        // call $anchorScroll()
        $anchorScroll();
    };
    $scope.gotoamenities = function () {
        // set the location.hash to the id of
        // the element you wish to scroll to.
        $location.hash('amenity-details');

        // call $anchorScroll()
        $anchorScroll();
    };
    $scope.gotogallery = function () {
        // set the location.hash to the id of
        // the element you wish to scroll to.
        $location.hash('gallery-details');

        // call $anchorScroll()
        $anchorScroll();
    };
}

firstapp.directive('resizable', function ($window) {
    return function ($scope) {
        $scope.initializeWindowSize = function () {
            $scope.windowHeight = $window.innerHeight;
            return $scope.windowWidth = $window.innerWidth;
        };
        $scope.initializeWindowSize();
        return angular.element($window).bind('resize', function () {
            $scope.initializeWindowSize();
            return $scope.$apply();
        });
    };
});

/*
firstapp.directive('ngElevateZoom', function() {
  return {
    restrict: 'A',
    link: function(scope, element, attrs) {
      element.attr('data-zoom-image',attrs.zoomImage);
      //$(element).elevateZoom();
        $(element).elevateZoom({ zoomType	 : "inner", cursor: "crosshair" }); 
    }
  };
});*/

firstapp.directive('ngElevateZoom', function () {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            console.log("Linking")

            //Will watch for changes on the attribute
            attrs.$observe('zoomImage', function () {
                linkElevateZoom();
            })

            function linkElevateZoom() {
                //Check if its not empty
                if (!attrs.zoomImage) return;
                element.attr('data-zoom-image', attrs.zoomImage);
                $(".zoomimg").elevateZoom({
                    zoomType: "lens",
                    lensShape: "round",
                    lensSize: 200
                });
            }

            linkElevateZoom();

        }
    };
});

firstapp.run(function ($rootScope) {
    $rootScope.isloaded = 0; //global variable
});
firstapp.directive('myRepeatDirective', function () {
    return function (scope, element, attrs) {
        angular.element(element).css('color', 'blue');
        if (scope.$last) {
            new WOW().init();
        }
    };
});