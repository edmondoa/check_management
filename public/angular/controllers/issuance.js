(function(app) {

  'use strict';

  app.controller('issuanceCtrl', ['issuanceService','$scope','$window', function (service,$scope,$window) {

      var ctrl = this; 
      $scope.issuance = {};    
      this.showAvailableCheck = function(model)
      {        
        console.log(model)
        service.getAvailableCheck(model).then(function (result) {
            var opt="<option>Select</option>";
            for(var i = 0; i < result.data.length; i++){
              opt+="<option value="+result.data[i].check_id+" data-status='"+result.data[i].check_status_id+"'>"+result.data[i].check_no+"</option>";
            }
            $( "select.check_no" ).html(opt);
            $('select.payee_id').removeAttr('disabled'); 
        });
      }    
      
      this.wareHouseCheck = function(model)
      {
          console.log(model);
          status = $("select.check_no").find(':selected').data('status');
          if(status == 2){
             model['check_no'] = ($(".check_no").val()=='Select')?'':$(".check_no").val();
            console.log(model);           
            service.getPayee(model).then(function (result) {
              $("select.payee_id").val(result.data.payee_id).trigger("change") ;
              $('select.payee_id').attr('disabled','disabled'); 
            });
          }else{
            $('select.payee_id').removeAttr('disabled'); 
          }
      }

      this.saveIssuance= function(model){ 
        if (model === undefined) {          
          var data = {};
          data['status'] = false;
          data['message'] = ["Account is required"];
          $scope.message(data);
          return false;
        }
        console.log($(".check_no").val());
          
        model['check_no'] = ($(".check_no").val()=='Select')?'':$(".check_no").val();
        model['payee_id'] = ($(".payee_id").val()=='Select')?'':$(".payee_id").val();
        model['notes'] = $("[name='notes']").val();          
        service.saveIssuance(model).then(function (result) {
            $scope.message(result.data);
            $(".check_no").val(model['check_no']);//.trigger("change") ; 
            if(result.data.status==true){
              $window.location.reload();          
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
