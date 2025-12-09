// ========================
// Element references
// ========================

// Favorites
const favoriteBtn = document.querySelector(".favorites_btn");
const heart = document.querySelector(".heart");

// Toggle button
const toggleBtn = document.querySelector(".toggle_btn");
const toggleText = document.getElementById("text");

// Cart
const addToCartBtn = document.getElementById("addtocart");
const decreaseBtn = document.getElementById("decrease");
const increaseBtn = document.getElementById("increase");
const qtyValue = document.getElementById("qty");
const notification = document.getElementById('notification');

// Recipe carousel
const recipeCarousel = document.getElementById("recipeCarousel");
const recipeCard = document.getElementById("recipeCard");
const recipeTitle = document.getElementById("recipeTitle");
const recipeArrows = document.querySelectorAll(".recipe-arrow");
const recipeImg = document.querySelector(".recipe-img");
const titleEl = document.querySelector(".recipe h2");
const ingredientsList = document.querySelector("#Ainesosat ul");
const stepsList = document.querySelector("#Valmistus ol");

// Recipe tutorial tabs
const buttons = document.querySelectorAll('.recipe-tutorial-toggle-btn');
const Ainesosat = document.getElementById("Ainesosat");
const Valmistus = document.getElementById("Valmistus");

// Review carousel
const carousel = document.querySelector("#reviewCarousel");
const nextBtn = document.querySelector(".carousel_btn.next");
const prevBtn = document.querySelector(".carousel_btn.prev");

const Kategoria = document.getElementById("kategory").dataset.productKategoria

let isExpanded = false;
let quantity = 1;

// ========================
// Favorites toggle
// ========================
favoriteBtn?.addEventListener("click", () => heart?.classList.toggle("active_heart"));

// ========================
// Show more / Show less
// ========================
toggleBtn?.addEventListener("click", () => {
    toggleText?.classList.toggle("open");
    toggleBtn.textContent = toggleText?.classList.contains("open") ? "Show less" : "Show more";
});

// ========================
// Quantity update
// ========================
const updateQuantity = () => { qtyValue.textContent = quantity; };

decreaseBtn?.addEventListener("click", () => {
    if (quantity > 1) quantity--;
    updateQuantity();
});

increaseBtn?.addEventListener("click", () => {
    quantity++;
    updateQuantity();
});

// ========================
// Add to Cart
// ========================
addToCartBtn?.addEventListener('click', async () => {
    if (!addToCartBtn) return;

    addToCartBtn.classList.add("loading");
    addToCartBtn.textContent = "Lisätään...";

    const qty = parseInt(qtyValue.textContent);
    if (isNaN(qty) || qty < 1 || qty > 99) return;

    const productId = addToCartBtn.dataset.productId;
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    try {
        const response = await fetch("/cart", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({ quantity: qty, TuoteID: productId })
        });

        if (!response.ok) throw new Error(`Virheellinen vastaus: ${response.status}`);

        const data = await response.json();
        if (data.data?.success) {
            // Update notification (you already have this)
            notification.innerHTML = "<p>Tuote lisätty onnistuneesti</p>";
            notification.style.opacity = 0;
            setTimeout(() => notification.style.transition = "opacity 0.5s ease", 50);
            setTimeout(() => notification.style.opacity = 1, 100);
            setTimeout(() => notification.style.opacity = 0, 3100);

            // --- Update cart count in header ---
            const cartCountEl = document.getElementById("cartCount");
            if (cartCountEl) {
                const newCount = data.data?.cartCount ?? 0; // Assuming your server returns updated cart count
                cartCountEl.textContent = newCount;
                cartCountEl.style.display = newCount > 0 ? "flex" : "none";
            }
        }

    } catch (err) {
        console.error(err);
    } finally {
        addToCartBtn.classList.remove("loading");
        addToCartBtn.textContent = "Lisää koriin";
    }
});

// ========================
// Recipe Carousel (Single Card)
// ========================
let currentIndex = 0;
let recipes = [];
let autoScrollInterval = null;
let updateCard = () => { };

// Auto-scroll functions
function startAutoScroll() {
    if (autoScrollInterval) return;

    autoScrollInterval = setInterval(() => {
        if (!isExpanded && recipes.length > 0) {
            currentIndex = (currentIndex + 1) % recipes.length;
            updateCard(currentIndex);
        }
    }, 3000);
}

function stopAutoScroll() {
    clearInterval(autoScrollInterval);
    autoScrollInterval = null;
}

async function fetchRecipes() {
    try {
        const response = await fetch(`/reseptit?Kategoria=${Kategoria}`);
        console.log("kategoria:", Kategoria)
        if (!response.ok) throw new Error(`Virheellinen vastaus: ${response.status}`);
        const data = await response.json();
        renderRecipeCarousel(data);
    } catch (err) {
        console.error(err);
    }
}


function renderRecipeCarousel(data) {
    if (data.success !== true) {
        recipeImg.style.backgroundImage = '';
        titleEl.textContent = data.message || "reseptejä ei löytynyt aa";
        return;
    }
    recipes = data.data;

    updateCard = (index) => {
        const recipe = recipes[index];

        titleEl.textContent = recipe.Nimi;
        ingredientsList.innerHTML = recipe.Ainesosat.split(",").map(i => `<li>${i.trim()}</li>`).join("");
        stepsList.innerHTML = recipe.Valmistusohje
            .split(". ")
            .filter(s => s)
            .map(s => `<li>${s.trim()}${s.endsWith(".") ? "" : "."}</li>`)
            .join("");

        recipeImg.style.backgroundImage = `url(images/${recipe.Kuva})`;
    };

    updateCard(currentIndex);

    document.getElementById("recipeNext")?.addEventListener("click", (e) => {
        e.stopPropagation();
        stopAutoScroll();
        currentIndex = (currentIndex + 1) % recipes.length;
        updateCard(currentIndex);
    });

    document.getElementById("recipePrev")?.addEventListener("click", (e) => {
        e.stopPropagation();
        stopAutoScroll();
        currentIndex = (currentIndex - 1 + recipes.length) % recipes.length;
        updateCard(currentIndex);
    });

    startAutoScroll();
}

fetchRecipes();

// ========================
// Recipe Tutorial Tabs
// ========================
buttons.forEach(btn => btn.addEventListener("click", () => {
    buttons.forEach(b => b.classList.remove("toggled"));
    btn.classList.add("toggled");

    if (btn.dataset.target === "Ainesosat") {
        Ainesosat.classList.add("selected");
        Valmistus.classList.remove("selected");
    } else {
        Ainesosat.classList.remove("selected");
        Valmistus.classList.add("selected");
    }
}));

// ========================
// Recipe Expand / Collapse
// ========================
recipeCard?.addEventListener('click', (e) => {
    if (e.target.closest('.recipe-arrow')) return;
    toggleRecipeView();
});

function toggleRecipeView() {
    isExpanded = !isExpanded;

    if (isExpanded) stopAutoScroll();
    else startAutoScroll();

    requestAnimationFrame(() => {
        recipeTitle?.classList.toggle('collapsed');
        recipeCarousel?.classList.toggle('expanded');
        recipeCarousel?.querySelectorAll('*').forEach(c => c.classList.toggle('expanded'));
        recipeArrows.forEach(arrow => arrow.classList.toggle('collapsed'));
    });
}

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && isExpanded) toggleRecipeView();
});

// ========================
// Review Carousel Navigation
// ========================
let cardWidth = 280;
let isMoving = false;

function moveNext() {
    if (isMoving || !carousel) return;
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
    if (isMoving || !carousel) return;
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

nextBtn?.addEventListener("click", moveNext);
prevBtn?.addEventListener("click", movePrev);
