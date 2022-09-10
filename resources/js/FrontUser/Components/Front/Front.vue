<template>
    <div class="front front1" ref="cont">
        <div class="front__inner" >

            <div class="front__innerOverflow">
                <div class="header">
                    Привет петушиному отряду!
                </div>
                <div class="text">
                    Оказавнись на этой странице, вы подтверждаете, что своевременно не оплачивали задолженность по ютубу.
                </div>
                <div class="images__cont">
                    <img class="arrow_down" src="/images/arrow_down.gif" alt="">
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "Front",


    mounted() {

        this.$refs.cont.classList.add('front--mounted')
        setTimeout(()=> {
            this.$refs.cont.classList.add('front--cssAnimationIsEnd');
        }, 400)

    }




}
</script>

<style scoped>




    .front1 {
        background-color: black;
        color: white;
    }



    .header {
        font-size: 2.14rem;
        text-align: center;
    }

    .text {
        margin-top: 25px;
        font-size: 1.25rem;
        text-align: center;
    }

    .images__cont {
        text-align: center;
    }

    .arrow_down {
        max-width: 100px;
    }



</style>
