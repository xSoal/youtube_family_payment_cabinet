<template>
    <div class="front front2" ref="cont">
        <div class="front__inner" >
            <div class="front__innerOverflow">
                <div class="line">
                    <div class="line__bg"></div>
                    <a href="/login">
                        <div class="text">
                            Нажать сюда, чтобы увеличить на 3см
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Front__SecondScreen",
    mounted() {

        this.$refs.cont.classList.add('front--mounted')
        setTimeout(()=> {
            this.$refs.cont.classList.add('front--cssAnimationIsEnd');
        }, 400)
    }

}
</script>

<style scoped>

    .front__innerOverflow {
        max-width: 70%;
        width: 100%;
    }

    .front2 {
        background-color: yellow;
    }

    .overflow {
        padding: 25px 35px;
    }

    .text {
        cursor: pointer;
    }


    .line {
        position: relative;
        width: 100%;
        text-align: center;
    }

    .line__bg {
        height: 0px;
        position: absolute;
        top: 0px;
        bottom: 0px;
        left: 0px;
        right: 0px;
        background-color: #dada29;
        transition: .25s;
        margin: auto;

    }

    .text {
        position: relative;
        z-index: 1;
        padding: 25px 15px;
    }


    .line:hover .line__bg  {
        height: 100%;
    }

    a,
    a:hover {
        color: inherit;
        text-transform: none;
        text-decoration: none;
    }



</style>
