/* ---------------- SELECTORS ---------------- */
const productGrid = document.querySelector("#productGrid");
const searchInput = document.querySelector(".search_input");
const minPriceInput = document.querySelector("#minPrice");
const maxPriceInput = document.querySelector("#maxPrice");
const categoryList = document.querySelector(".products_left_categories");
const sortButtons = document.querySelectorAll(".filter-buttons button");
const loadmoreBtn = document.getElementById("loadmoreBtn");
const categoryNotice = document.getElementById('categoryNotice');

/* ---------------- BURGER MENU ---------------- */
const toggleBtn = document.querySelector(".filters_toggle");
const closeBtn = document.querySelector(".close-filters");
const productsLeft = document.querySelector(".products_left");
const catTitle = document.querySelector(".categories_title");

let activeSort = null;

/* ---------------- BURGER MENU EVENTS ---------------- */
closeBtn.addEventListener("click", () => {
    if (productsLeft.classList.contains("active")) {
        productsLeft.classList.remove("active");
        productsLeft.classList.add("slide-out");
        setTimeout(() => productsLeft.classList.remove("slide-out"), 300);
    }
});

toggleBtn.addEventListener("click", () => {
    if (productsLeft.classList.contains("active")) {
        productsLeft.classList.remove("active");
        productsLeft.classList.add("slide-out");
        setTimeout(() => productsLeft.classList.remove("slide-out"), 300);
    } else {
        productsLeft.classList.add("active");
    }
});

categoryNotice.addEventListener('click', async () => {
    categoryNotice.classList.remove('active');
    categoryList.querySelectorAll("a").forEach(a => a.classList.remove("active-category"));
    allProducts = [];
    filteredProducts = [];
    cursor = null;
    await FetchProducts();
})

/* ---------------- DATA ---------------- */
let allProducts = [];         // All loaded products
let filteredProducts = [];    // Filtered products
let cursor = null;            // Cursor for Load More

/* ---------------- SCROLL SYNC ---------------- */
let lastScrollY = window.scrollY;
window.addEventListener("scroll", () => {
    const currentScrollY = window.scrollY;
    const delta = currentScrollY - lastScrollY;
    productsLeft.scrollTop += delta;
    lastScrollY = currentScrollY;
});

/* ---------------- FETCH CATEGORIES ---------------- */
async function FetchCategories() {
    try {
        const res = await fetch("/api/categories");
        const json = await res.json();
        RenderCategories(json.data);
    } catch (err) {
        console.error("Failed to load categories", err);
    }
}

function RenderCategories(categories) {
    // Add "All" option at the top
    categoryList.innerHTML = `
        <li><a href="#" class="category_link">All</a></li>
        ${categories.map(cat => `<li><a href="#" class="category_link">${cat}</a></li>`).join("")}
    `;

    document.querySelectorAll(".category_link").forEach(link => {
        link.addEventListener("click", async (e) => {
            e.preventDefault();

            // Highlight active category
            categoryList.querySelectorAll("a").forEach(a => a.classList.remove("active-category"));
            link.classList.add("active-category");

            // Reset products + cursor
            allProducts = [];
            filteredProducts = [];
            cursor = null;

            // Fetch products
            const category = link.textContent.trim();
            if (category === "All") {
                if (categoryNotice.classList.contains('active')) {
                    categoryNotice.classList.remove('active');
                }
                await FetchProducts(); // No category filter
            } else {
                if (!categoryNotice.classList.contains('active')) {
                    categoryNotice.classList.add('active');
                }
                categoryNotice.innerHTML = `${category} <i class="fa-solid fa-x"></i>`;
                await FetchProducts({ Kategoria: category });
            }
        });
    });
}


/* ---------------- FETCH PRODUCTS ---------------- */
async function FetchProducts({ Kategoria = null, cursorCreatedAt = null, cursorId = null } = {}) {
    let url = "/api/products";
    const params = [];

    if (Kategoria) params.push(`Kategoria=${encodeURIComponent(Kategoria)}`);
    if (cursorCreatedAt && cursorId) {
        params.push(`cursor_created_at=${encodeURIComponent(cursorCreatedAt)}`);
        params.push(`cursor_id=${encodeURIComponent(cursorId)}`);
    }

    if (params.length > 0) url += "?" + params.join("&");

    loadmoreBtn.disabled = true;
    loadmoreBtn.textContent = "Loading...";

    try {
        const res = await fetch(url);
        const json = await res.json();

        // Normalize products
        const newProducts = json.data.map(p => ({
            ...p,
            Hinta: Number(p.Hinta),
            Lisätty: new Date(p.Lisätty)
        }));

        allProducts.push(...newProducts);

        // Apply filters & sort after new products
        ApplyFilters();

        cursor = json.next_cursor;

        loadmoreBtn.style.display = cursor ? "block" : "none";
        loadmoreBtn.disabled = false;
        loadmoreBtn.textContent = "Load More";
    } catch (err) {
        console.error(err);
        loadmoreBtn.disabled = false;
        loadmoreBtn.textContent = "Load More";
    }
}

/* ---------------- LOAD MORE ---------------- */
loadmoreBtn.addEventListener("click", () => {
    if (!cursor) return;
    const activeCategory = categoryList.querySelector(".active-category")?.textContent;
    FetchProducts({
        Kategoria: activeCategory,
        cursorCreatedAt: cursor.cursor_created_at,
        cursorId: cursor.cursor_id
    });
});

/* ---------------- RENDER PRODUCTS ---------------- */
async function RenderProducts(arr) {
    productGrid.innerHTML = "";

    if (arr.length === 0) {
        productGrid.innerHTML = `<p>No products found.</p>`;
        return;
    }

    const html = arr.map(p => {
        const imgPath = `/images/${p.Kuva}.jpg`;
        const fallback = "/images/placeholder.jpg";

        return `
            <div class="product_card" data-id="${p.Tuote_ID}">
                <img 
                    src="${imgPath}"
                    alt="${p.Nimi}"
                    onerror="this.src='${fallback}'"
                />
                <h4>${p.Nimi}</h4>
                <p class="price">${p.Hinta.toFixed(2)} €</p>
                <p class="brand">${p.Kategoria}</p>
            </div>
        `;
    });

    productGrid.innerHTML = html.join("");

    document.querySelectorAll(".product_card").forEach(card =>
        card.addEventListener("click", () => {
            window.location.href = `product?id=${card.dataset.id}`;
        })
    );
}

/* ---------------- FILTERS ---------------- */
function ApplyFilters() {
    const searchValue = searchInput.value.toLowerCase();
    const minP = Number(minPriceInput.value) || 0;
    const maxP = Number(maxPriceInput.value) || Infinity;

    filteredProducts = allProducts.filter(p => {
        return (
            p.Nimi.toLowerCase().includes(searchValue) &&
            p.Hinta >= minP &&
            p.Hinta <= maxP
        );
    });

    // Apply active sort
    if (activeSort) SortProducts(activeSort);
    else RenderProducts(filteredProducts);
}

searchInput.addEventListener("input", ApplyFilters);
minPriceInput.addEventListener("input", ApplyFilters);
maxPriceInput.addEventListener("input", ApplyFilters);

/* ---------------- SORTING ---------------- */
function SortProducts(type) {
    if (!type) return;

    if (type === "New") {
        filteredProducts = [...filteredProducts].sort((a, b) => b.Lisätty - a.Lisätty);
    } else if (type === "Price ascending") {
        filteredProducts.sort((a, b) => a.Hinta - b.Hinta);
    } else if (type === "Price descending") {
        filteredProducts.sort((a, b) => b.Hinta - a.Hinta);
    }

    RenderProducts(filteredProducts);
}

sortButtons.forEach(btn => {
    btn.addEventListener("click", () => {
        if (btn.classList.contains("active")) return;

        sortButtons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        activeSort = btn.textContent.trim();
        SortProducts(activeSort);
    });
});

/* ---------------- INIT ---------------- */
async function Init() {
    await FetchCategories();
    await FetchProducts();
}

Init();
