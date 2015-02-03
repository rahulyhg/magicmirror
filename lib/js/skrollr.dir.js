'use strict';

var skrollr2=0;

angular.module('directives.skrollr', [])
    .directive('skrollr', function () {
        var directiveDefinitionObject = {
            link: function () {
                if(skrollr2==0)
                {
                    skrollr2=skrollr.init();
                   
                }
                else
                {
                    skrollr2.refresh();
                   
                }
                console.log("Skrollr Refreshed.");
            }
        };

        return directiveDefinitionObject;
    });