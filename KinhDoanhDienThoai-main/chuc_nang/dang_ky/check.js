function checkUsername (uname) {
    if (uname.indexOf(" ") !== -1) {
        return false;
    }
    if (uname.charAt(0) >= "0" && uname.charAt(0) <= "9") {
        return false;
    }
    if (uname.search(/[a-z]/i) === -1) {
        return false;
    }
    return true;
}

function checkPassword (passwd, uname) {
    if (passwd.indexOf(" ") !== -1) {
        return false;
    }
    if (passwd.length >= 8 && passwd.length <= 16) {
        if (passwd.search(/[a-z]/) !== -1 && passwd.search(/[A-Z]/) !== -1) {
            if (passwd.search(/[0-9]/) !== -1) {
                const count = passwd.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g).length;
                if (count >= 1) {
                    if (passwd.search(uname) === -1) {
                        return true;
                    }
                }
            }
        }
    }
    return false;
}

function CheckEmail (em) {
    if (em.indexOf(" ") !== -1) {
        return false;
    }
    if (/.+@gmail\.com/.test(em)) {
        return true;
    }
    return false;
}

function CheckPhonenumber (phonenumber) {
    if (phonenumber.indexOf(" ") !== -1) {
        return false;
    }
    if (/^\d{10,12}$/.test(phonenumber) && phonenumber.length === 12) {
        return true;
    }
    return false;
}

// function CheckFirstName (FirstName) {
//     if (FirstName.length === 0) {
//         return false;
//     }
//     return true;
// }

// function CheckLastName (LastName) {
//     if (LastName.length === 0) {
//         return false;
//     }
//     return true;
// }

const element = document.getElementById("btn_login");
element.onclick = (e) => {
    e.preventDefault();
    var result = true;
    
    const uname = document.Form.uname.value;
    result = result && checkUsername(uname);
    
    const passwd = document.Form.passwd.value;
    result = result && checkPassword(passwd, UserName);
    
    const repasswd = document.Form.repassword.value;
    result = result && (passwd === repasswd);
  
    // const FirstName = document.Form.FirstName.value;
    // result = result && CheckFirstName(FirstName);

    // const LastName = document.Form.LastName.value;
    // result = result && CheckFirstName(LastName);

    const em = document.Form.em.value;
    result = result && CheckEmail(em);
    
    const phonenumber = document.Form.phonenumber.value;
    result = result && CheckPhonenumber(phonenumber);

    if (result) {
        //alert("Hợp lệ");
        document.getElementById('return').style.color = "green";
        document.getElementById('return').textContent = "Thông tin đã nhập là hợp lệ!";
    } else {
        //alert("Không hợp lệ");
        document.getElementById('return').style.color = "red";
        document.getElementById('return').textContent = "Thông tin đã nhập không hợp lệ!";
    }
}