<div>
	<div class="box">
	    <div class='header'><h4>Result</h4></div>
	    <div class="box-body">
	    <ul ng-repeat='result in cc.results'>
	    	<li ng-class="result.class"><span ng-bind="result.check_no"></span> - <span ng-bind="result.response" ></span></li>
	    </ul>
	    <table class="table table-bordered">
	    	<thead>
	    		<th>Check No</th>
	    		<th>Check Date</th>
	    		<th>Payee</th>
	    		<th>Check Amount</th>
	    		<th>Amount</th>
	    		<th>Variance</th>
	    	</thead>
	    	<tbody>
	    		<tr ng-repeat="set in settles">
	    			<td ng-bind="set.check_no"></td>
	    			<td ng-bind="set.check_date"></td>
	    			<td ng-bind="set.payee"></td>
	    			<td ng-bind="set.check_amount"></td>
	    			<td ng-bind="set.amount"></td>
	    			<td ng-bind="set.variance"></td>
	    		</tr>
	    	</tbody>
	    </table>
	    </div>
	</div>
</div>	    