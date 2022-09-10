<template>
    <div class="front__overflow">

        <router-view></router-view>
    </div>
</template>

<script>




import { routerSlideController } from "../eco/router";

export default {
    name: "Index",
    methods: {
        animateController(e){
            let goTo = null;
            if(e.deltaY > 0){
                goTo = 'next';
            } else {
                goTo = 'prev'
            }

            routerSlideController(this.$route.name, goTo);

        }
    },
    mounted() {
        window.addEventListener('mousewheel', this.animateController);
        window.addEventListener('touchstart', this.animateController);
    },
    beforeDestroy() {
        window.removeEventListener('mousewheel', this.animateController)
        window.removeEventListener('touchstart', this.animateController)
    }
}
</script>

<style>

    * {
        margin: 0;
        padding: 0;
    }


    .front__inner {
        display: flex;
        align-items: center;
        justify-content: center;
    }


    .front__innerOverflow {
        max-width: 50vw;
    }

    @media all and (max-width: 800px){
        .front__innerOverflow {
            max-width: 90vw;
        }
    }


    .front__overflow {
        background-color: grey;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    .front__overflow,
    .front {
        height: 100vh;
        width: 100vw;
    }

    .front {
        /*transition: 2s;*/
        margin: auto;
    }

    @keyframes move_eye {
        from {
            /*opacity: 0;*/
            width: 95%;
            height: 20%;
            transform: translate(0, 0);
        }
        to {
            width: 100%;
            height: 100%;
            opacity: 1;
            transform: translate(0, 0);
        }
    }

    .front {

    }

    .front--mounted {
        animation: 0.4s linear 0s move_eye;
    }


    .front__inner {
        height: 100%;
        width: 100%;
        transition: 2s;
        opacity: 0;
    }

    .front.front--cssAnimationIsEnd .front__inner {
        opacity: 1;
    }

</style>
