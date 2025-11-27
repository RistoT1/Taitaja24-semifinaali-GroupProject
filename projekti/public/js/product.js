// Element references (safe form)
const favoriteBtn = document.querySelector(".favorites_btn");
const heart = document.querySelector(".heart");
const text = document.getElementById("text");
const button = document.querySelector(".toggle_btn");
const cartCount = document.querySelector(".cart_count");
const addToCartBtn = document.querySelector(".products_details_buybtn");
const decreaseBtn = document.getElementById("decrease");
const increaseBtn = document.getElementById("increase");
const qtyValue = document.getElementById("qty");
const carousel = document.querySelector("#reviewCarousel");
const nextBtn = document.querySelector(".carousel_btn.next");
const prevBtn = document.querySelector(".carousel_btn.prev");

if (favoriteBtn && heart) {
    favoriteBtn.addEventListener("click", () => {
        heart.classList.toggle("active_heart");
    });
}

if (button && text) {
    button.addEventListener("click", () => {
        text.classList.toggle("open");
        button.textContent = text.classList.contains("open") ? "Show less" : "Show more";
    });
}

let quantity = 1;

function updateQuantity() {
    qtyValue.textContent = quantity;
}

if (decreaseBtn) {
    decreaseBtn.addEventListener("click", () => {
        if (quantity > 1) {
            quantity--;
            updateQuantity();
        }
    });
}

if (increaseBtn) {
    increaseBtn.addEventListener("click", () => {
        quantity++;
        updateQuantity();
    });
}

let count = 0;

if (addToCartBtn && cartCount) {
    addToCartBtn.addEventListener("click", () => {
        count++;
        cartCount.textContent = count;
    });
}

let cardWidth = 280; 
let isMoving = false;

function moveNext() {
    if (isMoving) return;
    isMoving = true;

    carousel.style.transition = "transform 0.4s ease";
    carousel.style.transform = `translateX(-${cardWidth}px)`;

    setTimeout(() => {
        carousel.appendChild(carousel.firstElementChild);
        carousel.style.transition = "none";
        carousel.style.transform = "translateX(0)";
        setTimeout(() => isMoving = false, 20);
    }, 400);
}

function movePrev() {
    if (isMoving) return;
    isMoving = true;

    carousel.style.transition = "none";
    carousel.insertBefore(carousel.lastElementChild, carousel.firstElementChild);
    carousel.style.transform = `translateX(-${cardWidth}px)`;

    setTimeout(() => {
        carousel.style.transition = "transform 0.4s ease";
        carousel.style.transform = "translateX(0)";
        setTimeout(() => isMoving = false, 400);
    }, 20);
}

if (nextBtn) nextBtn.addEventListener("click", moveNext);
if (prevBtn) prevBtn.addEventListener("click", movePrev);
