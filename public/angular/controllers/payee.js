(function(app) {

  'use strict';

  app.controller('payeeCtrl', ['payeeService','$scope', function (service,$scope) {

      var ctrl = this;
      $scope.branch = {};
      var bsTable     = jQuery('.bsTable');

      bsTable.bootstrapTable({
          responseHandler: function (res) {
              return ctrl.formatter(res);
          },
          queryParams: function(q){
              return q;
          },
          onPostBody: function(data){
          }
      });

      this.formatter = function(res){
            $("div.bs-bars").addClass('col-md-5');
          return {
              "total": res.total,
              "rows": res.rows
          };
      }
      this.filterRecord = function(model)
      {
        var searchStr = (typeof(model['searchStr'])=='undefined') ? '': model['searchStr'];
        var url = '/payees/ng-payee-list?searchStr='+searchStr;
        bsTable.bootstrapTable('refresh', {url: url});
      }

      this.savePayee= function(model){ 
        if(typeof model === 'undefined')
        {
          var model = {};
          model['is_active'] = 0;
        }else{
          model['is_active'] = ($("#is_active").is(":checked")) ? 1:0;
          
        }        
        var method = $("input[type='submit']").val();
        if(method=='Create'){  
          service.savePayee(model).then(function (result) {
              $scope.message(result.data);
              $("input[type='reset']").trigger('click');
              bsTable.bootstrapTable('refresh');
              
          });
        }else{
          var model = {};
          model['is_active'] = ($("#is_active").is(":checked")) ? 1:0;
          model['payee_name'] = $("#payee_name").val();
          model['payee_id'] = $("#payee_id").val();         
          model['notes'] = $("#notes").val();         
          service.updatePayee(model).then(function (result) {
            $scope.message(result.data);
            if(result.data.status){
              $("input[type='reset']").trigger('click');
              $("input[type='submit']").val('Create'); 
              bsTable.bootstrapTable('refresh');
            }              
          });
        }  
       
       
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
