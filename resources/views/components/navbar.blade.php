
<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-white text-lg font-bold">
            <a href="#">Motoride</a>
        </div>
        <div class="flex space-x-4">
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded">My Products</a>
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded">Favorites</a>
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded">My Inbox</a>
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded">Profile</a>
            <button id="logout-button" class="btn btn-danger text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded">Logout</button>
            <button id="login-button" class="btn btn-primary text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded">Login</button>
        </div>
    </div>
    <script>
        // Cek apakah pengguna sudah login dengan memeriksa token di localStorage
        function checkLoginStatus() {
            let authToken = localStorage.getItem('authToken');
            const loginButton = document.getElementById('login-button');
            const logoutButton = document.getElementById('logout-button');

        if (authToken) {
        // Jika sudah login, sembunyikan tombol login dan tampilkan tombol logout
            loginButton.style.display = 'none';
            logoutButton.style.display = 'inline-block';
    
        } else {
        // Jika belum login, sembunyikan tombol logout dan tampilkan tombol login
            loginButton.style.display = 'inline-block';
            logoutButton.style.display = 'none';
        }
      }
        document.getElementById("logout-button").addEventListener("click", function () {
        axios
        .post("http://127.0.0.1:8000/api/logout")
        .then((response) => {
            console.log(response.data.message);
            localStorage.removeItem("authToken"); // Hapus token dari localStorage
            window.location.href = "/login"; // Arahkan pengguna kembali ke halaman login
        })
        .catch((error) => {
            console.error("Logout error:", error);
        });
      });

      // Cek status login saat halaman dimuat
      document.addEventListener('DOMContentLoaded', checkLoginStatus);

      // Event listener untuk tombol login
      document.getElementById('login-button').addEventListener('click', function() {
      window.location.href = '/login';
      });
    </script>
</nav>
