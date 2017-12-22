<template>
    <div class="row">
        <div class="col" v-if="todos.length < 1">
            <p class="text-center text-muted">
                There are no todo items.
            </p>
        </div>
        <div class="col-12" v-for="(todo, i) in todos" :key="i">
            <div class="todo card mb-2" :class="{ 'completed' : todo.completed == 1 }">
                <div class="card-body pl-5 pr-5">
                    <input type="checkbox" class="form-check form-check-inline"
                           :checked="todo.completed == 1"
                           :value="todo.id"
                           @click="$emit('onUpdate', todo.id)">
                    <span>{{ todo.todo }}</span>
                    <button type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-label="Close"
                            @click="$emit('onDelete', todo.id)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Axios from 'axios'

    export default {

        props: [ 'todos', 'message' ]

    }
</script>