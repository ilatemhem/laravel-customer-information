import Customers from './components/Customers.vue';
import CustomerCreate from './components/CustomerCreate.vue';

export const routes = [
    {
        name: 'index',
        path: '/',
        component: Customers
    },
    {
        name: 'create',
        path: '/create',
        component: CustomerCreate
    }
];
