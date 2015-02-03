var templateservicemod = angular.module('templateservicemod', []);
templateservicemod.service('TemplateService', function () {
    this.title = "Home";
    this.meta = "Google";
    this.header = "views/header.html";
    this.navigation = "views/navigation.html";

    this.slider = "views/slider.html";
    this.content = "views/content.html";
    this.footer = "views/footer.html";
    this.firstload = "wow";
    this.cartclicked = "";
    this.lightboximage = "";
    this.changetitle = function (newtitle) {
        this.title = newtitle;
    };
    this.firsttimeloaded = function (newtitle) {
        $(".zoomContainer").remove();

        this.firstload = "";
    };
    
});
templateservicemod.controller('navigationctrl', ['$scope', 'TemplateService',
                                        function ($scope, TemplateService, MainJson, $rootScope) {
        $scope.submenuval = ['views/jewellerysubmenu.html', 'views/accessoriessubmenu.html', 'views/lookbooksubmenu.html', 'views/iheartsubmenu.html', 'views/handmadesubmenu.html', 'views/newinmenu.html','views/contactsubmenu.html'];
        $scope.submenu = [];
        $scope.showsub = function (data) {
            console.log(data);
            $scope.submenu[data] = true;


        };
        $scope.hidesub = function (data) {
            console.log(data);
            $scope.submenu[data] = false;
        };
}]);

templateservicemod.controller('filterctrl', ['$scope', 'TemplateService',
                                                 function ($scope, TemplateService, MainJson, $rootScope) {
        $scope.filterval = ['views/filter.html', 'views/sort.html'];
        $scope.filters = [];
        $scope.showfilter = function (data) {
            console.log(data);
            $scope.filters[data] = true;


        };
        $scope.hidefilter = function (data) {
            console.log(data);
            $scope.filters[data] = false;
        };
}]);