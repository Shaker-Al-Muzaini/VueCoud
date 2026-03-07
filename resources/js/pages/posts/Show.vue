<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { defineProps } from 'vue'

// تعريف prop الذي يأتي من Laravel
const props = defineProps<{
    post: {
        id: number
        title: string
        body: string
        created_at: string
        updated_at: string
    }
}>()

// يمكن إضافة أي دوال إضافية لاحقًا إذا أردت تفاعلات
</script>

<template>
    <Head :title="post.title" />

    <AppLayout>

        <div class="max-w-3xl mx-auto p-6 space-y-6">

            <!-- Header -->
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
                    {{ post.title }}
                </h1>

                <Link
                    href="/posts"
                    class="text-sm bg-gray-200 dark:bg-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                >
                    Back to Posts
                </Link>
            </div>

            <!-- Card -->
            <div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-6 border border-gray-200 dark:border-gray-700 space-y-4">

                <!-- Post Body -->
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    {{ post.body }}
                </p>

                <!-- Metadata -->
                <div class="text-sm text-gray-500 dark:text-gray-400 flex justify-between">
                    <span>Created: {{ new Date(post.created_at).toLocaleString() }}</span>
                    <span>Updated: {{ new Date(post.updated_at).toLocaleString() }}</span>
                </div>

                <!-- Actions -->
                <div class="flex gap-4 mt-4">
                    <Link
                        :href="`/posts/${post.id}/edit`"
                        class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition"
                    >
                        Edit
                    </Link>

                    <Link
                        href="/posts"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-lg transition"
                    >
                        Back
                    </Link>
                </div>

            </div>
        </div>

    </AppLayout>
</template>
