(function(app) {

  'use strict';

  app.controller('issuanceCtrl', ['issuanceService','$scope', function (service,$scope) {

      var ctrl = this; 

      this.showAvailableCheck = function(model)
      {
        console.log(model);
        service.getAvailableCheck(model).then(function (result) {
            var opt="<option>Select</option>";
            for(var i = 0; i < result.data.length; i++){
              opt+="<option value="+result.data[i].check_id+">"+result.data[i].check_no+"</option>";
            }
            $( "select.check_no" ).html(opt);
            console.log(result.data);
        });
      }    
      

      this.saveAccount= function(model){        
        model['is_active'] = ($("#is_active").is(":checked")) ? 1:0;

        service.saveAccount(model).then(function (result) {
            $scope.message(result.data);
            $("input[type='reset']").trigger('click');
            bsTable.bootstrapTable('refresh');
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
