<?php

?>

<!-- component -->
<header>

    <div class="grid py-4 px-2 lg:mx-4 xl:mx-12 place-content-end">
        <div class="">
            <nav class="flex items-center justify-between flex-wrap  ">
                <div class="block lg:hidden">
                    <button
                        class="navbar-burger flex items-center px-3 py-2 border rounded text-white border-white hover:text-white hover:border-white">
                        <svg class="fill-current h-6 w-6 text-gray-700" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <title>Menu</title>
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                        </svg>
                    </button>
                </div>
                <div id="main-nav" class="w-full flex-grow lg:flex items-center lg:w-auto hidden  ">
                    <div class="text-sm lg:flex-grow mt-2 animated jackinthebox xl:mx-8">
                        <a href="/"
                           class="block lg:inline-block text-md font-bold  text-gray-900  sm:hover:border-indigo-400  hover:text-orange-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                            ACCUEIL
                        </a>
                        <a href="/products"
                           class="block lg:inline-block text-md font-bold  text-gray-900  sm:hover:border-indigo-400  hover:text-orange-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                            ARTICLES
                        </a>
                        <a href="/about"
                           class="block lg:inline-block text-md font-bold  text-gray-900  sm:hover:border-indigo-400  hover:text-orange-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                            &Aacute; PROPOS
                        </a>
                        <?php if (!isset($_SESSION['userPseudo'])) : ?>
                        <a href="/login"
                           class="block lg:inline-block text-md font-bold text-gray-900  sm:hover:border-indigo-400  hover:text-orange-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                            SE CONNECTER
                        </a>
                        <?php else : ?>
                            <a href="/orders"
                               class="block lg:inline-block text-md font-bold  text-gray-900  sm:hover:border-indigo-400  hover:text-orange-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                                MES COMMANDES
                            </a>
                            <a href="/logout"
                               class="block lg:inline-block text-md font-bold  text-gray-900  sm:hover:border-indigo-400  hover:text-orange-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                                SE DECONNECTER
                            </a>
                        <?php endif; ?>
                        <a href="/cart"
                           class="block lg:inline-block text-md font-bold  text-gray-900  sm:hover:border-indigo-400  hover:text-orange-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                            <img src="/assets/images/cart.png">
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <?php if (isset($_SESSION['userPseudo'])) : ?>
    <h2 class="block lg:inline-block text-md font-bold text-gray-900 mx-2 p-1"> Bonjour, <?=$_SESSION['userPseudo']?></h2>
    <?php endif; ?>
</header>





<script>
    // Navbar Toggle
    document.addEventListener('DOMContentLoaded', function () {

        // Get all "navbar-burger" elements
        var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

            // Add a click event on each of them
            $navbarBurgers.forEach(function ($el) {
                $el.addEventListener('click', function () {

                    // Get the "main-nav" element
                    var $target = document.getElementById('main-nav');

                    // Toggle the class on "main-nav"
                    $target.classList.toggle('hidden');

                });
            });
        }

    });
</script>