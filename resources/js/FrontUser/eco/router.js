import Vue from 'vue';
import VueRouter from 'vue-router';
import Front from "../Components/Front/Front";
import Front__SecondScreen from "../Components/Front/Front__SecondScreen";

Vue.use(VueRouter);


const frontRoutes = [
        {
            path: '/',
            component: Front,
            name: 'first',

        },
        {
            path: '/second',
            component: Front__SecondScreen,
            name: 'second',
        }
];

const routes = [
    ...frontRoutes
];


const slideAnimationController = {
    isAnimationDoing: false,
    go(){
       this.isAnimationDoing = true;
       setTimeout(()=>{
           this.isAnimationDoing = false;
       },2500);
    },

};


const router = new VueRouter({
    routes,
    mode: 'history'
});


router.beforeEach((to, from, next) => {

    if(!slideAnimationController.isAnimationDoing){
        next();
        slideAnimationController.go();
    }

    // next('/admin/login');

});

window.router = router;


// TODO refactor
const routerSlideController = ( routeName, goTo = 'next' ) => {

    const routeIndex = frontRoutes.findIndex(el => el.name === routeName);

    if(routeIndex === -1) return;

    let routeToSlideIndex = null;
    if(goTo === 'next'){
       if(routeIndex === frontRoutes.length - 1){
           routeToSlideIndex = 0;
       } else {
           routeToSlideIndex = routeIndex + 1;
       }
    }

    if(goTo === 'prev'){
        if(routeIndex === 0){
            routeToSlideIndex = frontRoutes.length - 1;
        } else {
            routeToSlideIndex = routeIndex - 1;
        }
    }



    let name =
        frontRoutes[routeToSlideIndex].name === 'first'
            ? '/' : frontRoutes[routeToSlideIndex].name;

    router.push(name);
}




export  {
    router,
    routerSlideController
};
