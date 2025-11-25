const favoriteBtn = document.querySelector(".favorites_btn");
const heart = document.querySelector(".heart");
const text = document.getElementById("text");
const button = document.querySelector(".toggle_btn");
const cartCount = document.querySelector('.cart_count');
const addToCartBtn = document.querySelector('.products_details_buybtn');
const decreaseBtn = document.getElementById('decrease');
const increaseBtn = document.getElementById('increase');
const qtyValue = document.getElementById('qty');
const carousel = document.querySelector('#reviewCarousel');
const nextBtn = document.querySelector('.carousel_btn.next');
const prevBtn = document.querySelector('.carousel_btn.prev');






  favoriteBtn.addEventListener("click", () => {
    heart.classList.toggle("active_heart");
  });

function toggleText() {


    text.classList.toggle("open");

    if (text.classList.contains("open")) {
        button.textContent = "Show less";
    } else {
        button.textContent = "Show more";
    }
}

  button.addEventListener("click", toggleText())






    let quantity = 1;


    decreaseBtn.addEventListener('click', () => {
        if (quantity > 1) {
            quantity--;
            qtyValue.textContent = quantity;
        }
    });


    increaseBtn.addEventListener('click', () => {
        quantity++;
        qtyValue.textContent = quantity;
    });






let count = 0;

addToCartBtn.addEventListener('click', () => {
    count++;
    cartCount.textContent = count;
});











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

nextBtn.addEventListener('click', moveNext);
prevBtn.addEventListener('click', movePrev);

