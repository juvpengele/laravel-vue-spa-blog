export default {
    mounted() {
        axios.defaults.headers.common['Authorization'] = `Bearer ${ this.auth.token }`;
    }
}