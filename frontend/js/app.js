define([
    'fastclick',
    './module'
    ], function(FastClick, Module){
        "use strict";
        document.addEventListener("DOMContentLoaded", function(event) {

            FastClick.attach(document.body);


            var module = new Module();
        });
});