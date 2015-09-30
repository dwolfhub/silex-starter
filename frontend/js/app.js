define([
    'fastclick',
    './modules/module'
], function (FastClick, Module) {
    'use strict';
    document.addEventListener('DOMContentLoaded', function () {

        FastClick.attach(document.body);

        new Module();
    });
});