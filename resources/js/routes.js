import VueRouter from 'vue-router';

import Books from './components/BooksComponent.vue';
import Comments from './components/CommentsComponent.vue';
import Characters from './components/CharactersComponent.vue';
 
export const routes = [
    {
        name: 'books',
        path: '/',
        component: Books
    },
    {
        name: 'comments',
        path: '/comment/:name',
        component: Comments
    },
    {
        name: 'characters',
        path: '/characters/:book_id',
        component: Characters
    }
];