<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/news/create" method="post" class="ml-9 mr-16 mt-7" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
        <input name="title" type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write the title of your new...">
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lead</label>
        <textarea name="lead" id="body" cols="45" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write the lead of your new..."><?= set_value('body') ?></textarea>
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Body</label>
        <textarea name="body" id="body" cols="45" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write the content of your new..."><?= set_value('body') ?></textarea>
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Closure</label>
        <textarea name="closure" id="body" cols="45" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write the closure of your new..."><?= set_value('body') ?></textarea>
    </div>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload an image for the new</label>
        <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG.</p>
    </div>
    <button type="submit" name="submit" class=" my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>
