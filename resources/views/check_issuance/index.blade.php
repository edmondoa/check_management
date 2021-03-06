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
    <section class="content" ng-controller='issuanceCtrl as ic'>
      	<!-- Account Create -->
      	@include('check_issuance.create')
    	<!-- Account List -->	    
    </section>
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/issuance.js"></script>
<script src="/angular/service/HttpRequestFactory.js"></script>
<script src="/angular/service/issuanceService.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">

  $(document).ready(function(){    
    $("li.check-issuances").addClass("active");
    $(".date_picker").datepicker({'autoClose':true});

  })

  $(document).on("change","select.check_no",function(){
    $("a.checkWarehouse").trigger('click');
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
