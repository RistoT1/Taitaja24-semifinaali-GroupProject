// Element references (safe form)
const favoriteBtn = document.querySelector(".favorites_btn");
const heart = document.querySelector(".heart");
const text = document.getElementById("text");
const button = document.querySelector(".toggle_btn");
const cartCount = document.querySelector(".cart_count");
const addToCartBtn = document.getElementById("addtocart");
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
const recipeCard = document.getElementById("recipeCard");

const buttons = document.querySelectorAll('.recipe-tutorial-toggle-btn');
const Ainesosat = document.getElementById("Ainesosat");
const Valmistus = document.getElementById("Valmistus");

const notification = document.getElementById('notification');
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

addToCartBtn.addEventListener('click', async () => {
    addToCartBtn.classList.toggle("loading");
    addToCartBtn.innerHTML="Lisätään..."
    const qty = qtyValue.textContent;
    if (isNaN(qty) || qty < 0 || qty > 99) {
        console.log("trs")
        return;
    }
    const productId = addToCartBtn.dataset.productId;
    console.log("id", productId);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch("/cart", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
            quantity: qty,
            TuoteID: productId
        })
    });
    if (!response.ok) {
        throw new Error(`Virheellinen vastaus: ${response.status}`);
    }

    const data = await response.json();
    console.log(data);
    if (data.data.success === true) {
        notification.innerHTML = "<p>Tuote lisätty onnistuneesti</p>";

        // Start hidden
        notification.style.opacity = 0;

        // Fade in after a short delay
        setTimeout(() => {
            notification.style.transition = "opacity 0.5s ease";
            notification.style.opacity = 1;
        }, 100); // delay before fade-in
    }
    addToCartBtn.classList.toggle("loading");
    addToCartBtn.innerHTML="Lisää koriin"
    setTimeout(() => {
        notification.style.opacity = 0;
    }, 3000);



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
