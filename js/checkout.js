let checkoutIsPageReloaded = false;

const storageMedium = localStorage;

function listenForCheckoutState() {
    const interval = setInterval(function() {
        const state = storageMedium.getItem("checkoutState");
        if (state == "1") {
            if (enableReloader) {
                if (checkoutIsPageReloaded) location.reload(); else {
                    window.location.href = window.location.href + "?o=r";
                }
            }
            return;
        }
        storageMedium.removeItem("checkoutState");
        window.location.href = window.location.origin + "/w/thanks";
    }, 1000);
}

function checkoutPopup() {
    storageMedium.setItem("checkoutState", "1");
    centeredPopup(window.location.href+"Popup", "Checkout", screen.width/3*2, screen.height/3*2, true);
}

let popupWindow = null;
function centeredPopup(url, winName, w, h, scroll){
    if (popupWindow != null) return;
    const LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
    const TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
    const settings =
        'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable,toolbar=no,menubar=no,location=no,directories=no,status=no'
    popupWindow = window.open(url,winName,settings)
}

function finishCheckout() {
    storageMedium.setItem("checkoutState", "0");
}

function get(name){
    if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
        return decodeURIComponent(name[1]);
}

const enableReloader = false;

function loadCheckoutPage() {
    if (!enableReloader) {
        if (!loadPageControlCheckout()) {
            return;
        }
    }
    const o = get("o");
    if (enableReloader && (o != null && o == "r")) {
        checkoutIsPageReloaded = true;
    } else {
        checkoutPopup();
    }
    listenForCheckoutState();
}

function checkoutPopupState() {
    const interval = setInterval(function() {
        const state = storageMedium.getItem("checkoutState");
        if (state == "1") return;
        window.close();
    }, 1000);
}

let isOpenReopen = false;

async function reopenCheckoutPrompt() {
    if (isOpenReopen) return;
    isOpenReopen = true;
    const res = await b_confirm("Reopen checkout form?");
    isOpenReopen = false;
    if (!res) return;
    window.location.reload();
}

let isOpenCheckoutB = false;

async function checkoutPopupConfirmButton() {
    if (isOpenCheckoutB) return;
    isOpenCheckoutB = true;
    const res = await b_confirm("Confirm purchase?");
    isOpenCheckoutB = false;
    if (!res) return;
    finishCheckout();
}

function setupCheckoutPage() {
    const items = localStorage.getItem("checkoutItems");
    const data = JSON.parse(items);
    let price = 0.0;
    for(let element in data) {
        let i = data[element];
        appendItemToListPopup(i.Name, i.Price);
        price+=i.Price;
    }
    document.getElementById("checkoutListPrice").innerText = "€ " + price.toFixed(2).toString();
    document.getElementById("autoScrollBottom").scrollIntoView();
}

function appendItemToListPopup(name, price) {
    const html = '                            <div class="item">\n' +
        '                                <span class="price">€ '+price.toString()+'</span>\n' +
        '                                <p class="item-name">'+name+'</p>\n' +
        '                            </div>';
    document.getElementById("checkoutListItems").insertAdjacentHTML("beforeend", html);
}
