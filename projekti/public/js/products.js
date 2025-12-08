/* ---------------- SELECTORS ---------------- */

const productGrid = document.querySelector("#productGrid")
const searchInput = document.querySelector(".search_input")
const minPriceInput = document.querySelector("#minPrice")
const maxPriceInput = document.querySelector("#maxPrice")
const categoryList = document.querySelector(".products_left_categories")
const sortButtons = document.querySelectorAll(".filter-buttons button")
const loadmoreBtn = document.getElementById("loadmoreBtn")

/* ---------------- BURGER MENU ---------------- */

const toggleBtn = document.querySelector(".filters_toggle")
const productsLeft = document.querySelector(".products_left")
const catTitle = document.querySelector(".categories_title")

toggleBtn.addEventListener("click", () => productsLeft.classList.toggle("active"))

/* ---------------- DATA ---------------- */

let allProducts = []         // all loaded products
let filteredProducts = []    // filtered products
let cursor = null            // cursor for Load More

/* ---------------- FETCH CATEGORIES ---------------- */

async function FetchCategories() {
    try {
        const res = await fetch("/api/categories")
        const json = await res.json()
        RenderCategories(json.data)
    } catch (err) {
        console.error("Failed to load categories", err)
    }
}
let lastScrollY = window.scrollY;

window.addEventListener("scroll", () => {
    const currentScrollY = window.scrollY;
    const delta = currentScrollY - lastScrollY; // how much the user scrolled
    productsLeft.scrollTop += delta;           // scroll the sidebar content by same amount
    lastScrollY = currentScrollY;             // update for next scroll event
});

function RenderCategories(categories) {
    // flat list of links/buttons
    categoryList.innerHTML = categories.map(cat => `
        <li><a href="#" class="category_link">${cat}</a></li>
    `).join("")

    // add click event to all categories
    document.querySelectorAll(".category_link").forEach(link => {
        link.addEventListener("click", async (e) => {
            e.preventDefault()

            // highlight active category
            categoryList.querySelectorAll("a").forEach(a => a.classList.remove("active-category"))
            link.classList.add("active-category")

            // reset products + cursor
            allProducts = []
            filteredProducts = []
            cursor = null

            // fetch products for this category
            await FetchProducts({ Kategoria: link.textContent })
        })
    })
}

/* ---------------- FETCH PRODUCTS ---------------- */

async function FetchProducts({ Kategoria = null, cursorCreatedAt = null, cursorId = null } = {}) {
    let url = "/api/products"
    const params = []

    console.log(Kategoria)
    if (Kategoria) params.push(`Kategoria=${encodeURIComponent(Kategoria)}`)
    if (cursorCreatedAt && cursorId) {
        params.push(`cursor_created_at=${encodeURIComponent(cursorCreatedAt)}`)
        params.push(`cursor_id=${encodeURIComponent(cursorId)}`)
    }

    if (params.length > 0) url += "?" + params.join("&")

    loadmoreBtn.disabled = true
    loadmoreBtn.textContent = "Loading..."

    try {
        const res = await fetch(url)
        const json = await res.json()

        allProducts.push(...json.data)
        filteredProducts = [...allProducts]
        cursor = json.next_cursor

        RenderProducts(filteredProducts)

        loadmoreBtn.style.display = cursor ? "block" : "none"
        loadmoreBtn.disabled = false
        loadmoreBtn.textContent = "Load More"
    } catch (err) {
        console.error(err)
        loadmoreBtn.disabled = false
        loadmoreBtn.textContent = "Load More"
    }
}

/* ---------------- LOAD MORE ---------------- */

loadmoreBtn.addEventListener("click", () => {
    if (!cursor) return
    const activeCategory = categoryList.querySelector(".active-category")?.textContent
    FetchProducts({ category: activeCategory, cursorCreatedAt: cursor.cursor_created_at, cursorId: cursor.cursor_id })
})

/* ---------------- RENDER PRODUCTS ---------------- */

function RenderProducts(arr) {
    productGrid.innerHTML = ""

    if (arr.length === 0) {
        productGrid.innerHTML = `<p>No products found.</p>`
        return
    }

    const html = arr.map(p => `
        <div class="product_card" data-id="${p.Tuote_ID}">
            <img src="${p.Kuva ? `/images/${p.Kuva}.jpg` : '/images/placeholder.jpg'}" alt="${p.Nimi}">
            <h4>${p.Nimi}</h4>
            <p class="price">${p.Hinta} €</p>
            <p class="brand">${p.Kategoria}</p>
        </div>
    `)

    productGrid.innerHTML = html.join("")

    document.querySelectorAll(".product_card").forEach(card => {
        card.addEventListener("click", () => {
            window.location.href = `product?id=${card.dataset.id}`
        })
    })
}

/* ---------------- FILTERS ---------------- */

function ApplyFilters() {
    const searchValue = searchInput.value.toLowerCase()
    const minP = Number(minPriceInput.value) || 0
    const maxP = Number(maxPriceInput.value) || Infinity

    filteredProducts = allProducts.filter(p => {
        return (
            p.Nimi.toLowerCase().includes(searchValue) &&
            p.Hinta >= minP &&
            p.Hinta <= maxP
        )
    })

    RenderProducts(filteredProducts)
}

searchInput.addEventListener("input", ApplyFilters)
minPriceInput.addEventListener("input", ApplyFilters)
maxPriceInput.addEventListener("input", ApplyFilters)

/* ---------------- SORTING ---------------- */

function SortProducts(type) {
    if (type === "New") filteredProducts = [...filteredProducts].sort((a, b) => new Date(b.Lisätty) - new Date(a.Lisätty))
    if (type === "Price ascending") filteredProducts.sort((a, b) => a.Hinta - b.Hinta)
    if (type === "Price descending") filteredProducts.sort((a, b) => b.Hinta - a.Hinta)

    RenderProducts(filteredProducts)
}

sortButtons.forEach(btn =>
    btn.addEventListener("click", () => SortProducts(btn.textContent.trim()))
)

/* ---------------- INIT ---------------- */

async function Init() {
    await FetchCategories()   // fetch flat category links
    await FetchProducts()     // fetch initial products
}

Init()
