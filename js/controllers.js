var phonecatControllers = angular.module('phonecatControllers', ['templateservicemod', 'Service', 'ngRoute']);
phonecatControllers.controller('home',
    function ($scope, TemplateService, MainJson, $rootScope, $location) {
        ////$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.changetitle("Home");
        $scope.template = TemplateService;
        TemplateService.slider = "views/slider.html";
        TemplateService.header = "views/headerhome.html";
        TemplateService.navigation = "views/navigationhome.html";
        TemplateService.content = "views/content.html";
        $scope.homeactive = "active";
        $scope.loginlogouttext = "Login";
        $scope.visible = false;
        $scope.ishome = "homeclass";
        $scope.onhome = "onhome";
        $scope.demo = "demodemo";


        //start get country from geo location
        //        $scope.country = false;
        //        console.log("hello im in home controller");
        //        var showlocationdata = function (data, status) {
        //            console.log("in location success");
        //            console.log(data);
        //            var address = data.results[0].address_components;
        //            for (var i = 0; i < address.length; i++) {
        //                if (address[i].types.indexOf("country") >= 0) {
        //                    $scope.country = address[i].short_name;
        //                    
        //
        //
        //                    var countries = ['AL', 'AD', 'AM', 'AT', 'BY', 'BE', 'BA', 'BG', 'CH', 'CY', 'CZ', 'DE',
        //  'DK', 'EE', 'ES', 'FO', 'FI', 'FR', 'GE', 'GI', 'GR', 'HU', 'HR',
        //  'IE', 'IS', 'IT', 'LT', 'LU', 'LV', 'MC', 'MK', 'MT', 'NO', 'NL', 'PL',
        //  'PT', 'RO', 'RU', 'SE', 'SI', 'SK', 'SM', 'TR', 'UA', 'VA' ];
        //
        //                    if(countries.indexOf($scope.country) >= 0)
        //                    {
        //                        $scope.country="EUROPE";
        //                    }
        //                    console.log("Country ////////////////////////");
        //                    //case1 : short name: GB
        //                    console.log($scope.country);
        //                    if($scope.country=="GB")
        //                    {
        //                        currency="GBP";
        //                    }
        //                    else if($scope.country=="EUROPE")
        //                    {
        //                        currency="EURO";
        //                    }
        //                    else 
        //                    {
        //                        currency="USD";
        //                    }
        //                    console.log("Currency: "+currency);
        //                    break;
        //                }
        //            }
        //            MainJson.storecountry($scope.geocountry);
        //        };
        //
        //        function showPosition2(position) {
        //            var latlon = position.coords.latitude + "," + position.coords.longitude;
        //            console.log("Positions:.........");
        //            console.log(position);
        //            $scope.coords = position.coords;
        //            lat = position.coords.latitude;
        //            long = position.coords.longitude;
        //            locationdata = lat + "," + long;
        //
        //            MainJson.getmap(locationdata).success(showlocationdata);
        //        }
        //
        //        if (navigator.geolocation) {
        //            navigator.geolocation.getCurrentPosition(showPosition2, showError);
        //        } else {
        //            x.innerHTML = "Geolocation is not supported by this browser.";
        //        }


        //get get country from geo location

        $scope.showaccount = function () {
            $scope.visible = true;
        };
        $scope.hideaccount = function () {
            $scope.visible = false;
        };
        $scope.showslideset1 = 0;
        $scope.slidesetnext = function (value) {
            console.log("Next Clicked");
            $scope.showslideset1 = 1;
            console.log($scope.showslideset1);
        };
        $scope.slidesetprev = function (value) {
            console.log("Prev Clicked");
            $scope.showslideset1 = 0;
        };
        //authenticate
        var authenticate = function (data, status) {
            if (data != "false") {
                $scope.alldate = data;
                $scope.loginlogouttext = "Logout";
            }
        };
        MainJson.authenticate().success(authenticate);

        var slidersuccess = function (data, status) {
            $scope.sliders = data;
            console.log($scope.sliders);
        };
        MainJson.getallslider().success(slidersuccess);
        //authenticate
        //newsletter
        var newslettersaved = function (data, status) {
            if (data == "true") {
                $scope.msgg = "Thank You For Subscribe";
            } else {
                $scope.msgg = "Thank You For Subscribe";
            }
        };
        $scope.newsletter = function (uemail) {
            if (!uemail) {
                alert("Please Enter Email");
            } else {
                console.log($scope.alldate);
                MainJson.newsletter("", uemail, "").success(newslettersaved);
            }
        };
        //newsletter
        //cart badge
        var totalcart = function (data, status) {
            $scope.badge = data;
        };
        MainJson.gettotalcart().success(totalcart);
        //cart badge
        $scope.$on("$includeContentLoaded", function () {
            TemplateService.firsttimeloaded();
            $(".zoomContainer").remove();
            $(".pulseanimation").hover(function () {
                $(this).addClass("animated pulse");
            }, function () {
                $(this).removeClass("animated pulse");
            });

            $(".tadaanimation").hover(function () {
                $(this).addClass("animated tada");
            }, function () {
                $(this).removeClass("animated tada");
            });
        });
        $scope.myInterval = 5000;
        var slides = $scope.slides = [{
            image: "img/slide.jpg"
        }, {
            image: "img/slide2.jpg"
        }];


    });

phonecatControllers.controller('cart',
    function ($scope, TemplateService, MainJson, $rootScope, $location) {
        $(".zoomContainer").remove();
        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.changetitle("Cart");
        TemplateService.content = "views/cart.html";
        TemplateService.slider = "";
        $scope.cart = [];
        $scope.loginlogouttext = "Login";
        //authenticate

        var authenticate = function (data, status) {
            if (data != "false") {
                $scope.loginlogouttext = data.email;
                $scope.uid = data.id;
            }
        };
        MainJson.authenticate().success(authenticate);
        //check coupons
        $scope.discountamount = 0;

        function calcdiscountamount() {
            var data = MainJson.getcoupondetails();
            var subtotal = parseFloat($scope.subtotal);
            console.log(data);
            if (data.coupontype == '1') {
                if (data.discountpercent != '0') {
                    console.log("ABC");
                    $scope.ispercent = parseFloat(data.discountpercent);
                    $scope.discountamount = (subtotal * $scope.ispercent / 100);
                } else {
                    $scope.isamount = parseFloat(data.discountamount);
                    console.log("ABCD");
                    $scope.discountamount = $scope.isamount;
                }
            }
            if (data.coupontype == '2') {
                console.log($scope.cart);
                
                var totallength=0;
                _.each($scope.cart,function(cart) {totallength+=parseInt(cart.qty);} );
                var xproducts=parseInt(data.xproducts);
                var yproducts=parseInt(data.yproducts);
                var itter=Math.floor(totallength/xproducts)*yproducts;
                console.log("ITTER "+itter);
                var newcart=_.sortBy($scope.cart, function(cart){ cart.price=parseFloat(cart.price);cart.qty2=parseInt(cart.qty);return parseFloat(cart.price); });
                //newcart=_.each(newcart, function(cart){  cart.price=parseFloat(cart.price);cart.qty=parseFloat(cart.qty); });
                console.log(newcart);
                $scope.discountamount=0;
                for(var i=0;i<itter;i++)
                {
                    if(newcart[i].qty2!=0)
                    {
                        newcart[i].qty2--;
                        $scope.discountamount+=newcart[i].price;
                    }
                    
                }
            }
            if (data.coupontype == '4') {
                console.log("FREE DELIVERY APPLIED");
                $scope.isfreedelivery = "Free Delivery";
                $scope.discountamount = 0;
            }
        };



        var coupondetails = {};
        $scope.ispercent = 0;
        $scope.isamount = 0;
        $scope.isfreedelivery = 0;
        $scope.discountamount = 0;
        var couponsuccess = function (data, status) {
            if (data == 'false') {
                $scope.validcouponcode = 0;
            } else {
                console.log("Show it");
                $scope.validcouponcode = 1;

                MainJson.setcoupondetails(data);
                calcdiscountamount();

            }
        }



        $scope.checkcoupon = function (couponcode) {
            console.log(couponcode);
            MainJson.getdiscountcoupon(couponcode).success(couponsuccess);
        };


        //authenticate
        $scope.newquantity = [];
        var showcart = function (data, status) {
            console.log(data);
            $scope.cart = data;
            console.log("Values in cart");
            // console.log($scope.cart[0].qty);
            console.log($scope.cart.length);

            for (var i = 0; i < $scope.cart.length; i++) {
                $scope.newquantity[i] = $scope.cart[i].qty;

            }
            console.log("values in newquantity");
            console.log($scope.newquantity);
        };
        MainJson.getcart().success(showcart);
        var getsubtotal = function (data, status) {
            $scope.subtotal = data;
            calcdiscountamount();
        };
        MainJson.totalcart().success(getsubtotal);
        //separating cart
        $scope.postcart = function () {
            $scope.cart = MainJson.getcart();
            $scope.id = $scope.cart[0].id;
            $scope.name = $scope.cart[0].name;
            $scope.price = $scope.cart[0].price;
            $scope.quantity = $scope.cart[0].quantity;
            for (var i = 1; i < $scope.cart.length; i++) {
                $scope.id += "," + $scope.cart[i].id;
                $scope.name += "," + $scope.cart[i].name;
                $scope.price += "," + $scope.cart[i].price;
                $scope.quantity += "," + $scope.cart[i].quantity;
            }


        }
        //separating cart
        //add to cart
        var getsubtotal = function (data, status) {
            $scope.subtotal = data;
        };
        var cartt = function (data, status) {
            console.log(data);
            MainJson.gettotalcart().success(MainJson.gettotalproductsincart);
            MainJson.totalcart().success(getsubtotal);
        };
        $scope.addtocart = function (id, name, price, quantity, index) {
            // console.log(id+name+price+quantity);
            $scope.cart[index].subtotal = price * quantity;
            MainJson.addtocart(id, name, price, quantity).success(cartt);
        };
        //addto cart

        $scope.addproductcart = function (id, name, price, quantity, index) {
            console.log(id + name + price + quantity);
            quantity = parseInt(quantity) + 1;
            $scope.newquantity[index] = quantity;
            $scope.cart[index].subtotal = price * quantity;
            MainJson.addtocart(id, name, price, quantity).success(cartt);
        };
        $scope.subproductcart = function (id, name, price, quantity, index) {
            console.log(id + name + price + quantity);
            quantity = parseInt(quantity) - 1;
            $scope.newquantity[index] = quantity;
            $scope.cart[index].subtotal = price * quantity;
            MainJson.addtocart(id, name, price, quantity).success(cartt);
        };


        var deletefromcart = function () {
            MainJson.gettotalcart().success(MainJson.gettotalproductsincart);
            MainJson.totalcart().success(getsubtotal);
            console.log("Subtotal should change");
        };
        var savefromcart = function () {
            MainJson.gettotalcart().success(MainJson.gettotalproductsincart);
            MainJson.totalcart().success(getsubtotal);
            console.log("Subtotal should change on save");
        };
        $scope.deletecart = function (id) {
            //console.log(cart);
            for (var i = 0; i < $scope.cart.length; i++) {
                if ($scope.cart[i].id == id) {
                    $scope.cart.splice(i, 1);
                }
            }
            //console.log(cart);
            $scope.subtotal = 0;
            console.log($scope.cart);
            for (var i = 0; i < $scope.cart.length; i++) {
                $scope.subtotal += parseInt($scope.cart[i].qty) * parseFloat($scope.cart[i].price);
            }

            MainJson.deletecartfromsession(id).success(deletefromcart);

        };
        $scope.savecart = function (id, quantity) {
            $scope.returntwo = MainJson.savecart($scope.uid, id, quantity).success(savefromcart);
            $scope.subtotal = $scope.returntwo.subtotal;
        };

    });

phonecatControllers.controller('logout ',
    function ($scope, TemplateService, MainJson, $location) {

        //######################authentication######################
        var logout = function (data, status) {
            //console.log(data);
            $scope.loginlogouttext = "Login";
            $scope.isloggedin = 0;
            $location.url("/home");
        };
        MainJson.logout().success(logout);
        //######################authentication######################
    });





phonecatControllers.controller('login',
    function ($scope, TemplateService, MainJson, $rootScope, $routeParams, $location) {
        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.changetitle("Login");
        TemplateService.content = "views/login.html";
        TemplateService.slider = "";
        $scope.loginlogouttext = "Login";
        //authenticate

        var cartt = function (data, status) {
            MainJson.gettotalcart().success(MainJson.gettotalproductsincart);
        };

        var cartdata = function (data, status) {
            console.log(data);
            for (var i = 0; i < data.length; i++) {
                MainJson.addtocart(data[i].id, data[i].name, data[i].price, data[i].quantity).success(cartt);;
            }
        };
        var authenticate = function (data, status) {
            MainJson.getusercart(data.id).success(cartdata);
            if (data != "false") {
                $scope.loginlogouttext = "Logout";


            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate
        var emailsend = function (data, status) {
            console.log(data);
            alert("Email send to you");
        };
        var getsignup = function (data, status) {
            if (data != "false") {
                $scope.msgr = "Registred Successful";
                $location.url("/home");
                MainJson.signupemail(data.email).success(emailsend);
            } else {
                $scope.msgr = "Error In Registration";
            }
        };
        $scope.signup = function (register) {
            console.log(register);
            MainJson.registeruser(register.firstname, register.lastname, register.email, register.password).success(getsignup);
        };
        var getlogin = function (data, status) {
            if (data != "false") {
                $scope.msg = "Login Successful";
                $location.url("/home");
            } else {
                $scope.msg = "Invalid Email Or Password";
            }
        };
        $scope.userlogin = function (login) {
            console.log(login);
            MainJson.loginuser(login.email, login.password).success(getlogin);
        };


    });


phonecatControllers.controller('loginwishlist',
    function ($scope, TemplateService, MainJson, $rootScope, $routeParams, $location) {
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.changetitle("Login");
        TemplateService.content = "views/login.html";
        TemplateService.slider = "";
        TemplateService.lightboximage = "";
        $scope.loginlogouttext = "Login";
        //authenticate
        $scope.alert2 = "Login or signup for wishlist";

        var cartt = function (data, status) {
            MainJson.gettotalcart().success(MainJson.gettotalproductsincart);
        };

        var cartdata = function (data, status) {
            console.log(data);
            for (var i = 0; i < data.length; i++) {
                MainJson.addtocart(data[i].id, data[i].name, data[i].price, data[i].quantity).success(cartt);;
            }
        };
        var authenticate = function (data, status) {
            MainJson.getusercart(data.id).success(cartdata);
            if (data != "false") {
                $scope.loginlogouttext = "Logout";


            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate
        var emailsend = function (data, status) {
            console.log(data);
            alert("Email send to you");
        };
        var getsignup = function (data, status) {
            if (data != "false") {
                $scope.msgr = "Registred Successful";
                $location.url("/home");
                MainJson.signupemail(data.email).success(emailsend);
            } else {
                $scope.msgr = "Error In Registration";
            }
        };
        $scope.signup = function (register) {
            console.log(register);
            MainJson.registeruser(register.firstname, register.lastname, register.email, register.password).success(getsignup);
        };
        var getlogin = function (data, status) {
            if (data != "false") {
                $scope.msg = "Login Successful";
                $location.url("/wishlist");
            } else {
                $scope.msg = "Invalid Email Or Password";
            }
        };
        $scope.userlogin = function (login) {
            console.log(login);
            MainJson.loginuser(login.email, login.password).success(getlogin);
        };


    });




phonecatControllers.controller('xoxo',
    function ($scope, TemplateService, MainJson, $rootScope, $location) {
        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.changetitle("Login");
        $scope.homeactive = "active";
        TemplateService.content = "views/xoxo.html";
        TemplateService.slider = "";
        $scope.loginlogouttext = "Login";
        //authenticate
        var authenticate = function (data, status) {
            if (data != "false") {
                $scope.alldata = data;
                $scope.loginlogouttext = "Logout";
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate


    });

phonecatControllers.controller('contact',
    function ($scope, TemplateService, MainJson, $rootScope, $location) {
        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.changetitle("Login");
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        $scope.homeactive = "active";
        TemplateService.content = "views/contact.html";
        TemplateService.slider = "";
        $scope.loginlogouttext = "Login";
        //authenticate
        var authenticate = function (data, status) {
            if (data != "false") {
                $scope.alldata = data;
                $scope.loginlogouttext = "Logout";
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate
        //contact
        var contact = function (data, status) {
            console.log(data);
            $scope.msg = "YOUR REVIEW IS SAVED SUCCESSFULY";
        };
        $scope.contactsubmit = false;
        $scope.usercontact = function (data) {
            $scope.contactsubmit = true;
            MainJson.usercontact("", data.name, data.email, data.phone, data.comment).success(contact);
        };
        //contact

    });


phonecatControllers.controller('contact2',
    function ($scope, TemplateService, MainJson, $rootScope, $location) {

        var contact = function (data, status) {
            console.log(data);
            $scope.msg = "YOUR REVIEW IS SAVED SUCCESSFULY";
        };
        $scope.contactsubmit = false;
        $scope.usercontact = function (data) {
            $scope.contactsubmit = true;
            MainJson.usercontact("", data.name, data.email, data.phone, data.comment).success(contact);
        };
        //contact

    });

phonecatControllers.controller('wholesaler',
    function ($scope, TemplateService, MainJson, $rootScope, $location) {
        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.changetitle("Wholesaler");
        $scope.homeactive = "active";
        TemplateService.content = "views/wholesaler.html";
        TemplateService.slider = "";
        $scope.loginlogouttext = "Login";
        //authenticate
        var authenticate = function (data, status) {
            if (data != "false") {
                $scope.alldata = data;
                $scope.loginlogouttext = "Logout";
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate
        //register
        var getwholesalersignup = function (data, status) {
            if (data != "false") {
                $scope.msgr = "Registred Successful";

            } else {
                $scope.msgr = "Error In Registration";
            }
        };
        $scope.wholesalersignup = function (register) {
            console.log(register);
            MainJson.registerwholesaler(register.firstname, register.lastname, register.phone, register.email, register.password).success(getwholesalersignup);
        };
        //register

    });


phonecatControllers.controller('profile',
    function ($scope, TemplateService, MainJson, $rootScope, $location) {
        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.changetitle("Your Profile");
        $scope.homeactive = "active";
        TemplateService.content = "views/profile.html";
        TemplateService.slider = "";
        $scope.loginlogouttext = "Login";
        //authenticate
        var authenticate = function (data, status) {
            if (data != "false") {
                $scope.loginlogouttext = "Logout";
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate

    });

phonecatControllers.controller('lylaloves',
    function ($scope, TemplateService, MainJson, $rootScope, $location) {
        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.changetitle("lylaloves...");
        $scope.homeactive = "active";
        TemplateService.content = "views/lylaloves.html";
        TemplateService.slider = "";
        $scope.loginlogouttext = "Login";
        //authenticate
        var authenticate = function (data, status) {
            if (data != "false") {
                $scope.loginlogouttext = data.email;
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate
        //        $scope.$on('$includeContentLoaded', function () {
        //            console.log("content loaded");
        //        
        //            var $container = $('#isotope');
        //            
        //            // init
        //            $container.isotope({
        //                // options
        //                layoutMode: 'masonry',
        //                itemSelector: '.item',
        //
        //            });
        //        });

    });

phonecatControllers.controller('thankyou',
    function ($scope, TemplateService, MainJson, $rootScope, $location) {
        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.changetitle("Thank You");
        $scope.homeactive = "active";
        TemplateService.content = "views/thankyou.html";
        TemplateService.slider = "";
        $scope.loginlogouttext = "Login";
        MainJson.destroycart().success(MainJson.gettotalproductsincart);
        //authenticate
        var authenticate = function (data, status) {
            if (data != "false") {
                $scope.loginlogouttext = data.email;
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate

    });
phonecatControllers.controller('newsletter',
    function ($scope, $routeParams, TemplateService, MainJson, $rootScope, $location) {
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        $scope.msgg = "Message here..........";

        //authenticate
        var authenticate = function (data, status) {
            console.log(data);
            if (data != "false") {
                $scope.alldate = data;
                $scope.loginlogouttext = "Logout";
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate
        //newsletter
        var newslettersaved = function (data, status) {
            if (data == "true") {
                //alert("Thank you for subscribing.");
                TemplateService.lightboximage = "img/newsletterpopup.jpg";
                console.log("now popup should come.");
            } else {
                //alert("Thank You For Subscribe");
                $location.url("/xoxo");
            }
        };
        $scope.newsletter = function (uemail) {
            if (!uemail) {
                alert("Please Enter Email");
            } else {
                console.log($scope.alldate);
                MainJson.newsletter("", uemail, "").success(newslettersaved);
            }
        };
        //newsletter

    });

phonecatControllers.controller('badge',
    function ($scope, $routeParams, TemplateService, MainJson, $rootScope, $location) {
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        $scope.msgg = "Message here..........";

        //authenticate
        var authenticate = function (data, status) {
            console.log(data);
            if (data != "false") {
                $scope.alldate = data;
                $scope.loginlogouttext = "Logout";
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate
        var totalcart = function (data, status) {
            console.log(data);
            $scope.template.totalproducts = data;
        };
        MainJson.gettotalcart().success(MainJson.gettotalproductsincart);

    });


phonecatControllers.controller('search',
    function ($scope, $routeParams, TemplateService, MainJson, $rootScope, $location) {
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        $scope.msgg = "Message here..........";

        //authenticate
        var authenticate = function (data, status) {
            console.log(data);
            if (data != "false") {
                $scope.alldate = data;
                $scope.loginlogouttext = "Logout";
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate
        //search
        $scope.search = function (search) {
            $location.url("/search/" + search);
        };
        //search

    });


phonecatControllers.controller('lightbox',
    function ($scope, $routeParams, TemplateService, MainJson, $rootScope, $location) {
        $scope.removelightbox = function () {
            TemplateService.lightboximage = "";
        };
    });




phonecatControllers.controller('searchpage',
    function ($scope, $routeParams, TemplateService, MainJson, $rootScope, $location) {
        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.changetitle("Search");
        $scope.homeactive = "active";
        TemplateService.content = "views/search.html";
        TemplateService.slider = "";
        $scope.firstshow = "firstshow";
        $scope.loginlogouttext = "Login";
        //authenticate
        var authenticate = function (data, status) {
            if (data != "false") {
                $scope.loginlogouttext = data.email;
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate

        //searching
        $scope.searchresult = $routeParams.search;
        var searching = function (data, status) {
            $scope.find = data;
        };
        MainJson.seach($routeParams.search).success(searching);
        //searching
    });


phonecatControllers.controller('lookbook',
    function ($scope, TemplateService, MainJson, $rootScope, $location) {



        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.changetitle("Ziba Lookbook");
        $scope.homeactive = "active";
        TemplateService.content = "views/lookbook.html";
        TemplateService.slider = "";
        $scope.firstshow = "firstshow";
        $scope.loginlogouttext = "Login";
        //authenticate
        var authenticate = function (data, status) {
            if (data != "false") {
                $scope.loginlogouttext = data.email;
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate
        $scope.changeactivelookbook = function (id) {
            $scope.firstshow = "";
            console.log(id);
            for (var i = 0; i < $scope.lookbookimages.length; i++) {
                $scope.lookbookimages[i].active = "";
            }
            $scope.lookbookimages[id].active = "active";
            $scope.activeimage = $scope.lookbookimages[id].image;
        };
        $scope.lookbookimages = [{
            id: 1,
            image: "img/lookbook/pro1.jpg"
                                   }, {
            id: 2,
            image: "img/lookbook/pro2.jpg"
                                   }, {
            id: 3,
            image: "img/lookbook/pro1.jpg"
                                   }, {
            id: 4,
            image: "img/lookbook/pro2.jpg"
                                   }, {
            id: 5,
            image: "img/lookbook/pro1.jpg"
                                   }, {
            id: 6,
            image: "img/lookbook/pro2.jpg"
                                   }, {
            id: 7,
            image: "img/lookbook/pro1.jpg"
                                   }, {
            id: 8,
            image: "img/lookbook/pro2.jpg"
                                   }];
        $scope.lookbookimages[0].active = "active";
        $scope.activeimage = $scope.lookbookimages[0].image;
    });


phonecatControllers.controller('checkout',
    function ($scope, TemplateService, MainJson, $rootScope, $location) {
        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.changetitle("Checkout");
        TemplateService.content = "views/checkout.html";
    
        TemplateService.slider = "";
        $scope.buttonsvalidate={billing:0,shipping:0,payment:0};    
    $scope.loginlogouttext = "Login";
        $scope.isloggedin = 0;
        $scope.form = {};
        $scope.form.shipdifferent = 1;
        $scope.billinginfo = 0;
        //$scope.shipdifferent = false;
        $scope.shippinginfo = 0;
        $scope.paywithcard = 0;
        $scope.hidebilling = 1;
    
                
        
        $scope.paymentorderemail = "";
        $scope.paymentorderid = 0;
    
    
        $scope.focusout = function () {
            console.log("out focus");
        };
        var paymentcomplete = function (data, status) {
            console.log(data);
            MainJson.orderemail($scope.paymentorderemail, $scope.paymentorderid).success(orderemailsend);
            window.location.href = "http://www.lylaloves.co.uk/#/thankyou";
        };
        var handler = StripeCheckout.configure({
            key: 'pk_live_I1udSOaNJK4si3FCMwvHsY4g',
            //key: 'pk_test_4etgLi16WbODEDr4YBFdcbP0',
            image: 'img/logo.jpg',
            currency: 'GBP',
            token: function (token) {
                MainJson.chargestripe(token.id, $scope.form.email, ($scope.subtotal + $scope.form.shippingcost - $scope.discountamount), ($scope.form.firstname + " " + $scope.form.lastname)).success(paymentcomplete);
                //window.location.href="http://www.lylaloves.co.uk/#/thankyou";
                // Use the token to create the charge with a server-side script.
                // You can access the token ID with `token.id`
            }
        });

        $scope.StipePaymentGen = function (amount) {


            handler.open({
                name: 'Lyla Loves',
                description: 'Total Amount: £ ' + amount,
                amount: amount * 100,

            });

        };



        //discountamount
        $scope.discountamount = 0;

        function calcdiscountamount() {
            var data = MainJson.getcoupondetails();
            var subtotal = parseFloat($scope.subtotal);
            console.log(data);
            if (data.coupontype == '1') {
                if (data.discountpercent != '0') {
                    $scope.ispercent = parseFloat(data.discountpercent);
                    console.log("ABC");
                    $scope.discountamount = (subtotal * $scope.ispercent / 100);
                } else {
                    $scope.isamount = parseFloat(data.discountamount);
                    console.log("ABCD");
                    $scope.discountamount = $scope.isamount;
                }
            }
			if (data.coupontype == '2') {
                console.log($scope.cart);
                
                var totallength=0;
                _.each($scope.cart,function(cart) {totallength+=parseInt(cart.qty);} );
                var xproducts=parseInt(data.xproducts);
                var yproducts=parseInt(data.yproducts);
                var itter=Math.floor(totallength/xproducts)*yproducts;
                console.log("ITTER "+itter);
                var newcart=_.sortBy($scope.cart, function(cart){ cart.price=parseFloat(cart.price);cart.qty2=parseInt(cart.qty);return parseFloat(cart.price); });
                //newcart=_.each(newcart, function(cart){  cart.price=parseFloat(cart.price);cart.qty=parseFloat(cart.qty); });
                console.log(newcart);
                $scope.discountamount=0;
                for(var i=0;i<itter;i++)
                {
                    if(newcart[i].qty2!=0)
                    {
                        newcart[i].qty2--;
                        $scope.discountamount+=newcart[i].price;
                    }
                    
                }
            }
            
            if (data.coupontype == '4') {
                console.log("FREE DELIVERY APPLIED");
                $scope.isfreedelivery = "Free Delivery";
                $scope.discountamount = 0;
            }
        };


        //userloginckeckout
        var getlogin = function (data, status) {
            if (data != "false") {
                //$scope.msg = "Login Successful";
                $location.url("/checkout");
                $scope.isloggedin = 1;
            } else {
                $scope.msg = "Invalid Email Or Password";
            }
        };
        $scope.userloginckeckout = function (login) {
            console.log(login);
            MainJson.loginuser(login.email, login.password).success(getlogin);
        };
        //userloginckeckout

        $scope.continuebilling = function () {
            $scope.billinginfo = 1;
            $scope.buttonsvalidate.billing=1;
        };

        $scope.continueshipping = function () {

            //$scope.errorvalid="Fill All Information *";
            //alert($scope.form.firstname);
            console.log("first name");
            console.log($scope.form.firstname);

            $scope.allvalidation = [{
                field: $scope.form.firstname,
                validation: ""
            }, {
                field: $scope.form.lastname,
                validation: ""
            }, {
                field: $scope.form.email,
                validation: ""
            }, {
                field: $scope.form.billingaddress,
                validation: ""
            }, {
                field: $scope.form.billingcity,
                validation: ""
            }, {
                field: $scope.form.billingpincode,
                validation: ""
            }, {
                field: $scope.form.billingcountry,
                validation: ""
            }, {
                field: $scope.form.phone,
                validation: ""
            }, {
                field: $scope.form.shipdifferent,
                validation: ""
            }];


            var check = formvalidation();
            console.log(check);
            if (check) {
                $scope.shippinginfo = 1;
                $scope.buttonsvalidate.shipping=1;
                //$scope.hidebilling = 0;
            }

        };

        $scope.continueshipping1 = function () {

            //$scope.errorvalid="Fill All Information *";
            //alert($scope.form.firstname);
            console.log("first name");
            console.log($scope.form.firstname);

            $scope.allvalidation = [{
                field: $scope.form.firstname,
                validation: ""
            }, {
                field: $scope.form.lastname,
                validation: ""
            }, {
                field: $scope.form.email,
                validation: ""
            }, {
                field: $scope.form.billingaddress,
                validation: ""
            }, {
                field: $scope.form.billingcity,
                validation: ""
            }, {
                field: $scope.form.billingpincode,
                validation: ""
            }, {
                field: $scope.form.billingcountry,
                validation: ""
            }, {
                field: $scope.form.phone,
                validation: ""
            }, {
                field: $scope.form.shippingaddress,
                validation: ""
            }, {
                field: $scope.form.shippingcity,
                validation: ""
            }, {
                field: $scope.form.shippingpincode,
                validation: ""
            }, {
                field: $scope.form.shippingcountry,
                validation: ""
            }];


            var check = formvalidation();
            console.log(check);
            if (check) {
                $scope.shippinginfo = 1;
                
                $scope.buttonsvalidate.shipping=1;
                //$scope.hidebilling = 0;
            }

        };

        function formvalidation() {
            var isvalid2 = true;
            for (var i = 0; i < $scope.allvalidation.length; i++) {
                console.log("checking");
                console.log($scope.allvalidation[i].field);
                if ($scope.allvalidation[i].field == "" || !$scope.allvalidation[i].field) {
                    $scope.allvalidation[i].validation = "ng-dirty";
                    isvalid2 = false;
                }
            }
            return isvalid2;
        }

        //authenticate
        var authenticate = function (data, status) {
            console.log(data);
            if (data != "false") {
                $scope.isloggedin = 1;
                $scope.accesslevel = data.accesslevel;
                $scope.status = data.status;
                $scope.id = data.id;
                $scope.email = data.email;
                $scope.loginlogouttext = "Logout";
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate

        $scope.newquantity = [];
        var showcart = function (data, status) {
            console.log(data);
            $scope.cart = data;
            console.log($scope.cart[0].qty);
            console.log($scope.cart.length);

            for (var i = 0; i < $scope.cart.length; i++) {
                $scope.newquantity[i] = $scope.cart[i].qty;
                console.log($scope.newquantity[i]);
            }
            
            calcdiscountamount();
        };
        MainJson.getcart().success(showcart);
        var getsubtotal = function (data, status) {
            console.log(data);
            $scope.subtotal = parseFloat(data);
            calcdiscountamount();

        };


        MainJson.totalcart().success(getsubtotal);
        $scope.showshippingmethods = 0;
        // free
        $scope.free = function (country, subtotal, shipping) {
            console.log("MAaaaza");
            console.log(country);
            console.log(subtotal);
            console.log(shipping);
            var coupondetails = MainJson.getcoupondetails();
            if (coupondetails && MainJson.getcoupondetails().coupontype == "4") {
                console.log("ABC");
                $scope.showshippingmethods = 5;
                $scope.form.shippingcost = 0;
                $scope.form.shippingmethod = 6;
                return 0;
            } else if (shipping == "1") {
                if (country == "United Kingdom") {
                    if (subtotal >= 15) {
                        $scope.showshippingmethods = 1;
                        $scope.form.shippingmethod = 1;
                        $scope.form.shippingcost = 0;
                    } else {
                        $scope.showshippingmethods = 2;
                        $scope.form.shippingmethod = 2;
                        $scope.form.shippingcost = 3;
                    }

                } else {
                    if (subtotal >= 20) {
                        $scope.showshippingmethods = 3;
                        $scope.form.shippingmethod = 4;
                        $scope.form.shippingcost = 0;
                    } else {
                        $scope.showshippingmethods = 4;
                        $scope.form.shippingmethod = 5;
                        $scope.form.shippingcost = 5;
                    }

                }
            }

        };
        $scope.free2 = function (country, subtotal, shipping) {
            console.log(country);
            console.log(subtotal);
            console.log(shipping);
            var coupondetails = MainJson.getcoupondetails();
            if (coupondetails && MainJson.getcoupondetails().coupontype == "4") {
                $scope.showshippingmethods = 5;
                $scope.form.shippingcost = 0;
                $scope.form.shippingmethod = 6;
                return 0;
            } else if (shipping == "2") {
                if (country == "United Kingdom") {
                    if (subtotal >= 15) {
                        $scope.showshippingmethods = 1;
                        $scope.form.shippingmethod = 1;
                        $scope.form.shippingcost = 0;
                    } else {
                        $scope.showshippingmethods = 2;
                        $scope.form.shippingmethod = 2;
                        $scope.form.shippingcost = 3;
                    }

                } else {
                    if (subtotal >= 20) {

                        $scope.showshippingmethods = 3;
                        $scope.form.shippingmethod = 4;
                        $scope.form.shippingcost = 0;
                    } else {
                        $scope.showshippingmethods = 4;
                        $scope.form.shippingmethod = 5;
                        $scope.form.shippingcost = 5;
                    }

                }
            }

        };
        // free
        $scope.form.shippingcost = 0;
        $scope.changeshippingcost = function (value) {
            console.log(value);
            $scope.form.shippingcost = value;
        };



        $scope.deletecart = function (id) {
            $scope.subtotal = MainJson.deletecart(id);

        };
        $scope.savecart = function (id, quantity) {
            $scope.subtotal = MainJson.savecart(id, quantity);
        };
        var orderemailsend = function (data, status) {
            console.log(data);
            //alert("Email send");
        };

        // order id and email after payment
    
        var orderplaced = function (data, status) {
            console.log("place order returns");
            console.log(data);
//            $scope.paymentorderemail = $scope.form.email;
            $scope.paymentorderid = data;
//            MainJson.orderemail($scope.form.email, data).success(orderemailsend);
            //alert("Order Placed");
        };
        $scope.continuepayment = function (form) {
            $scope.paywithcard = 1;
            $scope.buttonsvalidate.payment=1;
            $scope.form.finalamount = $scope.subtotal;
            $scope.paymentorderemail = $scope.form.email;
            console.log($scope.cart);
            //MainJson.orderitem($scope.cart);
            $scope.form.cart = $scope.cart;
            $scope.form.user = $scope.id;
            $scope.form.status = $scope.status; //MainJson.placeorder(form.firstname,form.lastname,form.email,form.company,form.billingaddress,form.billingcity,form.billingstate,form.billingpincode,form.billingcountry,form.phone,form.fax,form.shippingaddress,form.shippingcity,form.shippingstate,form.shippingpincode,form.shippingcountry,$scope.id,$scope.status).success(orderplaced); 
            MainJson.placeorder(form).success(orderplaced);
        }

        $scope.placeorder = function (form) {
            console.log($scope.cart);
            //MainJson.orderitem($scope.cart);
            $scope.form.cart = $scope.cart;
            $scope.form.user = $scope.id;
            $scope.form.status = $scope.status; //MainJson.placeorder(form.firstname,form.lastname,form.email,form.company,form.billingaddress,form.billingcity,form.billingstate,form.billingpincode,form.billingcountry,form.phone,form.fax,form.shippingaddress,form.shippingcity,form.shippingstate,form.shippingpincode,form.shippingcountry,$scope.id,$scope.status).success(orderplaced); 
            MainJson.placeorder(form).success(orderplaced);
        };
    });

phonecatControllers.controller('headerctrl',
    function ($scope, TemplateService, MainJson) {
        $scope.template = TemplateService;
        $scope.testing = "testing";
        var fillemail = function (data, status) {
            $scope.email = data.email;
        };

        MainJson.authenticate().success(fillemail);

    });
phonecatControllers.controller('slider',
    function ($scope, $routeParams, TemplateService, MainJson, $rootScope, $location) {
        $scope.template = TemplateService;


        $scope.placelimited = function (limited) {

            var limitedorder = function (data, status) {
                if (data != "false") {
                    // alert("Order Placed");
                    TemplateService.lightboximage = "img/giveawaypopup.jpg";
                    //$location.url("/xoxo");
                    MainJson.placelimitedemail(limited);
                } else {
                    alert("You Already Subscribed To This Offer");
                }
            };

            if (!limited) {
                alert("Fill All Data");
            } else {

                MainJson.placelimited(limited).success(limitedorder);
            }
        };


    });

phonecatControllers.controller('category',
    function ($scope, $routeParams, TemplateService, MainJson, $rootScope, $location, $anchorScroll) {
        $scope.iscategory = "category";

        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.content = "views/category.html";
        TemplateService.slider = "";
        $scope.gototop = function () {
            $location.hash('totop');
            $anchorScroll();
        };
        $scope.loginlogouttext = "Login";
        //get user country
        var getcountry = function (data, status) {
            console.log("get country");
            console.log(data);
        };
        //  MainJson.showcountry().success(getcountry);
        $scope.usercountry = "India";
        //filters
        $scope.filter = MainJson.getfilters();
        $scope.filtercolors = [{
            name: "red",
            active: ""
        }, {
            name: "pink",
            active: ""
        }, {
            name: "black",
            active: ""
        }, {
            name: "white",
            active: ""
        }, {
            name: "grey",
            active: ""
        }, {
            name: "blue",
            active: ""
        }, {
            name: "green",
            active: ""
        }, {
            name: "purple",
            active: ""
        }, {
            name: "yellow",
            active: ""
        }, {
            name: "orange",
            active: ""
        }];

        $scope.filtercolor = function (color) {
            $scope.filter.color = color;
        };

        $scope.filtersave = function (filter) {
            MainJson.setfilter(filter);
            console.log(MainJson.getfilters());
            MainJson.getproductbycategory($routeParams.CategoryId).success(categorysuccess);
        };
        $scope.filterclear = function () {
            $scope.filter = {
                color: "",
                pricemin: 0,
                pricemax: 30
            };
            MainJson.setfilter($scope.filter);
            MainJson.getproductbycategory($routeParams.CategoryId).success(categorysuccess);
        };



        //authenticate
        var authenticate = function (data, status) {
            console.log(data);
            if (data != "false") {
                $scope.loginlogouttext = data.email;
                $scope.accesslevel = data.accesslevel;
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate

        $scope.products = [];
        $scope.productsheight = {};

        $scope.addMoreItems = function () {
            console.log("More Products Added " + $scope.products.length);
            var first = $scope.products.length;
            var addition = 12;
            var sum = first + addition;
            if (sum > $scope.productlist.length) {
                sum = $scope.productlist.length;
            }
            for (var i = first; i < sum; i++) {
                $scope.products.push($scope.productlist[i]);
            }
            $scope.productsheight.height = ($scope.products.length / 4) * 430 + "px";
        };
        var categorysuccess = function (data, status) {
            $scope.products = [];
            $scope.productsheight = {};
            $scope.category = data.category;
            $scope.breadcrumbs = data.breadcrumbs;
            $scope.subcategory = data.subcategory;
            $scope.currentcategory = data.currentcategory;
            $scope.productlist = data.product;
            $location.hash($scope.category.name.replace(/ /g, "_"));
            $location.replace();
            console.log(data);
            console.log(data.product);
            $scope.addMoreItems();
        };
        MainJson.getproductbycategory($routeParams.CategoryId).success(categorysuccess);




        $scope.$on('$viewContentLoaded', function () {

            new WOW().init();


            TemplateService.firsttimeloaded();
            $(".zoomContainer").remove();
            $(".pulseanimation").hover(function () {
                $(this).addClass("animated pulse");
            }, function () {
                $(this).removeClass("animated pulse");
            });

            $(".tadaanimation").hover(function () {
                $(this).addClass("animated tada");
            }, function () {
                $(this).removeClass("animated tada");
            });
        });

    });

phonecatControllers.controller('product',
    function ($scope, $routeParams, TemplateService, MainJson, $timeout, $location) {
        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        console.log($routeParams.ProductId);
        $scope.template = TemplateService;
        TemplateService.content = "views/product.html";
        $scope.bottommenu = "fixed";
        TemplateService.slider = "";
        $scope.addquantity = 1;
        $scope.addedtocart = "hide";
        $scope.loginlogouttext = "Login";


        //authenticate
        var authenticate = function (data, status) {
            if (data != "false") {
                $scope.accesslevel = data.accesslevel;
                $scope.id = data.id;
                $scope.loginlogouttext = data.email;
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate
        //nextprevious
        var changelocation = function (data) {
            $location.url("/product/" + data.id);
        };
        $scope.next = function (product) {
            MainJson.nextproduct(product, 1).success(changelocation);
        };
        $scope.previous = function (product) {
            MainJson.nextproduct(product, 0).success(changelocation);
        };
        //nestprevious
        $scope.wishlistlogin = false;
        $scope.wishlistadded = false;
        var getwishlist = function (data, status) {
            console.log(data);
            $scope.wish = data;
            $scope.wishlistadded = true;
        };
        $scope.addwishlist = function (id) {
            if ($scope.id) {
                MainJson.addtowishlist(id, $routeParams.ProductId).success(getwishlist);
            } else {
                $scope.wishlistlogin = true;
            }
        };
        var productsuccess = function (data, status) {
            if ($scope.accesslevel == 3) {
                $scope.rate = data.product.wholesaleprice;
            } else {
                $scope.rate = data.product.price;
            }
            $scope.product = data.product;
            $scope.product.quantity = parseInt($scope.product.quantity);
            $scope.breadcrumbs = data.breadcrumbs;
            $scope.productimage = data.productimage;
            $scope.relatedproduct = data.relatedproduct;
            console.log(data);
            $location.hash($scope.product.name.replace(/ /g, "_"));
            $location.replace();
        };
        MainJson.getproductdetails($routeParams.ProductId).success(productsuccess);
        var cartt = function (data, status) {
            console.log(data);
            MainJson.gettotalcart().success(MainJson.gettotalproductsincart);
        };
        $scope.addtocart = function (id, name, price, quantity) {
            // console.log(id+name+price+quantity);
            TemplateService.cartclicked = "animated swing";

            MainJson.addtocart(id, name, price, quantity).success(cartt);
            $scope.addedtocart = "show";
        };
        var addedtowaitinglist=function(data) {
            console.log(data);
            $scope.addedtowaitinglist=true;
        };
        $scope.addedtowaitinglist=false;
        $scope.addtowaitinglist=function(product,email) {
            MainJson.addtowaitinglist(product,email).success(addedtowaitinglist);
        };

        $scope.$on("$includeContentLoaded", function () {

            // stLight.options({publisher: "d145c5ea-9796-4078-8488-dc6407ac1d79", doNotHash: false, doNotCopy: false, hashAddressBar: true});

            TemplateService.firsttimeloaded();
            $(".zoomContainer").remove();
            $(".pulseanimation").hover(function () {
                $(this).addClass("animated pulse");
            }, function () {
                $(this).removeClass("animated pulse");
            });

            $(".tadaanimation").hover(function () {
                $(this).addClass("animated tada");
            }, function () {
                $(this).removeClass("animated tada");
            });
        });

    });

phonecatControllers.controller('delivery',
    function ($scope, TemplateService, MainJson, $rootScope, $location) {
        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.changetitle("Delivery");
        $scope.deliveryactive = "active";
        TemplateService.content = "views/delivery.html";
        TemplateService.slider = "";
        $scope.loginlogouttext = "Login";
        //authenticate
        var authenticate = function (data, status) {
            if (data != "false") {
                $scope.loginlogouttext = "Logout";
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate

    });

phonecatControllers.controller('wishlist',
    function ($scope, TemplateService, MainJson, $rootScope, $location) {
        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.changetitle("Wishlist");
        $scope.deliveryactive = "active";
        TemplateService.content = "views/wishlist.html";
        TemplateService.slider = "";
        $scope.loginlogouttext = "Login";
        //authenticate

        var userwishlist = function (data, status) {
            $scope.find = data;
        };
        var authenticate = function (data, status) {
            console.log(data);
            if (data != "false") {
                MainJson.showwishlist(data.id).success(userwishlist)
                $scope.loginlogouttext = "Logout";
            } else {
                $location.path("/loginwishlist");
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate

    });


phonecatControllers.controller('returns',
    function ($scope, TemplateService, MainJson, $rootScope, $location) {
        //$scope.firstloadclass = TemplateService.firstload;
        $scope.template = TemplateService;
        TemplateService.header = "views/header.html";
        TemplateService.navigation = "views/navigation.html";
        TemplateService.changetitle("Returns");
        TemplateService.content = "views/returns.html";
        $scope.returnsactive = "active";
        TemplateService.slider = "";
        $scope.loginlogouttext = "Login";
        //authenticate
        var authenticate = function (data, status) {
            if (data != "false") {
                $scope.loginlogouttext = "Logout";
            }
        };
        MainJson.authenticate().success(authenticate);
        //authenticate

    });




phonecatControllers.controller('zoomCtrl',
    function ($scope) {
        $scope.switchImage = function (imageSrc) {
            console.log('change image to: ' + imageSrc);
            $scope.imageSrc = imageSrc;
        };
    }
);

function CarouselDemoCtrl($scope) {

}