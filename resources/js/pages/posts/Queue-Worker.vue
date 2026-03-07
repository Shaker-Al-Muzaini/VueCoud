<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';

type PageProps = {
    items: any[];
    message: string | null;
    name: string;
    auth: { user: { id: number; name: string } };
    sidebarOpen: boolean;
    errors: Record<string, any>;
};

const page = usePage<PageProps>();

const items = page.props.items ?? [];
const message = page.props.message ?? null;
</script>
<template>
    <Head title="التوصيات" />

    <AppLayout>
        <div class="p-4">
            <h1 class="text-2xl font-bold mb-4">التوصيات لك:</h1>

            <div v-if="message" class="text-red-500">{{ message }}</div>

            <ul v-else>
                <li v-for="item in items" :key="item.id">{{ item.name }}</li>
            </ul>
        </div>
    </AppLayout>
</template>
