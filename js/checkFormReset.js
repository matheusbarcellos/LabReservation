function checkFormReset(form)
  {
   
    if(form.email.value == "") {
      alert("Error: Email cannot be blank!");
      form.email.focus();
      return false;
    }

    if(form.pass1.value != "" && form.pass1.value == form.pass.value) {
      if(form.pass1.value.length < 6) {
        alert("Error: Password must contain at least six characters!");
        form.pass1.focus();
        return false;
      }
      if(form.pass1.value == form.email.value) {
        alert("Error: Password must be different from Email!");
        form.pass1.focus();
        return false;
      }
      re = /[0-9]/;
      if(!re.test(form.pass1.value)) {
        alert("Error: password must contain at least one number (0-9)!");
        form.pass1.focus();
        return false;
      }
      re = /[a-z]/;
      if(!re.test(form.pass1.value)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        form.pass1.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(form.pass1.value)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        form.pass1.focus();
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      form.pass1.focus();
      return false;
    }
	
    return true;
  }