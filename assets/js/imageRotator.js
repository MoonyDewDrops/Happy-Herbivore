document.addEventListener("DOMContentLoaded", function() {
let foodImages = [
    "assets/img/food.png", 
    "assets/img/Breakfast2.webp", //change to the name of the 2nd image
    "assets/img/Breakfast3.webp" //you can go on and on w more images or whatever
];

let currentImageIndex = 0;

function changeFoodImage() {
    currentImageIndex = (currentImageIndex + 1) % foodImages.length;
    document.querySelector('.food').src = foodImages[currentImageIndex];
}

//After how much time it changes. This is 1 second (im pretty sure its in milisecond idk god help me)
setInterval(changeFoodImage, 100);
});