import Vue from 'vue';
import VueRouter from 'vue-router';
import IndexView from './components/index.vue';
import LoginView from './components/login.vue';
import RegisterView from './components/register.vue';
import ForgotView from './components/forgot.vue';
import TermsView from './components/terms.vue';
import PrivacyView from './components/privacy.vue';
import DashboardView from './components/dashboard.vue';

Vue.use(VueRouter);

let App = Vue.extend({
    ready(){
        $.backstretch(["img/bg/2.jpg"], {
            fade: 1e3,
            duration: 8e3
        })
    }
});

let Router = new VueRouter();

Router.map({
    '' : {
        component : IndexView
    },
    
    'login' : {
        component : LoginView
    },

    'register' : {
        component : RegisterView
    },

    'forgot' : {
        component : ForgotView
    },

    'privacy' : {
        component : PrivacyView
    },

    'terms' : {
        component : TermsView
    },

    'dashboard' : {
        component : DashboardView
    }
})

Router.start(App,'#app')