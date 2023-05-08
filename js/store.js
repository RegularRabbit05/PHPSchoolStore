let pwd = "";
let usr = "";
let admin = false;

function loadPageControl() {
    usr = getCookie("user");
    pwd = getCookie("password");
    let tmpAdmin = getCookie("admin");
    if (pwd == null || pwd == "" || usr == null || usr == "") {
        loginPage();
    }
    if (tmpAdmin == null) admin = false; else {
        admin = true;
        showAdminPages();
    }
    updateCartLabelItemCount();
}

async function showAdminPages() {
    const elements = document.getElementsByName("adminOnly");
    for (let i = 0; i < elements.length; i++) {
        elements[i].style.visibility = "visible";
        elements[i].style.display = "block";
    }
}

function createElement(name, description, price, image, id) {
    if (image == "null") {
        image = "https://i.imgur.com/4qSAR5G.png";
    }

    const htmlId = id.replaceAll(" ", "_");
    const data = "                    <div class=\"col\">\n" +
        "                        <div class=\"card h-100\">\n" +
        "                            <img width='300' height='300' src=" + image + " class=\"card-img-top\" alt=\"icon\">\n" +
        "                            <div class=\"card-body\">\n" +
        "                                <h5 class=\"card-title\">" + name +"</h5>\n" +
        "                                <p class=\"card-text\">" + description + "</p>\n" +
        "                            </div>\n" +
        "                            <div class=\"card-footer d-grid gap-2\">\n" +
        "                                <button id='item-"+htmlId+"' type='button' class=\"btn btn-dark\" onclick='shopElement(\"" + id + "\");'>Buy for € " + price + "</button>" +
        "                            </div>\n" +
        "                        </div>\n" +
        "                    </div>";
    document.getElementById("_storeContainer").insertAdjacentHTML( 'beforeend', data);
}

function shopElement(id) {
    const el = document.getElementById("item-"+id.replaceAll(" ", "_"));
    el.innerText = "Added to your cart!";
    el.disabled = true;
    try {
        const cart = localStorage.getItem("cart");
        if (cart == null || cart === "") {
            localStorage.setItem("cart", id+",");
        } else {
            localStorage.setItem("cart", cart+id+",");
        }
    } catch (e) {
        localStorage.setItem("cart", id+",");
    }
    updateCartLabelItemCount();
}

async function loadStoreElements() {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", window.location.origin+"/api/storePage", true);
    xhttp.send(JSON.stringify({
        email:usr,
        password:pwd
    }));

    xhttp.onreadystatechange = () => {
        if (xhttp.readyState === 4) {
            const tx = xhttp.responseText;
            const data = JSON.parse(tx);
            for (let i = 0; i < data["size"]; i++) {
                const el = data[i.toString()];
                createElement(el["Name"], el["Description"], el["Price"], el["Image"], el["Id"]);
            }
        }
    }
}

function loginPage() {
    window.location = window.location.origin;
}

function eraseCookie(name) { document.cookie = name +'=; Expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/; SameSite=Strict;' }

function getCookie(name) {
    const cookieArr = document.cookie.split(";");
    for(let i = 0; i < cookieArr.length; i++) {
        const cookiePair = cookieArr[i].split("=");
        if(name == cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    } 
    return null;
}

function logout() {
    localStorage.clear();
    const cookies = document.cookie.split(";");
    for (let i = 0; i < cookies.length; i++) eraseCookie(cookies[i].split("=")[0]);
    setTimeout(() => {
        loginPage();
    }, 500);
}

function setVariables() {
    document.getElementById("usernameTX").innerText = usr;
}

function updateCartLabelItemCount() {
    const items = localStorage.getItem("cart");
    let size = 0;
    if (items == null || items == "" || items == ",") ; else {
        size = items.split(",").length;
        if (items.split(",")[size-1] == "") size--;
    }
    document.getElementById("cartItemsAmount").innerText = size.toString();
}
