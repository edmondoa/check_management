<div class='col-md-12'>
    <div class="box">
      	<div class="box-body">
			<form ng-submit="ac.saveAccount(account)">
				<div class="col-sm-3">
					<div class="form-group">
				      <label for="bank_code">Bank Code</label>
				      <input type="text" class="form-control" id="bank_code" tabindex="1" ng-model='account.bank_code'>
				    </div>
			    </div>
			    <div class="col-sm-3">
					<div class="form-group">
				      <label for="account_no">Account No</label>
				      <input type="number" class="form-control" id="account_no" tabindex="2" ng-model='account.account_no' min='0'>
				      <input type="hidden" class="form-control" id="account_id" ng-model='account.account_id'>
				    </div>
			    </div>
			    <div class="col-sm-1">
					<div class="form-group">
				      <label for="is_active">Active</label>
				      <input type="checkbox" class="flat-red" id='is_active'  name='is_active' checked ng-model='account.is_active'>
				    </div>
			    </div>
			    <div class="col-sm-3">
					<div class="form-group">
				      <label for="bank_code">Notes</label>
				      <textarea class="form-control" id="notes" name='notes'rows="3" cols="50"  tabindex="4" ng-model='account.notes'>				      	
				      </textarea>
				      
				    </div>
			    </div>
			    <div class="col-sm-1">
			    	<div class="form-group">
				      	<label for="bank_code"></label>
				     	<input type="submit" class='btn btn-success' value="Create" tabindex="6"/>
				    </div>					
			    </div>
			    <div class="col-sm-1">
			    	<div class="form-group">
				      	<label for="bank_code"></label>
				     	<input type="reset" class='btn btn-default' value="Clear" tabindex="7"/>
				    </div>					
			    </div>
			</form>
		</div>
	</div>
</div>			