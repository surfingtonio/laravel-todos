<template>
    <div class="container">
        <todo @onSubmit="handleSubmit"></todo>
        <todos :todos="todos"
            @onUpdate="handleUpdate"
            @onDelete="handleDelete"></todos>
    </div>
</template>
<script>
    import Axios from 'axios';
    import Todo from './components/todo.vue';
    import Todos from './components/todos.vue';

    export default {

        data () {
            return {
                todos: []
            }
        },

        mounted () {
            Axios.get('/api/todos')
                .then(res => {
                    this.todos = res.data.reverse();
                })
        },

        components: {
            Todo, Todos
        },

        methods: {

            handleUpdate (id) {
                let i = this.todos.findIndex(obj => obj.id === id)
                Axios.put('/api/todos/' + id, { ...this.todos[i], completed: !this.todos[i].completed })
                    .then(res => {
                        this.todos[i].completed = !this.todos[i].completed
                    })
                    .catch(error => {
                        console.log('There was an error updating id: ' + id);
                    })
            },

            handleDelete (id) {
                let res = confirm('Are you sure you want to permanently delete?')
                if(res) {
                    Axios.delete('/api/todos/' + id)
                        .then(res => {
                            let i = this.todos.findIndex(obj => obj.id === id)
                            this.todos.splice(i, 1)
                        })
                }
            },

            handleSubmit (data) {
                Axios.post('/api/todos/', data)
                    .then(res => {
                        this.todos.unshift(res.data);
                    })
                    .catch(error => {
                        console.log('There was an error inserting new todo')
                    })
            }

        }

    }
</script>