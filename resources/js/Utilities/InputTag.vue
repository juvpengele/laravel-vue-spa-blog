<template>
    <div class="form-group">
        <label>{{ label }}</label>
        <div class="tag--wrapper" id="taginput--wrapper">
            <ul v-if="isData" class="tag__list">
                <li class="badge badge-primary m-1 tag__badge"
                    v-for="(item, index) in dataToShow"
                >
                    <span @click="updateValue(index)" class="tag__badge--name">{{ item }}</span>
                    <span @click="removeData(index)" class="tag__badge--remove">x</span>
                </li>
            </ul>
            <input
                type="text"
                class="form-control input--tag "
                :placeholder="placeholder"
                @keydown.enter.prevent="addValue"
                @keydown.delete="removeLast"
                v-model="singleData"
            >
        </div>
        <input type="hidden" class="form-control" :name="name" :value="tagInputValue">
    </div>
</template>

<script>
    export default {
        name: 'tag-input',
        props: {
            placeholder:{
                type: String,
                required: false,
                default: "Please enter your data"
            },
            name: {
                type: String,
                required: true
            },
            label: {
                type: String,
                required: false,
                default: 'Tags'
            },
            value: {
                type: String,
                required: false
            }
        },
        data() {
            return {
                tagInputValue: '',
                singleData: '',
                dataToShow: []
            }
        },
        mounted() {
            document.querySelector("#taginput--wrapper").addEventListener('click', function(){
                document.querySelector(".input--tag").focus();
                return;
            });

            if(this.value.length > 1) {
                this.setData(this.value);
            }
        },
        computed: {
            isData() {
                return this.dataToShow.length > 0;
            }
        },
        methods: {
            addValue(){
                if(this.singleData !== "") {
                    this.dataToShow.push(this.singleData);
                    this.updateTagValue();
                    this.singleData = "";
                }
            },
            updateTagValue() {
                this.tagInputValue = this.dataToShow.join(",");

                this.dispatchValue(this.tagInputValue);
            },
            updateValue(index) {
                this.singleData = this.dataToShow[index];
                this.removeData(index);
            },
            removeData(index) {
                this.dataToShow.splice(index, 1);
                this.updateTagValue();
            },
            removeLast() {
                if(this.singleData.length === 0) {
                    this.dataToShow.splice(-1, 1);
                    this.updateTagValue();
                }
            },
            setData(value) {
                this.dataToShow = value.split(',');
                this.tagInputValue = value;
            },
            dispatchValue(value) {
                this.$emit("input", value);
            }
        },
        watch: {
            value(newValue, oldValue) {
               this.setData(newValue);
            }
        }
    }
</script>

<style lang="scss">
    .tag--wrapper {
        border: 1px solid darkcyan;
        border-radius: 2px;
        display: flex;
        flex-wrap: wrap;
        .input--tag {
            border: none;
            width: 40% !important;
            outline: none !important;
            transition: none !important;
            box-shadow: none !important;
            &:focus {
                border: none !important;
                box-shadow: none !important;
            }
        }
    }
    .tag__list {
        margin-bottom: 0px !important;
        padding-left: 0.2rem;
    }
    .tag__badge {
        padding: 8px;
        font-size: 10.5px;
        &--name {
            margin-right: 3px;
            cursor: pointer;
        }
        &--remove {
            border-left: 1px solid #e1e1e199;
            padding-left: 5px;
            cursor: pointer;
        }
    }
</style>