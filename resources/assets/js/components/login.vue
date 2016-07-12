<style>

</style>

<template>
    <validator name="loginValidation">
        <form class="login-form" method="post" novalidate v-on:submit.prevent="login">
            <h3 class="form-title">Login to your account</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span> Enter any username and password. </span>
            </div>
            <div class="form-group" v-bind:class="{'has-error' : $loginValidation.username.required}">
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix"
                           type="text"
                           autocomplete="off"
                           placeholder="Username"
                           name="username"
                           v-model="username"
                           v-validate:username="['required']"
                    />
                    <span class="help-block" v-if="$loginValidation.username.required">Username is required</span>
                </div>
            </div>
            <div class="form-group" v-bind:class="{'has-error' : $loginValidation.password.minlength}">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix"
                           type="password"
                           autocomplete="off"
                           placeholder="Password"
                           name="password"
                           v-model="password"
                           v-validate:password="{required : true,minlength : 4}"
                    />
                    <span class="help-block" v-if="$loginValidation.password.required">Password is required</span>
                    <span class="help-block" v-if="$loginValidation.password.minlength">Password min length is 4</span>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit"
                        class="btn green pull-right"
                        v-if="$loginValidation.valid"
                > Login </button>
            </div>
            <div class="login-options">
                <h4>Or login with</h4>
                <ul class="social-icons">
                    <li>
                        <a class="facebook" data-original-title="facebook" href="javascript:;"> </a>
                    </li>
                    <li>
                        <a class="twitter" data-original-title="Twitter" href="javascript:;"> </a>
                    </li>
                    <li>
                        <a class="googleplus" data-original-title="Goole Plus" href="javascript:;"> </a>
                    </li>
                    <li>
                        <a class="linkedin" data-original-title="Linkedin" href="javascript:;"> </a>
                    </li>
                </ul>
            </div>
            <div class="forget-password">
                <h4>Forgot your password ?</h4>
                <p> no worries, click
                    <a v-link="{ path: '/forgot' }" id="forget-password"> here </a> to reset your password. </p>
            </div>
            <div class="create-account">
                <p> Don't have an account yet ?&nbsp;
                    <a v-link="{ path: '/register' }" id="register-btn"> Create an account </a>
                </p>
            </div>
        </form>
    </validator>
</template>

<script>
    import Vue from 'vue';
    import VueResource from 'vue-resource';
    import VueValidator from 'vue-validator';
    import auth from '../auth';

    Vue.use(VueResource);
    Vue.use(VueValidator);
    export default Vue.extend({
        data(){
            return {
                username : '',
                password : ''
            }
        },
        methods : {
            login(){
                if(this.$loginValidation.valid)
                {
                    let data = {
                        username : this.username,
                        password : this.password
                    }

                    this.$http.post('login',data)
                        .then(response => {
                            if(response.status == 200)
                            {
                                auth.setApiToken(response.data.api_token);
                            }

                            this.$router.go('dashboard');
                        })
                }
            }
        },

        route: {
            canActivate : function (transition) {
                if(auth.checkApiToken()){
                    transition.redirect('dashboard')
                }

                transition.next()
            }
        }
    })
</script>