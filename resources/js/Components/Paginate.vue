<template>
    <div class="bg-white dark:bg-gray-700 px-4 py-3 flex items-center justify-between border-t border-gray-200 dark:border-gray-800 sm:px-6 md:rounded-md">
        <div class="flex-1 flex justify-between sm:hidden">
            <Link :href="responsivePrevious" class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-indigo-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-100 bg-white dark:bg-indigo-600 hover:bg-gray-50 dark:hover:bg-indigo-700">Previous</link>
            <Link :href="responsiveNext" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-indigo-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-100 bg-white dark:bg-indigo-600 hover:bg-gray-50 dark:hover:bg-indigo-700">Next</Link>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 dark:text-gray-100">
                    Showing
                    <span class="font-medium">{{from}}</span>
                    to
                    <span class="font-medium">{{to}}</span>
                    of
                    <span class="font-medium">{{result}}</span>
                    results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <Link
                        v-for="link in links"
                        :is="link.url ? 'Link' : 'span'"
                        :href="link.url"
                        v-html="link.label"
                        class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                        :class="{'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': ! link.url, 'z-10 bg-indigo-50 dark:bg-indigo-700 border-gray-100 text-gray-500' : link.active}"
                    />
                </nav>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    links: Array,
    from: Number,
    to: Number,
    result: Number,
    responsiveNext: String,
    responsivePrevious: String
});
</script>






