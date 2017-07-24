(function(app) {
    'use strict';
    /*
    *   productService
    *   https://weblogs.asp.net/dwahlin/using-an-angularjs-factory-to-interact-with-a-restful-service
    */
app.factory('accountService', ['HttpRequestFactory','$q','$timeout',function (HttpRequestFactory,$q,$timeout) {
        var urlBase = '/accounts';

      function saveAccount(model){
        console.log(model)
        var config;
        config = {
            method: 'POST',
            url: urlBase,
            data:$.param(model),          
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      }
      function updateAccount(model){
        console.log(model)
        var config;
        config = {
            method: 'PUT',
            url: urlBase+'/'+model['account_id'],
            data:$.param(model),          
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      }

    	return {
        saveAccount : saveAccount,
        updateAccount :updateAccount
    	};
    }]);

})(App)
