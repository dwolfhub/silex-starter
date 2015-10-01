define([], function(){
    "use strict";

    var SomeModule = function(){
        document.querySelector('body').addEventListener('click', this.doSomething.bind(this));
    };

    SomeModule.prototype = {
        doSomething : function(event){
            console.log('something');
        }
    };

    return SomeModule;
});