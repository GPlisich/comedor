<template>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Sign In</h5>

                    <el-form ref="form" :model="form" :rules="rulesForm">
                        
                        
                        <el-form-item  label="Email" prop="email">
                            <el-input v-model="form.email" prop="email" ref="email"></el-input>
                        </el-form-item>
                        <el-form-item label="Password" prop="password">
                            <el-input show-password v-model="form.password" prop="password" ref="password"></el-input>
                        </el-form-item>
                        <div v-show="showError" class="error-login">
                            {{ this.validationErrors }}
                        </div>
                            
                        <div class="d-grid gap-2">
                            <el-button 
                                :disabled="isSubmitting"
                                @click="loginAction('form')"
                                type="primary"
                                prop="bottonSubmit"
                                ref="bottonSubmit">Login
                            </el-button>
                            <!-- <p class="text-center">No tienes una cuenta? 
                                <el-link type="primary" href="/register">Registrate aqui</el-link>
                            </p> -->
                        </div>


                    </el-form>
                
                </div>
            </div>
        </div>
 </template>
   
<script>
   
export default {
    data() {
        return {
            showError:false,
            form:{
                email:'',
                password:'',
            },
            rulesForm:{
                email:[{required: true, message: 'El email no puede estar vacio', trigger: 'blur'}],
                password:[{required: true, message: 'La password no puede ser vacia', trigger: 'blur'}],
            },
            
            validationErrors:'',
            isSubmitting:false,
        };
    },
    created(){
        var self = this;
        document.onkeyup=function(e){
            var key=window.event.keyCode;
            if(key==13 && self.form.email!='' && self.form.password!=''){
                self.loginAction('form')
            }else if(key==13 ){
                self.focusInput('password');
            }
        }
    },
    mounted(){
        this.focusInput('email');
        
    },
    methods: {

        focusInput(input) {
            this.$refs[input].focus() 
        },
        
        loginAction(form){
            axios.get('/login/nuevoToken').then(response =>{

                const nuevoToken = response.data.token;
                axios.defaults.headers.common['X-CSRF-TOKEN'] = nuevoToken;

                this.$refs[form].validate((valid) => {   
                if(valid){
                    var form = this.form;
                    this.isSubmitting = true;
                    axios.post('/login/loguearse', form)
                    .then(response => {
                        const mensaje = response.data.message;
                        if(mensaje!=''){
                            this.showError=true;
                            this.validationErrors=response.data.message;
                            this.isSubmitting = false;
                        }else{
                            const redirectTo = response.data.redirectTo;
                            localStorage.setItem('token', response.data.token)
                            if(redirectTo!=null){
                                window.location.href='/'+redirectTo;
                            }else{
                                window.location.href='/';
                            }
                        }    
                    })
                }
            });

            });

        }
    },
};
</script>
<style>
    .error-login{
       color: red;
       font-weight: bold; 
       text-align: center;
    }

</style>