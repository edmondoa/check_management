(function(app) {
    'use strict';
    /*
    *   productService
    *   https://weblogs.asp.net/dwahlin/using-an-angularjs-factory-to-interact-with-a-restful-service
    */
app.factory('payeeService', ['HttpRequestFactory','$q','$timeout',function (HttpRequestFactory,$q,$timeout) {
        var urlBase = '/payees';

     function savePayee(model){
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

      function updatePayee(model){
        console.log(model)
        var config;
        config = {
            method: 'PUT',
            url: urlBase+'/'+model['payee_id'],
            data:$.param(model),          
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      }


        return {
        savePayee : savePayee,
        updatePayee : updatePayee
        };
    }]);

})(App)
