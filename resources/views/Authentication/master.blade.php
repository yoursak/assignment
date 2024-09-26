<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body,
        html {
            height: 100%;
            font-family: 'Arial', sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .login-card {
            display: flex;
            justify-content: space-between;
            background-color: #fff;
            width: 900px;
            height: 450px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .illustration-side {
            width: 50%;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .illustration-side img {
            width: 80%;
            height: auto;
        }

        .form-side {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-side h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-side input {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            background-color: #e9fdfb;
        }

        .form-side input::placeholder {
            opacity: 0.5;
        }

        .form-side button {
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            font-weight: bold;
        }

        .form-side button:hover {
            background-color: #007bff;
            color: #fff;
        }

        .form-side .switch-buttons {
            display: flex;
            margin-bottom: 20px;
        }

        .switch-buttons button {
            flex: 1;
            border: none;
            background-color: #fff;
            border: 2px solid #007bff;
            cursor: pointer;
            color: #007bff;
            font-size: 14px;
        }

        .switch-buttons button.active {
            background-color: #007bff;
            color: white;
        }

        .form-side .register {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .form-side .register a {
            color: #007bff;
            text-decoration: none;
        }

        .form-side .register a:hover {
            text-decoration: underline;
        }

        .form-side label {
            color: #aca6a6;
            font-weight: bold;
        }

        @media (max-width: 900px) {
            .login-card {
                flex-direction: column;
                width: 100%;
                height: auto;
            }

            .illustration-side,
            .form-side {
                width: 100%;
            }

            .illustration-side img {
                width: 50%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-card">

            <div class="illustration-side">
                <img src="{{ asset('assets/login-banner.png') }}" alt="Login Illustration">
            </div>

            <div class="form-side">
                <form action="{{route('login.authenticateUser')}}" method="post">
                    @csrf
                    <h2>Login to your account</h2>
                    <div class="switch-buttons">
                        <button type="button" class="active">Login as User</button>
                        <button type="button">Login as Admin</button>
                    </div>
                    <label for="email">Enter Your Email</label>
                    <input type="email" name="email" placeholder="inputyouremail@gmail.com" required>
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Log In</button>
                </form>
                <div class="register">
                    Don't have an account? <a href="#">Register</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
