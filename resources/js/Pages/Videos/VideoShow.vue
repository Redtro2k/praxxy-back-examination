<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

const props = defineProps({
    videos: Object
})
</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Dashboard
                </h2>
                <Breadcrumbs/>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 p-4 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex justify-center">
                       <div>
                        <video width="320" height="240" controls class="flex justif">
                            <source :src="route('get-video', videos[0].url)" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <h2 class="font-semibold">
                            {{ videos[0].url }}
                        </h2>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>