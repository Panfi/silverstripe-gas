<form $FormAttributes>
<div class="row">
	<div class="large-8 columns">
		<div class="formleft">
			<h4>Contact Information</h4>
			<div id="response"></div>
			<div class="row">
			    <div class="large-6 columns">
			    	<label class="grey" for="fname">First Name:<span class="required_filed">*</span></label>
			    	 $Fields.FieldByName(FirstName)
			    </div>
			    <div class="large-6 columns">
					<label class="grey" for="lname">Last Name:<span class="required_filed">*</span></label>
					$Fields.FieldByName(LastName)
			    </div>
			</div>
			<div class="row">
			    <div class="large-6 columns">
			    	<label class="grey" for="year">E-mail:</label>
			    	$Fields.FieldByName(Email)
			    </div>
			    <div class="large-6 columns">
			      <label class="grey" for="contact_email">Phone:<span class="required_filed">*</span></label>
			      $Fields.FieldByName(Phone)
			    </div>
			</div>
			
			<div class="row">
			    <div class="large-6 columns">
			    	<label class="grey" for="year">City:</label>
			    	$Fields.FieldByName(City)
			    </div>
			    <div class="large-2 columns">
			      <label class="grey" for="make">State:</label>
			      $Fields.FieldByName(State)
			    </div>
			    <div class="large-4 columns">
			    	<label class="grey" for="make">ZIP:</label>
			    	$Fields.FieldByName(ZIP)
			    </div>
			</div>
			
			<h5>Vehicle You Own (Year/Make/Model)</h5>
			<div class="row">
			    <div class="large-2 columns">
			    	<label class="grey" for="year">Year:</label>
			    	$Fields.FieldByName(CarYear)
			    </div>
			    <div class="large-5 columns">
			      <label class="grey" for="make">Make:</label>
			      $Fields.FieldByName(CarMake)
			    </div>
			    <div class="large-5 columns">
			    	<label class="grey" for="make">Model:</label>
			    	$Fields.FieldByName(CarModel)
			    </div>
			</div>
		</div>
	</div>
	<div class="large-4 columns">
		<div class="formright">
			<h4>Your needs</h4>
			<label class="grey" for="make">Interested in</label>
			$Fields.FieldByName(ContactAction)
			
			<label class="grey" for="make">Please describe your needs in detail:</label>		
			$Fields.FieldByName(Message)
			<div>
				$Fields.FieldByName(Subscribe)
				Add me to the Mailing List
				$Fields.FieldByName(CurrentURL)
			</div>
			
			$Fields.dataFieldByName(SecurityID)
			
			<% if $Actions %>
			    <div class="Actions">
			        <% loop $Actions %>$Field<% end_loop %>
			    </div>
			<% end_if %>
		</div>	
	</div>
</div>
</form>