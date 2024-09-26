<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Management App</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            background-color: #f7f7f7;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #fff;
            padding: 20px;
            /* box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); */
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            color: #333;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin: 40px 25px;
            color: #47505E;
            font-weight: bold;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        .sidebar ul li a:hover {
            color: #3498db;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        /* Updated Header Style */
        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 20px;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
            border-radius: 8px;
        }

        .welcome-text {
            font-size: 20px;
            font-weight: bold;
            align-self: center;
        }

        .notification-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .notification-section .notifications {
            position: relative;
            cursor: pointer;
        }

        .notifications span {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #f39c12;
            color: #fff;
            border-radius: 50%;
            padding: 5px 7px;
            font-size: 12px;
        }

        .notification-section img {
            width: 40px;
            border-radius: 50%;
        }

        .navbar-btn-sec {
            display: flex;
        }

        .navbar-btn {
            font-size: 20px;
            margin: 5px 10px;
            display: none;
        }

        .sidebar-close-div {
            text-align: end;
        }

        .sidebar-close-div {
            display: none;
        }

        /* Tasks Overview Section */
    </style>
    <style>
        /* Large devices (desktops, 768px and up) */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-20rem);
                display: none;
            }

            .navbar-btn {
                display: block;
            }

            .sidebar-close-div {
                display: block;
            }

            .task-card {
                margin: 15px;
                width: 45%;
            }
        }


        /* Medium devices (desktops, 768px and up) */
        @media (max-width: 768px) {
            .task-card {
                width: 95%;
            }
        }

        /* Small devices (tablets, 576px and up) */
        @media (max-width: 576px) {
            /* .task-card {
                width: 95%;
            } */
        }
    </style>

</head>

<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-close-div" onclick="closeSidebar()"><span><i class="fa fa-close"></i></span></div>
        <h2>Logo</h2>
        <ul>
            <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i>Dashboard</a></li>
            @if (Session::get('type') == 1)
                <li><a href="{{ route('user.page') }}"><i class="fas fa-user-alt"></i>Users</a></li>
            @endif
            <li><a href="{{ route('task.page') }}"><i class="fas fa-tasks"></i>Tasks</a></li>
            <li><a href="#" onclick="$('#logoutModal').fadeIn();"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="main-header">
            <div class="navbar-btn-sec">
                <div class="navbar-btn" onclick="openSidebar()"><i class="fa fa-bars"></i></div>
                <div class="welcome-text">Welcome, {{ Session::get('name') ?? 'User' }} !</div>
            </div>
            <div class="notification-section">
                <div class="notifications">
                    <i class="fa fa-commenting"></i>
                    {{-- <span>84</span> --}}
                </div>
                <div class="notifications">
                    <i class="fa fa-bell"></i>
                    {{-- <span>84</span> --}}
                </div>
                <img src="{{ asset('assets/user.png') }}" alt="Profile Image">
            </div>
        </div>
        <script>
            var sidebar = document.getElementById('sidebar');

            function openSidebar() {
                sidebar.style.display = 'block';
                sidebar.style.transform = 'translateX(0rem)';
            }

            function closeSidebar() {
                sidebar.style.display = 'none';
                sidebar.style.transform = 'translateX(-200rem)';
            }
        </script>

        @yield('content')

        <!-- Logout Confirmation Modal -->
        <div id="logoutModal" class="modal">
            <div class="modal-content">
                <div class="modal-body">
                    Are you sure you want to log out?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#logoutModal').fadeOut();"
                        data-dismiss="modal">Cancel</button>
                    <a href="{{ route('logout') }}" type="button" class="btn btn-primary" id="confirmLogout">Logout</a>
                </div>
            </div>
        </div>

    </div>

    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif

    @if (session('info'))
        <script>
            toastr.info("{{ session('info') }}");
        </script>
    @endif

    @if (session('warning'))
        <script>
            toastr.warning("{{ session('warning') }}");
        </script>
    @endif


</body>

</html>
