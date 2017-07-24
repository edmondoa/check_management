<div >
    <div class="box">
      	<div class="box-body">
			<form ng-submit="wc.saveWarehouse(warehouse)">
				
				<div class="form-group">
			        <label for="account_no">Account No</label>
			        <select class="form-control select2 account_id" ng-model='warehouse.account_id'  name='account_id'tabindex="1" ng-change="ic.showAvailableCheck(issuance)">
				      	<option >Select</option>
				      	@foreach($accounts as $account)
				      		<option value='{{$account->account_id}}'>{{$account->account_no}}</option>
				      	@endforeach

				    </select>
			    </div>	

			    <div class="form-group">
			    	<label for="warehouse_date">Warehouse Date</label>
			    	<input type="text" name='warehouse_date' class="form-control date_picker" ng-model='models.warehouse_date'tabindex="2"/>
			    </div>    			    
				
			    <div class="form-group">
			        <label for="account_no">Payee</label>
			        <select class="form-control select2 payee_id" ng-model='warehouse.payee_id'  name='payee_id'tabindex="3" >
				      	<option >Select</option>
				      	@foreach($payees as $payee)
				      		<option value='{{$payee->payee_id}}'>{{$payee->payee_name}}</option>
				      	@endforeach

				    </select>
			    </div>
			    <div class="form-group">
			        <label for="account_no">Start Check Number</label>
			        <input type="text" name='start_check_no' class="form-control" ng-model='warehouse.start_check_no',tabindex="4"/>
			    </div>	
			    <div class="form-group">
			        <label for="account_no">End Check Number</label>
			        <input type="text" name='end_check_no' class="form-control" ng-model='warehouse.end_check_no',tabindex="5"/>
			    </div>	
			    			    
			    <div class='text-center'>
			    	<div class="form-group">
				      	<label for="bank_code"></label>
				     	<input type="submit" class='btn btn-success' value="Proceed" tabindex="6"/>
				    
				      	<label for="bank_code"></label>
				     	<input type="reset" class='btn btn-default' value="Clear" tabindex="7"/>
				    </div>
			    </div>					
			    
			</form>
		</div>
	</div>
</div>			