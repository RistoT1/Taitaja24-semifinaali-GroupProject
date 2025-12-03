
const productGrid = document.querySelector("#productGrid")
const searchInput = document.querySelector(".search_input")

// Price inputs
const minPriceInput = document.querySelector("#minPrice")
const maxPriceInput = document.querySelector("#maxPrice")

// Category list (left sidebar)
const categoryList = document.querySelector(".products_left_categories")

// Manufacturer checkboxes
const manufacturerList = document.querySelectorAll(".manufacturer_list input[type='checkbox']")

// Sort buttons
const sortButtons = document.querySelectorAll(".filter-buttons button")

let allProducts = []
let filteredProducts = []

// ---------------- API --------------------
async function GetProducts() {
    try {
        const response = await fetch("/api/tuotteet") 
        const data = await response.json()
        return data
    } catch (error) {
        console.error( error)
        return []
    }
}

// ---------------- RENDER ---------------------
function RenderProducts(arr) {
    productGrid.innerHTML = ""

    if (arr.length === 0) {
        productGrid.innerHTML = `<p>No products found.</p>`
        return
    }

    const html = arr.map(p => `
        <div class="product_card" data-id="${p.id}">
            <img src="${p.Kuva}" alt="${p.Nimi}">
            <h4>${p.Nimi}</h4>
            <p class="price">${p.Hinta} €</p>
            <p class="brand">${p.Kategoria}</p>
        </div>
    `)

    productGrid.innerHTML = html.join("")

    // Make product card clickable
    document.querySelectorAll(".product_card").forEach(card => {
        card.addEventListener("click", () => {
            const id = card.dataset.id
            window.location.href = `productdetails.html?id=${id}`
        })
    })
}

// ---------------- FILTERS ---------------------
function ApplyFilters() {
    const searchValue = searchInput.value.toLowerCase()
    const minPrice = Number(minPriceInput.value) || 0
    const maxPrice = Number(maxPriceInput.value) || Infinity

    // Active category from sidebar
    const activeCategoryLink = categoryList.querySelector(".active-category")
    const activeCategory = activeCategoryLink ? activeCategoryLink.textContent.trim().toLowerCase() : "all"

    // Active manufacturers
    const selectedBrands = [...manufacturerList]
        .filter(c => c.checked)
        .map(c => c.parentElement.textContent.trim())

    filteredProducts = allProducts.filter(p => {
        const matchCategory = p.category.toLowerCase().includes(activeCategory) || activeCategory === "all"
        const matchSearch = p.title.toLowerCase().includes(searchValue)
        const matchPrice = p.price >= minPrice && p.price <= maxPrice
        const matchBrand = selectedBrands.length === 0 || selectedBrands.includes(p.brand)

        return matchCategory && matchSearch && matchPrice && matchBrand
    })

    RenderProducts(filteredProducts)
}

// ---------------- SORTING ---------------------
function SortProducts(type) {
    if (type === "New") {
        filteredProducts = [...filteredProducts].reverse()
    } else if (type === "Price ascending") {
        filteredProducts.sort((a, b) => a.price - b.price)
    } else if (type === "Price descending") {
        filteredProducts.sort((a, b) => b.price - a.price)
    } else if (type === "Rating") {
        filteredProducts.sort((a, b) => b.rating - a.rating)
    }

    RenderProducts(filteredProducts)
}

// ---------------- CATEGORY CLICK ---------------------
categoryList.addEventListener("click", (e) => {
    if (e.target.tagName === "A") {
        e.preventDefault()
        categoryList.querySelectorAll("a").forEach(a => a.classList.remove("active-category"))
        e.target.classList.add("active-category")
        ApplyFilters()
    }
})

// ---------------- EVENT LISTENERS ---------------------
searchInput.addEventListener("input", ApplyFilters)
minPriceInput.addEventListener("input", ApplyFilters)
maxPriceInput.addEventListener("input", ApplyFilters)
manufacturerList.forEach(ch => ch.addEventListener("change", ApplyFilters))
sortButtons.forEach(btn => btn.addEventListener("click", () => SortProducts(btn.textContent.trim())))

// ---------------- INIT ---------------------
async function Init() {
    allProducts = await GetProducts()
    filteredProducts = [...allProducts]
    RenderProducts(allProducts)
}

Init()