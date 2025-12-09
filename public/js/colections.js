// Sample product data
const products = [
    {

    }
]

// Function to fetch and render products
async function fetchProducts() {
    try {
        const response = await fetch('/api/products');
        const products = await response.json();

        renderProducts(products);
    } catch (error) {
        console.error('Error fetching products:', error);
    }
}

// Function to render products
function renderProducts(productsToRender) {
    const productGrid = document.getElementById('productGrid');
    productGrid.innerHTML = '';

    productsToRender.forEach(product => {
        const productCard = `
            <div class="product-card">
                <div class="product-image-wrapper">
                    <img src="${product.image}" alt="${product.name}" class="product-image">
                    ${product.discount ? `<div class="discount-tag">${product.discount}</div>` : ''}
                    ${product.is_mall ? '<div class="mall-tag">Mall</div>' : ''}
                    <div class="product-labels">
                        ${product.has_cashback ? '<span class="cashback">Cashback</span>' : ''}
                        ${product.has_free_shipping ? '<span class="free-shipping">Free Shipping</span>' : ''}
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-title">${product.name}</div>
                    <div class="price-section">
                        ${product.original_price > product.price ? `<div class="original-price">${formatPrice(product.original_price)}</div>` : ''}
                        <div class="current-price">${formatPrice(product.price)}</div>
                    </div>
                    <div class="product-stats">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            ${product.rating}
                        </div>
                        <div>Terjual ${product.sold_count}</div>
                    </div>
                    <div class="location">${product.location}</div>
                </div>
            </div>
        `;
        productGrid.innerHTML += productCard;
    });
}

// Function to format price
function formatPrice(price) {
    return `Rp${price.toLocaleString('id-ID', {
        useGrouping: true
    })}`;
}

// Call fetchProducts when DOM is ready
document.addEventListener('DOMContentLoaded', fetchProducts);


// Filter functions
function filterProducts() {
    let filteredProducts = [...products];
    
    const categoryFilter = document.getElementById('categoryFilter').value;
    const priceFilter = document.getElementById('priceFilter').value;
    const ratingFilter = document.getElementById('ratingFilter').value;
    const sortFilter = document.getElementById('sortFilter').value;

    // Apply category filter
    if (categoryFilter) {
        filteredProducts = filteredProducts.filter(product => 
            product.category === categoryFilter
        );
    }

    // Apply price filter
    if (priceFilter) {
        const [min, max] = priceFilter.split('-').map(Number);
        filteredProducts = filteredProducts.filter(product => {
            if (max) {
                return product.price >= min && product.price <= max;
            }
            return product.price >= min;
        });
    }

    // Apply rating filter
    if (ratingFilter) {
        filteredProducts = filteredProducts.filter(product =>
            product.rating >= Number(ratingFilter)
        );
    }

    // Apply sorting
    switch (sortFilter) {
        case 'price-low':
            filteredProducts.sort((a, b) => a.price - b.price);
            break;
        case 'price-high':
            filteredProducts.sort((a, b) => b.price - a.price);
            break;
        case 'rating':
            filteredProducts.sort((a, b) => b.rating - a.rating);
            break;
        default:
            // 'newest' - using ID as proxy for newness
            filteredProducts.sort((a, b) => b.id - a.id);
    }

    renderProducts(filteredProducts);
}

// Add event listeners
document.getElementById('categoryFilter').addEventListener('change', filterProducts);
document.getElementById('priceFilter').addEventListener('change', filterProducts);
document.getElementById('ratingFilter').addEventListener('change', filterProducts);
document.getElementById('sortFilter').addEventListener('change', filterProducts);

// Initial render
renderProducts(products);