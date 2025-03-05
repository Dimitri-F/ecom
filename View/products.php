<?php


?>


<div class="bg-white lg:mx-auto lg:max-w-7xl lg:px-8 my-5">

    <h1 class="text-center text-4xl font-bold tracking-tight text-gray-900 ">Nos produits</h1>

    <?php if (!empty($products)) : ?>
        <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:gap-x-8">
            <?php foreach ($products as $product) : ?>
                <div class="shadow-xl p-2 rounded">
                    <a href="/products_detail/<?= $product['id'] ?>" class="group block">
                        <img
                            src="/uploads/<?= htmlspecialchars($product['photo']) ?>"
                            alt=""
                            class="aspect-square w-full rounded object-cover" />

                        <div class="mt-3">
                            <h2 class="font-medium text-gray-500">
                                <?php echo htmlspecialchars($product['category_name']); ?>
                            </h2>
                            <h3 class="font-medium text-gray-900 group-hover:underline group-hover:underline-offset-4">
                                <?php echo htmlspecialchars($product['name']); ?>
                            </h3>

                            <p class="mt-1 text-sm text-gray-700"><?php echo htmlspecialchars($product['price']); ?> €</p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p class="mt-8 text-center text-gray-500">Aucun article trouvé.</p>
    <?php endif; ?>
</div>