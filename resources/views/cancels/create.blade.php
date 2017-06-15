<div >
    <div class="box">
      	<div class="box-body">
			<form ng-submit="cc.setCancel(models)">
				
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
			        <label for="account_no">Start Check Number</label>
			        <input type="text" name='start_check_no' class="form-control" ng-model='models.start_check_no',tabindex="4"/>
			    </div>	
			    <div class="form-group">
			        <label for="account_no">End Check Number</label>
			        <input type="text" name='end_check_no' class="form-control" ng-model='models.end_check_no',tabindex="5"/>
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