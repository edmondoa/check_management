(function(app) {

  'use strict';

  app.controller('settledCtrl', ['settleService','$scope','$window', function (service,$scope,$window) {

      var ctrl = this;   
      ctrl.results = []; 
      getSettle(); 
      this.setSettle= function(model){ 
        var botbox = bootbox.confirm({
          title: "Confirm",
          message: "Are you sure you want to proceed?",
          size: 'small',
          buttons: {
              cancel: {
                  label: '<i class="fa fa-times"></i> Cancel',
                  className: 'btn-danger'
              },
              confirm: {
                  label: '<i class="fa fa-check"></i> Confirm',
                  className: 'btn-success'
              }
          },
          callback: function (result) {           
             if(result){
              model['payee'] = $("input[name='payee']").val(); 
              model['payee_id'] = $("input[name='payee_id']").val();
              model['check_id'] = $("input[name='check_id']").val(); 
              model['check_amount'] = $("input[name='check_amount']").val();    
             
              service.setSettle(model).then(function (result) {            
                if(result.data.status){
                  ctrl.results = result.data.results; 
                  $("input[type='reset']").trigger('click');             
                }else{
                  $scope.message(result.data);
                } 

                  
              });
              
             }
          }
        }); 

              
      }

      this.setCancel = function(){ 
        var botbox = bootbox.confirm({
          title: "Confirm",
          message: "Are you sure you want to Cancel?",
          size: 'small',
          buttons: {
              cancel: {
                  label: '<i class="fa fa-times"></i> Cancel',
                  className: 'btn-danger'
              },
              confirm: {
                  label: '<i class="fa fa-check"></i> Confirm',
                  className: 'btn-success'
              }
          },
          callback: function (result) {           
             if(result){
              service.setCancel().then(function (result) {            
                if(result.data.status){
                  ctrl.results = result.data.results;              
                }else{
                  $scope.message(result.data);
                }                       
                    
              });
             }
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
        var botbox = bootbox.confirm({
          title: "Confirm",
          message: "Are you sure you want to commit this list of checks?",
          size: 'small',
          buttons: {
              cancel: {
                  label: '<i class="fa fa-times"></i> Cancel',
                  className: 'btn-danger'
              },
              confirm: {
                  label: '<i class="fa fa-check"></i> Confirm',
                  className: 'btn-success'
              }
          },
          callback: function (result) {           
             if(result){
              service.setCommit().then(function (result) {            
                ctrl.results = result.data.results;             
              }); 
             }
          }
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
