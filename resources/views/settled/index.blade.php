@extends('layouts.master')

@section('content')
	<link rel="stylesheet" href="/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">      
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-circle"></i> Settle Check</li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller='cancelCtrl as cc'>
      	<!-- Account Create -->
      	<div class="col-md-4">
        @include('settled.create')
        </div>
        <div class="col-md-8">
        @include('settled.result')
        </div>
       
        
    	<!-- Account List -->	    
    </section>
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/cancel.js"></script>
<script src="/angular/service/HttpRequestFactory.js"></script>
<script src="/angular/service/cancelService.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">

  $(document).ready(function(){    
    $("li.check-settle").addClass("active");
    $(".date_picker").datepicker({format: 'dd/mm/yyyy',
    todayHighlight:'TRUE',
    autoclose: true,});
  })
  $(function () {   
   	$(".select2").select2();
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
</script>


@stop
