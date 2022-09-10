<template>
    <div class="welcome__overflow">
        <div class="welcome__middle">
            <h1>Hello</h1>
            <div class="welcome__inputsCont">
                <form action="" autocomplete="off" method="post">
                    <div class="inputCont">
                        <Input
                            v-model="email"
                            type="email"
                            title="Dudes email"
                            name="login"
                            :reqiured="true"
                        />
                    </div>
                    <div class="inputCont">
                        <Input
                            v-model="password"
                            type="password"
                            title="Dudes password"
                            name="password"
                            :required="true"
                        />
                    </div>
                    <div class="buttonCont">
                        <button class="button" type="submit">Enter</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
import Input from "../units/Input";

export default {
    name: "Welcome",
    data(){
        return {
            email: '',
            password: ''
        }
    },
    components: {
        Input
    },
    methods: {
        onFocusHandler(){

        },
        onInputHandler(){

        }
    }
}
</script>

<style>

</style>
