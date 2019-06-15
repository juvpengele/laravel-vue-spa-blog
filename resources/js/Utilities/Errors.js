class Errors {

    constructor() {
        this.errors = {};
    }

    has(key) {
        return this.errors.hasOwnProperty(key);
    }

    record(errors) {
        this.errors = errors;
    }

    get(key) {
        return this.errors[key][0];
    }

    clear(key) {
        delete this.errors[key];
    }

    clearAll() {
        this.errors = {};
    }

}

export default Errors;