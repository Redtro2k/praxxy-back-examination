<template>
<!-- for viewing category -->
<TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-10" @close="open = false">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>
        <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                <form @submit.prevent="submit">
                <div>
                <div class="mt-2 sm:mt-4">
                    <DialogTitle as="h3" class="text-lg font-bold leading-6 text-gray-900 dark:text-gray-200">Edit Category</DialogTitle>
                    <p class="text-gray-400 pb-2 text-xs">Create a new category to your product.</p>
                    <div class="mt-2">
                            <div>
                                <InputLabel for="Title" value="Title" />
                                <TextInput
                                    id="name"
                                    v-model="form.title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>
                    </div>
                </div>
                </div>
                <div class="mt-5 sm:mt-6 flex justify-between">
                    <button type="submit" :disabled="!form.isDirty && !props.category || form.processing" class="disabled:opacity-75 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:text-sm">{{!props.category ? 'Create' : 'Update'}}</button>
                    <button type="button" v-if="!props.category" @click.prevent="handleCancel" class="inline-flex items-center rounded-md border border-transparent bg-rose-100 px-3 py-2 text-sm font-medium leading-4 text-rose-700 hover:bg-rose-200 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">Cancel</button>
                    <Link v-else :href="route('category.index')" class="inline-flex items-center rounded-md border border-transparent bg-indigo-100 px-4 py-2 text-sm font-medium text-indigo-700 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Back</Link>
                </div>
                <small v-if="form.isDirty && !props.category" class="mt-2 text-amber-400 dark:text-amber-200">There are unsaved form changes.</small>
            </form>
            </DialogPanel>
            </TransitionChild>
        </div>
        </div>
    </Dialog>
</TransitionRoot>
<AppLayout title="Categories">
     <template #header>
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Categories
            </h2>
            <Breadcrumbs/>
        </div>
     </template>
     <div class="py-8 px-8 mt-4 sm:px-2">
         <div class="flex justify-between mx-16">
            <div class="flex items-end space-x-2">
                <h2 class="text-3xl font-bold text-gray-700 dark:text-indigo-600">Most Categories</h2>
                <span v-if="props.new_items != 0 || handleMessage.length" class="bg-indigo-500 px-2 rounded-md text-sm font-semibold text-white">New</span>
            </div>
            <div class="mt-4">
                <button @click.prevent="open = true" class="inline-flex items-center rounded-md border border-transparent bg-teal-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">Create</button>
            </div>
         </div>
        <div class="grid grid-cols-2 md:grid-cols-4 sm:grid-cols-3 md:px-12 md:gap-8 gap-4 mt-8">
            <div class="rounded-xl shadow-sm bg-white dark:bg-gray-800 pt-6 space-y-2" v-for="category in categories" :key="category.id">
                <div class="flex justify-center items-end space-x-2">
                    <h1 class="text-center dark:text-gray-100 font-semibold">{{category.title}}</h1>
                    <span v-show="category.items != 0" class="text-white text-xs bg-indigo-500 px-2 rounded-md">{category.items} New</span>
                </div>
                <div class="flex justify-center">
                    <div>
                        <XCircleIcon class="w-28 p-2 text-gray-200 dark:text-gray-900"/>
                        <h3 class="text-center font-semibold text-gray-300 dark:text-gray-900">No Images</h3>
                    </div>
                </div>
                <div class="flex justify-between p-2">
                    <Link :href="route('category.index', category.id)" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Edit</Link>
                    <Link preserve-state :href="route('category.destroy', category.id)" as="button" method="DELETE" class="inline-flex items-center rounded-md border border-transparent bg-indigo-100 px-4 py-2 text-sm font-medium text-indigo-700 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Delete</Link>
                </div>
            </div>
        </div>
    </div>
</AppLayout>
</template>
<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Breadcrumbs from '@/Components/Breadcrumbs.vue';
    import { XCircleIcon } from '@heroicons/vue/24/outline';
    import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Link, useForm } from '@inertiajs/vue3';
    import { watchEffect,ref, onMounted } from 'vue';
    import Pusher from 'pusher-js'
    const handleMessage = ref([]);
    const open = ref(false);
    const props = defineProps({
        categories: Object, 
        category: Object, 
        new_items: Number,
        pusher_credentials: Object
    })
    const form = useForm({
        title: ''
    });
    watchEffect(() => {
        open.value = !!props.category
        form.title = !props.category ? '' : props.category.title
    });
    onMounted(() => {
        const pusher = new Pusher(props.pusher_credentials.api_key, {
            cluster: props.pusher_credentials.cluster,
        })
        const channel = pusher.subscribe('public')
        channel.bind('newCategory', (data) => {
            handleMessage.value.push(data)
        })
    })
    const submit = () => {
        if(props.category != null){
            form.put(route('category.update', props.category.id, {
                preserveState: false,
            }))
        }else{
            form.post(route('category.store'), {
                preserveScroll: true,
                onSuccess: () => form.reset('title')
            })
            open.value = false;
        }
    }
    const handleCancel = () => {
        form.cancel();
        open.value = false
    }
</script>