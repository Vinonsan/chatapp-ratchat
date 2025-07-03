<?php
$menuItems = ['Home' => '#', 'About' => '#', 'Service' => '#', 'Contact' => '#'];
?>

<nav class="shadow-sm px-4 md:px-8 py-3 bg-transparent">
    <div class="flex justify-between items-center w-full">

        <div class="flex items-center">
            <a href="#">
                <img src="/assets/images/logo.png" alt="Quiz SL Logo" class="w-12 md:w-16 aspect-square object-contain">
            </a>
        </div>

        <div class="hidden md:flex gap-10 text-lg font-semibold text-brand-primary">
            <?php foreach ($menuItems as $label => $url): ?>
                <a href="<?= $url ?>"
                    class="inline-block relative overflow-hidden group">
                    <span class="relative z-10"><?= $label ?></span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-current transition-all duration-300 group-hover:w-full"></span>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="flex items-center gap-4">
            <a href="" class="flex items-center gap-2 bg-brand-primary text-white rounded-full px-6 py-2 font-medium hover:opacity-90 transition">
                <i class="fa-solid fa-right-to-bracket"></i>
                Login
            </a>

            <button type="button" class="md:hidden text-2xl text-brand-secondary">
                <i class="fas fa-bars"></i>
            </button>
        </div>

    </div>
</nav>