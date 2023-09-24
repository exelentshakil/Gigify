<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';


const props = defineProps({
    gig: {
        type: Object,
        required: true,
        default: {}
    }
})

const gig = props.gig

//
// const form = useForm({
//     title: gig.title,
//     description: gig.description,
//     price: gig.price,
//     category: gig.category
// })
//
//
// const submit = () => {
//     form.put(route('gigs.update', gig.id), () => {
//         onFinish: () => form.reset('title')
//     })
// }

</script>
<template>
    <Head title="Create New Gig"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Details</h2>
            <Link :href="route('gigs.index')">Back</Link>
        </template>
        <div class="max-w-md mx-auto p-6 bg-white shadow-md rounded my-6">
            <h2 class="text-2xl font-bold mb-6">Details</h2>
            <div class="max-w-md mx-auto p-6 bg-white shadow-md rounded my-6">
                <div class="flex flex-col items-center justify-center">
                    <h2 class="text-2xl font-bold mb-4">{{ gig.title }}</h2>
                    <p class="text-gray-700 mb-4">{{ gig.description }}</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-gray-500">{{ gig.category }}</span>
                        <span class="text-blue-500 font-bold bg-red-500 text-white p-2">${{ gig.price }}</span>
                    </div>

                    <button @click="confirmDelete" class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Add To Cart
                    </button>
                    <button @click="confirmDelete" class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Quick Checkout
                    </button>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>


<style scoped>

</style>
