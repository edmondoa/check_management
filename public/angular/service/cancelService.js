(function(app) {
    'use strict';
    /*
    *   productService
    *   https://weblogs.asp.net/dwahlin/using-an-angularjs-factory-to-interact-with-a-restful-service
    */
app.factory('cancelService', ['HttpRequestFactory','$q','$timeout',function (HttpRequestFactory,$q,$timeout) {
        var urlBase = '/check-reset';

      function setCancel(model){
        var config;
        config = {
            method: 'POST',
            url: urlBase+'/cancel',
            data:$.param(model),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      }

    	return {
        setCancel : setCancel
    	};
    }]);

})(App)
