<template>
    <div class="login-form page-wrapper">
      <h2 class="login-heading">Login</h2>
      <Form action="#" @submit="login">

        <div v-if="successMessage" class="success-message">{{ successMessage }}</div>
        <div v-if="serverError" class="server-error">{{ serverError }}</div>
  
        <div class="form-control">
          <label for="email">Username/Email</label>
          <Field 
            type="email" 
            name="email" 
            id="username" 
            class="login-input" 
            v-model="username" 
            :rules="validateEmail"
          />
          <ErrorMessage name="email" class="form-error"/>
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
        </div>
  
        <div class="form-control">
          <button type="submit" class="btn-submit" :disabled="loading">
            
            <div class="lds-ring-container" v-if="loading"> 
              <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
            </div>
            Login
          </button>
        </div>
  
      </Form>
    </div>
  </template>
  
  <script>
  import { toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';
  import { Form, Field, ErrorMessage } from 'vee-validate';

  export default {
    name: 'login-page',

    components: {
        Form,
        Field,
        ErrorMessage,
    },

    data() {
      return {
        username: '',
        password: '',
        serverError: '',
        successMessage: this.dataSuccessMessage,
        loading: false
      }
    },

    props: {
      dataSuccessMessage: {
        type: String,
      }
    },

    created(){
      if(this.successMessage){
        toast.success('registrado com Sucesso!',{
          autoClose: 3000
        });
      }
    },
    
    methods: {

      login() {

        this.loading = true
        this.$store.dispatch('retrieveToken', {
          username: this.username,
          password: this.password,
        })
          .then(() => {
            this.loading = false
            this.$router.push({ name: 'todo' })
          })
          .catch(error => {
            this.loading = false
            this.serverError = error.response.data.message
            this.password = ''
            this.successMessage = ''
        })
      },

      validateEmail(value) {
            //Verificar se o campo está vazio
            if (!value) {

                return 'Esse campo é obrigatório';
            }

            //Verificar se o email é válido
            // const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            // if (!regex.test(value)) {
            //     return 'Esse campo deve ser um email válido';
            // }


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
    }
  }
  </script>