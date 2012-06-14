
/* These are currently not being used
function validatePassword(password)
{
}

function validateUsername(username)
{
}
*/

function isMatch(input1, input2)
{
	return input1 == input2;
}

//http://stackoverflow.com/questions/46155/validate-email-address-in-javascript
function isValidEmail(email) //returns true or false
{
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}