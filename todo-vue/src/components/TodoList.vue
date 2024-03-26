
<template>
    <div>

        <div class="name-container">
            Welcome, {{ name }}
        </div>

        <input type="text" class="todo-input" placeholder="What needs to be done?" v-model="newTodo" @keyup.enter="addTodo">

        <transition-group name="fade" enter-active-class="animated fadeInUp" leave-active-class="animated fadeOutDown">
            <todo-item v-for="(todo, index) in todosFiltered" :key="todo.id" :todo="todo" :index="index"  :checkAll="!anyRemainig">
            <!-- @removeTodo="removeTodo" @finishedEdit="finishedEdit" -->

            </todo-item>
        </transition-group>

        <div class="extra-container">
            <todo-check-all></todo-check-all>
            <todo-items-remainig ></todo-items-remainig>
        </div>

        <div class="extra-container">
            <todo-filtered></todo-filtered>

            <div>
                <transition name="fade">
                    <todo-clear-completed></todo-clear-completed>
                    
                </transition>
            </div>
        </div>
    </div>
  </template>
  
  <script>
// import { remove } from "@vue/shared"
import TodoItem from "./TodoItem"
import TodoItemsRemainig from "./TodoItemsRemaining"
import TodoCheckAll from "./TodoCheckAll"
import TodoFiltered from "./TodoFiltered"
import TodoClearCompleted from "./TodoClearCompleted"

  export default {
    name: 'todo-list',
    components: {
        TodoItem,
        TodoItemsRemainig,
        TodoCheckAll,
        TodoFiltered,
        TodoClearCompleted
    },  
    data(){
        return {
            newTodo: "",
            idForTodo: 3,
            name: '',
        }
    },

    directives: {
        focus: {
            inserted: function (el) {
                el.focus()
            }
        }
    },  

    methods: {
        addTodo() {
            if(this.newTodo.trim().length == 0){
                return
            }

            this.$store.dispatch('addTodo', {
                id: this.idForTodo,
                title: this.newTodo,
            })

            this.newTodo = ''
            this.idForTodo++
        },

        
    },

    computed: {

        anyRemainig(){
            return this.$store.getters.anyRemaining
        },        

        todosFiltered() {
            return this.$store.getters.todosFiltered
        },
    },

    created() {
        this.$store.dispatch('retrieveTodos')
        this.$store.dispatch('retrieveName')
            .then(response => {
                this.name = response.data.name
            })
    }
}
  </script>
  
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  <style>
  
  .todo-input {
    width: 100%;
    padding: 10px 18px;
    font-size: 18px;
    margin-bottom: 16px;
  }

  .todo-input:focus{
    outline: 0;
  }

  .todo-item{
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    animation-duration: 0.3s;
  }

  .remove-item {
    cursor: pointer;
    margin-left: 14px;
  }

  .remove-item:hover{
    color: black;
  }

  .todo-item-edit {
    font-size: 24px;
    color: #2c3e50;
    margin-left: 12px;
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    }

    .todo-item-edit:focus {
        outline: none;
    }

    .completed {
        text-decoration: line-through;
        color: grey;
    }

    .extra-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 16px;
        border-top: 1px solid lightgrey;
        padding-top: 14px;
        margin-bottom: 14px;
    }

    button {
        font-size: 14px;
        background-color: white;
        appearance: none;
        padding: 4px;
        margin: 2px;
    }
    
    button:hover {
        background: lightgreen;
    }

    button:focus {
        outline: none;
    }
    
    .active {
        background: lightgreen;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .2s;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }

    .name-container {
        margin-bottom: 16px;
    }
  </style>
  