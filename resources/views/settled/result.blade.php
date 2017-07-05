<div ng-load="sc.getSettle()">
	<div class="box">
	    <div class='header'><h4>Result
	    <a href="#" class='pull-right btn btn-sm btn-primary' ng-show="sc.results.length > 0" ng-click="sc.setCommit()">Commit</a>

	    </h4></div>
	    <div class="box-body">	    
	    <table class="table table-bordered">
	    	<thead>
	    		<th>Check No</th>
	    		<th>Check Date</th>
	    		<th>Payee</th>
	    		<th>Check Amount</th>
	    		<th>Amount</th>
	    		<th>Variance</th>
	    		<th></th>
	    	</thead>
	    	<tbody>
	    		<tr ng-repeat="set in sc.results" ng-class="set.status">
	    			<td ng-bind="set.check_no"></td>
	    			<td ng-bind="set.check_date"></td>
	    			<td ng-bind="set.payee"></td>
	    			<td ng-bind="set.check_amount"></td>
	    			<td ng-bind="set.amount"></td>
	    			<td ng-bind="set.variance"></td>
	    			<td ><i ng-class="(set.status=='success') ? fa-check : fa-times" ></i></td>
	    		</tr>
	    	</tbody>
	    </table>
	    </div>
	</div>
</div>	    