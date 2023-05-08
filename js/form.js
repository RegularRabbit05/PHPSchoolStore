function login() {
    const email = document.getElementById("email_input").value;
    const password = document.getElementById("password_input").value;

    if (email == "" || password == "") {
        localStorage.clear();
        return false;
    }
    
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./api/ping", true);
    xhttp.send(JSON.stringify({
        email:email,
        password:password
    }));

    xhttp.onreadystatechange = () => {
    if (xhttp.readyState === 4) {
        const tx = xhttp.responseText;
        if (tx != "OK") {
            alert("Combinazione non valida, riprovare!");
            return false;
        }
        check_admin(email, password);
        return false;
    }
  }
  return false;
}

function logout() {
    localStorage.clear();
    var cookies = document.cookie.split(";");
    for (var i = 0; i < cookies.length; i++) eraseCookie(cookies[i].split("=")[0]);
}

function eraseCookie(name) { document.cookie = name +'=; Expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/; SameSite=Strict;' }

function check_admin(email, password) {    
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./api/admin", true);
    xhttp.send(JSON.stringify({
        email:email,
    }));

    xhttp.onreadystatechange = () => {
    if (xhttp.readyState === 4) {
        const tx = xhttp.responseText;
        setAdmin(tx == "OK");
        open(email, password);
    }
  }
  return;
}

function setAdmin(v) {
    eraseCookie("admin");
    
    if (v) {
        const session = document.getElementById("remember_input").checked;

        var CookieDate = new Date;
        CookieDate.setFullYear(CookieDate.getFullYear() +10);

        var exp = "session";
        if (session) {
            exp = CookieDate.toUTCString();
        }

        document.cookie = "admin="+v+'; expires=' + exp + '; SameSite=Strict; path=/;';
    }
}

function open(usr, pwd) {
    var CookieDate = new Date;
    CookieDate.setFullYear(CookieDate.getFullYear() +10);

    const session = document.getElementById("remember_input").checked;

    var exp = "session";
    if (session) {
        exp = CookieDate.toUTCString();
    }

    document.cookie = "user="+usr+'; expires=' + exp + '; SameSite=Strict; path=/;';
    document.cookie = "password="+pwd+'; expires=' + exp + '; SameSite=Strict; path=/;';
    window.location.href = window.location.origin + "/w/store";
}

function getCookie(name) {
    var cookieArr = document.cookie.split(";");
    for(var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split("=");
        if(name == cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    } 
    return null;
}

function loadPage() {
    const usr = getCookie("user");
    const pwd = getCookie("password");
    if (usr == null || usr == "" || pwd == null || pwd == "") {
        return;  
    }

    document.getElementById("email_input").value = usr;
    document.getElementById("password_input").value = pwd;
}

function signup() {
    const email = document.getElementById("email_input").value;
    const password = document.getElementById("password_input").value;

    if (email == "" || password == "") return false;
    
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./api/register", true);
    xhttp.send(JSON.stringify({
        email:email,
        password:password
    }));

    xhttp.onreadystatechange = () => {
    if (xhttp.readyState === 4) {
        const tx = xhttp.responseText;
        if (tx != "OK") {
            alert("Account non valido, prova un altro user!");
            return false;
        }
        logout();
        open(email, password);
    }
  }
  return false;
}
