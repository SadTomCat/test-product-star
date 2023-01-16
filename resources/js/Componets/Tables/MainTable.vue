<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-gray-700 uppercase bg-blue-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3" v-for="column in columns" :key="column.name">
                    {{ column.title }}
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b hover:bg-gray-200"
                v-for="item in items"
            >
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center"
                    v-for="column in columns"
                    :key="column.name"
                >
                    {{ item[column.field] }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
/**
 * items Array<Object>
 *
 * columns Array<{
 *      title: String
 *      field: String - field name in item object
 * }>
 * */
const props = defineProps({
    items: Array,
    columns: Array,
})
</script>
