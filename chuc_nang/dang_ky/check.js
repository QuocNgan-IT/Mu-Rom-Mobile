function checkUsername(username) {
    if (username.indexOf(" ") !== -1) {
        return false;
    }
    if (username.charAt(0) >= "0" && username.charAt(0) <= "9") {
        return false;
    }
    if (username.search(/[a-z]/i) === -1) {     //A-Za-z
        return false;
    }
    return true;
}

function checkPassword(password, username) {
    if (password.indexOf(" ") !== -1) {
        return false;
    }
    if (password.length >= 8 && password.length <= 16) {
        if (password.search(/[a-z]/) !== -1 && password.search(/[A-Z]/) !== -1) {
            if (password.search(/[0-9]/) !== -1) {
                const count = password.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g).length;
                if (count >= 1) {
                    if (password.search(username) === -1) {
                        return true;
                    }
                }
            }
        }
    }
    return false;
}

function CheckEmail(email) {
    if (email.indexOf(" ") !== -1) {
        return false;
    }
    if (/.+@gmail\.com/.test(email)) {
        return true;
    }
    return false;
}

function CheckPhonenumber(phonenumber) {
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

const element = document.getElementById("btn_register");
element.onclick = (e) => {
    e.preventDefault();
    var result = true;
    
    const username = document.Form.username.value;
    result = result && checkUsername(username);
    
    const password = document.Form.password.value;
    result = result && checkPassword(password, username);
    
    const repassword = document.Form.repassword.value;
    result = result && (password === repassword);
  
    // const FirstName = document.Form.FirstName.value;
    // result = result && CheckFirstName(FirstName);

    // const LastName = document.Form.LastName.value;
    // result = result && CheckFirstName(LastName);

    const email = document.Form.email.value;
    result = result && CheckEmail(email);
    
    const phonenumber = document.Form.phonenumber.value;
    result = result && CheckPhonenumber(phonenumber);

    if(result) {
        //alert("Hợp lệ");
        document.getElementById('return').style.color = "green";
        document.getElementById('return').textContent = "Thông tin đã nhập là hợp lệ!";
    } else {
        //alert("Không hợp lệ");
        document.getElementById('return').style.color = "red";
        document.getElementById('return').textContent = "Thông tin đã nhập không hợp lệ!";
    }
    // document.getElementById('return').style.color = "red";
    // document.getElementById('return').textContent = "Thông tin đã nhập không hợp lệ!";
}