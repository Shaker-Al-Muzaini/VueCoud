<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { ref } from 'vue'

const form = ref({
    title: '',
    body: '',
})

const submit = () => {
    console.log(form.value)
}
</script>

<template>
    <Head title="Create Post" />

    <AppLayout>

        <div class="max-w-4xl mx-auto p-6">

            <!-- Header -->
            <div class="flex items-center justify-between mb-6">

                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Create New Post
                </h1>

                <Link
                    href="/posts"
                    class="text-sm bg-gray-200 dark:bg-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                >
                    Back
                </Link>

            </div>

            <!-- Card -->
            <div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-6 border border-gray-200 dark:border-gray-700">

                <form @submit.prevent="submit" class="space-y-6">

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Post Title
                        </label>

                        <input
                            v-model="form.title"
                            type="text"
                            placeholder="Enter post title..."
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-4 py-2 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition"
                        />
                    </div>

                    <!-- Body -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Post Content
                        </label>

                        <textarea
                            v-model="form.body"
                            rows="6"
                            placeholder="Write your post here..."
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-4 py-3 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition"
                        ></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center gap-4">

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium"
                        >
                            Create Post
                        </button>

                        <Link
                            href="/posts"
                            class="bg-gray-200 dark:bg-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                        >
                            Cancel
                        </Link>

                    </div>

                </form>

            </div>

        </div>

    </AppLayout>
</template>
