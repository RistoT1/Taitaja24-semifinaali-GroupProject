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

const recipeTitle = document.getElementById("recipeTitle");
const recipeCarousel = document.getElementById("recipeCarousel");
const recipeItem = document.getElementById("recipeItem");
const recipeArrows = document.querySelectorAll(".recipe-arrow");

const buttons = document.querySelectorAll('.recipe-tutorial-toggle-btn');
const Ainesosat = document.getElementById("Ainesosat");
const Valmistus = document.getElementById("Valmistus");

let isExpanded = false;

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

recipeCard.addEventListener('click', (e) => {
    if (e.target.closest('.recipe-arrow')) return;

    toggleRecipeView();
});

function toggleRecipeView() {
    isExpanded = !isExpanded;

    requestAnimationFrame(() => {
        recipeTitle.classList.toggle('collapsed');
        recipeCarousel.classList.toggle('expanded');

        recipeCarousel.querySelectorAll('*').forEach(child => {
            child.classList.toggle('expanded');
        });

        recipeArrows.forEach(arrow => {
            arrow.classList.toggle('collapsed');
        });
    });
}

buttons.forEach(btn => {
    btn.addEventListener("click", () => {

        // Toggle active styling
        buttons.forEach(b => b.classList.remove("toggled"));
        btn.classList.add("toggled");

        // Switch content
        if (btn.dataset.target === "Ainesosat") {
            Ainesosat.classList.add("selected");
            Valmistus.classList.remove("selected");
        } else {
            Ainesosat.classList.remove("selected");
            Valmistus.classList.add("selected");
        }
    });
});

document.getElementById('recipePrev')?.addEventListener('click', (e) => {
    e.stopPropagation();
    // Add your carousel navigation logic here
    console.log('Previous recipe');
});

document.getElementById('recipeNext')?.addEventListener('click', (e) => {
    e.stopPropagation();
    // Add your carousel navigation logic here
    console.log('Next recipe');
});


document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && isExpanded) {
        toggleRecipeView();
    }
});

if (nextBtn) nextBtn.addEventListener("click", moveNext);
if (prevBtn) prevBtn.addEventListener("click", movePrev);
