<?php


?>

    <div class="bg-white py-16 sm:py-24 lg:mx-auto lg:max-w-7xl lg:px-8">
        <div class="flex items-center justify-between px-4 sm:px-6 lg:px-0">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Nos produits</h2>
        </div>

        <?php if (!empty($products)) : ?>
            <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:gap-x-8">
                <?php foreach ($products as $product) : ?>
                    <div class="group relative">
                        <div class="w-full overflow-hidden rounded-md bg-gray-200 lg:h-80">
                            <img src="/uploads/<?= htmlspecialchars($product['photo']) ?>" alt="Black machined steel pen with hexagonal grip and small white logo at top." class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <p class="text-sm text-gray-500"><?php echo htmlspecialchars($product['id']); ?></p>
                                <h3 class="text-sm font-medium text-gray-900">
                                    <a href="/products_detail/<?=$product['id']?>">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        <?php echo htmlspecialchars($product['name']); ?>
                                    </a>
                                </h3>
                            </div>
                            <p class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($product['price']); ?> €</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="mt-8 text-center text-gray-500">Aucun article trouvé.</p>
        <?php endif; ?>
    </div>
