<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>JoBee Magang</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        img {
            width: 50px;
            height: 50px;
        }

        button {
            background-color: #D79311;
            padding: 5px;
            border: none;
            color: white;
            cursor: pointer;
        }
    </style>

<script>
        // Fungsi untuk mengambil data magang dari server
        function fetchInternships() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'internships.php', true);
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    displayInternships(JSON.parse(this.responseText));
                }
            };
            xhr.send();
        }

        // Fungsi untuk menampilkan data magang dalam tabel
        function displayInternships(data) {
            var table = document.getElementById('magangTable');
            table.innerHTML = '';
            data.forEach(function(item, index) {
                var row = table.insertRow();
                row.innerHTML = `
                    <td><img src="${item.logo}" alt="Logo Perusahaan"></td>
                    <td>${item.nama_perusahaan}</td>
                    <td>${item.posisi}</td>
                    <td>
                        <button onclick="acceptInternship(${index})">Terima</button>
                        <button onclick="deleteInternship(${item.id})">Hapus</button>
                    </td>
                `;
            });
        }

        // Fungsi untuk menghapus data magang
        function deleteInternship(id) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'hapus_magang.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    alert('Data magang berhasil dihapus.');
                    fetchInternships();
                }
            };
            xhr.send(JSON.stringify({ id: id }));
        }

        // Panggil fungsi untuk mengambil data magang saat halaman dimuat
        window.onload = fetchInternships;
    </script>
    
</head>

<body>
    <table id="magangTable">
        <tr>
            <th>Logo Perusahaan</th>
            <th>Nama Perusahaan</th>
            <th>Posisi</th>
            <th>Aksi</th>
        </tr>
        <!-- Data magang akan ditampilkan di sini -->
    </table>
</body>

</html>
