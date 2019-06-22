class Storage {
    constructor() {
        this.storage = localStorage
    }

    record(key, value) {
        this.storage.setItem(key, value)
    }

    has(key) {
        return this.storage.getItem(key) !== null;
    }

    get(key) {
        return this.storage.getItem(key);
    }

    clear(key) {
        this.storage.removeItem(key)
    }

}

export default new Storage()