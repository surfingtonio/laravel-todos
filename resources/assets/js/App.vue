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
                    this.todos = res.data.reverse()
                })
        },

        components: {
            Todo, Todos
        },

        methods: {

            handleUpdate (id) {
                let i = this.todos.findIndex(obj => obj.id === id)
                let todo = this.todos[i]

                this.$set(todo, 'loading', true)
                this.$set(todo, 'completed', todo.completed === 1 ? 0 : 1)
                Axios.put('/api/todos/' + id, this.todos[i])
                    .then(res => {
                        this.$set(todo, 'loading', false)
                    })
                    .catch(error => {
                        this.$set(todo, 'completed', todo.completed === 1 ? 0 : 1)
                        this.$set(todo, 'loading', false)
                        console.log('There was an error updating id: ' + id);
                    })
            },

            handleDelete (id) {
                let res = confirm('Are you sure you want to permanently delete?')
                if(res) {
                    let i = this.todos.findIndex(obj => obj.id === id)
                    let todo = this.todos[i]

                    this.$set(todo, 'loading', true)
                    Axios.delete('/api/todos/' + id)
                        .then(res => {
                            this.todos.splice(this.todos.indexOf(todo), 1)
                        })
                        .catch(error => {
                            this.$set(todo, 'loading', false)
                            console.log('There was an error deleting id: ' + id);
                        })
                }
            },

            handleSubmit (data) {
                this.todos.unshift(data);
                let todo = this.todos[0]

                this.$set(todo, 'loading', true)
                Axios.post('/api/todos', data)
                    .then(res => {
                        this.$set(todo, 'id', res.data.id)
                        this.$set(todo, 'loading', false)
                    })
                    .catch(error => {
                        this.todos.splice(this.todos.indexOf(todo), 1)
                        this.$set(todo, 'loading', false)
                        console.log('There was an error inserting new todo')
                    })
            }

        }

    }
</script>