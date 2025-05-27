// Authentication System (unchanged)
class AuthSystem {
    constructor() {
        this.currentUser = null;
        this.init();
    }

    init() {
        this.bindEvents();
        this.checkLoginStatus();
    }

    bindEvents() {
        document.getElementById('login-btn').addEventListener('click', (e) => {
            e.preventDefault();
            this.showLoginModal();
        });

        document.getElementById('closeLoginModal').addEventListener('click', () => {
            this.hideLoginModal();
        });

        document.getElementById('closeSignupModal').addEventListener('click', () => {
            this.hideSignupModal();
        });

        document.getElementById('showSignup').addEventListener('click', (e) => {
            e.preventDefault();
            this.hideLoginModal();
            this.showSignupModal();
        });

        document.getElementById('showLogin').addEventListener('click', (e) => {
            e.preventDefault();
            this.hideSignupModal();
            this.showLoginModal();
        });

        document.getElementById('loginForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleLogin();
        });

        document.getElementById('signupForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleSignup();
        });

        document.getElementById('user-profile').addEventListener('click', (e) => {
            e.preventDefault();
            this.toggleUserDropdown();
        });

        document.getElementById('logout-btn').addEventListener('click', (e) => {
            e.preventDefault();
            this.handleLogout();
        });

        window.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal')) {
                this.hideLoginModal();
                this.hideSignupModal();
            }
        });
    }

    showLoginModal() {
        document.getElementById('loginModal').style.display = 'block';
    }

    hideLoginModal() {
        document.getElementById('loginModal').style.display = 'none';
        this.clearAlerts();
    }

    showSignupModal() {
        document.getElementById('signupModal').style.display = 'block';
    }

    hideSignupModal() {
        document.getElementById('signupModal').style.display = 'none';
        this.clearAlerts();
    }

    async handleLogin() {
        const formData = new FormData(document.getElementById('loginForm'));
        try {
            const response = await fetch('login.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.success) {
                this.currentUser = result.user;
                this.updateUIAfterLogin();
                this.hideLoginModal();
                this.showAlert('loginAlert', 'Login successful!', 'success');
                // Merge guest cart to user cart after login
                await mergeGuestCart();
                await updateCart();
            } else {
                this.showAlert('loginAlert', result.message, 'error');
            }
        } catch (error) {
            this.showAlert('loginAlert', 'Connection error. Please try again.', 'error');
        }
    }

    async handleSignup() {
        const password = document.getElementById('signupPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (password !== confirmPassword) {
            this.showAlert('signupAlert', 'Passwords do not match.', 'error');
            return;
        }

        const formData = new FormData(document.getElementById('signupForm'));
        try {
            const response = await fetch('signup.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.success) {
                this.showAlert('signupAlert', 'Account created successfully!', 'success');
                setTimeout(() => {
                    this.hideSignupModal();
                    this.showLoginModal();
                }, 2000);
            } else {
                this.showAlert('signupAlert', result.message, 'error');
            }
        } catch (error) {
            this.showAlert('signupAlert', 'Connection error. Please try again.', 'error');
        }
    }

    async handleLogout() {
        try {
            const response = await fetch('logout.php', {
                method: 'POST'
            });
            const result = await response.json();
            if (result.success) {
                this.currentUser = null;
                this.updateUIAfterLogout();
                await updateCart();
            }
        } catch (error) {
            console.error('Logout error:', error);
        }
    }

    async checkLoginStatus() {
        try {
            const response = await fetch('check_session.php');
            const result = await response.json();
            if (result.logged_in) {
                this.currentUser = result.user;
                this.updateUIAfterLogin();
                await mergeGuestCart();
                await updateCart();
            } else {
                await updateCart();
            }
        } catch (error) {
            console.error('Session check error:', error);
            await updateCart();
        }
    }

    updateUIAfterLogin() {
        document.getElementById('auth-section').style.display = 'none';
        document.getElementById('user-menu').classList.add('active');
        document.getElementById('username-display').textContent = this.currentUser.username;
    }

    updateUIAfterLogout() {
        document.getElementById('auth-section').style.display = 'block';
        document.getElementById('user-menu').classList.remove('active');
        document.getElementById('user-dropdown').classList.remove('active');
    }

    toggleUserDropdown() {
        document.getElementById('user-dropdown').classList.toggle('active');
    }

    showAlert(elementId, message, type) {
        const alert = document.getElementById(elementId);
        alert.textContent = message;
        alert.className = `alert ${type}`;
        alert.style.display = 'block';
        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000);
    }

    clearAlerts() {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.display = 'none';
        });
    }
}

// Cart System
const products = [
    { id: 1, name: "Baggy Jeans", price: 23, image: "images/model1.jpg" },
    { id: 2, name: "Baggy Jeans", price: 14.99, image: "images/Ripped.jpg" },
    { id: 3, name: "Strap shirt", price: 10, image: "images/model3.jpg" },
    { id: 4, name: "Gray shirt", price: 3.99, image: "images/model4a.jpg" },
    { id: 5, name: "Hoddie", price: 7, image: "images/hoodie.jpg" },
    { id: 6, name: "Plain black shirt", price: 2, image: "images/gongyo.jpg" },
    { id: 7, name: "Sando", price: 4.99, image: "images/cha.jpg" },
    { id: 8, name: "Wind breaker", price: 7.35, image: "images/parkbogum.jpg" },
];

const productGrid = document.getElementById('product-grid');
const cartSidebar = document.getElementById('cart-sidebar');
const cartItems = document.getElementById('cart-items');
const cartCount = document.querySelector('.cart-count');
const cartTotalAmount = document.getElementById('cart-total-amount');
const cartIcon = document.querySelector('.cart-icon');
const closeCartBtn = document.querySelector('.close-cart');

async function fetchCart() {
    try {
        const response = await fetch('cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=get_cart'
        });
        const result = await response.json();
        if (result.success) {
            return result.cart;
        } else {
            console.error(result.message);
            return [];
        }
    } catch (error) {
        console.error('Error fetching cart:', error);
        return [];
    }
}

async function mergeGuestCart() {
    try {
        const response = await fetch('cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=merge_guest_cart'
        });
        const result = await response.json();
        if (!result.success) {
            console.error(result.message);
        }
    } catch (error) {
        console.error('Error merging guest cart:', error);
    }
}

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

async function addToCart(productId) {
    try {
        const response = await fetch('cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=add_to_cart&product_id=${productId}&quantity=1`
        });
        const result = await response.json();
        if (result.success) {
            await updateCart();
            showCart();
        } else {
            alert(result.message);
        }
    } catch (error) {
        alert('Error adding to cart');
    }
}

async function removeFromCart(cartItemId, productId) {
    try {
        const response = await fetch('cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=remove_from_cart&cart_item_id=${cartItemId}&product_id=${productId}`
        });
        const result = await response.json();
        if (result.success) {
            await updateCart();
        } else {
            alert(result.message);
        }
    } catch (error) {
        alert('Error removing from cart');
    }
}

async function updateQuantity(cartItemId, productId, newQuantity) {
    try {
        const response = await fetch('cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=update_quantity&cart_item_id=${cartItemId}&product_id=${productId}&quantity=${newQuantity}`
        });
        const result = await response.json();
        if (result.success) {
            await updateCart();
        } else {
            alert(result.message);
        }
    } catch (error) {
        alert('Error updating quantity');
    }
}

async function updateCart() {
    const cart = await fetchCart();
    cartItems.innerHTML = cart.map(item => `
        <div class="cart-item">
            <img src="${item.image}" alt="${item.name}" class="cart-item-image">
            <div class="cart-item-details">
                <h4 class="cart-item-title">${item.name}</h4>
                <p class="cart-item-price">$${Number(item.price).toFixed(2)}</p>
                <div class="cart-item-quantity">
                    <button class="quantity-btn" onclick="updateQuantity(${item.cart_item_id || 0}, ${item.product_id}, ${item.quantity - 1})">-</button>
                    <input type="number" class="quantity-input" value="${item.quantity}" 
                           onchange="updateQuantity(${item.cart_item_id || 0}, ${item.product_id}, this.value)">
                    <button class="quantity-btn" onclick="updateQuantity(${item.cart_item_id || 0}, ${item.product_id}, ${item.quantity + 1})">+</button>
                </div>
            </div>
            <button class="remove-item" onclick="removeFromCart(${item.cart_item_id || 0}, ${item.product_id})">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `).join('');

    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCount.textContent = totalItems;

    const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    cartTotalAmount.textContent = total.toFixed(2);
}

function showCart() {
    cartSidebar.classList.add('active');
}

function hideCart() {
    cartSidebar.classList.remove('active');
}

cartIcon.addEventListener('click', showCart);
closeCartBtn.addEventListener('click', hideCart);

document.addEventListener('click', (e) => {
    if (!cartSidebar.contains(e.target) && !cartIcon.contains(e.target)) {
        hideCart();
    }
});

document.querySelector('.checkout-button').addEventListener('click', async function() {
    const cart = await fetchCart();
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }

    const paymentMethod = prompt(
        "Select payment method:\n1. Credit/Debit Card\n2. GCash\n3. Cash on Delivery\n\nEnter 1, 2, or 3:"
    );

    if (paymentMethod === "1" || paymentMethod === "2" || paymentMethod === "3") {
        try {
            const response = await fetch('cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=clear_cart'
            });
            const result = await response.json();
            if (result.success) {
                alert(`You selected ${paymentMethod === "1" ? "Credit/Debit Card" : paymentMethod === "2" ? "GCash" : "Cash on Delivery"}.\nThank you for your purchase! Total: $${cartTotalAmount.textContent}`);
                await updateCart();
                hideCart();
            } else {
                alert(result.message);
            }
        } catch (error) {
            alert('Error during checkout');
        }
    } else {
        alert("Checkout cancelled or invalid payment method.");
    }
});

// Slider (unchanged)
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slider-dot');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    let currentSlide = 0;
    
    function updateSlider() {
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            currentSlide = (currentSlide + 1) % slides.length;
            updateSlider();
        });
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            updateSlider();
        });
    }
    
    dots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            currentSlide = index;
            updateSlider();
        });
    });
    
    setInterval(function() {
        currentSlide = (currentSlide + 1) % slides.length;
        updateSlider();
    }, 3000);
});

// Initialize
const auth = new AuthSystem();
displayProducts();
updateCart();