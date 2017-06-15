(function(app) {

  'use strict';

  app.controller('cancelCtrl', ['cancelService','$scope','$window', function (service,$scope,$window) {

      var ctrl = this;     
      this.setCancel= function(model){         
        console.log(model);     
        service.setCancel(model).then(function (result) {
            
            if(result.data.status){
              ctrl.warehouses = result.data.result;
              console.log(ctrl.warehouses);
              console.log(result.data); 
            }else{
              $scope.message(result.data);
            }
                       
            
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
