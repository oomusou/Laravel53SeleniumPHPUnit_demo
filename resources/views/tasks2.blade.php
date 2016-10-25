@extends('layouts.app')

@section('content')
    <div class="container" id="task">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">

                    <!-- New Task Form -->
                    <div class="form-horizontal">

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>
                            <div class="col-sm-6">
                                <input id="task-name" type="text" class="form-control" v-model="name">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button class="btn btn-default" @click="addTask()">
                                    <i class="fa fa-btn fa-plus"></i>
                                    Add Task
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Tasks -->
            <div class="panel panel-default" v-show="tasks.length">
                <div class="panel-heading">
                    Current Tasks
                </div>

                <div class="panel-body">
                    <table id="table" class="table table-striped task-table">
                        <thead>
                            <th>Task</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr class="task" v-for="(task, index) in tasks">
                                <td class="table-text">
                                    <div>@{{ task.name }}</div>
                                </td>

                                <!-- Task Delete Button -->
                                <td>
                                    <button class="btn btn-danger" @click="removeTask(index)">
                                        <i class="fa fa-btn fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        var tasks = {!! json_encode($tasks->toArray()) !!}

        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name=csrf-token]').getAttribute('content');

        var app = new Vue({
            el: '#task',
            data: {
                name: '',
                tasks: tasks
            },
            methods: {
                addTask: function () {
                    this.$http.post('/todo2/task', {
                        name: this.name
                    }).then(function (response) {
                        this.tasks.push(response.data);
                        this.name = '';
                    });
                },
                removeTask: function (index) {
                    var task = this.tasks.splice(index, 1)[0];
                    this.$http.delete('/todo2/task/' + task.id);
                }
            }
        });
    </script>
@endsection
