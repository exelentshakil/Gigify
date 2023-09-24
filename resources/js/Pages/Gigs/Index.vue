<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import {ref} from "vue";

const selectedCategory = ref('All Categories')
const searchQuery = ref('')
const props = defineProps({
    gigs: {
        type: Object,
        required: true,
        default: {}
    },
    categories: {
        type: Object,
        required: true,
        default: {}
    }
})

const form = useForm({
    id: ''
})

const deleteGig = (id) => {
    if ( confirm('Are you sure?') ) {
        form.delete(route('gigs.destroy', id))
    }
}
</script>

<template>
    <Head title="Gigs" />

    <AuthenticatedLayout>
        <template #header>
            <div class="navbar flex items-center gap-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gigs</h2>
                <Link :href="route('gigs.create')" class="px-6 py-2 rounded bg-red-500 hover:bg-red-300">Create New Gig</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="max-w-full mx-auto p-6">
                        <div class="bg-white shadow-md rounded my-6">
                            <div class="flex justify-between items-center mb-4">
                                <input type="text" v-model="searchQuery" placeholder="Search gigs" class="w-2/3 py-2 px-3 border border-gray-300 rounded" />

                                <select v-model="selectedCategory" class="w-1/3 ml-4 py-2 px-3 border border-gray-300 rounded">
                                    <option value="All Categories">All Categories</option>
                                    <option v-for="category in categories" :key="category" :value="category.id">{{ category.name }}</option>
                                </select>
                            </div>

                            <button @click="applyFilters" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Apply Filters
                            </button>
                            <table class="min-w-full bg-white border border-gray-300 mt-2">
                                <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">Title</th>
                                    <th class="py-2 px-4 border-b">Description</th>
                                    <th class="py-2 px-4 border-b">Price</th>
                                    <th class="py-2 px-4 border-b">Category</th>
                                    <th class="py-2 px-4 border-b">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- Example gig item, replace with a loop over your gigs -->
                                <tr v-for="gig in gigs" :key="gig.id">
                                    <td class="py-4 px-6 border-b">
                                        <div class="flex items-center">
                                            <div class="mr-2">
                                                <div class="font-bold">{{ gig.title }}</div>
                                                <div class="text-gray-500">by - {{  gig.user.name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 border-b">{{ gig.description}}</td>
                                    <td class="py-4 px-6 border-b">{{ gig.price}}</td>
                                    <td class="py-4 px-6 border-b">{{ gig.category}}</td>
                                    <td class="py-6 px-6 border-b flex items-center justify-center">
                                        <Link :href="route('gigs.show', gig.id)"><button class="px-6 py-2 rounded bg-blue-500 text-white hover:text-blue-700 mr-2">Show</button></Link>
                                        <Link :href="route('gigs.edit', gig.id)"><button class="px-6 py-2 rounded bg-purple-500 text-white hover:text-blue-700 mr-2">Edit</button></Link>
                                        <button @click="deleteGig(gig.id)" class="px-6 py-2 rounded bg-red-500 text-white hover:text-red-700">Delete</button>
                                    </td>
                                </tr>
                                <!-- End of example gig item -->
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
