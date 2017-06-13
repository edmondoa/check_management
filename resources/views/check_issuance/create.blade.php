<div class='col-md-6 col-md-offset-3'>
    <div class="box">
      	<div class="box-body">
			<form ng-submit="ic.saveIssuance(issuance)">
				
				<div class="form-group">
			        <label for="account_no">Account No</label>
			        <select class="form-control select2 account_id" ng-model='issuance.account_id'  name='account_id'tabindex="1" ng-change="ic.showAvailableCheck(issuance)">
				      	<option >Select</option>
				      	@foreach($accounts as $account)
				      		<option value='{{$account->account_id}}'>{{$account->account_no}}</option>
				      	@endforeach

				    </select>
			    </div>
			    			    
				<div class="form-group">
			        <label for="account_no">Check No</label>
			        <select class="form-control select2 check_no" ng-model='issuance.check_no'  name='check_no'tabindex="2">
				      	<option >Select</option> 
				    </select>
			    </div>	
			    <div class="form-group">
			        <label for="account_no">Payee</label>
			        <select class="form-control select2 payee_id" ng-model='issuance.payee_id'  name='payee_id'tabindex="3" >
				      	<option >Select</option>
				      	@foreach($payees as $payee)
				      		<option value='{{$payee->payee_id}}'>{{$payee->payee_name}}</option>
				      	@endforeach

				    </select>
			    </div>
			    <div class="form-group">
			        <label for="account_no">Amount</label>
			        <input type="text" name='check_amount' class="form-control" ng-model='issuance.check_amount',tabindex="4"/>
			    </div>	
			    <div class="form-group">
			        <label for="account_no">Check Date</label>
			        <input type="text" name='check_date' class="form-control date_picker" ng-model='issuance.check_date',tabindex="5"/>
			    </div>			    
			    
				<div class="form-group">
			      <label for="bank_code">Notes</label>
			      <textarea class="form-control" name='notes'rows="3" cols="50"  tabindex="6" ng-model='issuance.notes'>				      	
			      </textarea>
			      
			    </div>			    
			    <div class='text-center'>
			    	<div class="form-group">
				      	<label for="bank_code"></label>
				     	<input type="submit" class='btn btn-success' value="Create" tabindex="7"/>
				    
				      	<label for="bank_code"></label>
				     	<input type="reset" class='btn btn-default' value="Clear" tabindex="8"/>
				    </div>
			    </div>					
			    
			</form>
		</div>
	</div>
</div>			