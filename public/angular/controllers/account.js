(function(app) {

  'use strict';

  app.controller('accountCtrl', ['accountService','$scope', function (service,$scope) {

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
        var url = '/accounts/ng-account-list?searchStr='+searchStr;
        bsTable.bootstrapTable('refresh', {url: url});
      }

      this.saveAccount= function(model){ 
        if(typeof model === 'undefined')
        {
          var model = {};
          model['is_active'] = 0;
        }else{
          model['is_active'] = ($("#is_active").is(":checked")) ? 1:0;
          
        }
        var method = $("input[type='submit']").val();
        if(method=='Create'){
          service.saveAccount(model).then(function (result) {
            $scope.message(result.data);
            if(result.data.status){
              $("input[type='reset']").trigger('click');
              bsTable.bootstrapTable('refresh');
            }              
          });
        }else{
          var model = {};
          model['is_active'] = ($("#is_active").is(":checked")) ? 1:0;
          model['bank_code'] = $("#bank_code").val();
          model['account_no'] = $("#account_no").val();
          model['account_id'] = $("#account_id").val();
          model['notes'] = $("#notes").val();         
          service.updateAccount(model).then(function (result) {
            $scope.message(result.data);
            if(result.data.status){
              $("input[type='reset']").trigger('click');
              $("input[type='submit']").val('Create'); 
              bsTable.bootstrapTable('refresh');
            }              
          });
        }    
        
        
      }

      $scope.getAccount = function(id)
      {
        alert(id);
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
