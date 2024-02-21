<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nişantaşı KEP Kontrol Sistemi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- by Görkem Karamolla && Burhan Sancaklı 8) -->
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
            color: green !important;
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
                <a href="https://sanalkampus.nisantasi.edu.tr/">Sanal Kampüse gitmek için tıklayınız</a>
            </div>
            <button class="btn btn-outline-danger my-2 my-sm-0" id="logoutButton">Çıkış Yap</button>
        </div>


    </nav>
    <div class="container">
        <h1>KEP II ETKİNLİKLERİ KATILIM DURUMU</h1>
        <p>Son güncellenme tarihi 19.02.2024 09:00</p>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th style="with:200px !important" scope="row" colspan="2">Öğrenci Numarası / Student
                            Number</th>
                        <td id="studentNumber"></td>
                    </tr>
                    <tr>
                        <th style="with:200px !important" scope="row" colspan="2">Öğrenci Adı / Student Name</th>
                        <td id="studentName"></td>
                    </tr>
                    <tr>
                        <th style="with:200px !important" scope="row" colspan="2">Öğrenci Soyadı / Student Surname
                        </th>
                        <td id="studentLastName"></td>
                    </tr>
                    <tr>
                        <th style="with:200px !important" scope="row" colspan="2">Bölüm / Department</th>
                        <td id="department"></td>
                    </tr>
                </tbody>
            </table>
        </div>



        <div id="main-container">
            <div class="table-responsive ">
                <table id="summaryTable">
                    <thead>
                        <tr>
                            <th>Etkinlik Sayısı / Number of Activities</th>
                            <th>Kendi Fakültenizden / From Your Faculties</th>
                            <th>Diğer Fakültelerden / From Other Faculties</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-primary">
                            <td>Toplam Tamamlanız Gereken / Total To Be Completed</td>
                            <td id="toplamAyniFakulte"></td>
                            <td id="toplamFarkliFakulte"></td>
                        </tr>
                        <tr class="table-success text-success">
                            <td>Tamamladığınız / Completed</td>
                            <td id="tamamlananAyniFakulte"></td>
                            <td id="tamamlananFarkliFakulte"></td>
                        </tr>
                        <tr class="table-danger text-danger">
                            <td>Eksik / Not Completed</td>
                            <td id="eksikAyniFakulte"></td>
                            <td id="eksikFarkliFakulte"></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="row">
                <div class="col">
                    <p>
                        Aşağıdaki tabloda KEP II etkinliklerinin listesi yer almaktadır.
                    </p>
                    <p>
                        Lütfen aşağıdaki tabloyu inceleyiniz ve eksiklerinizi tamamlayınız.
                    </p>
                </div>
                <div class="col">


                    <!-- Button trigger modal -->

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Dikkat:
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                            <path
                                d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z" />
                            <path
                                d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                        </svg>
                    </button>
                    <a href="https://sanalkampus.nisantasi.edu.tr/">Sanal Kampüse gitmek için tıklayınız</a>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Uyarı</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <pre>
Değerli Öğrencilerimiz,

KEP dersinden başarılı olmanız için en az altı tanesi öğrencisi olduğunuz
Fakülte/Yüksekokulunuzun sunacağı ve en az ikisi diğerlerinin sunacağı seminer olmak
üzere Bahar yarıyılında toplam sekiz seminere katılım sağlamanız gerekmektedir.
Seminerlere katılım durumlarınız ilgili Akademik Birimlerinizden alınmıştır

Şartları yerine getiremeyen öğrencilere I (tamamlanmamış) notu verilmiştir.

19 Şubat tarihindeki İzleme durumunuzu https://kepkontrol.nisantasi.edu.tr/ adresinden
sanal kampüs kullanıcı bilgileri ile giriş yaparak kontrol edebilirsiniz.

İzlemelerde aynı anda farklı uygulama açılmaması, ekranda başka bir uygulama açık
olmaması ve hızlı ilerletme ile atlayarak izleme yapılması durumunda kayıtlar
sayılmayacaktır.

Eksik katılımlarınızı sanal kampüse girip 24 Şubat 2024 Cumartesi günü saat 23:59'a
kadar tamamlamanız durumunda başarılı olabileceksiniz.

Başarılar Dileriz



Dear Students,

In order to be successful in KEP courses, you must attend totally eight seminars in the
spring semester at least six of which are the seminars arranged by your faculty/
vocational school and at least two from others.

The information about your attendance to the seminars have been received from the
concerned academic units.

The students who did not fulfill the requirements were graded as I (incomplete).

You can check the monitoring status by logging in with your virtual campus user
information at https://kepkontrol.nisantasi.edu.tr/.

If no different applications are opened at the same time, no other application is open
on the screen, and skipping is done with fast forwarding, the recordings will not be
counted.

You will be successful if you complete the course logging in to Virtual (Sanal) Campus
until February 24th 2024, 23:59.

Good luck
                                </pre>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Kapat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-group-horizontal text-center list-group">
                <button id="kendiFakulteButton" class="list-group-item list-group-item-action active"
                    aria-current="true">
                    Kendi Fakültenizden / From Your Faculty
                </button>
                <button id="farkliFakulteButton" class="list-group-item list-group-item-action">Diğer
                    Fakültelerden / From Other Faculties
                </button>
            </div>
            <div class="table-responsive ">

                <table id="activityTable">

                    <tr>
                        <th>Etkinlik Adı / Activity Name</th>
                        <th class="d-none">Aynı Fakülte Olup Olmadığı</th>
                        <th>Katılım Durumu / Attendance Status</th>
                    </tr>
                    <tr>

                    </tr>
                </table>
            </div>
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
                //let student_number = "20205010050";

                fetch(`/api/etkinlikler/${userInformation.student_number}/`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length === 0) {
                            document.getElementById('main-container').innerHTML =
                                "<h1>KEP II etkinlikleri başarısız öğrenciler listesinde öğrenci numaranız bulunamamıştır.<br>Sorularınız için lütfen bölümünüz ile irtibata geçiniz.</h1> <br><h1>Your student number could not be found in the list for the failed students.<br>For questions, please contact your department. </h1>";
                            return;
                        }
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
                    headerCell1.textContent = "Etkinlik Adı / Activity Name";
                    headerCell2.textContent = "Aynı Fakülte Olup Olmadığı";
                    headerCell3.textContent = "Katılım Durumu / Attendance Status";
                    headerCell1.classList.add("bolder");
                    headerCell2.classList.add("bolder");
                    headerCell2.classList.add("d-none");
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
                        cell2.classList.add("bolde");
                        cell2.classList.add("d-none");
                        cell3.textContent = activity.KATILIM === "Tamamlandı" ? "Katılım Sağlandı (Completed)" :
                            "Katılım Sağlanmadı (Not Attended)";
                        cell3.classList.add(activity.KATILIM === "Tamamlandı" ? "color-success" : "color-danger");
                        cell3.classList.add("bolde");
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
