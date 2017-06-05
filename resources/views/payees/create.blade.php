<div class='col-md-12'>
    <div class="box">
      	<div class="box-body">
			<form ng-submit="pc.savePayee(payee)">
				<div class="col-sm-4">
					<div class="form-group">
				      <label for="bank_code">Name</label>
				      <input type="text" class="form-control" id="payee_name" tabindex="1" ng-model='payee.payee_name'>
				    </div>
			    </div>			
			    <div class="col-sm-1">
					<div class="form-group">
				      <label for="is_active">Active</label>
				      <input type="checkbox" class="flat-red" id='is_active' tabindex="2" name='is_active' checked ng-model='payee.is_active'>
				    </div>
			    </div>
			    <div class="col-sm-4">
					<div class="form-group">
				      <label for="bank_code">Notes</label>
				      <textarea class="form-control" name='notes'rows="3" cols="50"  tabindex="4" ng-model='payee.notes'>				      	
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