// Sample product data
const products = [
    {
        id: 1,
        name: "Baggy Jeans",
        price: 23,
        image: "images/model1.jpg",
    },
    {
        id: 2,
        name: " baggy Jeans",
        price: 14.99,
        image: "images/Ripped.jpg",
    },
    {
        id: 3,
        name: "Strap shirt",
        price: 10,
        image : "images/model3.jpg",
    },
    {
        id: 4,
        name: "Gray shirt",
        price: 3.99,
        image :"images/model4a.jpg",
    },
    {
        id: 5,
        name: "Hoddie",
        price: 7,
        image :"images/hoodie.jpg",
    },  
    {
        id: 6,
        name: "Plain  black shirt",
        price: 2,
        image : "images/gongyo.jpg",
    },
    {
        id: 7,
        name: "Sando",
        price: 4.99,
        image :"images/cha.jpg",
    },  
    {
        id: 8,
        name: "wind breaker",
        price: 7.35,
        image :"images/parkbogum.jpg",
    },  
        { id: 9, name: "Summer Style Jeans", price: 20.00, image: "images/haerin.jpg" },
                { id: 10, name: "Jumpsuit", price: 14.99, image: "images/karina.jpg" },
                { id: 11, name: "Crop Top", price: 5.45, image: "images/mica.jpg" },
                { id: 12, name: "Gray & White Tank Top", price: 7.59, image: "images/hanni.jpg" },
                { id: 13, name: "Sweater Set", price: 15.54, image: "images/momo.jpg" },
                { id: 14, name: "Polo Shirt", price: 8.69, image: "images/vanessa.jpg" },
                { id: 15, name: "Tambay Cap", price: 7.80, image: "images/winter.jpg" },
                { id: 16, name: "Cuddle Sweater", price: 7.00, image: "images/chaewon.jpg" },
];

// Shopping cart functionality with localStorage persistence
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// DOM Elements
const productGrid = document.getElementById('product-grid');
const cartSidebar = document.getElementById('cart-sidebar');
const cartItems = document.getElementById('cart-items');
const cartCount = document.querySelector('.cart-count');
const cartTotalAmount = document.getElementById('cart-total-amount');
const cartIcon = document.querySelector('.cart-icon');
const closeCartBtn = document.querySelector('.close-cart');

// Display products
function displayProducts() {
    productGrid.innerHTML = products.map(product => `
        <div class="product-card">
            <img src="${product.image}" alt="${product.name}" class="product-image">
            <div class="product-info">
                <h3 class="product-title">${product.name}</h3>
                <p class="product-price">$${product.price.toFixed(2)}</p>
                <button class="add-to-cart" onclick="addToCart(${product.id})">
                    Add to Cart
                </button>
            </div>
        </div>
    `).join('');
}

// Add to cart functionality
function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    const existingItem = cart.find(item => item.id === productId);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            ...product,
            quantity: 1
        });
    }

    updateCart();
    showCart();
}

// Remove from cart functionality
function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    updateCart();
}

// Update quantity functionality
function updateQuantity(productId, newQuantity) {
    const item = cart.find(item => item.id === productId);
    if (item) {
        if (newQuantity > 0) {
            item.quantity = Number(newQuantity);
        } else {
            removeFromCart(productId);
        }
        updateCart();
    }
}

// Save cart to localStorage
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Update cart display
function updateCart() {
    // Update cart items
    cartItems.innerHTML = cart.map(item => `
        <div class="cart-item">
            <img src="${item.image}" alt="${item.name}" class="cart-item-image">
            <div class="cart-item-details">
                <h4 class="cart-item-title">${item.name}</h4>
                <p class="cart-item-price">$${item.price.toFixed(2)}</p>
                <div class="cart-item-quantity">
                    <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
                    <input type="number" class="quantity-input" value="${item.quantity}" 
                           onchange="updateQuantity(${item.id}, this.value)">
                    <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                </div>
            </div>
            <button class="remove-item" onclick="removeFromCart(${item.id})">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `).join('');

    // Update cart count
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCount.textContent = totalItems;

    // Update total amount
    const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    cartTotalAmount.textContent = total.toFixed(2);

    // Save cart to localStorage
    saveCart();
}

// Show/hide cart sidebar
function showCart() {
    cartSidebar.classList.add('active');
}

function hideCart() {
    cartSidebar.classList.remove('active');
}

// Event listeners
cartIcon.addEventListener('click', showCart);
closeCartBtn.addEventListener('click', hideCart);

// Close cart when clicking outside
document.addEventListener('inactive', (e) => {
    if (!cartSidebar.contains(e.target) && !cartIcon.contains(e.target)) {
        hideCart();
    }
});

// Initialize the page
displayProducts();
updateCart(); 

// Slider functionality
document.addEventListener('DOMContentLoaded', function() {
            // Slider functionality
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.slider-dot');
            const prevBtn = document.querySelector('.slider-prev');
            const nextBtn = document.querySelector('.slider-next');
            let currentSlide = 0;
            
            // Function to update the slider
            function updateSlider() {
                // Remove active class from all slides and dots
                slides.forEach(slide => slide.classList.remove('active'));
                dots.forEach(dot => dot.classList.remove('active'));
                
                // Add active class to current slide and dot
                slides[currentSlide].classList.add('active');
                dots[currentSlide].classList.add('active');
            }
            
            // Next button click event
            nextBtn.addEventListener('click', function() {
                currentSlide = (currentSlide + 1) % slides.length;
                updateSlider();
            });
            
            // Previous button click event
            prevBtn.addEventListener('click', function() {
                currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                updateSlider();
            });
            
            // Dot click events
            dots.forEach((dot, index) => {
                dot.addEventListener('click', function() {
                    currentSlide = index;
                    updateSlider();
                });
            });
            
            // Auto-play slider
            setInterval(function() {
                currentSlide = (currentSlide + 1) % slides.length;
                updateSlider();
            }, 3000); // Change slide every 5 seconds
        });
        
 document.querySelector('.check-btn').addEventListener('click', () => {
  if (cart.length === 0) {
    alert('Your cart is empty!');
    return;
  }
  
  alert('Thank you for your purchase! Total: ₱' + cartTotal.toLocaleString());
  cart = [];
  updateCartDisplay();
  updateCounter();
  cartTab.classList.remove('active');
  overlay.classList.remove('active');
});

cartTab.addEventListener('click', () => {
  cartTab.classList.toggle('active');
  overlay.classList.toggle('active');
});

// Checkout button with payment methods
document.querySelector('.checkout-button').addEventListener('click', function() {
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }

    // Show payment method selection
    const paymentMethod = prompt(
        "Select payment method:\n1. Credit/Debit Card\n2. GCash\n3. Cash on Delivery\n\nEnter 1, 2, or 3:"
    );

    if (paymentMethod === "1") {
        alert("You selected Credit/Debit Card.\nThank you for your purchase! Total: $" + cartTotalAmount.textContent);
    } else if (paymentMethod === "2") {
        alert("You selected GCash.\nThank you for your purchase! Total: $" + cartTotalAmount.textContent);
    } else if (paymentMethod === "3") {
        alert("You selected Cash on Delivery.\nThank you for your purchase! Total: $" + cartTotalAmount.textContent);
    } else {
        alert("Checkout cancelled or invalid payment method.");
        return;
    }

    cart = [];
    saveCart();
    updateCart();
    hideCart();
});

document.addEventListener('DOMContentLoaded', function() {
    // Fade in on load
    document.body.classList.remove('fade-out');
    // Add transition to all internal links
    document.querySelectorAll('a[href]').forEach(function(link) {
        // Only apply to local links (not external or anchors)
        if (
            link.hostname === window.location.hostname &&
            !link.href.includes('productM.html') &&
            !link.target
        ) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.body.classList.add('fade-out');
                setTimeout(function() {
                    window.location = link.href;
                }, 400); // Match the CSS transition duration
            });
        }
    });
});
// Start with fade-out for smooth transition
document.body.classList.add('fade-out');
