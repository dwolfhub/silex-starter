define([], function(Module){
    "use strict";

    var SomeModule = function(){
        console.log('hello...');
        document.querySelector('body').addEventListener('click', this.doSomething.bind(this));
    };

    SomeModule.prototype = {
        doSomething : function(event){
            console.log('something');
        }
    };

    return SomeModule;
});