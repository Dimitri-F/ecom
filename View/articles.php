<?php
include_once dirname(__DIR__) . '/Public/includes/head.php';
include_once dirname(__DIR__) . '/Public/includes/nav.php';


?>
<!-- component -->
<div class="bg-white">
  <div class="py-16 sm:py-24 lg:mx-auto lg:max-w-7xl lg:px-8">
    <div class="flex items-center justify-between px-4 sm:px-6 lg:px-0">
      <h2 class="text-2xl font-bold tracking-tight text-gray-900">Nos produits</h2>
    </div>

      <div class="inline-flex flex-col text-center my-12 lg:w-auto">
          <div class="group relative">
              <div class="w-64 mx-auto overflow-hidden rounded-md bg-gray-200">
                  <img src="https://tailwindui.com/img/ecommerce-images/home-page-02-product-01.jpg" alt="Black machined steel pen with hexagonal grip and small white logo at top." class="h-full w-full object-cover object-center group-hover:opacity-75">
              </div>
              <div class="mt-6">
                  <p class="text-sm text-gray-500">Black</p>
                  <h3 class="mt-1 font-semibold text-gray-900">
                      <a href="#">
                          <span class="absolute inset-0"></span>
                          Machined Pen
                      </a>
                  </h3>
                  <p class="mt-1 text-gray-900">$35</p>
              </div>
          </div>


      </div>



<?php include_once dirname(__DIR__) . '/Public/includes/footer.php'; ?>