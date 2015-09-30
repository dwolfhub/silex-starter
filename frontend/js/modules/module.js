define([], function(){
    "use strict";

    var SomeModule = function(){
        console.log('hello...');
        document.querySelector('body').addEventListener('click', this.doSomething.bind(this));
    };

    SomeModule.prototype = {
        doSomething : function(){
            console.log('something');
        }
    };

    return SomeModule;
});