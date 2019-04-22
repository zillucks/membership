import Dashboard from "./components/Dashboard.vue";
import {
    Index,
    Create,
    Edit,
    View
} from "./components/Users";

export const routes = [
    {
        path: 'users',
        component: Users.Index,
        name: 'users'
    }
]