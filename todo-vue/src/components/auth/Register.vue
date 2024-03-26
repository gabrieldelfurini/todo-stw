<template>
    <div class="login-form page-wrapper">
        <h2 class="login-heading">Register</h2>
    
            
        
        <Form action="#" @submit="register">

            <div v-if="serverErrors" class="server-error">
                <div v-for="(value, key) in serverErrors" :key="key">
                    {{ value[0] }}
                </div>
            </div>

            
            <div class="form-control">
                <label for="name">Name</label>
                <Field type="text" name="name" id="name" class="login-input"   v-model="name" :rules="isRequired"/>
                <ErrorMessage name="name" class="form-error"/>
                <!-- <span class="form-error">{{  }}</span> -->
            </div>


            <div class="form-control">
                <label for="email">Email</label>
                <Field 
                    type="text" 
                    name="email" 
                    id="email" 
                    class="login-input"  
                    v-model="email" 
                    :rules="validateEmail"
                    :class="{ 'input-error': inputErrorClass == 'email' }"
                />
                <ErrorMessage name="email" class="form-error"/>
                <!-- <span class="form-error">{{  }}</span> -->
            </div>


            <div class="form-control mb-more">
                <label for="password">Password</label>
                <Field 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="login-input" 
                    v-model="password" 
                    :rules="validatePassword" 
                />
                <ErrorMessage name="password" class="form-error"/>
                <!-- <span class="form-error">{{  }}</span> -->
            </div>

            <div class="form-control">
                <button type="submit" class="btn-submit">Create Account</button>
            </div>

        </Form>
    </div>
</template>

<script>
import { Form, Field, ErrorMessage } from 'vee-validate';

export default {
    name: 'register-page',
    components: {
        Form,
        Field,
        ErrorMessage,
    },

    data() {
        return {
            name: '',
            email: '',
            password: '',
            serverErrors: '',
            successMessage: '',
            inputErrorClass: '',
        }
    },

    methods: {
        register() {

            // this.$store.dispatch('register', {
            //     name: this.name,
            //     email: this.email,
            //     password: this.password,
            // })
            //     .then(() => {
            //         this.$router.push({ name: 'login', params: { dataSuccessMessage: this.successMessage } })
                        // this.successMessage = 'Registered Successfully!'

            //     })
            //     .catch(error => {
            //         this.serverErrors = Object.values(error.response.data.errors)
            //     })
        },

        validateEmail(value) {
            // if the field is empty
            if (!value) {
                // this.inputErrorClass = 'email' // adicionando cor á borda

                return 'Esse campo é obrigatório';
            }
            // if the field is not a valid email
            const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            if (!regex.test(value)) {
                return 'Esse campo deve ser um email válido';
            }

            // All is good
            // this.inputErrorClass = null
            return true;
        },

        isRequired(value) {
            if (!value) {
                return 'Esse campo é obrigatório';
            }
            
            return true;
        },

        validatePassword(value) {
            if (!value) {
                // input-error
                return 'Esse campo é obrigatório';
            }
            if(value.length < 6){
                return 'Tem que ter no mínimo 6 digitos.';
            }
            
            return true;
        }
    },

    mounted() {
        // this.$nextTick(() => {
        //     this.$watch(() => this.errors.items, () => {
        //         // Faça algo sempre que a validação mudar
        //     });
        // });
    },

    updated(){
        const elemento = document.querySelector('.form-error');
        console.log(elemento)
    }

}
</script>