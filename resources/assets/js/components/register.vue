<style>

</style>

<template>
    <validator name="regValidation" >
        <form  method="post" novalidate v-on:submit.prevent="register">
            <h3>Sign Up</h3>
            <p> Enter your personal details below: </p>
            <div class="form-group" v-bind:class="{'has-error' : $regValidation.fullname.required}">
                <label class="control-label visible-ie8 visible-ie9">Full Name</label>
                <div class="input-icon">
                    <i class="fa fa-font"></i>
                    <input class="form-control placeholder-no-fix"
                           type="text"
                           placeholder="Full Name"
                           name="fullname"
                           v-model="fullname"
                           v-validate:fullname="['required']"
                    />
                    <span class="help-block" v-if="$regValidation.fullname.required">Full name is required</span>
                </div>
            </div>
            <div class="form-group" v-bind:class="{'has-error' : $regValidation.email.email}">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon">
                    <i class="fa fa-envelope"></i>
                    <input class="form-control placeholder-no-fix"
                           type="text"
                           placeholder="Email"
                           name="email"
                           v-model="email"
                           v-validate:email="{required : true, email : true}"
                    />
                    <span class="help-block" v-if="$regValidation.email.required">Email is required</span>
                    <span class="help-block" v-if="$regValidation.email.email">Email should be valid email address</span>
                </div>
            </div>
            <p> Enter your account details below: </p>
            <div class="form-group" v-bind:class="{'has-error' : $regValidation.username.minlength}">
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix"
                           type="text"
                           autocomplete="off"
                           placeholder="Username"
                           name="username"
                           v-model="username"
                           v-validate:username="{required : true, minlength : 2}"
                    />
                    <span class="help-block" v-if="$regValidation.username.required">Username is required</span>
                    <span class="help-block" v-if="$regValidation.username.minlength">Username length should be at least 2</span>
                </div>
            </div>
            <div class="form-group" v-bind:class="{'has-error' : $regValidation.password.minlength}">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix"
                           type="password"
                           autocomplete="off"
                           id="register_password"
                           placeholder="Password"
                           name="password"
                           v-model="password"
                           v-validate:password="{required : true, minlength : 4}"
                    />
                    <span class="help-block" v-if="$regValidation.password.required">Password is required</span>
                    <span class="help-block" v-if="$regValidation.password.minlength">Password length should be at least 4</span>
                </div>
            </div>
            <div class="form-group" v-bind:class="{'has-error' : $regValidation.tnc.required}">
                <label class="mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="tnc" v-model="tnc" v-validate:tnc="{required : true}" /> I agree to the
                    <a v-link="{ path: '/terms' }">Terms of Service </a> &
                    <a v-link="{ path: '/privacy' }">Privacy Policy </a>
                    <span></span>
                </label>
                <div id="register_tnc_error"> </div>
            </div>
            <div class="form-actions">
                <a v-link="{ path: '/login' }" id="register-back-btn" class="btn red btn-outline"> Back </a>
                <button type="submit"
                        id="register-submit-btn"
                        class="btn green pull-right"
                        v-if="$regValidation.valid"
                > Sign Up </button>
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

    Vue.validator('email', function (val) {
        return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(val)
    })

    export default Vue.extend({
        data(){
            return {
                fullname : '',
                email : '',
                username : '',
                password : '',
                tnc : false,
            }
        },
        methods : {
            register(){
                if(this.$regValidation.valid)
                {
                    let data = {
                        fullname : this.fullname,
                        email : this.email,
                        username : this.username,
                        password : this.password,
                        tnc : this.tnc
                    }

                    this.$http.post('register',data)
                        .then(response => {
                            if(response.statusCode == 200)
                            {
                                auth.setApiToken(response.data.api_token);
                            }

                        $router.redirect('dashboard');
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
    });
</script>