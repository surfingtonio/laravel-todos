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
                let c = this.todos[i].completed

                this.todos[i].completed = c === 1 ? 0 : 1
                Axios.put('/api/todos/' + id, { ...this.todos[i], completed: c === 1 ? 0 : 1 })
                    .catch(error => {
                        this.todos[i].completed = c
                        console.log('There was an error updating id: ' + id);
                    })
            },

            handleDelete (id) {
                let res = confirm('Are you sure you want to permanently delete?')
                if(res) {
                    let i = this.todos.findIndex(obj => obj.id === id)
                    let c = this.todos[i]

                    this.todos.splice(i, 1)
                    Axios.delete('/api/todos/' + id)
                        .catch(error => {
                          this.todos.splice(i, 0, c)
                          console.log('There was an error deleting id: ' + id);
                        })
                }
            },

            handleSubmit (data) {
                this.todos.unshift(data);
                Axios.post('/api/todos/', data)
                    .then(res => {
                        this.todos[0].id = res.data.id
                    })
                    .catch(error => {
                        this.todos.splice(0, 1)
                        console.log('There was an error inserting new todo')
                    })
            }

        }

    }
</script>