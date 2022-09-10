<template>
    <div class="input__overflow">
        <label :class="{ focused: isFocused }">
            <input
                class="input"
                v-model="data"
                :type="type"
                :name="name"
                @focus="onFocusHandler"
                @input="onInputHandler"
                @blur="onBlurHandler"
                @change="onChangeHandler"
                autocomplete="off"
                :required="required && required !== '' ? required : 'false'"
            >
            <span class="input__title">{{ title }}</span>
        </label>
        <div class="input__error">{{ error }}</div>
    </div>
</template>

<script>
export default {
    name: "Input",
    props: ['value', 'type', 'title', 'name', 'required', 'error'],
    data(){
        return {
            isFocused: false,
            localValue: this.value
        }
    },
    computed: {
        data: {
            get(){
                return this.localValue;
            },
            set(newValue){
                this.localValue = newValue;
                this.$emit('input', newValue);
            }
        }
    },
    methods: {
        onFocusHandler(){
            this.isFocused = true;
        },
        onInputHandler(e){
            this.isFocused = !!this.data;
            // this.data = e.target.value;
        },
        onBlurHandler(){
            if(!this.data){
                this.isFocused = false;
            }
        },
        onChangeHandler(e){
            this.data = e.target.value;
        }
    },
    mounted() {
        if(this.data){
            this.isFocused = true;
        }
    }
}
</script>

<style scoped>
    .input {
        font-size: 0.9rem;
        padding: 14px 15px 10px 15px;
    }

    .input__error {
        color: red;
    }
</style>
