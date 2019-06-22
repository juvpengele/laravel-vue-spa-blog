import Auth from "../Utilities/Auth";

export default {
    beforeRouteEnter(to, from, next) {
        next(vm => {
            if(Auth.loggedIn) {
                return vm.$router.push({
                    name: "admin.dashboard"
                });
            }
        })
    }
}