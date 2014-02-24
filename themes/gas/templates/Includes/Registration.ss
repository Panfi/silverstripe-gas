<form  id="FacebookLoginForm_FacebookLoginForm" action="Security/FacebookLoginForm" method="post" enctype="application/x-www-form-urlencoded">

	
	<p id="FacebookLoginForm_FacebookLoginForm_error" class="message " style="display: none"></p>
	
	
	<fieldset>
		 
		
			<fb:login-button scope='email'></fb:login-button>
		
			<input class="hidden" type="hidden" id="FacebookLoginForm_FacebookLoginForm_BackURL" name="BackURL" value="/mundotrevi/new/admin" />
		
		<div class="clear"><!-- --></div>
	</fieldset>

	
	<div class="Actions">
		
			<!-- <a href='https://www.facebook.com/dialog/oauth?client_id=158325834340990&redirect_uri=http%3A%2F%2Flocalhost%2Fmundotrevi%2Fnew%2FSecurity%2Flogin%3FBackURL%3D%252Fmundotrevi%252Fnew%252Fadmin&state=04b333292d0e7c818f9d407078b49b00&next=http%3A%2F%2Flocalhost%2Fmundotrevi%2Fnew%2FSecurity%2F%3Fupdatecache%3D1%26flush%3D1'>Login</a> -->
		
	</div>
	

</form>


<form  id="TwitterLoginForm_LoginForm" action="Security/LoginForm" method="post" enctype="application/x-www-form-urlencoded">

	
	<p id="TwitterLoginForm_LoginForm_error" class="message " style="display: none"></p>
	
	
	<fieldset>
		 
		
			<input class="hidden" type="hidden" id="TwitterLoginForm_LoginForm_AuthenticationMethod" name="AuthenticationMethod" value="TwitterAuthenticator" />
	
</p>
		
			<input class="hidden" type="hidden" id="TwitterLoginForm_LoginForm_BackURL" name="BackURL" value="/mundotrevi/new/admin" />
		
		<div class="clear"><!-- --></div>
	</fieldset>

	
	<div class="Actions">
		
			<input class="action" id="TwitterLoginForm_LoginForm_action_dologin" type="image" name="action_dologin" src="twitter/Images/signin.png" title="Sign in with Twitter" alt="Sign in with Twitter" />
		
	</div>
	

</form>