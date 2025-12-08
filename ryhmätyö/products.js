/* ---------------- SELECTORS ---------------- */

const productGrid = document.querySelector("#productGrid")
const searchInput = document.querySelector(".search_input")

const minPriceInput = document.querySelector("#minPrice")
const maxPriceInput = document.querySelector("#maxPrice")

const categoryList = document.querySelector(".products_left_categories")
const manufacturerListContainer = document.querySelector("#manufacturer_list")

const sortButtons = document.querySelectorAll(".filter-buttons button")






const btn = document.querySelector(".burger_menu");
const burger_menu = document.querySelector(".burger_menu_bg");

document.body.addEventListener("click", (e) => {
    if (!e.target.closest(".burger_menu") && 
        !e.target.closest(".burger_menu_bg")) {
        burger_menu.classList.remove("active_burger");
    }
});

btn.addEventListener("click", (e) => {
    e.stopPropagation();
    burger_menu.classList.toggle("active_burger");
});





const toggleBtn = document.querySelector(".filters_toggle")
const productsLeft = document.querySelector(".products_left")
const catTitle = document.querySelector(".categories_title")

/* ---------------- BURGER MENU ---------------- */

toggleBtn.addEventListener("click", () => {
    productsLeft.classList.toggle("active")
})

document.querySelectorAll(".categories_item > a").forEach(link => {
    link.addEventListener("click", function (e) {
        if (window.innerWidth <= 1024) {
            e.preventDefault()
            e.stopPropagation()
            this.parentElement.classList.toggle("open")
        }
    })
})

document.addEventListener("click", (e) => {
    if (!productsLeft.contains(e.target) && !toggleBtn.contains(e.target)) {
        productsLeft.classList.remove("active")
        document.querySelectorAll(".categories_item.open").forEach(item => item.classList.remove("open"))
    }
})

if (catTitle) {
    catTitle.addEventListener("click", (e) => {
        e.stopPropagation()
        catTitle.classList.toggle("active")
        categoryList.classList.toggle("open")
    })
}

/* ---------------- DATA ---------------- */

let allProducts = []
let filteredProducts = []

/* ---------------- API ---------------- */

async function GetProducts() {
    try {
        const response = await fetch("https://fakestoreapi.com/products")
        return await response.json()
    } catch {
        return []
    }
}

// FakeStore API has no brands → extract unique category names as "brands"
async function GetManufacturers() {
    const products = await GetProducts()
    const brand = [...new Set(products.map(p => p.brand))]
    return brand
}

/* ---------------- RENDER ---------------- */

function RenderProducts(arr) {
    productGrid.innerHTML = ""

    if (arr.length === 0) {
        productGrid.innerHTML = `<p>No products found.</p>`
        return
    }

    const html = arr.map(p => `
        <div class="product_card" data-id="${p.id}">
            <img src="${p.image}" alt="${p.title}">
            <h4>${p.title}</h4>
            <p class="price">${p.price} €</p>
            <p class="brand">${p.category}</p>
        </div>
    `)

    productGrid.innerHTML = html.join("")

    document.querySelectorAll(".product_card").forEach(card => {
        card.addEventListener("click", () => {
            window.location.href = `productdetails.html?id=${card.dataset.id}`
        })
    })
}

function RenderManufacturers(arr) {
    manufacturerListContainer.innerHTML = arr
        .map(brand => `
        <li>
            <label>
                <input type="checkbox" class="brand_checkbox" value="${brand}">
                ${brand}
            </label>
        </li>
    `)
        .join("")

    // Attach events
    document.querySelectorAll(".brand_checkbox")
        .forEach(ch => ch.addEventListener("change", ApplyFilters))
}

/* ---------------- FILTERS ---------------- */

function ApplyFilters() {
    const searchValue = searchInput.value.toLowerCase()
    const minP = Number(minPriceInput.value) || 0
    const maxP = Number(maxPriceInput.value) || Infinity

    const activeCategory =
        categoryList.querySelector(".active-category")?.textContent.trim().toLowerCase() || "all"

    const selectedBrands = [...document.querySelectorAll(".brand_checkbox:checked")]
        .map(c => c.value.toLowerCase())

    filteredProducts = allProducts.filter(p => {
        const pBrand = p.category.toLowerCase()

        return (
            (activeCategory === "all" || p.category.toLowerCase().includes(activeCategory)) &&
            p.title.toLowerCase().includes(searchValue) &&
            p.price >= minP &&
            p.price <= maxP &&
            (selectedBrands.length === 0 || selectedBrands.includes(pBrand))
        )
    })

    RenderProducts(filteredProducts)
}

/* ---------------- SORTING ---------------- */

function SortProducts(type) {
    if (type === "New") filteredProducts = [...filteredProducts].reverse()
    if (type === "Price ascending") filteredProducts.sort((a, b) => a.price - b.price)
    if (type === "Price descending") filteredProducts.sort((a, b) => b.price - a.price)
    if (type === "Rating") filteredProducts.sort((a, b) => b.rating - a.rating)

    RenderProducts(filteredProducts)
}

/* ---------------- EVENTS ---------------- */

categoryList.addEventListener("click", (e) => {
    if (e.target.tagName === "A") {
        e.preventDefault()
        categoryList.querySelectorAll("a").forEach(a => a.classList.remove("active-category"))
        e.target.classList.add("active-category")
        ApplyFilters()
    }
})

searchInput.addEventListener("input", ApplyFilters)
minPriceInput.addEventListener("input", ApplyFilters)
maxPriceInput.addEventListener("input", ApplyFilters)

sortButtons.forEach(btn =>
    btn.addEventListener("click", () => SortProducts(btn.textContent.trim()))
)

/* ---------------- INIT ---------------- */

async function Init() {
    allProducts = await GetProducts()
    filteredProducts = [...allProducts]

    const manufacturers = await GetManufacturers()
    RenderManufacturers(manufacturers)

    RenderProducts(allProducts)
}

Init()
