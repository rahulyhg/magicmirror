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

firstapp.config(['$routeProvider', '$locationProvider',
    function($routeProvider, $locationProvider) {
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
        when('/wedding-jewellery', {
            templateUrl: 'views/template.html',
            controller: 'wedding-jewellery'
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
        $locationProvider
            .html5Mode(true);
    }
]);

firstapp.filter('imagepath', function() {
    return function(input) {
        if (input) {
            input = input.replace("gs://magicmirroruploads/uploads/", "");
            var image = "http://magicmirrornew.appspot.com/showimage?size=300&image=gs://magicmirroruploads/uploads/" + input.trim();
            image = image.replace(" ", "_");
        }
        return image;
    };
});
firstapp.filter('imagepath1', function() {
    return function(input) {

        if (input) {
            input = input.replace("gs://magicmirroruploads/uploads/", "");
            var image = "http://magicmirrornew.appspot.com/showimage?size=300&image=gs://magicmirroruploads/uploads/" + input.trim();
            image = image.replace(" ", "_");
        }
        return image;
    };
});
firstapp.filter('imagepath2', function() {
    return function(input) {

        if (input) {
            input = input.replace("gs://magicmirroruploads/uploads/", "");
            return "img/" + input.trim();
        }
    };

});
firstapp.filter('imagepathbig', function() {
    return function(input) {
        if (input) {
            input = input.replace("gs://magicmirroruploads/uploads/", "");
            var image = "http://magicmirrornew.appspot.com/showimage?size=800&image=gs://magicmirroruploads/uploads/" + input.trim();

            image = image.replace(" ", "_");
        }

        return image;
    };
});

firstapp.filter('convertprice', function() {
    return function(input) {

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

firstapp.directive('modal', function () {
    return {
      template: '<div class="modal fade">' + 
          '<div class="modal-dialog">' + 
            '<div class="modal-content">' + 
              '<div class="modal-header">' + 
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' + 
                '<h4 class="modal-title">{{ title }}</h4>' + 
              '</div>' + 
              '<div class="modal-body" ng-transclude></div>' + 
            '</div>' + 
          '</div>' + 
        '</div>',
      restrict: 'E',
      transclude: true,
      replace:true,
      scope:true,
      link: function postLink(scope, element, attrs) {
        scope.title = attrs.title;

        scope.$watch(attrs.visible, function(value){
          if(value == true)
            $(element).modal('show');
          else
            $(element).modal('hide');
        });

        $(element).on('shown.bs.modal', function(){
          scope.$apply(function(){
            scope.$parent[attrs.visible] = true;
          });
        });

        $(element).on('hidden.bs.modal', function(){
          scope.$apply(function(){
            scope.$parent[attrs.visible] = false;
          });
        });
      }
    };
  });


var formvalidation = function(allvalidation) {
    var isvalid2 = true;
    for (var i = 0; i < allvalidation.length; i++) {
        console.log("checking");
        console.log(allvalidation[i].field);
        if (allvalidation[i].field == "" || !allvalidation[i].field) {
            allvalidation[i].validation = "ng-dirty";
            isvalid2 = false;
        }
    }
    return isvalid2;
};

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