# StreetCrown 🧢

StreetCrown is a web application developed using Laravel, following the MVC architecture.
It allows users to browse products, manage a shopping cart, place orders, and interact with features such as reviews and wishlist.
An administrative panel is also included for managing products, categories, orders, and users.

---

## 📌 Features

### 👤 User

* View product catalog
* Filter and search products
* Add products to cart
* Manage wishlist
* Place orders
* Leave reviews

### 🔐 Authentication

* User registration and login
* Session management

### 🛒 Cart & Orders

* Add, update, and remove products from cart
* Checkout process
* Order history
* Order status tracking

### 🛠 Admin Panel

* Manage products (CRUD)
* Manage categories (CRUD)
* Manage users (roles)
* Manage orders (status updates)

---

## 🏗 Architecture

The project follows:

* MVC (Model-View-Controller)
* Service layer (CartService, OrderService, WishlistService)
* Form Requests for validation
* Policies for authorization

---

## 🗄 Database

The database is managed through:

* Laravel migrations
* Factories and seeders for mock data

Additionally, a SQL file with fictitious data has been included for evaluation purposes:

📁 `database/sql/fake_data_rows.sql`

---

## ⚙️ Installation

```bash
git clone <repository-url>
cd streetcrown

composer install
cp .env.example .env
php artisan key:generate

php artisan migrate --seed
php artisan serve
```

---

## 🧪 Notes

* All data included in the SQL file is fictitious.
* Formatting logic (prices, totals, dates) is handled in the models.
* Route parameters follow Laravel conventions (e.g., `{order}`, `{product}`).

---

## 👩‍💻 Authors

* Alyson Henao
* Samuel Moncada Mejía
* Emmanuel Cortes

---
