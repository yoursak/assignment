@extends('layout.master')
@section('content')
    <style>
        .tasks-overview {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
            margin-bottom: 20px;
        }

        .heading-over {
            padding: 10px 20px;
            border-radius: 8px;
        }

        .heading-over h3 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #464255;
        }

        .heading-over p {
            color: #888;
            font-size: 14px;
            line-height: 5px;
        }

        .tasks-overview h3 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #464255;
        }

        .tasks-overview p {
            color: #888;
            margin-bottom: 40px;
            font-size: 14px;
            line-height: 5px;
        }

        .tasks-overview .add-new-task {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .tasks-overview .add-new-task:hover {
            background-color: #2980b9;
        }

        /* Task Cards Section */
        .tasks-list {
            /* display: flex; */
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            /* width: 30%; */
        }

        .task-card {
            flex: 1;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
            min-width: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 15px;
            margin: 5px 16px;
            width: 30%;
            float: left;
        }

        .task-card h4 {
            font-size: 16px;
            color: #333;
        }

        .task-card p {
            font-size: 14px;
            color: #888;
        }

        .task-card .priority {
            font-size: 12px;
            font-weight: bold;
            border-radius: 4px;
            padding: 5px 10px;
            color: #fff;
            width: fit-content;
            height: fit-content;
        }

        .priority-high {
            background-color: #e74c3c;
        }

        .priority-medium {
            background-color: #f1c40f;
        }

        .priority-low {
            background-color: #2ecc71;
        }

        .task-card .task-actions {
            display: flex;
            justify-content: space-between;
        }

        .task-actions i {
            cursor: pointer;
            color: #888;
        }

        .task-actions i:hover {
            color: #3498db;
        }

        /* Tab section */
        .tab-section {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            background-color: #59B2E8;
            border-radius: 10px;
        }

        .tab-section .tab {
            /* background-color: #3498db; */
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .tab-section .tab.active {
            /* background-color: #2ecc71; */
        }

        .filter-priority {
            background-color: transparent;
            color: #fff;
            padding: 8px 20px;
            border-radius: 10px;
            cursor: pointer;
            margin-left: auto;
            border: none;
        }


        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 2% 25%;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); */
            animation-name: animatetop;
            animation-duration: 0.4s;
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        .modal-header {
            padding: 10px 10px;
            color: rgb(86, 41, 41);
        }

        .modal-body {
            padding: 10px 10px;
        }

        .close {
            color: rgb(86, 41, 41);
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            margin: 0.5rem 0rem;
            color: #155176;
        }

        .form-group .task-name-input {
            width: 100%;
        }

        .form-group input {
            border: #e4eaee 1px solid;
            height: 40px;
            padding: 5px
        }

        .form-group select {
            border: #e4eaee 1px solid;
            height: 40px;
            padding: 5px
        }

        .form-bottom {
            display: flex;
            justify-content: space-between;
        }

        .form-bottom .form-group {
            width: 45%;
        }

        .form-bottom .form-group select {
            width: 100%;
        }

        .form-bottom .form-group input {
            width: 100%;
        }


        input[type="date"] {
            color: #9EA8B6;
        }

        select {
            color: #9EA8B6;
        }

        select option {
            color: #9EA8B6;
        }

        .bottom-btns {
            display: flex;
            justify-content: end;
        }

        .bottom-btns .submit-btn {
            background-color: #0ACF97;
            margin: 0px 5px;
            color: #ffffff;
        }

        .bottom-btns .cancel-btn {
            background-color: #FA5C7C;
            margin: 0px 5px;
            color: #ffffff;
        }

        .assigned-by-sec {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .assigned-by-sec img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        .assigned-by-sec {
            display: flex;
            align-items: center;
        }

        .assigned-by-sec img {
            margin-right: 1px;
            height: 40px;
        }

        .assigned-by-sec p {
            margin: 0;
            line-height: 40px;
            font-weight: bold;
        }
    </style>
    <style>
        .task-card {
            padding: 15px;
            margin-bottom: 10px;
            position: relative;
        }

        .task-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .task-menu {
            position: absolute;
            top: 50px;
            right: 10px;
            background: #fff;
            border: 1px solid #ccc;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            border-radius: 5px;
        }

        .task-menu ul {
            list-style-type: none;
            margin: 0;
            padding: 10px;
        }

        .task-menu ul li {
            padding: 5px;
            cursor: pointer;
        }

        .task-menu ul li:hover {
            background-color: #f0f0f0;
        }

        .more-btn {
            cursor: pointer;
        }

        .modal-footer button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .save-btn {
            background-color: #4CAF50;
            color: #fff;
        }

        .save-btn:hover {
            background-color: #43a047;
        }

        .cancel-btn {
            background-color: #f44336;
            color: #fff;
        }

        .cancel-btn:hover {
            background-color: #e53935;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .modal-close {
            /* background-color: #f44336; */
            color: black;
            border: none;
            /* padding: 5px 10px; */
            /* border-radius: 50%; */
            cursor: pointer;
            font-size: 16px;
        }
    </style>
    <div class="heading-over">
        <h3><b>Manage Task</b></h3>
        <p>Check Your daily Tasks and Schedule</p>
    </div>

    <div class="tasks-overview">
        <h3><b>Today's Task</b></h3>
        <p>Check Your daily Tasks and Schedule</p>
        <button class="add-new-task" onclick="openModal()">Add New</button>
    </div>

    <div class="tab-section">
        <div class="tab active">My Tasks (06)</div>
        <div class="tab">Completed (06)</div>
        <button class="filter-priority">Filter By Priority</button>
    </div>

    <div class="tasks-list">
        <!-- Task Card 1 -->

        @foreach ($Tasks as $task)
            <div class="task-card">
                <div class="task-actions">
                    <div class="task-heading">
                        <h4><b>{{ $task->TITLE }}</b></h4>
                        <p>Details: {!! $task->DESCRIPTION !!}</p>
                    </div>
                    <i class="fas fa-ellipsis-h more-btn" onclick="toggleTaskMenu(this)"></i>
                </div>

                <div class="task-actions">
                    <div class="assigned-by-sec">
                        <img src="{{ asset('assets/user.png') }}" alt="Profile Image">
                        <p>
                            {{ Session::get('type') == 1 ? 'To ' : 'By ' }}
                            {{ Session::get('type') == 1 ? $task->NAME : ($task->ASSIGNED_TO == $task->CREATED_BY ? ' Me' : ' Admin') }}
                        </p>
                    </div>
                    <div class="priority priority-{{ $task->PRIORITY }}">
                        {{ ucfirst($task->PRIORITY) }}
                    </div>
                </div>

                <div class="task-menu" style="display: none;">
                    @if (Session::get('type') == 1 || $task->ASSIGNED_TO == $task->CREATED_BY)
                        <ul>
                            <li onclick="openModalWithData({{ $task }})">Edit</li>
                            <li onclick="$('#deleteTaskModal').fadeIn(); $('#taskIdDelete').val('{{ $task->TASK_ID }}')">
                                Delete
                            </li>
                        </ul>
                    @else
                        <ul>
                            <li onclick="openModalWithData({{ $task }})">Edit</li>
                            <li onclick="">Delete</li>
                        </ul>
                    @endif
                </div>
            </div>
        @endforeach

    </div>

    <div id="taskModal" class="modal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Create Task</h5>
                <span class="close" onclick="dismissModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form action="{{ route('task.createTask') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="taskName">Task Name*</label>
                        <input class="task-name-input" type="text" id="taskName" name="taskName" required>
                    </div>
                    <div class="form-group">
                        <label for="taskDetails">Description</label>
                        <textarea id="taskDetails" name="taskDetails"></textarea>
                    </div>

                    <div class="form-bottom">
                        <div class="form-group">
                            <label for="taskDate">Date*</label>
                            <input type="date" id="taskDate" name="taskDate" required>
                        </div>
                        <div class="form-group">
                            <label for="taskPriority">Priority*</label>
                            <select id="taskPriority" name="taskPriority" required>
                                <option value="1">Low</option>
                                <option value="2">Medium</option>
                                <option value="3">High</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <div class="form-group">
                            <label for="taskStatus">Assign Task *</label>
                            <select id="taskStatus" name="asignTo">
                                @foreach ($Users as $user)
                                    <option value="{{ $user->USER_ID }}">{{ $user->NAME }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taskStatus">Process Of Task</label>
                            <select id="taskStatus" name="taskStatus">
                                <option value="1">Assigned</option>
                                <option value="2">In Progress</option>
                                <option value="3">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="bottom-btns">
                        <button type="submit" class="btn submit-btn">Submit</button>
                        <button type="button" class="btn cancel-btn" onclick="dismissModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="taskUpdateModal" class="modal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Update Task</h5>
                <span class="close" onclick="dismissModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form action="{{route('task.updateTask')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="taskName">Task Name*</label>
                        <input class="task-name-input" type="text" id="taskName1" name="taskName" required>
                    </div>
                    <div class="form-group">
                        <label for="taskDetails">Description</label>
                        <textarea id="taskDetails1" name="taskDetails"></textarea>
                    </div>

                    <div class="form-bottom">
                        <div class="form-group">
                            <label for="taskDate">Date*</label>
                            <input type="date" id="taskDate1" name="taskDate" required>
                        </div>
                        <div class="form-group">
                            <label for="taskPriority">Priority*</label>
                            <select id="taskPriority1" name="taskPriority" required>
                                <option value="1">Low</option>
                                <option value="2">Medium</option>
                                <option value="3">High</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <div class="form-group">
                            <label for="taskStatus">Assign Task *</label>
                            <select id="taskAssignTo1" name="taskStatus">
                                @foreach ($Users as $user)
                                    <option value="{{ $user->USER_ID }}">{{ $user->NAME }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taskStatus">Process Of Task</label>
                            <select id="taskStatus1" name="taskStatus">
                                <option value="1">Assigned</option>
                                <option value="2">In Progress</option>
                                <option value="3">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="bottom-btns">
                        <button type="submit" class="btn submit-btn">Submit</button>
                        <button type="button" class="btn cancel-btn" onclick="dismissModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteTaskModal" class="modal">
        <form action="{{ route('task.deleteTask') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Confirm Delete</h2>
                    <button type="button" class="modal-close"
                        onclick="$('#deleteTaskModal').fadeOut();">&times;</button>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="delete-user-name"></strong>?</p>
                    <input type="text" id="taskIdDelete" name="id" hidden>
                </div>

                <div class="modal-footer">
                    <button type="button" class="cancel-btn" onclick="$('#deleteTaskModal').fadeOut();">Cancel</button>
                    <button type="submit" class="save-btn">Delete</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const moreButtons = document.querySelectorAll('.more-btn');

            moreButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const taskCard = this.closest('.task-card');
                    const taskMenu = taskCard.querySelector('.task-menu');
                    closeAllMenus();
                    taskMenu.style.display = taskMenu.style.display === 'none' || taskMenu.style
                        .display === '' ? 'block' : 'none';
                });
            });
            document.addEventListener('click', function(event) {
                closeAllMenus();
            });
            const menuItems = document.querySelectorAll('.task-menu ul li');
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    closeAllMenus();
                });
            });

            function closeAllMenus() {
                const taskMenus = document.querySelectorAll('.task-menu');
                taskMenus.forEach(menu => {
                    menu.style.display = 'none';
                });
            }
        });
    </script>
    <script>
        function openModal() {
            $('#taskModal').fadeIn();
        }

        function dismissModal() {
            $('#taskModal').fadeOut();
            $('#taskUpdateModal').fadeOut();
        }
        $(document).ready(function() {

            $('#taskDetails').summernote({
                placeholder: 'Enter details here...',
                tabsize: 2,
                height: 120
            });
        });

        $(document).ready(function() {

            $('#taskDetails1').summernote({
                placeholder: 'Enter details here...',
                tabsize: 2,
                height: 120
            });
        });

        function openModalWithData(data) {
            $('#taskUpdateModal').fadeIn();
            $('#taskName1').val(data.TITLE);
            $('#taskDetails1').val(data.DESCRIPTION);
            $('#taskDate1').val(data.DATE);
            $('#taskPriority1').val(data.PRIORITY == 'high' ? '3' : (data.PRIORITY == 'medium' ? '2' : '1'));
            $('#taskAssignTo1').val(data.ASSIGNED_TO);
            $('#taskStatus1').val(data.PROGRESS);

            $('#taskUpdateModal').fadeIn();


            if (data.ASSIGNED_TO != data.CREATED_BY && "{{ Session::get('type') }}" != '1') {
                $('#taskName1').prop('readonly', true);
                $('#taskDetails1').prop('readonly', true);
                $('#taskDate1').prop('readonly', true);
                $('#taskPriority1').prop('disabled', true);
                $('#taskAssignTo1').prop('disabled', true);
            } else {
                $('#taskName1').prop('readonly', false);
                $('#taskDetails1').prop('readonly', false);
                $('#taskDate1').prop('readonly', false);
                $('#taskPriority1').prop('disabled', false);
                $('#taskAssignTo1').prop('disabled', false);
            }

        }
    </script>
@endsection
