<div class='col-md-12'>
    <div class="box">
      	<div class="box-body">
			<form ng-submit="cb.saveCheckBook(checkbook)">
				<div class="col-sm-3">
					<div class="form-group">
				      <label for="bank_code">Account</label>
				      <select class="form-control select2 account_id" ng-model='checkbook.account_id'  name='account_id'tabindex="1">
				      	<option >Select</option>
				      	@foreach($accounts as $account)
				      		<option value='{{$account->account_id}}'>{{$account->account_no}}</option>
				      	@endforeach

				      </select>
				    </div>
			    </div>
			    <div class="col-sm-3">
					<div class="form-group">
				      <label for="account_no">Start No</label>
				      <input type="text" class="form-control" id="check_no_start_no" tabindex="2" ng-model='checkbook.check_number_start_no'>
				    </div>
			    </div>			    
			    <div class="col-sm-3">
					<div class="form-group">
				      <label for="account_no">End No</label>
				      <input type="text" class="form-control" id="check_no_end_no" tabindex="3" ng-model='checkbook.check_number_end_no'>
				    </div>
			    </div>
			    <div class="col-sm-1">
			    	<div class="form-group">
				      	<label for="bank_code"></label>
				     	<input type="submit" class='btn btn-success' value="Create" tabindex="4"/>
				    </div>					
			    </div>
			    <div class="col-sm-1">
			    	<div class="form-group">
				      	<label for="bank_code"></label>
				     	<input type="reset" class='btn btn-default' value="Clear" tabindex="5"/>
				    </div>					
			    </div>
			</form>
		</div>
	</div>
</div>			