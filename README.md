<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



System analies:
User: (create account, log in, view books, verfiy account, view categories, add to cart, view publishers, rate books, view authors, pay, logout)
admin: (add/update/delete book, add/update/delete category, add/update/delete publishers, add/update/delete users, add/update/delete authors)

Database tables:
Books:
    - ID
    - category_id
    - publish_id
    - title
    - isbn
    - desciption
    - publish_year
    - number_of_pages
    - number_of_copies
    - price
    - cover_image
authors:
    - id
    - name
    - image
    - description
categories:
    - id
    - name
    - desciption
publishers:
    - id
    - name
    - address
users:
    - id
    - name
    - email
    - password
    - role (user, admin)
book_author:
    - id
    - author_id
    - book_id
book_user:
    - id
    - user_id
    - book_id
    - number_of_copies
    - Bought
    - price
ratings:
    - id
    - user_id
    - book_id
    - value

Database relationships:
books - authors = many-to-many
books - categories = one-to-many
books - publishers = one-to-many
books - users = many-to-many

Steps:
    - Create models for each database
    - Create Controllers
    - Link models to relationship
    - Create Route
    - Create controller for home page
    - Create Seeder
    - Create views


Create the views:
    - layouts/main.blade.php
    - useing bootstrap for design
    - add google fonts
    - use fontawesome
    - add navigation bar
    - change route from dashbaord to layouts.main
    - add user icon dropdown on navigation
Make Seeders:
    - Create seeders for auther, book, category, publisher
Create home page:
    - Create gallaryController
    - View books on grid with title from index Gallery Class
    - Add bootstrap card
    - Create search route
    - Create form search on gallary
Create Inner pages
    - book page
    - ordering the book based on categories
    - categories page
        - make list function on CategoryController
            - get all categories sort by name
            - categories index
        - Create search fucntion on CategoryController
            - get categories from query and sortby name
        - Create index page category
    - publishers page
    - authors page

Create dashbaord
    - Create theme on views folder
        - default main page
        - footer section
        - header section
        - sidebar section
    - Dashbaord Sidebar items:
        - Logo site
        - mainPage analises
        - books table
        - publishers table
        - authors table
        - categories table
        - Users table
        - Selles
    - Add flash message on begin page content when Session has
    - Add @yield('title')

    - Create adminsController
        - Index-return, books, authors, categories, authors count.
        - Create /admin route adminCont
        - Create admin/index views
    - Create route /admin/books BookController
        - Create view inside admin books/index
        - Create button delete form on books table
        - Create column edit button on books table
        - Use datatables.net
        - Arabic.json cdn
    - Create route admin/books/create
        - Create view admin/books/create
        - On create function on bookController return all publishers, categories, authors
        - Create form create new book with /@error
    - Create Post route admin/books on store function
        - Add intervention image for edit image
        - Create App/Traits/ImageUploadTrait.php
        - Use imageuploadtraits
        - Use attach function for create author_book
        - Add session flash “book created successfully “
        - Add image holder to show user the image choosed with Javascript
    
    - Create route admin/books/{book}
        - Create view admin/books/show
    
    - Create route admin/books/{book} /edit
        - Create view admin/books/edit
        - Create patch route admin/books/{book} for update
        - On update function Check image before update book
        - Detach authors before update book
        - Check for isbn isDirty before update book

    - Create delete route admin/books/{book}
        - Delete cover image before delete book

    - Create Resources for all publishers, authors, categories
    - Make a middleware checkUpdatePermission to do not let the user to access on dashboard.
    - Create route for users and views to show table, Update the user role, and delete the Users by admin.
    - admin no one can delete it

Rating
- Create model for Rating
- create rate, ratings function on Book model
- sum all ratings and divide on itself on rate function
- create rated, ratings, bookRating function on user modal
- Create 5 stars on book card
- add style css on stars
- Create POST route /book/{book}/rate
- create rate functino on bookController
- @auth Create form after check (if user rated this book ?) for user to rate book on books details
- Add style css on rating-stars
- Send rate request from AJAX to avoid page refresh
- Go to link ajax.googleapis.com
- Add the script link into main.layout
- Create ajax script into book details
- Add meta token into main.layout head tag
- Add toastr.js and toastr.css cdn into main.layout

Cart
- Create post route to addToCart
    - Create function bookInCart on user model return book
    - Create cartController 
    - Add middleware auth for cartController
    - Create button for add to cart on book details
    - Add some CSS style on .bg-cart
    - Create AJAX script for add book to cart
    - Create cart icon and redirect to cart.view if user auth on main.layout
    - Add couter on cart icon
- Create get Route /cart with name cart.view
    - Add href on cart button on navbar
    - Create Post Route /removeOne/{book} with name cart.remove_one
    - Create Post Route /removeAll/{book} with name cart.remove_all
    - Create viewCart function on CartController
    - Create removeOne function on CartController
    - Create removeAll function on CartController
    - Create cart view
Create payment with paypal
    - Get the script from paypal dev and add to cart page
    - Create paypal account
    - Create paypal sandbox
    - Create business account and link into project
    - Add srmk live laravel paypal
    - Add srmk config into .env
    - Create API paypal route
    - create PurchaseController
    - create createPayment, ExecutePayment function PurchaseController
Create payment with Stripe
    - Install laravel casher
    - signup stripe account
    - Add stripe key and secrect key from stripe dashboard
    - Add use Billable on user model
    - Create function CreditCheckout on PurchaseController
    - Create Credit folder on view
    - Create file Checkout.blade.php
    - Create Route /checkout for checkout view with name credit.checkout
    - Create post Route /checkout for purchase function with name products.purchase
    - Create purchase function on PurchaseController
Send Email for complate the payment
    - using MailTrap
    - Add mailtrap config into .evn
    - Create mail OrderMail
    - Create view mails.order-mail
    - use OrderMail, Mail into PurchaseController
    - Create Mail function
Fix rated system
    - create ratedpurches on User modal
    - update details function on bookController
    - Update details book view
    - Use Auth to BookController
Add order views
    - create purchaseProduct function on user modal
    - Create route for myOrders
    - Update main view navlink myOrders
    - Create myOrders function on PurchaseController
    - Create myOrders view
Create admin purchase page
    - Create Shopping modal
    - Create route admin/allOrders
    - Update sidebar view
    - Create function allOrders on PurchaseController
    - use shopping modal to Purchase Controller
    - Create view allOrders on admin/books