document.addEventListener("DOMContentLoaded", function() {
    const quantityInput = document.getElementById("quantity");
    const totalPriceSpan = document.getElementById("total-price");
    const productPrice = parseFloat(totalPriceSpan.textContent.replace('€', '').replace(',', '.'));

    document.querySelector(".plus").addEventListener("click", function() {
        let quantity = parseInt(quantityInput.value);
        if (quantity < 99) {
            quantity++;
            quantityInput.value = quantity;
            totalPriceSpan.textContent = `€${(productPrice * quantity).toFixed(2).replace('.', ',')}`;
        }
    });

    document.querySelector(".minus").addEventListener("click", function() {
        let quantity = parseInt(quantityInput.value);
        if (quantity > 1) {
            quantity--;
            quantityInput.value = quantity;
            totalPriceSpan.textContent = `€${(productPrice * quantity).toFixed(2).replace('.', ',')}`;
        }
    });
});
