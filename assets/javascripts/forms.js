$(document).ready(function ()
{
	console.log('yey!!!');
	function validateForm() {
    var x = document.forms["sign_up"]["name"].value;
    if (x == null || x.trim() == "")) {
        alert("Email must be filled out correctly");
        return false;
    }
    
    var x = document.forms["sign_up"]["password"].value;
    if (x == null || x.trim() == "") {
        alert("Password must be filled out");
        return false;
    }
    
    var y = document.forms["sign_up"]["confirmation"].value;
    if (x.trim() != y.trim()) {
        alert("Password & it's Confirmation must be the same");
        return false;
    }
	}
});