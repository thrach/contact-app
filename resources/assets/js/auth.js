import Vue from 'vue';
import VueResource from 'vue-resource';

Vue.use(VueResource);

export default {
    loggedIn : false,

    api_token : '',

    getApiToken(){
        this.api_token = window.localStorage.getItem('api_token');
    },

    setApiToken(apiToken){
        window.localStorage.setItem('api_token',apiToken)
    },
    
    setHeader(){
        
    },
    
    checkApiToken(){
       this.getApiToken();
        
        return this.api_token != null ? true : false;
    },
    
    checkAuth(){
        this.getApiToken();

        Vue.http.post('test',{api_token : this.api_token})
            .then(response => {
                console.debug(response)
            });
    }
}