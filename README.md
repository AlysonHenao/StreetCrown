# StreetCrown

StreetCrown is a web e-commerce application built with **Laravel 12**, following the MVC architecture with service layers, interfaces, and dependency injection.

It allows users to browse a cap catalog, manage a shopping cart, place orders, and leave reviews. It also includes a full admin panel and a REST API.

---

## Technologies

- **Backend:** PHP 8.2, Laravel 12
- **Frontend:** Blade, Bootstrap 5, Tailwind CSS, Vite
- **Database:** SQLite (development) / MySQL (production)
- **Other:** DomPDF (reports), Axios (AJAX), Google Maps Embed API

---

## Features

### User
- Product catalog with filters by name, category, and exclusivity
- Product detail page with reviews and ratings
- Shopping cart with real-time updates (AJAX)
- Wishlist
- Checkout process with payment method selection
- Order history with order detail view
- Editable profile with shipping information

### Authentication
- User registration and login
- Session management with remember token
- Roles: `admin` and `user`

### Cart
- Session-based cart (no login required to add products)
- Real-time quantity updates via AJAX
- Stock validation on add and update
- Automatic cart clear on order completion

### Orders
- Order creation from cart
- Automatic stock deduction on confirmation
- Statuses: `pending`, `paid`, `shipped`, `delivered`, `cancelled`

### Admin Panel
- Full CRUD for products and categories
- Order management (status updates)
- User management (role changes)
- Sales report generation in **PDF** and **Excel**

### Extras
- Top 3 best-selling products (home page and dedicated section)
- Top 3 highest-rated products
- Store locations map using Google Maps Embed
- Integration with external partner API (movies)
- Own REST API: `GET /api/products/available`

---

## Architecture

```
app/
├── Http/
│   ├── Controllers/        # MVC Controllers (user and admin)
│   ├── Requests/           # Form Requests with validation rules
│   └── Resources/          # API Resources (JSON transformation)
├── Interfaces/             # Service contracts
├── Models/                 # Eloquent models with getters/setters
├── Providers/              # AppServiceProvider, ReportServiceProvider
└── Services/
    ├── CartService.php             # Session-based cart logic
    ├── OrderService.php            # Order creation from cart
    ├── WishlistService.php         # Wishlist management
    ├── PartnerProductService.php   # External API consumption
    ├── StoreMapService.php         # Google Maps Embed URLs
    └── Reports/
        ├── PdfReportGenerator.php
        ├── ExcelReportGenerator.php
        └── ReportGeneratorFactory.php  # Strategy pattern
```

**Patterns used:**
- MVC with service layer
- Interfaces + dependency injection (AppServiceProvider)
- Form Requests for validation
- API Resources for JSON transformation
- Strategy Pattern for report generation

---

## Database

### Main tables

| Table | Description |
|-------|-------------|
| `users` | Users with roles and shipping data |
| `categories` | Product categories |
| `products` | Cap catalog |
| `orders` | Placed orders |
| `items` | Line items per order |
| `reviews` | Product reviews |
| `wishlists` | Favorite products per user |

### Setup options

**Option 1 — Migrations + Seeders:**
```bash
php artisan migrate:fresh --seed
```
Creates all tables and inserts 5 categories and 30 sample products.

**Option 2 — SQL file with fake data:**

Includes pre-built users, products, orders, and reviews.

> Test users from the SQL file:
> - **Admin:** `alyson.cuentas@gmail.com` / `password`
> - **User:** `samuel@gmail.com` / `password`

---

## Installation

### Requirements
- PHP 8.2+
- Composer
- Node.js 18+ and npm

### Steps

```bash
# 1. Clone the repository
git clone <repository-url>
cd streetcrown

# 2. Install PHP dependencies
composer install

# 3. Install PDF dependency (required for reports)
composer require barryvdh/laravel-dompdf

# 4. Install JS dependencies
npm install

# 5. Set up environment
cp .env.example .env
php artisan key:generate

# 6. Database (SQLite by default)
touch database/database.sqlite
php artisan migrate --seed

# 7. Build assets
npm run build

# 8. Start server
php artisan serve
```

Or using the setup script (after installing dompdf manually):
```bash
composer require barryvdh/laravel-dompdf
composer run setup
php artisan serve
```

### Relevant environment variables

```env
APP_LOCALE=es                        # App language (es / en)
PARTNER_PRODUCTS_API_URL=...         # External partner API URL (movies)
GOOGLE_MAPS_EMBED_API_KEY=...        # Google Maps Embed API Key
DB_CONNECTION=sqlite                 # sqlite or mysql
```

---

## Docker Deployment

```bash
docker build -t streetcrown .
docker run -p 8080:80 streetcrown
```

The Dockerfile includes Apache, PHP 8.2, Composer, Node.js, and SQLite. It runs migrations and builds assets automatically.

---

## API

### `GET /api/products/available`

Returns all products with available stock.

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Non Ea",
      "price": 347748,
      "formatted_price": "347.748 COP",
      "stock": 8,
      "image_url": "http://localhost/storage/default-cap.jpg",
      "product_url": "http://localhost/products/1",
      "category": {
        "id": 2,
        "name": "Exclusive"
      }
    }
  ]
}
```

---

## Testing

```bash
php artisan test
```

Included tests:

| Test | Type | Description |
|------|------|-------------|
| `AvailableProductsApiTest` | Feature | Verifies the API returns JSON with the correct structure |
| `ReportGeneratorFactoryTest` | Unit | Verifies the factory returns the correct generator by format |
| `StoreMapServiceTest` | Unit | Verifies Google Maps URLs are generated correctly |

---

## Authors

- **Alyson Henao** — Admin panel, product/category models, reports, admin views
- **Samuel Moncada Mejía** — Authentication, orders, reviews, wishlist, profile, routes
- **Emmanuel Cortés** — Cart, order service, API, external service integrations, store map