<script setup>
    const vFocus = {
    mounted: (el) => el.focus()
    }
</script>

<template>
    <div>
        <input type="text" class="todo-input" placeholder="What needs to be done?" v-model="newTodo" @keyup.enter="addTodo">
        <div v-for="(todo, index) in todos" :key="todo.id" class="todo-item">

            <div class="todo-item-left">
                <input type="checkbox" v-model="todo.completed">
                <div class="todo-item-label" v-if="!todo.editing" @dblclick="editTodo(todo)" :class="{completed : todo.completed}">{{ todo.title }}</div>
                <input type="text" class="todo-item-edit" v-model="todo.title" v-else @blur="doneEdit(todo)" @keyup.enter="doneEdit(todo)" @keyup.esc="cancelEdit(todo)" v-focus>

            </div>
            <div class="remove-item" @click="removeTodo(index)">
                &times;
            </div>
        </div>
    </div>
  </template>
  
  <script>

  export default {
    name: 'todo-list',
    data(){
        return {
            newTodo: "",
            idForTodo: 3,
            beforeCache: '',
            todos: [
                {
                    'id': 1,
                    'title': 'Finish Vue Screencast',
                    'completed': false,
                    'editing': false
                },
                {
                    'id': 2,
                    'title': 'Take ovwe world',
                    'completed': false,
                    'editing': false
                }
            ]
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

            this.todos.push({
                id: this.idForTodo,
                title: this.newTodo,
                completed: false
            })

            this.newTodo = ''
            this.idForTodo++
        },

        removeTodo(index){
            this.todos.splice(index, 1)
        },

        editTodo(todo){
            this.beforeCache = todo.title
            todo.editing = true
        },

        doneEdit(todo) {
            if(todo.title.trim() == ''){
                todo.title = this.beforeCache
            }
            
            todo.editing = false
        },

        cancelEdit(todo) {
            todo.title = this.beforeCache
            todo.editing = false
        }
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
  </style>
  