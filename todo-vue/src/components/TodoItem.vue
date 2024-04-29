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
        <div>
            <button @click="pluralize">Plural</button>
            <span class="remove-item" @click="removeTodo(this.id)">
                &times;
            </span>
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
            'completed': this.todo.completed ? true : false,
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

        removeTodo(id) {
            this.$store.dispatch('deleteTodo', id)
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
            this.$store.dispatch('updateTodo', {
                'id': this.id,
                'title': this.title,
                'completed': this.completed,
                'editing': this.editing,
            })

            // this.emitter.emit('finishedEdit', {
            //     'index': this.index,
            //     'todo': {
            //         'id': this.id,
            //         'title': this.title,
            //         'completed': this.completed,
            //         'editing': this.editing,
            //     }
            // })
        },

        cancelEdit() {
            this.title = this.beforeCache
            this.editing = false
        },

        pluralize() {
            this.emitter.emit('pluralize')
        },

        handlePluralize() {
            this.title = this.title + 's'

            this.$store.dispatch('updateTodo', {
                'id': this.id,
                'title': this.title,
                'completed': this.completed,
                'editing': this.editing,
            })

            // const index = this.$store.state.todos.findIndex(item => item.id == this.id)
            // this.$store.state.todos.splice(index, 1, {
            //     'id': this.id,
            //     'title': this.title,
            //     'completed': this.completed,
            //     'editing': this.editing
            // })
        }
    },

    created() {
        this.emitter.on('pluralize', this.handlePluralize)

    },

    beforeUnmount() {
        this.emitter.off('pluralize', this.handlePluralize)
    }
}

</script>

