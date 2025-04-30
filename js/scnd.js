
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  function isMatchingPassword(p1,p2){
    return p1==p2;
  }

  function isCorrectPassword(p){
    return p.length>4;
  }

  document.getElementById("signup-btn").addEventListener("click",function () {
    const email = document.getElementById("email");
    const pwd = document.getElementById("password");
    const pwd2 = document.getElementById("confirm-password");
    const v_pwd = pwd.value;
    const v_pwd2 = pwd2.value;
    const v_em = email.value;
    if(!isCorrectPassword(v_pwd)){
        event.preventDefault();
        pwd.value="";
        pwd2.value="";
        pwd.placeholder="Password must be 4 characters long +";
        pwd.focus();
        console.log("Password wrong");
        console.log(pwd.length);
        return;
    }
    if(!isMatchingPassword(v_pwd,v_pwd2)){
        event.preventDefault();
        pwd.value="";
        pwd2.value="";
        pwd.placeholder="Passwords don't match";
        pwd.focus();
        console.log("Password don't match")
        return;
    }
    if(!isValidEmail(v_em)){
        event.preventDefault();
        email.value="";
        email.placeholder="Invalid email";
        pwd.focus();
        return;
    }

    
  });