<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div id="studentName">Öğrenci Adı</div>
    <div id="studentLastName">Öğrenci Soyadı</div>
    <div id="department">Bölüm</div>

    <button id="logoutButton">Logout</button>

    <script>
        var userInformation = JSON.parse(localStorage.getItem('userInformation'));

        if (userInformation) {
            document.getElementById('studentName').textContent = userInformation.name;
            document.getElementById('studentLastName').textContent = userInformation.lastname;
            document.getElementById('department').textContent = userInformation.department;
        }

        document.getElementById('logoutButton').addEventListener('click', function() {
            localStorage.removeItem('userInformation');
            window.location.href = '/';
        });
    </script>
</body>

</html>
