let items_arr = [{
    "id": "11111111111",
    "count": "2"
}, {
    "id": "11111111111",
    "count": "2"
}, {
    "id": "11111111111",
    "count": "2"
}, {
    "id": "11111111111",
    "count": "2"
}, {
    "id": "11111111111",
    "count": "2"
}];
function addToCart(pId, count) {
    var x = { pId, count }
    console.log(x)

    if (localStorage.getItem("cart") !== null) {
        z = JSON.parse(localStorage.getItem("cart"));
        z.push(x);
        localStorage.setItem("cart", JSON.stringify(z));
        }
        else {
            z = [x]
            localStorage.setItem("cart", JSON.stringify(z));
            }
                if (loggedIn = true) {
                    console.log("uploading items to cloud cart");
                    
                }
}

// print(localStorage.getItem("cart"));
function removeFromCart(pId) {
    z = localStorage.getItem("cart");
    if (z !== null) {
        z = JSON.parse(z);
        z.forEach(x => {
            if (x.pId == pId) {
                const index = z.indexOf(x);
                if (index > -1) {
                    z.splice(index, 1);
                }
            }
        });
        localStorage.setItem("cart",JSON.stringify(z))
    }
    else {
        alert("Error! The cart is empty nothing to remove")
    }
}

function cartItems(){
    if (localStorage.getItem("cart")!==null) {
        return (JSON.parse(localStorage.getItem("cart")).length);
        
    }
    else{
        return 0;
    }
}
if (document.querySelector("#items")!==null) {
    document.querySelector("#items").innerHTML = cartItems();    
}


