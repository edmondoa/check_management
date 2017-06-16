<div >
    <div class="box">
      	<div class="box-body">
			<form ng-submit="cc.setSettle(models)">
				
				<div class="form-group">
			        <label for="account_no">Account No</label>
			        <select class="form-control select2 account_id" ng-model='models.account_id'  name='account_id'tabindex="1">
				      	<option >Select</option>
				      	@foreach($accounts as $account)
				      		<option value='{{$account->account_id}}'>{{$account->account_no}}</option>
				      	@endforeach

				    </select>
			    </div>		    
				
			    <div class="form-group">
			        <label for="account_no">Check Date</label>
			        <input type="text" name='clear_date' class="form-control date_picker" ng-model='models.clear_date'tabindex="2"/>
			    </div>	
			    <div class="form-group">
			        <label for="account_no">Check No</label>
			        <input type="text" name='check_no' class="form-control" ng-model='models.check_no'tabindex="3" ng-change="findCheck(models)"/>
			    </div>
			    <div class="form-group">
			        <label for="account_no">Payee</label>
			        <input type="text" readonly name='payee' class="form-control" />
			        <input type="hidden" name='payee_id' class="form-control" ng-model='models.payee_id'/>
			    </div>	
			     <div class="form-group">
			        <label for="account_no">Check Amount</label>
			        <input type="text" name='check_amount' class="form-control" readonly ng-model='models.check_amount'/>
			    </div>
			     <div class="form-group">
			        <label for="account_no">Amount</label>
			        <input type="text" name='clear_amount' class="form-control"  ng-model='models.clear_amount'tabindex="4"/>
			    </div>
			    			    
			    <div class='text-center'>
			    	<div class="form-group">
				      	<label for="bank_code"></label>
				     	<input type="submit" class='btn btn-success' value="Proceed" tabindex="5"/>
				    
				      	<label for="bank_code"></label>
				     	<input type="reset" class='btn btn-default' value="Clear" tabindex="6"/>
				    </div>
			    </div>					
			    
			</form>
		</div>
	</div>
</div>			