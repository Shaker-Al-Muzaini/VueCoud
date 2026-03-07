<script setup lang="ts">
import { Head ,Link ,router  } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: '/posts',
    },
];

const props = defineProps<{
    posts: { id: number; title: string; body: string }[]
}>();

function deletePost(id: number) {
    if (confirm('Are you sure you want to delete this post?')) {
        router.delete(`/posts/${id}`, {
            onSuccess: () => {
                alert('Post deleted successfully!')
            },
            onError: function(errors) {
                console.error(errors);
            },
            preserveScroll: true,
        })
    }
}
</script>

<template>
    <Head title="Post" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">


            </div>

            <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">

                <!-- Header -->
                <div class="flex items-center justify-between p-4">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                        Posts Table
                    </h2>

                    <Link
                        href="/posts/create"
                        class="rounded-lg bg-green-600 px-4 py-2 text-sm text-white hover:bg-blue-700 transition"
                    >
                        + Add Post
                    </Link>
                </div>

                <!-- Table -->
                <table class="w-full border-collapse text-sm">

                    <!-- Head -->
                    <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">
                            ID
                        </th>

                        <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">
                            Title
                        </th>

                        <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">
                            Body
                        </th>

                        <th class="px-4 py-3 text-center text-gray-600 dark:text-gray-300">
                            Action
                        </th>
                    </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                    <tr
                        v-for="post in props.posts"
                        :key="post.id"
                        class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"
                    >
                        <!-- ID -->
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-200">
                            {{ post.id }}
                        </td>

                        <!-- Title -->
                        <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-200">
                            {{ post.title }}
                        </td>

                        <!-- Body -->
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400 max-w-xs truncate">
                            {{ post.body }}
                        </td>

                        <!-- Actions -->
                        <td class="px-4 py-3 text-center">

                            <div class="flex justify-center gap-2">

                                <!-- View -->
                                <Link
                                    :href="`/posts/${post.id}`"
                                    class="rounded-md bg-blue-500 px-3 py-1 text-xs text-white hover:bg-blue-600 transition"
                                >
                                    View
                                </Link>

                                <!-- Edit -->
                                <Link
                                    :href="`/posts/${post.id}/edit`"
                                    class="rounded-md bg-green-500 px-3 py-1 text-xs text-white hover:bg-green-600 transition"
                                >
                                    Edit
                                </Link>

                                <!-- Delete -->
                                <button
                                    @click="deletePost(post.id)"
                                    class="rounded-md bg-red-500 px-3 py-1 text-xs text-white hover:bg-red-600 transition"
                                >
                                    Delete
                                </button>

                            </div>

                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>


        </div>
    </AppLayout>
</template>
