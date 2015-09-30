define([
    'fastclick',
    './modules/module'
], function (FastClick, Module) {
    "use strict";
    document.addEventListener("DOMContentLoaded", function (event) {

        FastClick.attach(document.body);

        new Module();
    });
});