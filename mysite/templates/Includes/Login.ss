<div id="AccountSection" style="text-align:right; font-size:80%;">
<% if CurrentMember %>
<p>Hello, $CurrentMember.Name!  |  <a href="Security/logout">Log out</a>  |  <a href="account">My account</a></p>
<% else %>
<p><a href="Security/Login">Login</a> | <a href="candidate-registration">Candidate registration</a> | <a href="employer-registration">Employer registration</a></p>
<% end_if %>
</div>