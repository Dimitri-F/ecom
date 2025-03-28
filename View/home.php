<?php

?>

<div class="relative flex items-center justify-center">
    <img src="assets/images/home.jpg" alt="Home Image" class="max-w-full h-full rounded-lg shadow-lg">
    <h1 class="absolute lg:top-20 text-white bg-gray-500 bg-opacity-50 px-6 py-3 text-5xl font-medium text-center rounded">
        Bienvenue !
    </h1>
    <p class="absolute lg:bottom-25 text-white bg-gray-500 bg-opacity-50 px-6 py-3 text-2xl font-medium text-center rounded hidden lg:block animate-pulse">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis justo diam. Duis in convallis nisi, eu sollicitudin nunc. Praesent vel mauris sit amet erat rhoncus vulputate ut nec neque.
    </p>
    <a class="absolute text-2xl lg:bottom-5 text-orange-500 bg-white px-2 py-3 rounded shadow-xl hidden lg:block animate-bounce" href=" /products">Vers la boutique</a>
</div>


<!-- Testimonials Section -->
<section class="bg-white">
    <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <h2 class="text-center text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
            Les avis de nos clients
        </h2>

        <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-3 md:gap-8">
            <!-- Testimonial 1 -->
            <blockquote class="rounded-lg bg-gray-50 p-6 shadow-xl sm:p-8">
                <div class="flex items-center gap-4">
                    <img
                        alt="User Image"
                        src="https://images.unsplash.com/photo-1595152772835-219674b2a8a6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1180&q=80"
                        class="h-14 w-14 rounded-full object-cover" />
                    <div>
                        <div class="flex justify-center gap-0.5 text-orange-500">
                            <!-- Star rating  -->
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            <?php endfor; ?>
                        </div>
                        <p class="mt-0.5 text-lg font-medium text-gray-900">Paul Starr</p>
                    </div>
                </div>

                <p class="mt-4 text-gray-700">
                    Entier neque justo, finibus id orci et, sollicitudin lobortis enim. Pellentesque ut fermentum mauris. Fusce commodo mauris ut aliquam mattis. Pellentesque scelerisque arcu eu lorem cursus laoreet.
                </p>
            </blockquote>

            <blockquote class="rounded-lg bg-gray-50 p-6 shadow-xl sm:p-8">
                <div class="flex items-center gap-4">
                    <img
                        alt="User Image"
                        src="https://images.unsplash.com/photo-1728075770776-33201a4f2623?q=80&w=1376&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="h-14 w-14 rounded-full object-cover" />
                    <div>
                        <div class="flex justify-center gap-0.5 text-orange-500">
                            <!-- Star rating  -->
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            <?php endfor; ?>
                        </div>
                        <p class="mt-0.5 text-lg font-medium text-gray-900">Amanda Lint</p>
                    </div>
                </div>

                <p class="mt-4 text-gray-700">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Culpa sit rerum incidunt, a consequuntur recusandae ab saepe illo est quia obcaecati neque quibusdam eius!
                </p>
            </blockquote>

            <blockquote class="rounded-lg bg-gray-50 p-6 shadow-xl sm:p-8">
                <div class="flex items-center gap-4">
                    <img
                        alt="User Image"
                        src="https://plus.unsplash.com/premium_photo-1725022935609-585e3f42b992?q=80&w=1472&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="h-14 w-14 rounded-full object-cover" />
                    <div>
                        <div class="flex justify-center gap-0.5 text-orange-500">
                            <!-- Star rating  -->
                            <?php for ($i = 0; $i < 4; $i++): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            <?php endfor; ?>
                        </div>
                        <p class="mt-0.5 text-lg font-medium text-gray-900">John Woo</p>
                    </div>
                </div>

                <p class="mt-4 text-gray-700">
                    Sed tincidunt varius nisl, vel iaculis est tempor et. Aliquam cursus commodo interdum. Sed egestas nibh sed ligula mattis, eget viverra sapien ultricies. Nullam tempus, elit nec lobortis elementum, quam quam consectetur ligula, non dapibus tortor lorem ut magna.
                </p>
            </blockquote>

        </div>
    </div>
</section>