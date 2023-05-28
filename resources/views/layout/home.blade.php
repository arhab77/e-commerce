<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/eshop/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/eshop/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/eshop/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/eshop/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/eshop/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="/eshop/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/eshop/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/eshop/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="/eshop/#"><img src="/eshop/img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="/eshop/#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="/eshop/#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="/eshop/img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="/eshop/#">Spanis</a></li>
                    <li><a href="/eshop/#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="/eshop/#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="/eshop/./index.html">Home</a></li>
                <li><a href="/eshop/./shop-grid.html">Shop</a></li>
                <li><a href="/eshop/#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="/eshop/./shop-details.html">Shop Details</a></li>
                        <li><a href="/eshop/./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="/eshop/./checkout.html">Check Out</a></li>
                        <li><a href="/eshop/./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="/eshop/./blog.html">Blog</a></li>
                <li><a href="/eshop/./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="/eshop/#"><i class="fa fa-facebook"></i></a>
            <a href="/eshop/#"><i class="fa fa-twitter"></i></a>
            <a href="/eshop/#"><i class="fa fa-linkedin"></i></a>
            <a href="/eshop/#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a><img src="/eshop/img/logo2.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <div class="text-center">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><a href="/cart">keranjang</a></li>
                                <li><a href="/orders">Order</a></li>
                            </ul>
                        </div>
                        
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li>
                                <div class="header__top__right__auth">
                                    @if (Auth::guard('webmember')->check())
                                        <a href="/profile"><i class="fa fa-user"></i> {{Auth::guard('webmember')->user()->nama_member}}</a>
                                    @else
                                        <a href="/login_member"><i class="fa fa-user"></i> login</a>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="header__top__right__auth">
                                    @if (Auth::guard('webmember')->check())
                                        <a href="/logout_member"><i class="fa fa-sign-out"></i></a>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    
    <!-- Hero Section End -->

    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="footer__widget">
                <div class="text-center">
                <h6>ig: @mh.fdhlarhb</h6>
            </div>
            </div>
            
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="/eshop/js/jquery-3.3.1.min.js"></script>
    <script src="/eshop/js/bootstrap.min.js"></script>
    <script src="/eshop/js/jquery.nice-select.min.js"></script>
    <script src="/eshop/js/jquery-ui.min.js"></script>
    <script src="/eshop/js/jquery.slicknav.js"></script>
    <script src="/eshop/js/mixitup.min.js"></script>
    <script src="/eshop/js/owl.carousel.min.js"></script>
    <script src="/eshop/js/main.js"></script>
    @stack('js')

</body>

</html>