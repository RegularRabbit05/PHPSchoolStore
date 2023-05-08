let cartTotalPrice = 0.000;
let items = [];

async function loadItemsImplementation() {
    usr = getCookie("user");
    pwd = getCookie("password");
    if (usr == null || usr == "" || pwd == null || pwd == "") return;
    const cart = localStorage.getItem("cart");

    const el = document.getElementById("_cart");

    if (cart == null || cart == "") {
        appendNoItems();
        return;
    }

    const data = cart.split(",");

    for (let i = 0; i < data.length; i++) {
        if (data[i] == "") continue;
        setTimeout(getItem, 150*(i+2), usr, pwd, data[i], el, i);
    }

    updateCartLabelItemCount();
}

async function loadItems() {
    loadItemsImplementation().then(() => {});
}

function getItem(usr, pwd, id, el, i) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", window.location.origin+"/api/item", true);
    xhttp.send(JSON.stringify({
        email:usr,
        password:pwd,
        id:id
    }));

    xhttp.onreadystatechange = () => {
        if (xhttp.readyState === 4) {
            const tx = xhttp.responseText;
            let item = null;
            try {
                item = JSON.parse(tx);
            } catch (e) {
                setTimeout(getItem, 150*(i+2), usr, pwd, id, el, i);
                return;
            }
            if (!item["ok"]) {
                localStorage.setItem("cart", localStorage.getItem("cart").replaceAll(id+",", ""));
                return;
            }

            items[items.length] = {"Name": item["Name"], "Price": item["Price"]};

            const str = "<li name='"+item["Price"]+"' id='item-"+ id.replaceAll(" ", "_") +"' class=\"list-group-item list-group-item-dark\">" +
                "<button type='button' class='btn btn-dark pull-right' onclick='removeItem(\""+id.replaceAll(" ", "_")+"\")'>Remove</button>"+
                " &nbsp;&nbsp; "+
                "[€ "+item["Price"]+"] "+item["Name"]+
                ""+
                "</li>";
            el.insertAdjacentHTML("beforeend", str);
            cartTotalPrice += item["Price"];
            updateTotalPrice();
        }
    }
}

function updateTotalPrice() {
    document.getElementById("cartTotalPriceBar").innerText = cartTotalPrice.toFixed(2).toString();
    document.getElementById("autoScrollBottom").scrollIntoView();
}

function removeItem(id) {
    const elementById = document.getElementById("item-"+id);
    try {
        const price = parseFloat(elementById.getAttribute("name"));
        cartTotalPrice -= price;
        updateTotalPrice();
    } catch (e) {}
    elementById.remove();
    localStorage.setItem("cart", localStorage.getItem("cart").replace(id.replaceAll("_", " ")+",", ""));
    if (localStorage.getItem("cart") == null || localStorage.getItem("cart") == "") {
        cartTotalPrice = 0;
        updateTotalPrice();
        appendNoItems();
    }
    updateCartLabelItemCount();
}

function appendNoItems() {
    document.getElementById("_cart").insertAdjacentHTML("beforeend", "<li class=\"list-group-item list-group-item-dark\">No items!</li>");
}

async function askClearCart() {
    const result = await b_confirm('Do you really want to clear the cart?');
    if (result) {
        localStorage.setItem("cart", "");
        cartTotalPrice = 0;
        updateTotalPrice();
        updateCartLabelItemCount();
        document.getElementById("_cart").innerHTML = "";
        appendNoItems();
    }
}

async function b_confirm(msg) {
    const modalElem = document.createElement('div')
    modalElem.id = "modal-confirm"
    modalElem.className = "modal"
    modalElem.innerHTML = `
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">             
        <div class="modal-body fs-6">
          <p>${msg}</p>
      </div>
      <div class="modal-footer" style="border-top:0px">             
        <button id="modal-btn-descartar" type="button" class="btn btn-secondary">Cancel</button>
        <button id="modal-btn-aceptar" type="button" class="btn btn-primary">Accept</button>
      </div>
    </div>
  </div>
  `
    const myModal = new bootstrap.Modal(modalElem, {
        keyboard: false,
        backdrop: 'static'
    })
    myModal.show()

    return new Promise((resolve, reject) => {
        document.body.addEventListener('click', response)

        function response(e) {
            let bool = false
            if (e.target.id == 'modal-btn-descartar') bool = false
            else if (e.target.id == 'modal-btn-aceptar') bool = true
            else return

            document.body.removeEventListener('click', response)
            document.body.querySelector('.modal-backdrop').remove()
            modalElem.remove()
            resolve(bool)
        }
    })
}

function redirectCheckout() {
    if (items.length == 0) {
        new swal('What?', 'You have no items in your cart!', 'question');
        return;
    }
    localStorage.removeItem("checkoutItems");
    localStorage.setItem("checkoutItems", JSON.stringify(items));
    window.location.href = window.location.origin+'/w/checkout';
}
