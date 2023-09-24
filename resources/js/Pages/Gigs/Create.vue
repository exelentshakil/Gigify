<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

const form = useForm({
    title: '',
    description: '',
    price: '',
    category_id: 'Select a Category'
})

const submit = () => {
    form.post(route('gigs.store'), () => {
        onFinish: () => form.reset('title')
    })
}

const props = defineProps({
    categories: {
        type: Object,
        required: true,
        default: {}
    }
})
</script>
<template>
    <Head title="Create New Gig"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Gig</h2>
            <Link :href="route('gigs.index')">Back</Link>
        </template>
        <div class="max-w-md mx-auto p-6 bg-white shadow-md rounded my-6">
            <h2 class="text-2xl font-bold mb-6">Create a New Gig</h2>
            {{ form.errors }}
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input v-model="form.title"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="title" type="text" placeholder="Enter gig title"/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea v-model="form.description"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="description" placeholder="Enter gig description"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                        Price
                    </label>
                    <input
                        v-model="form.price"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="price" type="number" placeholder="Enter gig price"/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                        Category
                    </label>
                    <select
                        v-model="form.category_id"
                        class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                        id="category">
                        <option value="Select a Category" selected disabled hint>Select a category</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                    </select>
                </div>
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Create Gig
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>


<style scoped>

</style>
