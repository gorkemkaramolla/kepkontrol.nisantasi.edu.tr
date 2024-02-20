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


    <table id="summaryTable">
        <tr>
            <th>Etkinlik Sayısı</th>
            <th>Kendi Fakültenizden / Yüksekokulunuzdan</th>
            <th>Okulunuzdan	Diğer Birimlerden</th>
        </tr>
        <tr>
            <td>Toplam Tamamlanız Gereken</td>
            <td id="toplamAyniFakulte"></td>
            <td id="toplamFarkliFakulte"></td>
        </tr>
        <tr>
            <td>Tamamladığınız</td>
            <td id="tamamlananAyniFakulte"></td>
            <td id="tamamlananFarkliFakulte"></td>
        </tr>
        <tr>
            <td>Eksik</td>
            <td id="eksikAyniFakulte"></td>
            <td id="eksikFarkliFakulte"></td>
        </tr>
    </table>

    <table id="activityTable">
        <tr>
            <th>Etkinlik Adı</th>
            <th>Aynı Fakülte Olup Olmadığı</th>
            <th>Katılım Durumu</th>
        </tr>
        <tr>
            
        </tr>
    </table>

    <script>
        var userInformation = JSON.parse(localStorage.getItem('userInformation'));

        if (userInformation) {
            document.getElementById('studentName').textContent = userInformation.name;
            document.getElementById('studentLastName').textContent = userInformation.lastname;
            document.getElementById('department').textContent = userInformation.department;
            //let student_number = userInformation.student_number;
            let student_number = "20166011101";
            
            fetch(`/api/etkinlikler/${student_number}/`)
            .then(response => response.json())
            .then(data => {
                console.log(data)

                 // Populate table cells with fetched data
                let table = document.getElementById('activityTable');
                data.forEach(activity => {
                    let row = table.insertRow();
                    let cell1 = row.insertCell(0);
                    let cell2 = row.insertCell(1);
                    let cell3 = row.insertCell(2);
                    
                    cell1.textContent = activity.EKTINLIK_KEY + ' ' + activity.ETKINLIK_ADI;                    
                    cell2.textContent = activity.AYNI_FAKULTE === "Fakülte/MYO içi" ? "Aynı Fakülte" : "Farklı Fakülte";
                    cell3.textContent = activity.KATILIM === "Tamamlandı" ? "Katılım Sağlandı" : "Katılım Sağlanmadı";
                    
                });
                
                const tamamlanan_ayni_fakulte = data.filter(item => item.KATILIM === "Tamamlandı" && item.AYNI_FAKULTE==="Fakülte/MYO içi").length;
                const tamamlanan_farkli_fakulte = data.filter(item => item.KATILIM === "Tamamlandı" && item.AYNI_FAKULTE==="Fakülte/MYO dışı").length;
                const eksik_ayni_fakulte = Math.max(0, 6-tamamlanan_ayni_fakulte); // data.filter(item => item.KATILIM === "" && item.AYNI_FAKULTE==="Fakülte/MYO içi").length;
                const eksik_farkli_fakulte = Math.max(0, 2-tamamlanan_farkli_fakulte); // data.filter(item => item.KATILIM === "" && item.AYNI_FAKULTE==="Fakülte/MYO içi").length; // data.filter(item => item.KATILIM === "" && item.AYNI_FAKULTE==="Fakülte/MYO dışı").length;
                const toplam_ayni_fakulte = 6 // tamamlanan_ayni_fakulte+eksik_ayni_fakulte;
                const toplam_farkli_fakulte = 2 // tamamlanan_farkli_fakulte+eksik_farkli_fakulte;

                document.getElementById('tamamlananAyniFakulte').textContent = tamamlanan_ayni_fakulte;
                document.getElementById('tamamlananFarkliFakulte').textContent = tamamlanan_farkli_fakulte;
                document.getElementById('eksikAyniFakulte').textContent = eksik_ayni_fakulte;
                document.getElementById('eksikFarkliFakulte').textContent = eksik_farkli_fakulte;
                document.getElementById('toplamAyniFakulte').textContent = toplam_ayni_fakulte;
                document.getElementById('toplamFarkliFakulte').textContent = toplam_farkli_fakulte;
                

            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        }
        document.getElementById('logoutButton').addEventListener('click', function() {
            localStorage.removeItem('userInformation');
            window.location.href = '/';
        });
    </script>
</body>

</html>
