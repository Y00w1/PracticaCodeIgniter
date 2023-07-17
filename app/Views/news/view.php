<div class="m-9 text-white ">
    <h2 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl"><?= esc($news['title']) ?></h2>
    <p class="mt-6 text-xl leading-8 text-gray-700"><?= esc($news['lead']) ?></p>
    <p class="text-justify mb-3 text-gray-500 dark:text-gray-400  first-letter:text-5xl first-letter:font-bold first-letter:text-gray-900 dark:first-letter:text-gray-100 first-letter:mr-3 first-letter:float-left">
        <?= esc($news['body']) ?>
    </p>
    <p class="mb-3 text-right text-gray-500 dark:text-gray-400">
        <?= esc($news['closure']) ?>
    </p>

</div>
