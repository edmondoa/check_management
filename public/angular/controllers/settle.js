(function(app) {

  'use strict';

  app.controller('settledCtrl', ['settleService','$scope','$window', function (service,$scope,$window) {

      var ctrl = this;   
      ctrl.results = []; 
      getSettle(); 
      this.setSettle= function(model){         
        model['payee'] = $("input[name='payee']").val(); 
        model['payee_id'] = $("input[name='payee_id']").val();
        model['check_id'] = $("input[name='check_id']").val(); 
        model['check_amount'] = $("input[name='check_amount']").val();    
        service.setSettle(model).then(function (result) {            
          if(result.data.status){
            ctrl.results = result.data.results;              
          }else{
            $scope.message(result.data);
          }                       
            
        });       
      }

      this.findCheck = function(model){
        model['account_id'] = (model['account_id']=='Select')?'':model['account_id'];
        service.findCheck(model).then(function (result) {            
          if(result.data.status){
            console.log(result);
            $("input[name='payee']").val(result.data.data.payee.payee_name)  
            $("input[name='payee_id']").val(result.data.data.payee.payee_id) 
            $("input[name='check_id']").val(result.data.data.check_id)            
            $("input[name='check_amount']").val(result.data.data.amount)   
          }else{
            $scope.message(result.data);
          }                       
            
        }); 
      }

      this.clear = function()
      {
        $("input[type='text']").val('');
        $("input[type='hidden']").val('');
      }

      this.setCommit = function()
      {
        service.setCommit().then(function (result) {            
          ctrl.results = result.data.results;             
        }); 
      }
      function getSettle(){
        service.getSettle().then(function (result) {            
          ctrl.results = result.data.results; 
            
        }); 
      }
      

    $scope.message = function(data)
    {
      console.log(data);
      if(data.status){
        $.notify({
          message: data.message
        },{
          type: 'success',
          newest_on_top: true,
          placement: {
              align: "right",
              from: "bottom"
          }
        });
      }else{
        var stringBuilder ="<ul class='error'>";
        for (var x in data.message) {
          console.log(x);
          stringBuilder +="<li>"+data.message[x]+"</li>";
        }
        stringBuilder +="</ul>";
         $.notify({
            message: stringBuilder
          },{
            type: 'danger',
            newest_on_top: true,
          placement: {
              align: "right",
              from: "bottom"
          }
          });
      }
    }
  }])
  })(App)
