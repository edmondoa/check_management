@extends('layouts.master')

@section('content')
	<link rel="stylesheet" href="/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">      
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-circle"></i> Check Issuance</li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller='checkBookCtrl as cb'>
      	<!-- Account Create -->
      	@include('checkbooks.create')
    	<!-- Account List -->
	    <div class='col-md-12'>
	        <div class="box">
	          <div class="box-body">
	            <div class='row'>
	              <div class='col-md-5 pull-right'>
	                <div class='col-md-8'>
	                  <input type='text'class='form-control' ng-model="filterBy.searchStr" placeholder="Filter" ng-keyup="bc.filterRecord(filterBy)"/>
	                </div>
	                
	              </div>
	            </div>
	            <br>
	            <table id="checkbooks" class="bsTable table table-striped"
	             data-url="/checkbooks/ng-checkbook-list"
	             data-pagination="true"
	             data-side-pagination="server"
	             data-page-list="[10,20,50]"
	             data-sort-order="desc"
	             data-show-clear="true"
	             js-bootstraptable>
	            <thead>
	                <tr>
	                    <th class="col-md-4" data-field="account_no" >Account #</th>
	                    <th class="col-md-3"data-field="check_number_start_no" >Check Number Start</th>
	                    <th class="col-md-3"data-field="check_number_end_no" >Check Number End</th>                    
	                    <th style='width:50px' data-field="action" class="action">Action</th>
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
<script src="/angular/controllers/checkbook.js"></script>
<script src="/angular/service/HttpRequestFactory.js"></script>
<script src="/angular/service/checkbookService.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">

  $(document).ready(function(){    
    $("li.checkbook").addClass("active");
  })
  $(function () {   
   
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
</script>


@stop
