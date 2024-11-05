
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
        </div>
    </div>
    <script>
        document.getElementById("logout-button").addEventListener("click", function () {
      axios
        .post("http://127.0.0.1:8000/api/logout")
        .then((response) => {
            console.log(response.data.message);
            localStorage.removeItem("authToken"); // Hapus token dari localStorage
            window.location.href = "/"; // Arahkan pengguna kembali ke halaman login
        })
        .catch((error) => {
            console.error("Logout error:", error);
        });
      });
    </script>
</nav>
