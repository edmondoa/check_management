@extends('layouts.master')

@section('content')
	<link rel="stylesheet" href="/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">      
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-circle"></i> Logs</li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller='logsCtrl as lc'>      	
	    <div class='col-md-12'>
	        <div class="box">
	          <div class="box-body">
	            <div class="col-md-3"style="padding-left: 0px !important;padding-bottom: 20px">
                <select class="form-control" name='type' ng-model="filterBy.type">
                  <option value="checks">Checks</option>
                  <option value="check_warehouses">WareHouse</option>
                  <option value="check_issuances">Check Issued</option>
                  <option value="check_clears">Check Settled</option>                  
                </select>
              </div>
              <div class="col-md-2">
                <input type="text" name="from" ng-model="filterBy.from" value="{{date('Y-m-d')}}"class='form-control date_picker' placeholder="From"/>
              </div>
              <div class="col-md-2">
                <input type="text" name="to" ng-model="filterBy.to" value="{{date('Y-m-d')}}"class='form-control date_picker' placeholder="To"/>
              </div>
              <div class='col-md-1'>
                <a href="#" class='btn  btn-primary search-logs' ng-click="lc.filterRecord(filterBy)">Search</a>
              </div>
              
	            <table id="payees" class="bsTable table table-striped"
	             data-url="/logs/ng-list"
	             data-pagination="true"
	             data-side-pagination="server"
	             data-page-list="[10,20,50]"
	             data-sort-order="desc"
	             data-show-clear="true"
	             js-bootstraptable>
	            <thead>
	                <tr>
                      <th class="col-md-2" data-field="type" >Type</th>
	                    <th class="col-md-2" data-field="account_code" >Account Code</th>
	                    <th class="col-md-3"data-field="check_no" >Check Number</th>  
	                    <th class="col-md-5"data-field="payee" >Payee</th>                    
	                    
	                </tr>
	            </thead>
	            </table>
	          </div>
	            <!-- /.box-body -->

	        </div>
	    </div>
    </section>
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/logs.js"></script>
<script type="text/javascript">
  $(document).ready(function(){    
     $(document).ready(function(){    
    $("li.logs").addClass("active");
    $(".date_picker").datepicker({format: 'yyyy-mm-dd',
      todayHighlight:'TRUE',
      autoclose: true,});
    })
  })
  
  
</script>


@stop
