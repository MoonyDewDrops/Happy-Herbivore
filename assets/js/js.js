document.addEventListener("DOMContentLoaded", function() {
    let productIdToRemove = null; // Store the product ID when confirming removal

    // Plus and minus buttons for updating cart quantity
    document.querySelectorAll(".plus, .minus").forEach(button => {
        button.addEventListener("click", async function() {
            try {
                const productId = this.getAttribute("data-id");
                const action = this.classList.contains("plus") ? "increase" : "decrease";
                
  
                    // If trying to decrease, check if it's the last item
                    if (action === "decrease") {
                    const quantitySpan = document.querySelector(`.quantity[data-id='${productId}']`);
                    const cartItems = document.querySelectorAll("#cart-list li");

                    if (quantitySpan && parseInt(quantitySpan.textContent) === 1) {
                        if (cartItems.length === 1) {
                            // If it's the only product in the cart, show clear cart popup
                            document.getElementById("clearCartOverlay").style.display = "block";
                        } else {
                            // Otherwise, show remove item popup
                            productIdToRemove = productId;
                            document.getElementById("removeItemOverlay").style.display = "block";
                        }
                        return; // Wait for user input
                    }
                }

                // If cart quantity is normal, just go ahead and decrease number :3
                await updateCartQuantity(productId, action);
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while updating the cart. Please try again.');
            }
        });
    });

    // Function to update the total cart price
    function updateTotalCartPrice() {
        let total = 0;

        // Get all product total prices and sum them up
        document.querySelectorAll(".total-price").forEach(priceSpan => {
            total += parseFloat(priceSpan.textContent.replace('€', '').replace(',', '.')); // Convert to float
        });

        // Update the total price display
        const totalElement = document.getElementById("cart-total");
        if (totalElement) {
            totalElement.textContent = `Total: €${total.toFixed(2).replace('.', ',')}`;
        }
    }

    async function updateCartQuantity(productId, action) {
        try { 
                const quantitySpan = document.querySelector(`.quantity[data-id='${productId}']`);
                const priceSpan = document.querySelector(`.total-price[data-id='${productId}']`);

                const response = await fetch("update_cart.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `product_id=${productId}&action=${action}`
                });

                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

                const data = await response.json();

                // If the product should be removed, show popup
                if (data.confirmRemoval) {
                    productIdToRemove = productId;
                    const popupId = data.isOnlyProduct ? "clearCartOverlay" : "removeItemOverlay";
                    document.getElementById(popupId).style.display = "block";
                    return;
                }

                // Update quantity and price
                if (data.quantity !== undefined) {
                    quantitySpan.textContent = data.quantity;
                    priceSpan.textContent = `€${data.total_price}`;
                    updateTotalCartPrice(); // Update total cart price after any change
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while updating the cart. Please try again.');
            }
}

    // Handle product removal confirmation
    document.getElementById("confirmRemoveItem").addEventListener("click", async function() {
        if (productIdToRemove) {
            try {
                const removeResponse = await fetch("remove_product.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `product_id=${productIdToRemove}`
                });

                if (!removeResponse.ok) throw new Error(`HTTP error! status: ${removeResponse.status}`);

                const removeData = await removeResponse.json();

                if (removeData.success) {
                    const listItem = document.querySelector(`.quantity[data-id='${productIdToRemove}']`).closest('li');
                    if (listItem) listItem.remove();

                    if (document.querySelectorAll('#cart-list li').length === 0) {
                        window.location.reload();
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while removing the product. Please try again.');
            }
        }
        closePopup("removeItemOverlay");
    });

    // Handle clearing the cart
    function confirmClearCart() {
        window.location.href = "clear_cart.php";
    }

    // Function to close popups
    function closePopup(popupId) {
        document.getElementById(popupId).style.display = "none";
        productIdToRemove = null; // Reset the product ID when closing the popup
    }

    // Expose confirmClearCart and closePopup globally
    window.confirmClearCart = confirmClearCart;
    window.closePopup = closePopup;
});