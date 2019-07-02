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

    remove(key) {
        this.storage.removeItem(key)
    }

    clear() {
        this.storage.clear();
    }

}

const storage = new Storage();

export default storage;