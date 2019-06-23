import Auth from "../Utilities/Auth";

export default {
    beforeRouteEnter(to, from, next) {
        next(vm => {
            if(! Auth.loggedIn) {
                vm.$store.dispatch("alert", {
                    message: "You are not allowed to access",
                    type: "danger"
                });
                vm.$router.push({
                    name: "posts.index"
                })
            }
        })
    }
}