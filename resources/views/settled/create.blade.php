<div >
    <div class="box">
      	<div class="box-body">
			<form ng-submit="sc.setSettle(models)">
				
				<div class="form-group">
			        <label for="account_no">Account No</label>
			        <select class="form-control select2 account_id" ng-model='models.account_id'  name='account_id'tabindex="1" ng-change="sc.clear()">
				      	<option >Select</option>
				      	@foreach($accounts as $account)
				      		<option value='{{$account->account_id}}'>{{$account->account_no}}</option>
				      	@endforeach

				    </select>
			    </div>		    
				
			    <div class="form-group">
			        <label for="account_no">Check Date</label>
			        <input type="text" name='clear_date' class="form-control date_picker" ng-model='models.check_date'tabindex="2"/>
			    </div>	
			    <div class="form-group">
			        <label for="account_no">Check No</label>
			        <div class="input-group">
	                  <input type="text" class="form-control " id="check_no" ng-model='models.check_no' name='check_no' tabindex="3" style='padding:6px 2px !important' on-enter="sc.findCheck(models)">
	                  <a href="#" class='btn btn-sm btn-default input-group-addon  search-prod' ng-click="sc.findCheck(models)"><i class='fa fa-magnify'></i> Search!</a>
	                </div>
			    </div>
			    <div class="form-group">
			        <label for="account_no">Payee</label>
			        <input type="text" readonly name='payee' class="form-control" />
			        <input type="hidden"  name='payee_id' class="form-control" />
			        <input type="hidden"  name='check_id' class="form-control" />
			    </div>	
			     <div class="form-group">
			        <label for="account_no">Check Amount</label>
			        <input type="text" name='check_amount' class="form-control" readonly />
			    </div>
			     <div class="form-group">
			        <label for="account_no">Amount</label>
			        <input type="text" name='amount' class="form-control"  ng-model='models.amount'tabindex="4"/>
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