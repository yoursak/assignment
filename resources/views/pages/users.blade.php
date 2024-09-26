@extends('layout.master')
@section('content')
    <style>
        .user-table {
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 8px;
            margin-top: 20px;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-header h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .add-new-btn {
            background-color: #36A2EB;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .add-new-btn:hover {
            background-color: #218dd1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #36A2EB;
            color: #fff;
        }

        thead th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        tbody tr {
            background-color: #fff;
            border-bottom: 1px solid #e0e0e0;
        }

        tbody td {
            padding: 15px;
            text-align: left;
            font-size: 14px;
            color: #333;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .edit-btn,
        .delete-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }

        .edit-btn i {
            color: #4CAF50;
        }

        .delete-btn i {
            color: #f44336;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 8% auto;
            padding: 10px;
            border-radius: 8px;
            width: 70%;
            max-width: 1100px;
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* margin-bottom: 20px; */
        }

        .modal-header h2 {
            margin: 0;
            font-size: 18px;
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

        /* .modal-close:hover {
                                    background-color: #d12b1f;
                                } */

        .modal-body input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .modal-body select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
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

        .input-form {
            width: 48%;
            float: left;
            margin: 5px;
        }

        .paginationm {
            text-align: center;
            margin-top: 1rem;
        }
    </style>
    <style>
        @media (max-width: 768px) {
            .input-form {
                width: 98%;
            }
        }

        @media (max-width: 576px) {}
    </style>
    <style>
        .custom-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }

        .custom-pagination a,
        .custom-pagination span {
            padding: 5px 7px;
            margin: 0 5px;
            text-decoration: none;
            border-radius: 4px;
            color: #007bff;
            transition: background-color 0.2s, color 0.2s;
            font-size: 14px;
        }

        .custom-pagination a:hover {
            background-color: #007bff;
            color: white;
        }

        .custom-pagination .active {
            background-color: #007bff;
            color: white;
        }

        .custom-pagination .disabled {
            color: #6c757d;
            pointer-events: none;
        }
    </style>

    <!-- User Table -->
    <div class="user-table">
        <div class="table-header">
            <h2>User Management</h2>
            <button class="add-new-btn" onclick="showAddModal()">Add New <i class="fas fa-plus"></i></button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>S. No</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Users as $key => $user)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $user->NAME }}</td>
                        <td>{{ $user->USER_TYPE == 1 ? 'Admin' : 'User' }}</td>
                        <td>{{ $user->EMAIL }}</td>
                        <td class="actions">
                            <button class="edit-btn"
                                onclick="showEditModal('{{ $user->NAME }}', '{{ $user->USER_TYPE }}', '{{ $user->EMAIL }}')"><i
                                    class="fas fa-edit"></i></button>
                            <button class="delete-btn"
                                onclick="showDeleteModal('{{ $user->NAME }}','{{ $user->USER_ID }}')"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="custom-pagination">
            @if ($Users->onFirstPage())
                <span class="disabled">&laquo; &laquo;</span>
            @else
                <a href="{{ $Users->previousPageUrl() }}">&laquo; &laquo;</a>
            @endif

            @for ($i = 1; $i <= $Users->lastPage(); $i++)
                @if ($i == $Users->currentPage())
                    <span class="active">{{ $i }}</span>
                @else
                    <a href="{{ $Users->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            @if ($Users->hasMorePages())
                <a href="{{ $Users->nextPageUrl() }}">&raquo; &raquo;</a>
            @else
                <span class="disabled">&raquo; &raquo;</span>
            @endif
        </div>

    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="modal">
        <form action="{{ route('user.addNewUser') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Add New User</h2>
                    <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="input-form">
                        <span for="taskStatus">Full Name</span>
                        <input type="text" placeholder="Full Name" name="name" id="name">
                    </div>
                    <div class="input-form">
                        <span for="taskStatus">Designation</span>
                        <input type="text" placeholder="Desilgnation" name="designation" id="designation">
                        {{-- <select name="designation" id="designation">
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select> --}}
                    </div>
                    <div class="input-form">
                        <span for="taskStatus">Email</span>
                        <input type="email" placeholder="Email" name="email" id="email">
                    </div>
                    <div class="input-form">
                        <span for="taskStatus">Password</span>
                        <input type="text" placeholder="Password" name="password" id="password">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="save-btn">Save</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="modal">
        <form action="{{ route('user.updateUser') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Edit User</h2>
                    <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="input-form">
                        <span for="taskStatus">Full Name</span>
                        <input type="text" placeholder="Full Name" name="name" id="edit-name">
                    </div>
                    <div class="input-form">
                        <span for="taskStatus">Designation</span>
                        <input type="text" placeholder="Desilgnation" name="designation" id="edit-designation">
                    </div>
                    <div class="input-form">
                        <span for="taskStatus">Email</span>
                        <input type="email" placeholder="Email" name="email" id="edit-email">
                    </div>
                    <div class="input-form">
                        <span for="taskStatus">Change Password</span>
                        <input type="text" placeholder="Password" name="password" id="edit-password">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="save-btn">Save Changes</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Delete User Modal -->
    <div id="deleteUserModal" class="modal">
        <form action="{{ route('user.deleteUser') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Confirm Delete</h2>
                    <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="delete-user-name"></strong>?</p>
                    <input type="text" id="userIdDelete" name="userid" hidden>
                </div>

                <div class="modal-footer">
                    <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="save-btn">Delete</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function showAddModal() {
            document.getElementById("addUserModal").style.display = "block";
        }

        function showEditModal(name, designation, email) {
            document.getElementById("edit-name").value = name;
            document.getElementById("edit-designation").value = designation;
            document.getElementById("edit-email").value = email;
            document.getElementById("editUserModal").style.display = "block";
        }

        function showDeleteModal(name, id) {
            document.getElementById("delete-user-name").innerText = name;
            document.getElementById("deleteUserModal").style.display = "block";
            document.getElementById("userIdDelete").value = id;
        }

        function closeModal() {
            const modals = document.querySelectorAll(".modal");
            modals.forEach(modal => modal.style.display = "none");
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modals = document.querySelectorAll(".modal");
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        }
    </script>
@endsection
