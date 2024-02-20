<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
    <style>
        #studentNumber,
        #studentName,
        #studentLastName,
        #department {
            width: 100%;
            font-family: Arial, sans-serif;
            color: #333;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .color-danger {
            color: red !important;
        }

        .color-success {
            color: green !important !;
        }

        .bolder {
            font-weight: 800;
        }
    </style>
</head>

<body class="">
    <nav class="navbar navbar-light w-100 bg-light">
        <div class="container">
            <div>
                <a class="navbar-brand" href="#"><img class="w-25 h-25" src="/logo-nisantasi.png"
                        alt=""></a>
                <a href="https://sanalkampus.nisantasi.edu.tr/">SanalKampüse gitmek için tıklayınız</a>
            </div>
            <button class="btn btn-outline-danger my-2 my-sm-0" id="logoutButton">Logout</button>
        </div>


    </nav>
    <div class="container">
        <h1>KEP II ETKİNLİKLERİ KATILIM DURUMU</h1>
        <div class="table-responsive ">
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row" colspan="2">Öğrenci Numarası</th>
                        <td id="studentNumber"></td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="2">Öğrenci Adı</th>
                        <td id="studentName"></td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="2">Öğrenci Soyadı</th>
                        <td id="studentLastName"></td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="2">Bölüm</th>
                        <td id="department"></td>
                    </tr>
                </tbody>
            </table>
        </div>




        <div class="table-responsive ">
            <table id="summaryTable">
                <thead>
                    <tr>
                        <th>Etkinlik Sayısı</th>
                        <th>Kendi Fakültenizden</th>
                        <th>Diğer Fakültelerden</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-primary">
                        <td>Toplam Tamamlanız Gereken</td>
                        <td id="toplamAyniFakulte"></td>
                        <td id="toplamFarkliFakulte"></td>
                    </tr>
                    <tr class="table-success text-success">
                        <td>Tamamladığınız</td>
                        <td id="tamamlananAyniFakulte"></td>
                        <td id="tamamlananFarkliFakulte"></td>
                    </tr>
                    <tr class="table-danger text-danger">
                        <td>Eksik</td>
                        <td id="eksikAyniFakulte"></td>
                        <td id="eksikFarkliFakulte"></td>
                    </tr>
                </tbody>
            </table>
            <p>
                Aşağıdaki tabloda KEP II etkinliklerinin listesi yer almaktadır.
            </p>
            <p>
                Lütfen aşağıdaki tabloyu inceleyiniz ve eksiklerinizi tamamlayınız.

            </p>
        </div>
        <div class="list-group-horizontal text-center list-group">
            <button id="kendiFakulteButton" class="list-group-item list-group-item-action active" aria-current="true">
                Kendi Fakültenizden
            </button>
            <button id="farkliFakulteButton" class="list-group-item list-group-item-action">Diğer
                Fakültelerden
            </button>
        </div>
        <div class="table-responsive ">

            <table id="activityTable">

                <tr>
                    <th>Etkinlik Adı</th>
                    <th>Aynı Fakülte Olup Olmadığı</th>
                    <th>Katılım Durumu</th>
                </tr>
                <tr>

                </tr>
            </table>
        </div>
    </div>
    <script>
        var userInformation = JSON.parse(localStorage.getItem('userInformation'));
    </script>
    <script>
        if (!userInformation) {
            window.location.href = '/';
        } else {
            var userInformation = JSON.parse(localStorage.getItem('userInformation'));

            if (userInformation) {
                document.getElementById('studentNumber').textContent = userInformation.student_number;
                document.getElementById('studentName').textContent = userInformation.name;
                document.getElementById('studentLastName').textContent = userInformation.lastname;
                document.getElementById('department').textContent = userInformation.department;
                let student_number = "20205010050";

                fetch(`/api/etkinlikler/${student_number}/`)
                    .then(response => response.json())
                    .then(data => {
                        window.activityData = data;

                        populateTable(data.filter(activity => activity.AYNI_FAKULTE === "Fakülte/MYO içi"));

                        const tamamlanan_ayni_fakulte = data.filter(item => item.KATILIM === "Tamamlandı" && item
                            .AYNI_FAKULTE === "Fakülte/MYO içi").length;
                        const tamamlanan_farkli_fakulte = data.filter(item => item.KATILIM === "Tamamlandı" && item
                            .AYNI_FAKULTE === "Fakülte/MYO dışı").length;
                        const eksik_ayni_fakulte = Math.max(0, 6 - tamamlanan_ayni_fakulte);
                        const eksik_farkli_fakulte = Math.max(0, 2 - tamamlanan_farkli_fakulte);
                        const toplam_ayni_fakulte = 6;
                        const toplam_farkli_fakulte = 2;

                        document.getElementById('tamamlananAyniFakulte').textContent = tamamlanan_ayni_fakulte ?
                            tamamlanan_ayni_fakulte : "---";
                        document.getElementById('tamamlananFarkliFakulte').textContent = tamamlanan_farkli_fakulte ?
                            tamamlanan_farkli_fakulte : "---";
                        document.getElementById('eksikAyniFakulte').textContent = eksik_ayni_fakulte ?
                            eksik_ayni_fakulte : "---";
                        document.getElementById('eksikFarkliFakulte').textContent = eksik_farkli_fakulte ?
                            eksik_farkli_fakulte : "---";
                        document.getElementById('toplamAyniFakulte').textContent = toplam_ayni_fakulte ?
                            toplam_ayni_fakulte : "---";
                        document.getElementById('toplamFarkliFakulte').textContent = toplam_farkli_fakulte ?
                            toplam_farkli_fakulte : "---";
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });

                document.getElementById('kendiFakulteButton').addEventListener('click', function() {
                    let filteredData = window.activityData.filter(activity => activity.AYNI_FAKULTE ===
                        "Fakülte/MYO içi");
                    populateTable(filteredData);

                    // Add active class to this button and remove from the other
                    this.classList.add('active');
                    document.getElementById('farkliFakulteButton').classList.remove('active');
                });

                document.getElementById('farkliFakulteButton').addEventListener('click', function() {
                    let filteredData = window.activityData.filter(activity => activity.AYNI_FAKULTE !==
                        "Fakülte/MYO içi");
                    populateTable(filteredData);

                    // Add active class to this button and remove from the other
                    this.classList.add('active');
                    document.getElementById('kendiFakulteButton').classList.remove('active');
                });

                function populateTable(data) {
                    let table = document.getElementById('activityTable');
                    table.innerHTML = ''; // Clear the table

                    // Add table header
                    let header = table.createTHead();
                    let headerRow = header.insertRow();
                    let headerCell1 = headerRow.insertCell(0);
                    let headerCell2 = headerRow.insertCell(1);
                    let headerCell3 = headerRow.insertCell(2);
                    headerCell1.textContent = "Etkinlik Adı";
                    headerCell2.textContent = "Aynı Fakülte Olup Olmadığı";
                    headerCell3.textContent = "Katılım Durumu";
                    headerCell1.classList.add("bolder");
                    headerCell2.classList.add("bolder");
                    headerCell3.classList.add("bolder");
                    // Populate table with data
                    data.forEach(activity => {
                        let row = table.insertRow();
                        let cell1 = row.insertCell(0);
                        let cell2 = row.insertCell(1);
                        let cell3 = row.insertCell(2);

                        cell1.textContent = activity.EKTINLIK_KEY + ' ' + activity.ETKINLIK_ADI;
                        cell2.textContent = activity.AYNI_FAKULTE === "Fakülte/MYO içi" ? "Aynı Fakülte" :
                            "Farklı Fakülte";
                        cell2.classList.add("bolder");
                        cell3.textContent = activity.KATILIM === "Tamamlandı" ? "Katılım Sağlandı" :
                            "Katılım Sağlanmadı";
                        cell3.classList.add(activity.KATILIM === "Tamamlandı" ? "color-success" : "color-danger");
                        cell3.classList.add("bolder");
                    });
                }
            }

            document.getElementById('logoutButton').addEventListener('click', function() {
                localStorage.removeItem('userInformation');
                window.location.href = '/';
            });
        }
    </script>
</body>

</html>
