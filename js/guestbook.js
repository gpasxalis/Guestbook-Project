function my_function(which){
        if (!document.getElementById)
        return
        if (which.style.display=="block")
        which.style.display="none"
        else
        which.style.display="block"
        }

function myFunction(){
	var x = document.getElementById("replies-to-hide");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
} 

        
function checktext(){

	var x=document.forms["form1"]["comment"].value;
	
	if (x==null || x=="" )
		{
		  alert("You can't post a comment without content");
		 
		  return false;
		}
}