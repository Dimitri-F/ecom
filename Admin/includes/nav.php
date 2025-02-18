<?php ?>

<!-- component -->
<header>
    <div class="grid py-4 px-2 lg:mx-4 xl:mx-12 place-content-end">
        <div>
            <nav class="flex items-center justify-between flex-wrap">
                <!-- Menu burger -->
                <div class="block lg:hidden">
                    <button
                        id="navbar-burger"
                        class="navbar-burger flex items-center px-3 py-2 border rounded text-gray-700 border-gray-700 hover:text-gray-900 hover:border-gray-900">
                        <!-- Icône des trois barres -->
                        <svg id="menu-icon" class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Menu</title>
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                        </svg>
                        <!-- Icône de la croix -->
                        <svg id="close-icon" class="fill-current h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Fermer</title>
                            <path d="M10 8.586l-4.293-4.293-1.414 1.414L8.586 10l-4.293 4.293 1.414 1.414L10 11.414l4.293 4.293 1.414-1.414L11.414 10l4.293-4.293-1.414-1.414L10 8.586z" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation principale -->
                <div id="main-nav" class="w-full flex-grow lg:flex items-center lg:w-auto hidden">
                    <div class="text-sm lg:flex-grow mt-2 animated jackinthebox xl:mx-8">
                        <a href="/admin/products"
                            class="block lg:inline-block text-md font-bold text-gray-900 sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg uppercase">
                            Produits
                        </a>
                        <a href="/admin/categories"
                            class="block lg:inline-block text-md font-bold text-gray-900 sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg uppercase">
                            Catégories
                        </a>
                        <a href="/admin/orders"
                            class="block lg:inline-block text-md font-bold text-gray-900 sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg uppercase">
                            Commandes
                        </a>
                        <a href="/admin/users"
                            class="block lg:inline-block text-md font-bold text-gray-900 sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg uppercase">
                            Utilisateurs
                        </a>
                        <?php if (!isset($_SESSION['userPseudo'])) : ?>
                            <a href="/login"
                                class="block lg:inline-block text-md font-bold text-gray-900 sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg uppercase">
                                Se connecter
                            </a>
                        <?php else : ?>
                            <a href="/logout"
                                class="block lg:inline-block text-md font-bold text-gray-900 sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg uppercase">
                                Se déconnecter
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <?php if (isset($_SESSION['userPseudo'])) : ?>
        <h2 class="block lg:inline-block text-md font-bold text-orange-600 ms-2 p-1"> Bonjour, <?= $_SESSION['userPseudo'] ?> :)</h2>
    <?php endif; ?>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbarBurger = document.getElementById('navbar-burger');
        const mainNav = document.getElementById('main-nav');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        navbarBurger.addEventListener('click', function() {
            // Basculer la visibilité du menu principal
            mainNav.classList.toggle('hidden');

            // Basculer les icônes
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    });
</script>