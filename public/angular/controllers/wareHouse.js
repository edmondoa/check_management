(function(app) {

  'use strict';

  app.controller('wareHouseCtrl', ['wareHouseService','$scope','$window', function (service,$scope,$window) {

      var ctrl = this; 
      ctrl.warehouses = [];
      this.saveWarehouse= function(model){ 
        if (model === undefined) {          
          var data = {};
          data['status'] = false;
          data['message'] = ["Account is required"];
          $scope.message(data);
          return false;
        }       
          
             
        service.saveWareHouse(model).then(function (result) {
            
            if(result.data.status){
              ctrl.warehouses = result.data.result;
              $("input[type='reset']").trigger('click');
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
