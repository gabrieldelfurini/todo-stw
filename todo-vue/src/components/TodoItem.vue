<script setup>
    const vFocus = {
    mounted: (el) => el.focus()
    }
</script>


<template>
    <div class="todo-item">
        <div class="todo-item-left">
            <input type="checkbox" v-model="completed" @change="doneEdit">
            <div class="todo-item-label" v-if="!editing" @dblclick="editTodo" :class="{completed : completed}">{{ title }}</div>
            <input type="text" class="todo-item-edit" v-model="title" v-else @blur="doneEdit" @keyup.enter="doneEdit" @keyup.esc="cancelEdit" v-focus>
    
        </div>
        <div class="remove-item" @click="removeTodo(index)">
            &times;
        </div>
    </div>
</template>

<script>
export default {
    name: 'todo-item',
    props: {
        todo: {
            type: Object,
            required: true
        },
        index: {
            type: Number,
            required: true
        },
        checkAll: {
            type: Boolean,
            required: true
        }
    },

    data() {
        return {
            'id': this.todo.id,
            'title': this.todo.title,
            'completed': this.todo.completed,
            'editing': this.todo.editing,
            'beforeEditCache': '',        
        }
    },

    watch: {
        checkAll() {
            // if(this.checkAll){
            //     this.completed = true
            // } else {
            //     this.completed = this.todo.completed
            // }
            this.completed = this.checkAll ? true : this.todo.completed
        }
    },

    methods: {
        removeTodo(index) {
            this.$emit('removeTodo', index)
        },

        editTodo(){
            this.beforeCache = this.title
            this.editing = true
        },

        doneEdit() {
            if(this.title.trim() == ''){
                this.title = this.beforeCache
            }
            
            this.editing = false
            this.$emit('finishedEdit', {
                'index': this.index,
                'todo': {
                    'id': this.id,
                    'title': this.title,
                    'completed': this.completed,
                    'editing': this.editing,
                }
            })
        },

        cancelEdit() {
            this.title = this.beforeCache
            this.editing = false
        },
    }
}

</script>

