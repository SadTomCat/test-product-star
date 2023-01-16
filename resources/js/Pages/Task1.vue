<template>
    <MainLayout>
        <InformationBlock class="mb-4">
            <p>
                Создать страницу, на которой в табличной форме будет выводиться
            </p>
            <ul class="list-disc pl-8">
                <li>Имя Фамилия, электронная почта;</li>
                <li>Прогресс обучения (27 уроков = 100%);</li>
                <li>Место в рейтинге</li>
            </ul>
        </InformationBlock>

        <MainTable :columns="columns" :items="pagination.data"/>

        <SimplePagination class="mt-2"
                          :links="pagination.links"
                          :current-page="pagination.current_page"
                          :total-pages="pagination.last_page"
        />
    </MainLayout>
</template>

<script setup>
import MainLayout from '../Componets/MainLayout.vue'
import MainTable from '../Componets/Tables/MainTable.vue'
import SimplePagination from '../Componets/Paginations/SimplePagination.vue'
import InformationBlock from "@/Componets/InformationBlock.vue";


const props = defineProps({
    pagination: Object
})

const columns = [
    {field: 'first_name', title: 'First Name'},
    {field: 'last_name', title: 'Last Name'},
    {field: 'email', title: 'Email'},
    {field: 'process', title: 'Process %'},
    {field: 'user_rank', title: 'Rank'},
]

</script>

