import Dashboard from "../Pages/Admin/Dashboard";
import Login from "../Pages/Admin/Login";
import CategoriesIndex from "../Pages/Admin/Categories/CategoriesIndex";
import CategoriesCreate from "../Pages/Admin/Categories/CategoriesCreate";
import CategoriesEdit from "../Pages/Admin/Categories/CategoriesEdit";


const routes = [
    {
        path: "/admin",
        component: Dashboard,
        name: "admin.dashboard",
        meta: {
            layout: "admin-layout"
        }
    },
    {
        path: "/admin/categories",
        component: CategoriesIndex,
        name: "admin.categories.index",
        meta: {
            layout: "admin-layout"
        }
    },
    {
        path: "/admin/categories/create",
        component: CategoriesCreate,
        name: "admin.categories.create",
        meta: {
            layout: "admin-layout"
        }
    },
    {
        path: "/admin/categories/:category/edit",
        component: CategoriesEdit,
        name: "admin.categories.edit",
        meta: {
            layout: "admin-layout"
        }
    },
    {
        path: "/login",
        component: Login,
        name: "login",
        meta: {
            layout: "login-layout"
        }
    },
];

export default routes;