function toggleMenu() {
    const nav = document.getElementById("navLinks");
    nav.style.display = nav.style.display === "flex" ? "none" : "flex";
}

function addToCart(id) {
    const form = new FormData();
    form.append("id", id);

    fetch("controllers/cart_controller.php", {
        method: "POST",
        body: form
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "ok") {
            document.getElementById("cartCount").innerText = data.cartCount;
        }
    });
}
