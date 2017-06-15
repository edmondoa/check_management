<div>
	<div class="box">
	    <div class='header'>Result</div>
	    <div class="box-body">
	    <ul ng-repeat='warehouse in wc.warehouses'>
	    	<li ng-class="warehouse.class"><span ng-bind="warehouse.check_no"></span> - <span ng-bind="warehouse.response" ></span></li>
	    </ul>
	    </div>
	</div>
</div>	    