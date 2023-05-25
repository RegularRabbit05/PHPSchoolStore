async function loadAdminPageControl() {
    let tmpAdmin = getCookie("admin");
    if (tmpAdmin == null) {
        window.location = window.location.origin + "/w/store";
    }
}

async function uploadItem(name, desc, price, img) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", window.location.origin+"/api/add", true);
    xhttp.send(JSON.stringify({
        email:usr,
        password:pwd,
        itemName:name,
        itemDesc:desc,
        itemPrice:price,
        itemPicture:img,
    }));

    xhttp.onreadystatechange = () => {
        if (xhttp.readyState === 4) {
            const tx = xhttp.responseText;
            if (tx.toLocaleLowerCase() == "no") {
                new swal("Error", "Unable to add your item to the store!", "error");
                return;
            }
            new swal("Item added!", "Go back to the store page to see the changes!", "success");
        }
    }
}

function submitNewItem() {
    const itemName = document.getElementById("itemName").value;
    const itemDesc = document.getElementById("itemDesc").value;
    const itemPrice = document.getElementById("itemPrice").value;

    let image = "null";

    const filepondItemFinder = document.getElementsByName("filepond")[0];
    if (filepondItemFinder == null || filepondItemFinder == "") ; else {
        if (filepondItemFinder.value != null && filepondItemFinder.value != "") {
            try {
                let json = JSON.parse(filepondItemFinder.value);
                image = "data:" + json.type + ";charset=utf-8;base64," + json.data;
            } catch (e) {}
        }
    }

    const success = itemName != null && itemName != "" && itemDesc != null && itemDesc != "" && itemPrice != null && itemPrice != "";
    if (!success) {
        new swal("Oh no", "You didn't fill in all the required fields!", "error");
        return;
    }
    uploadItem(itemName, itemDesc, parseFloat(itemPrice), image).then(() => {});
}
