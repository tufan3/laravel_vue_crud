import { createRouter, createWebHistory } from "vue-router";

import AddNew from "./../crud/AddNew.vue"
import List from "./../crud/List.vue"
import Edit from "./../crud/Edit.vue";
import AddTransaction from "./../crud/AddTransaction.vue";

const routes = [{
    path: '/',
    name: 'List',
    component: List
},
{
    path: '/add-new',
    name: 'AddNew',
    component: AddNew
},
{
    path: '/edit/:id',
    name: 'Edit',
    component: Edit
},
{
    path: '/add-transaction/:id',
    name: 'AddTransaction',
    component: AddTransaction
}

];
const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
