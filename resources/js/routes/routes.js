//Routes
import adminRoutes from "./admin"
import publicRoutes from "./public"

const routes = [...adminRoutes, ...publicRoutes];

export default routes;