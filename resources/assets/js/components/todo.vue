<template>
    <div class="row mb-2">
        <div class="col">
            <form action="/api/todos">
                <input type="text"
                       class="form-control form-control-lg"
                       placeholder="Enter todo item"
                       name="todo"
                       v-model="todo"
                       @keydown.enter="handleSubmit($event)">
            </form>
        </div>
    </div>
</template>

<script>
    export default {

        data () {
            return {
                todo: ''
            }
        },

        methods: {

            handleSubmit (e) {
                e.preventDefault()
                this.$emit('onSubmit', { todo: this.todo, completed: 0 })
                this.todo = ''
            }

        }
    }
</script>