function validateForm()
{
	
	
var x=document.forms["forma_2"]["username"].value;

if  (!isNaN(x))
  {
  alert("Please Enter Only Characters");
  document.forms["forma_2"]["username"].focus();
  return false;
  
  }  
if  ((x.length < 5) || (x.length > 15))
  {
  alert("Your username must be between 5 and 15 characters");
  document.forms["forma_2"]["username"].focus();
  return false;

  } 



var z=document.forms["forma_2"]["password"].value;

if ( (z.length < 6) || (z.length > 14))
  {
  alert("Your Password must be between 6 and 14 character");
  document.forms["forma_2"]["password"].focus();
  return false;
  }
}