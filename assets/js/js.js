document.addEventListener("DOMContentLoaded", function() {
    //adding event listeners to all plus and minus buttons for updating cart quantity
    document.querySelectorAll(".plus, .minus").forEach(button => {
        button.addEventListener("click", function() {
            //retrieving product ID from the data attribute of the clicked button
            let productId = this.getAttribute("data-id");
            
            //determining the action. Increase if it's the plus button, decrease if it's the minus button
            let action = this.classList.contains("plus") ? "increase" : "decrease";
            
            //locating the quantity and total price elements for the product
            let quantitySpan = document.querySelector(`.quantity[data-id='${productId}']`);
            let priceSpan = document.querySelector(`.total-price[data-id='${productId}']`);

            //sending a request to update the cart quantity in the backend
            fetch("update_cart.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `product_id=${productId}&action=${action}`
            })
            //converting the response to json
            .then(response => response.json()) 
            .then(data => {
                //Handle product removal confirmation if needed
                if (data.confirmRemoval) {
                    const message = data.isOnlyProduct 
                    //if it's the only product
                        ? "Do you wish to clear the cart?"
                        //if multiple products
                        : "Do you wish to remove this product?";
                    
                    if (confirm(message)) {
                        if (data.isOnlyProduct) {
                            //redirecting to clear the entire cart
                            window.location.href = "clear_cart.php";
                        } else {
                            //removing just the specific product from the cart
                            fetch("remove_product.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded"
                                },
                                body: `product_id=${productId}`
                            })
                            .then(() => {
                                //remove the product list from the DOM
                                const listItem = button.closest('li');
                                if (listItem) {
                                    listItem.remove();
                                }
                                //If the cart is empty after all this, refresh page
                                if (document.querySelectorAll('#cart-list li').length === 0) {
                                    window.location.reload();
                                }
                            });
                        }
                    }
                    //stop executing since product is now goneeee <3
                    return;
                }

                //Updating the quantity and total price in the UI if it still exists and wasn't deleted
                if (data.quantity) {
                    quantitySpan.textContent = data.quantity;
                    priceSpan.textContent = `€${data.total_price}`;
                }
            });
        });
    });
});