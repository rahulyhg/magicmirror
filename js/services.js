var adminurl1 = 'http://www.magicmirror.in/admin/index.php/';
//var adminurl1 = 'http://localhost/magicmirror/admin/index.php/';
var adminurl = adminurl1 + 'json/';
var adminurl2 = adminurl1 + 'json/';
//var adminurl = 'http://localhost/admin/index.php/json/';
//var adminurl2 = 'http://localhost/admin/index.php/json/';

var conversionrate = [{
    id: "1",
    name: "INR",
    conversionrate: "1",
    isdefault: "1"
}];
//$.holdReady(true);
$.getJSON(adminurl + "getconversionrates", {}, function(data) {

    conversionrate = data;
    //console.log("Conversion Rate");
});


var lat = 0;
var long = 0;
var currency = "INR";
var country = false;
var showError = function(data) {
    console.log(data);
    $.holdReady(false);
};
var showlocationdata = function(data, status) {
    console.log("in location success");
    console.log(data);
    var address = data.results[0].address_components;
    for (var i = 0; i < address.length; i++) {
        if (address[i].types.indexOf("country") >= 0) {
            country = address[i].short_name;



            var countries = ['AL', 'AD', 'AM', 'AT', 'BY', 'BE', 'BA', 'BG', 'CH', 'CY', 'CZ', 'DE',
                'DK', 'EE', 'ES', 'FO', 'FI', 'FR', 'GE', 'GI', 'GR', 'HU', 'HR',
                'IE', 'IS', 'IT', 'LT', 'LU', 'LV', 'MC', 'MK', 'MT', 'NO', 'NL', 'PL',
                'PT', 'RO', 'RU', 'SE', 'SI', 'SK', 'SM', 'TR', 'UA', 'VA'
            ];

            if (countries.indexOf(country) >= 0) {
                country = "EUROPE";
            }
            console.log("Country ////////////////////////");
            //case1 : short name: GB
            console.log(country);
            if (country == "IN") {
                currency = "INR";
            }  else {
                currency = "USD";
            }
            console.log("Currency: " + currency);

            break;
        }

    }
    //$.holdReady(false);
};
var ongettingdata = function(data) {
    console.log("in location success");
    console.log(data);
    country = data.country_code;

    if (data) {
        country = data.country_code;



        var countries = ['AL', 'AD', 'AM', 'AT', 'BY', 'BE', 'BA', 'BG', 'CH', 'CY', 'CZ', 'DE',
            'DK', 'EE', 'ES', 'FO', 'FI', 'FR', 'GE', 'GI', 'GR', 'HU', 'HR',
            'IE', 'IS', 'IT', 'LT', 'LU', 'LV', 'MC', 'MK', 'MT', 'NO', 'NL', 'PL',
            'PT', 'RO', 'RU', 'SE', 'SI', 'SK', 'SM', 'TR', 'UA', 'VA'
        ];

        if (countries.indexOf(country) >= 0) {
            country = "EUROPE";
        }
        console.log("Country ////////////////////////");
        //case1 : short name: GB
        console.log(country);
        if (country == "IN") {
            currency = "INR";
        } else {
            currency = "USD";
        }
        console.log("Currency: " + currency);
        if (currency == "USD" || currency == "EURO") {
            console.log("Show Popup");

            //POPup to be here
        }

    }
}
$.holdReady(false);

//start get country from geo location
function CommonCode() {



    function showPosition2(position) {
        var latlon = position.coords.latitude + "," + position.coords.longitude;
        console.log("Positions:.........");
        console.log(position);
        coords = position.coords;
        lat = position.coords.latitude;
        long = position.coords.longitude;
        locationdata = lat + "," + long;

        $.get("https://maps.googleapis.com/maps/api/geocode/json?address=" + locationdata + "&key=AIzaSyAj0OXepKIgjTlZiPe_ZVYTDjL8rYpobgQ").success(showlocationdata);
    }

    console.log("common code");
    $.getJSON("http://www.telize.com/geoip").success(ongettingdata);
    /*if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition2, showError);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }*/

}
CommonCode();



var service = angular.module('Service', []);
service.factory('MainJson', function($http, TemplateService) {
    var country = "";
    var cart = [];
    var returntwo = [];
    var subtotal = 0;
    var totalproducts = 0;
    var filters = {
        color: "",
        pricemin: 0,
        pricemax: 500000,
        orderby: "new"
    };
    var coupondetails = $.jStorage.get("coupon");
    var discount = $.jStorage.get("coupon");

    return {
        checkdiscount: function(discountcoupon) {
            return $http.post(adminurl + 'checkdiscount?coupon=' + discountcoupon, {}, {
                withCredentials: true
            });
        },
        nextproduct: function(product, next) {
            return $http.get("http://localhost:10080/admin/index.php/json/nextproduct", {
                params: {
                    id: product,
                    next: next
                }
            });
        },
        getcoupondetails: function() {
            return coupondetails;
        },
        getmap: function(data) {
            return $http.get("https://maps.googleapis.com/maps/api/geocode/json?address=" + data + "&key=AIzaSyAj0OXepKIgjTlZiPe_ZVYTDjL8rYpobgQ", {});
        },
        setcoupondetails: function(coupon) {
            $.jStorage.set("coupon", coupon);
            coupondetails = coupon;
        },
        addtowaitinglist: function(product, email) {
            return $http.get(adminurl + "addproductwaitinglist", {
                params: {
                    product: product,
                    email: email
                }
            });
        },
        getuserbyid: function() {
            return $http.get(adminurl + "getuserbyid ", {});
        },
        getfilters: function() {
            return filters;
        },
        setfilter: function(filter) {
            filters = filter;
        },
        placelimitedemail: function(limited) {
            return $http({
                url: adminurl + 'placelimitedemail',
                method: "POST",
                withCredentials: true,
                data: {
                    'limited': limited
                }
            });
        },
        placelimited: function(limited) {
            return $http({
                url: adminurl + 'placelimited',
                method: "POST",
                withCredentials: true,
                data: {
                    'limited': limited
                }
            });
        },
        newPassword: function(forgot) {
            return $http({
                url: adminurl + 'forgotpasswordsubmit',
                method: "POST",
                withCredentials: true,
                data: {
                    'password': forgot.password,
                    'hashcode': forgot.hashcode
                }
            });
        },
        placeorder: function(form) {
            return $http({
                url: adminurl + 'placeorder',
                method: "POST",
                withCredentials: true,
                data: {
                    'form': form
                }
            });
        },
        submitcheckout: function(form) {
            console.log(form);
            return $http({
                url: "http://localhost/magicmirror/paymentgateway/index.php",
                method: "POST",
                withCredentials: true,
                data: {
                    'form': form
                }
            });
        },
        seach: function(search) {
            return $http.post(adminurl + 'searchbyname?search=' + search, {}, {
                withCredentials: true
            });
        },
        showwishlist: function(user) {
            return $http.post(adminurl + 'showwishlist?user=' + user, {}, {
                withCredentials: true
            });
        },
        signupemail: function(email) {
            return $http.post(adminurl + 'signupemail?email=' + email, {}, {
                withCredentials: true
            });
        },
        orderemail: function(email, orderid) {
            return $http.post(adminurl + 'orderemail?email=' + email + '&orderid=' + orderid, {}, {
                withCredentials: true
            });
        },
        logout: function() {
            return $http.post(adminurl + 'logout', {}, {
                withCredentials: true
            });
        },
        usercontact: function(id, name, email, phone, comment) {
            return $http.post(adminurl + 'usercontact?id=' + id + '&name=' + name + '&email=' + email + '&phone=' + phone + '&comment=' + comment, {}, {
                withCredentials: true
            });
        },
        newsletter: function(id, email, status) {
            return $http.post(adminurl + 'newsletter?id=' + id + '&email=' + email + "&status=" + status, {}, {
                withCredentials: true
            });
        },
        addtowishlist: function(user, product) {
            return $http.post(adminurl + 'addtowishlist?user=' + user + '&product=' + product, {}, {
                withCredentials: true
            });
        },
        authenticate: function() {
            return $http.post(adminurl + 'authenticate', {}, {
                withCredentials: true
            });
        },
        registeruser: function(firstname, lastname, email, password) {
            return $http.post(adminurl + 'registeruser', {firstname:firstname,lastname:lastname,email:email,password:password}, {
                withCredentials: true
            });
        },
        registerwholesaler: function(firstname, lastname, phone, email, password) {
            return $http.post(adminurl + 'registewholesaler?firstname=' + firstname + '&lastname=' + lastname + '&phone=' + phone + '&email=' + email + '&password=' + password, {}, {
                withCredentials: true
            });
        },
        loginuser: function(email, password) {
            //            return $http.post(adminurl + 'loginuser?email=' + email + '&password=' + password, {}, {
            //                withCredentials: true
            //            });
            return $http({
                url: adminurl + "loginuser",
                method: "POST",
                withCredentials: true,
                data: {
                    "email": email,
                    "password": password
                }
            })
        },
        updateuser: function(user) {
            //            return $http.post(adminurl + 'loginuser?email=' + email + '&password=' + password, {}, {
            //                withCredentials: true
            //            });
            return $http({
                url: adminurl + "updateuser",
                method: "POST",
                withCredentials: true,
                data: {
                    "name": user.firstname,
                    "lastname": user.lastname,
                    "address": user.billingaddress,
                    "email": user.email,
                    "cell": user.phone,
                    "gender": user.gender
                }
            })
        },
        changepassword: function(pass) {
            return $http({
                url: adminurl + "changepassword",
                method: "POST",
                withCredentials: true,
                data: {
                    "email": pass.email,
                    "oldpassword": pass.oldpassword,
                    "newpassword": pass.newpassword,
                    "conformpassword": pass.conformpassword
                }
            })
        },
        getordertrace: function(order) {
            return $http({
                url: adminurl + "getordertrace",
                method: "POST",
                withCredentials: true,
                data: {
                    "order": order.order
                }
            })
        },
        getnavigation: function() {
            return $http.post(adminurl + 'getnavigation', {}, {
                withCredentials: true
            });
        },
        getorder: function(pageno) {
            return $http.post(adminurl + 'getuserorders?pageno=' + pageno, {}, {
                withCredentials: true
            });
        },
        getproductdetails: function(product, category) {
            return $http.get(adminurl + 'getproductdetails', {
                params: {
                    product: product
                }
            }, {
                withCredentials: true
            });
        },
        getproductbycategory: function(category, pageno, search) {
            return $http.get(adminurl + 'getproductbycategory', {
                params: {
                    pageno: pageno,
                    category: category,
                    color: filters.color,
                    price1: filters.pricemin,
                    price2: filters.pricemax,
                    orderby: filters.orderby,
                    search: search
                }
            }, {
                withCredentials: true
            });
        },
        forgotPassword: function(forgot) {
            return $http.get(adminurl1 + 'json/forgotpassword', {
                params: {
                    email: forgot.email
                }
            }, {
                withCredentials: true
            });
        },
        getusercart: function(user) {
            return $http.get(adminurl + 'getusercart?user=' + user, {}, {
                withCredentials: true
            });
        },
        getallslider: function(user) {
            return $http.get(adminurl + 'getallslider');
        },
        destroycart: function() {
            return $http.post(adminurl + 'destroycart', {}, {
                withCredentials: true
            });
        },
        addtocart: function(id, name, price, quantity) {
            return $http.post(adminurl + 'addtocart?product=' + id + '&productname=' + name + "&quantity=" + quantity + "&price=" + price, {}, {
                withCredentials: true
            });
            /*
            price=parseFloat(price);
            quantity=parseInt(quantity);
            if(isNaN(quantity))
            {
                return;
            }
            var isedit=-1;
            for(var i=0;i<cart.length;i++){
                if(cart[i].id==id)
                {
                    isedit=i;
                }

            }
            if(isedit==-1)
            {
		 	    cart.push({id:id,name:name,price:price,quantity:quantity});

            }
            else
            {
                cart[isedit].quantity+=quantity;
            }
            console.log(cart);
            subtotal=this.calcsubtotal();
            return subtotal;
           */
        },
        getcart: function() {
            return $http.post(adminurl + 'showcart', {}, {
                withCredentials: true
            });
            //return cart;
        },
        getdiscountcoupon: function(couponcode) {
            return $http.post(adminurl + 'getdiscountcoupon?couponcode=' + couponcode, {}, {
                withCredentials: true
            });
        },
        gettotalcart: function() {
            return $http.post(adminurl + 'totalitemcart', {}, {
                withCredentials: true
            });
            //return cart;
        },
        totalcart: function() {
            return $http.post(adminurl + 'totalcart', {}, {
                withCredentials: true
            });
            //return cart;
        },
        deletecart: function(id) {

            subtotal = this.calcsubtotal();
            return subtotal;
        },
        deletecartfromsession: function(id) {
            return $http.post(adminurl + 'deletecart?id=' + id, {}, {
                withCredentials: true
            });
        },
        savecart: function(uid, id, quantity) {
            console.log(cart);
            for (var i = 0; i < cart.length; i++) {
                if (cart[i].id == id) {
                    cart[i].quantity = quantity;
                    console.log(cart[i].name);
                    returntwo.state = $http.post(adminurl + 'addtocart?user=' + uid + '&product=' + id + "&quantity=" + cart[i].quantity, {}, {
                        withCredentials: true
                    });
                }

            }
            console.log(cart);
            returntwo.subtotal = this.calcsubtotal();
            return returntwo;
        },
        calcsubtotal: function() {
            subtotal = 0;
            for (var i = 0; i < cart.length; i++) {
                subtotal += cart[i].price * cart[i].quantity;
            }
            console.log(subtotal);
            return subtotal;

        },
        gettotalproductsincart: function(data, status) {
            console.log(data);
            TemplateService.totalproducts = data;
            return 0;
        },
        chargestripe: function(token, email, amount, name) {
            return $http.get('http://wohlig.com/stripe/index.php/welcome/chargestripe', {
                params: {
                    token: token,
                    email: email,
                    amount: amount * 100,
                    name: name,

                }
            }, {
                withCredentials: true
            });
        },


    }
});
