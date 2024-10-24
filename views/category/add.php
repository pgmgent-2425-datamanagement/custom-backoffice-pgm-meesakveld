<div class="flex flex-col gap-8 overflow-hidden">

    <div class="flex gap-3">
        <a href="/categories" class="hover:underline">Categories</a>
        <span>></span>
        <p class="font-medium text-c-blue"><?= $title ?></p>
    </div>

    <div class="flex flex-col gap-4">
        <?php
        $h1title = $title;
        include_once '../partials/h1.php';
        ?>
    </div>

    <div class="flex flex-col gap-8">

        <div class="flex flex-col gap-3 border border-c-gray rounded-lg p-4">
            <div class="grid">

                <form action="/categories/add" method="post" class="flex flex-col gap-8">

                    <div class="flex flex-col gap-4">
                        <div class="w-full flex flex-col gap-1">
                            <label for="name" class="text-c-gray">Name</label>
                            <input type="text" name="name" id="name" class="w-full border border-c-gray rounded-lg p-2"
                                required>
                        </div>

                        <div class="w-full flex flex-col gap-1">
                            <label for="email" class="text-c-gray">Description</label>
                            <input type="text" name="description" id="description" class="w-full border border-c-gray rounded-lg p-2" required>
                        </div>

                        <div class="w-full flex flex-col gap-1">
                            <label for="parent-category" class="text-c-gray">Parent Category</label>
                            <select name="parent-category" id="parent-category" class="w-full border border-c-gray rounded-lg p-2">
                                <option value="none">None</option>
                                <?php
                                foreach ($categories as $category) {
                                    if ($category->parent_category_id) {
                                        continue; // Skip categories that have parent categories, only categories without parent categories are allowed
                                    }
                                    echo "<option value='{$category->id}'>{$category->name}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="bg-c-blue-dark text-white px-4 py-1 rounded-lg flex items-center hover:underline">Add</button>

                </form>

            </div>

        </div>

    </div>

</div>