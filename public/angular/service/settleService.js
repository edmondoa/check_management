(function(app) {
    'use strict';
    /*
    *   productService
    *   https://weblogs.asp.net/dwahlin/using-an-angularjs-factory-to-interact-with-a-restful-service
    */
app.factory('settleService', ['HttpRequestFactory','$q','$timeout',function (HttpRequestFactory,$q,$timeout) {
        var urlBase = '/check-settle';

      function setSettle(model){
        var config;
        config = {
            method: 'POST',
            url: urlBase,
            data:$.param(model),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      }
      function getSettle(){
        var config;
        config = {
            method: 'GET',
            url: urlBase+'/getSettle',            
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      }
      function setCommit(){
        var config;
        config = {
            method: 'GET',
            url: urlBase+'/setCommit',            
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      }
      function findCheck(model){
        var config;
        config = {
            method: 'POST',
            url: urlBase+'/findCheck',
            data:$.param(model),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      }

      function setCancel(model){
        var config;
        config = {
            method: 'GET',
            url: urlBase+'/cancel',            
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        };
        return HttpRequestFactory.request(config);
      }

    	return {
        setSettle : setSettle,
        getSettle : getSettle,
        findCheck : findCheck,
        setCommit : setCommit,
        setCancel : setCancel
    	};
    }]);

})(App)
