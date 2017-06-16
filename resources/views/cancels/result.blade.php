<div>
	<div class="box">
	    <div class='header'><h4>Result</h4></div>
	    <div class="box-body">
	    <ul ng-repeat='result in cc.results'>
	    	<li ng-class="result.class"><span ng-bind="result.check_no"></span> - <span ng-bind="result.response" ></span></li>
	    </ul>
	    </div>
	</div>
</div>	    