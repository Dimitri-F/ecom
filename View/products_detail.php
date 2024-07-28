<?php ?>
<!-- component -->
<a href="/products">Retour à la liste d'articles</a>
<?php if (!empty($product)) : ?>
<div class="flex min-h-screen items-center justify-center bg-gray-100">

    <div class="flex font-sans">
        <div class="flex-none w-48 relative">
            <img src="https://images.unsplash.com/photo-1699412958387-2fe86d46d394?q=80&w=3329&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="absolute inset-0 w-full h-full object-cover" loading="lazy" />
        </div>
        <form class="flex-auto p-6">
            <div class="flex flex-wrap">
                <h1 class="flex-auto text-xl font-semibold text-gray-900">
                    <?php echo htmlspecialchars($product['name']); ?>
                </h1>
                <div class="text-lg font-semibold text-black-500">
                    <p>
                        <?php echo htmlspecialchars($product['price']); ?> €
                    </p>

                </div>
                <div class="w-full flex-none text-sm font-medium text-black-700 mt-2">
                    In stock
                </div>
            </div>

            <div class="flex space-x-4 mb-6 text-sm font-medium">
                <div class="flex-auto flex space-x-4">
                    <button class="h-10 px-6 font-semibold rounded-md border border-balck-800 text-gray-900" type="button">
                        Add to cart
                    </button>
                </div>
                <button class="flex-none flex items-center justify-center w-9 h-9 rounded-md text-slate-300 border border-slate-200" type="button" aria-label="Favorites">
                    <svg width="20" height="20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                    </svg>
                </button>
            </div>
            <p class="text-sm text-slate-700">
                Free shipping
            </p>
        </form>
    </div>
</div>
<?php else : ?>
    <p class="mt-8 text-center text-gray-500">Aucun article trouvé.</p>
<?php endif; ?>