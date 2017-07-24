@extends('layouts.master')

@section('content')
	<link rel="stylesheet" href="/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">      
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-circle"></i> Payees</li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller='payeeCtrl as pc'>
      	<!-- Account Create -->
      	@include('payees.create')
    	<!-- Account List -->
	    <div class='col-md-12'>
	        <div class="box">
	          <div class="box-body">
	            
	            <table id="payees" class="bsTable table table-striped"
	             data-url="/payees/ng-payee-list"
	             data-pagination="true"
	             data-side-pagination="server"
	             data-page-list="[10,20,50]"
	             data-sort-order="desc"
	             data-show-clear="true"
	             js-bootstraptable>
	            <thead>
	                <tr>
	                    <th class="col-md-4" data-field="payee_name" >Payee Name</th>
	                    <th class="col-md-2"data-field="status" >Status</th>  
	                    <th class="col-md-5"data-field="notes" >Notes</th>                    
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
<script src="/angular/controllers/payee.js"></script>
<script src="/angular/service/HttpRequestFactory.js"></script>
<script src="/angular/service/payeeService.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">

  $(document).ready(function(){    
    $("li.payees").addClass("active");
  })
  $(function () {   
   	
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
  $(document).on('click','.payee-edit',function(e){
  	e.preventDefault();
  	var id = $(this).data('id');
  	startLoad();
  	$.get('payees/'+id,function(data){
  		stopLoad();
  		$("#payee_name").val(data.payee_name);
  		$("#payee_id").val(data.payee_id);
  		if(data.is_active){
        $(".icheckbox_flat-green").addClass('checked')
        $(".icheckbox_flat").attr("aria-checked","true");
  			$("#is_active").attr('checked','checked');
  		}else{
        $(".icheckbox_flat").attr("aria-checked","false");
        $(".icheckbox_flat-green").removeClass('checked')
  			$("#is_active").removeAttr('checked');
  		}
  		
  		$("#notes").val(data.notes);  		
  		$("input[type='submit']").val('Update');  		
  	})
  })
</script>


@stop
