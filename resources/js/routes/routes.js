//components
import PostsIndex from "../Pages/Blog/PostsIndex";
import PostShow from "../Pages/Blog/PostShow";
import NotFound from "../Pages/NotFound";


const routes = [
    {
        path: "/",
        component: PostsIndex,
        name: "posts.index"
    },
    {
        path: "/:category/:slug",
        component: PostShow,
        name: "posts.show"
    },
    {
        path: "*",
        component: NotFound,
        name: "not found"
    }
];

export default routes;