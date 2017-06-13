(function(app) {
    'use strict';
    /*
    *   productService
    *   https://weblogs.asp.net/dwahlin/using-an-angularjs-factory-to-interact-with-a-restful-service
    */
app.factory('issuanceService', ['HttpRequestFactory','$q','$timeout',function (HttpRequestFactory,$q,$timeout) {
        var urlBase = '/check-issuances';

      function getAvailableCheck(model){
        console.log(model);
        var config;
        config = {
            method: 'GET',
            url: urlBase+'/'+model.account_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      } 

      function saveIssuance(model){       
        var config;
        config = {
            method: 'POST',
            url: urlBase,
            data:$.param(model), 
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      } 


    	return {
        getAvailableCheck : getAvailableCheck,
        saveIssuance : saveIssuance
    	};
    }]);

})(App)
