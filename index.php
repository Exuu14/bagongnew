 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street&Style.home</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
      
      /* Login/Signup Modal Styles */
        .modal {
            display: none;
            position: flex;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: linear-gradient(135deg, #8a7a7a
             0%, #8a7a7a 100%);
            margin: 5% auto;
            padding: 0;
            border: none;
            border-radius: 20px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 30px 30px 20px;
            text-align: center;
            color: white;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        .modal-body {
            padding: 20px 30px 40px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: white;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .auth-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }

        .auth-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(238, 90, 82, 0.4);
        }

        .switch-form {
            text-align: center;
            color: white;
            margin-top: 20px;
        }

        .switch-form a {
            color: #ffd700;
            text-decoration: none;
            font-weight: 600;
        }

        .switch-form a:hover {
            text-decoration: underline;
        }

        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .user-menu {
            position: relative;
            display: none;
        }

        .user-menu.active {
            display: block;
        }

        .user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            min-width: 150px;
            z-index: 100;
            display: none;
        }

        .user-dropdown.active {
            display: block;
        }

        .user-dropdown a {
            display: block;
            padding: 12px 16px;
            color: #333;
            text-decoration: none;
            border-bottom: 1px solid #eee;
        }

        .user-dropdown a:hover {
            background: #f5f5f5;
        }

        .user-dropdown a:last-child {
            border-bottom: none;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            display: none;
        }

        .alert.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .auth-section {
    margin-left: 15px; /* Adjust spacing as needed */
    display: inline;
}
.auth-section a#login-btn {
    font-size: 16px; /* Match other nav links */
    padding: 10px; /* Adjust as needed */
    color: inherit; /* Match nav link color */
}
  .user-menu {
    position: relative;
    display: none;
}

.user-menu.active {
    display: flex; /* Use flex to align with other nav items */
    align-items: center;
}

.user-menu a#user-profile {
    font-size: 16px; /* Match other nav links */
    color: inherit; /* Match nav link color */
    text-decoration: none;
    padding: 10px; /* Adjust as needed */
}

.user-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    min-width: 150px;
    z-index: 100;
    display: none;
}

.user-dropdown.active {
    display: block;
} 
.nav-items {
    display: flex;
    align-items: center;
    gap: 15px; /* Adjust spacing between nav items */
}
</style>
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="index.html">
                <img src="images/logo.jpeg" style="height:85px; border-radius: 30px;" alt="Street&Style Logo">
            </a>
           <div class="hamburger" id="hamburger-menu">
                <i class="fas fa-bars"></i>
            </div>
            
            <div class="nav-items" id="nav-items">
                <a href="index.php"class="active" >Home</a>
                <a href="productM.php">Men</a>
                <a href="productW.php">Women</a>
                <a href="about.html">About</a>
                <a href="contact.html">Contact</a>
                
                <div class="auth-section" id="auth-section">
                    <a href="#" id="login-btn">
                        <i class="fas fa-user"></i> Login
                    </a>
                </div>
                
                <!-- User Menu (shown when logged in) -->
                <div class="user-menu" id="user-menu">
                    <a href="#" id="user-profile">
                        <i class="fas fa-user-circle"></i> <span id="username-display"></span>
                    </a>
                    <div class="user-dropdown" id="user-dropdown">
                     
                        <a href="#" id="logout-btn">Logout</a>
                    </div>
                </div>
            </div>
            <div class="cart-icon">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span>
            </div>
        </nav>
        
    </header>

    

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" id="closeLoginModal">&times;</span>
                <h2>Welcome to S&S </h2>
            </div>
            <div class="modal-body">
                <div class="alert" id="loginAlert"></div>
                <form id="loginForm">
                    <div class="form-group">
                        <label for="loginEmail">Email</label>
                        <input type="email" id="loginEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" id="loginPassword" name="password" required>
                    </div>
                    <button type="submit" class="auth-btn">Login</button>
                </form>
                <div class="switch-form">
                    Don't have an account? <a href="#" id="showSignup">Sign up here</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Signup Modal -->
    <div id="signupModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" id="closeSignupModal">&times;</span>
                <h2>Join Street&Style!</h2>
            </div>
            <div class="modal-body">
                <div class="alert" id="signupAlert"></div>
                <form id="signupForm">
                    <div class="form-group">
                        <label for="signupFirstName">First Name</label>
                        <input type="text" id="signupFirstName" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="signupLastName">Last Name</label>
                        <input type="text" id="signupLastName" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="signupUsername">Username</label>
                        <input type="text" id="signupUsername" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="signupEmail">Email</label>
                        <input type="email" id="signupEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="signupPassword">Password</label>
                        <input type="password" id="signupPassword" name="password" required minlength="6">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirm_password" required>
                    </div>
                    <button type="submit" class="auth-btn">Sign Up</button>
                </form>
                <div class="switch-form">
                    Already have an account? <a href="#" id="showLogin">Login here</a>
                </div>
            </div>
        </div>
    </div>

    <div class="slider-container">
        <div class="slider">
            <div class="slide active">
                <img src="images/fashion.png" alt="Fashion collection">
                <div class="slide-caption">
                    <h3>Summer Collection 2025</h3>
                    <p>Explore our latest summer styles</p>
                </div>
            </div>
            <div class="slide">
                <img src="images/newarrivals.jpg" alt="New arrivals">
                <div class="slide-caption">
                    <h3>New Arrivals</h3>
                    <p>Check out what's trending this season</p>
                </div>
            </div>
            <div class="slide">
                <img src="images/model1.jpg" alt="Special discount">
                <div class="slide-caption">
                    <h3>Special Discounts</h3>
                    <p>Up to 50% off on selected items</p>
                </div>
            </div>
            <div class="slide">
                <img src="images/haerin.jpg" alt="Fashion model">
                <div class="slide-caption">
                    <h3>Premium Brands</h3>
                    <p>Discover our exclusive collections</p>
                </div>
            </div>
        </div>
        
        <div class="slider-arrow slider-prev">
            <i class="fas fa-chevron-left"></i>
        </div>
        <div class="slider-arrow slider-next">
            <i class="fas fa-chevron-right"></i>
        </div>
    </div>
    
    <div class="slider-nav">
        <div class="slider-dot active"></div>
        <div class="slider-dot"></div>
        <div class="slider-dot"></div>
        <div class="slider-dot"></div>
    </div>

    <section id="productsmen" class="productsmen">
        <h2>Featured Products</h2>
        <div class="product-grid" id="product-grid"></div>
    </section>

    <section class="newsletter">
        <h3>Subscribe to Our Newsletter</h3>
        <p>Get updates on new arrivals and special promotions!</p>
        <form id="newsletterForm">
            <input type="email" id="newsletterEmail" placeholder="Your email address" required>
            <button type="submit">Subscribe</button>
        </form>
    </section>

    <div class="cart-sidebar" id="cart-sidebar">
        <div class="cart-header">
            <h3>Your Cart</h3>
            <button class="close-cart">&times;</button>
        </div>
        <div class="cart-items" id="cart-items"></div>
        <div class="cart-total">
            <p>Total: $<span id="cart-total-amount">0.00</span></p>
            <button class="checkout-button">Checkout</button>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <a href="about.html">About us</a>
                <p>Street&Style, Create your own Style be unique.</p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="productM.php">Products</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contact Us</h4>
                <p>Email: @Street&Style.online.com</p>
                <p>Phone: (555) 123-4567</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; S&S. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Authentication System
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
                // Modal controls
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

                // Form submissions
                document.getElementById('loginForm').addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.handleLogin();
                });

                document.getElementById('signupForm').addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.handleSignup();
                });

                // User menu
                document.getElementById('user-profile').addEventListener('click', (e) => {
                    e.preventDefault();
                    this.toggleUserDropdown();
                });

                document.getElementById('logout-btn').addEventListener('click', (e) => {
                    e.preventDefault();
                    this.handleLogout();
                });

                // Close modals when clicking outside
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
                    }
                } catch (error) {
                    console.error('Session check error:', error);
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

        // Initialize authentication system
        const auth = new AuthSystem();

        // Hamburger menu
        const hamburger = document.getElementById('hamburger-menu');
        const navItems = document.getElementById('nav-items');
        hamburger.addEventListener('click', function() {
            navItems.classList.toggle('active');
        });

        // Slider functionality
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
            
            nextBtn.addEventListener('click', function() {
                currentSlide = (currentSlide + 1) % slides.length;
                updateSlider();
            });
            
            prevBtn.addEventListener('click', function() {
                currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                updateSlider();
            });
            
            dots.forEach((dot, index) => {
                dot.addEventListener('click', function() {
                    currentSlide = index;
                    updateSlider();
                });
            });
            
            setInterval(function() {
                currentSlide = (currentSlide + 1) % slides.length;
                updateSlider();
            }, 5000);
        });

        // Product and cart functionality
        const products = [
            {
                id: 1,
                name: "Summer style jeans",
                price: 20,
                image: "images/haerin.jpg",
            },
            {
                id: 2,
                name: "Jump suit",
                price: 14.99,
                image: "images/karina.jpg",
            },
            {
                id: 3,
                name: "Crop top",
                price: 5.45,
                image: "images/mica.jpg",
            },
            {
                id: 4,
                name: "Wind breaker",
                price: 7.35,
                image: "images/parkbogum.jpg",
            }
        ];

        let cart = [];

        // Cart elements
        const productGrid = document.getElementById('product-grid');
        const cartSidebar = document.getElementById('cart-sidebar');
        const cartItems = document.getElementById('cart-items');
        const cartCount = document.querySelector('.cart-count');
        const cartTotalAmount = document.getElementById('cart-total-amount');
        const cartIcon = document.querySelector('.cart-icon');
        const closeCartBtn = document.querySelector('.close-cart');

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

        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateCart();
        }

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

        function updateCart() {
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

        displayProducts();
        updateCart();

        // Checkout functionality
        document.querySelector('.checkout-button').addEventListener('click', function() {
            if (cart.length === 0) {
                alert('Your cart is empty!');
                return;
            }

            if (!auth.currentUser) {
                alert('Please login to checkout.');
                auth.showLoginModal();
                return;
            }

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
            updateCart();
            hideCart();
        });

        // Newsletter subscription
        document.getElementById('newsletterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('newsletterEmail').value;
            
            // Here you would typically send this to your PHP script
            alert('Thank you for subscribing with email: ' + email);
            document.getElementById('newsletterEmail').value = '';
        });
    </script>
</body>
</html>