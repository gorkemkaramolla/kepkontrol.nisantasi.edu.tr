<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 400px;
            padding: 20px;
            justify-content: center;
            align-items: center;
            background-color: white;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            color: white;
            background-color: #007BFF;
        }

        .login-form button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            body {
                padding: 20px;
                box-sizing: border-box;
            }
        }
    </style>

</head>

<body>
    <form class="login-form">
        <label for="username">Öğrenci Numarası</label>
        <input id="username" type="text" placeholder="Öğrenci Numarası">

        <label for="password">Şifre</label>
        <input id="password" type="password" placeholder="******************">

        <button type="button" id="loginButton">Giriş Yap</button>
    </form>

    <script>
        document.getElementById('loginButton').addEventListener('click', function() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        university_id: username,
                        password: password,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    localStorage.setItem('userInformation', JSON.stringify(data));
                    window.location.href = '/dashboard'; // Redirect to the dashboard
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>
