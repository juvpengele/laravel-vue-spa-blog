import Dashboard from "../Pages/Admin/Dashboard";
import Login from "../Pages/Admin/Login";
import CategoriesIndex from "../Pages/Admin/Categories/CategoriesIndex";
import CategoriesCreate from "../Pages/Admin/Categories/CategoriesCreate";
import CategoriesEdit from "../Pages/Admin/Categories/CategoriesEdit";
import PostsIndex from "../Pages/Admin/Posts/PostsIndex";
import PostsCreate from "../Pages/Admin/Posts/PostsCreate";
import PostsEdit from "../Pages/Admin/Posts/PostsEdit";
import TagsIndex from "../Pages/Admin/Tags/TagsIndex";
import TagsEdit from "../Pages/Admin/Tags/TagsEdit";
import CommentsIndex from "../Pages/Admin/Comments/CommentsIndex";


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
        path: "/admin/posts",
        component: PostsIndex,
        name: "admin.posts.index",
        meta: {
            layout: "admin-layout"
        }
    },
    {
        path: "/admin/posts/create",
        component: PostsCreate,
        name: "admin.posts.create",
        meta: {
            layout: "admin-layout"
        }
    },
    {
        path: "/admin/posts/:post/edit",
        component: PostsEdit,
        name: "admin.posts.edit",
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
        path: "/admin/tags",
        component: TagsIndex,
        name: "admin.tags.index",
        meta: {
            layout: "admin-layout"
        }
    },
    {
        path: "/admin/comments",
        component: CommentsIndex,
        name: "admin.comments.index",
        meta: {
            layout: "admin-layout"
        }
    },
    {
        path: "/admin/tags/:tag/edit",
        component: TagsEdit,
        name: "admin.tags.edit",
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