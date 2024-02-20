<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

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

<body class="d-flex flex-column gap-5">
    {{-- <div id="loadingPlaceholder" style="display: none;">Loading...</div> --}}
    <div id="loadingPlaceholder" class="spinner-border position-absolute" role="status" style="display: none;">
        <span class="visually-hidden">Loading...</span>
    </div>
    <h1 style="font-size: 2em;" class="text-center">KEP II Etkinlikleri
        Katılım Kontrol Sistemi</h1>
    <form class="login-form">
        <label for="username">Öğrenci Numarası</label>
        <input id="username" type="text" placeholder="Öğrenci Numarası">

        <label for="password">Şifre</label>
        <input id="password" type="password" placeholder="******************">

        <button type="button" id="loginButton">Giriş Yap</button>
        <div id="alertPlaceholder"></div>
        <p>
            Lütfen Sanal Kampüs kullanıcı ismi ve şifreniz ile giriş yapınız.
        </p>
    </form>

    <script>
        document.getElementById('loginButton').addEventListener('click', function() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            var loadingPlaceholder = document.getElementById('loadingPlaceholder');
            var alertPlaceholder = document.getElementById('alertPlaceholder');

            loadingPlaceholder.style.display = 'block'; // Show the loading message

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
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.message);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    localStorage.setItem('userInformation', JSON.stringify(data));
                    window.location.href = '/dashboard'; // Redirect to the dashboard
                })
                .catch((error) => {
                    alertPlaceholder.innerHTML =
                        `<div class="alert alert-danger" role="alert">${error.message}</div>`;
                })
                .finally(() => {
                    loadingPlaceholder.style.display = 'none'; // Hide the loading message
                });
        });
    </script>
</body>

</html>
