<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
  <x-navbar></x-navbar>
  <div id="error-message" style="display:none;"></div>

  <div class="w-full p-6 flex justify-center items-center bg-gray-100">
    <div class="container bg-white p-4 rounded-lg shadow-lg">
      <h1 class="font-semibold text-gray-900 text-xl mb-2">Daftar Produk</h1>
      <hr class="border">
      <div id="product-list" class="row mt-2"></div>
    </div>
  </div>

  <script>
     document.addEventListener('DOMContentLoaded', function() {
            const apiUrl = 'http://127.0.0.1:8000/api/products';
            const token = localStorage.getItem('authToken'); // Ambil token dari localStorage

            if (token) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`; // Set header token

                axios.get(apiUrl)
                    .then(response => {
                        console.log(response.data);
                        const productList = document.getElementById('product-list');
                        productList.innerHTML = ''; // Bersihkan daftar produk

                        //response.data.data, datanya 2x karena di API pakai APIResource jadi responsenya data{}
                        response.data.data.forEach(product => {
                            const col = document.createElement('div');
                            col.className = 'col-md-4';

                            col.innerHTML = `
                                <div class="flex m-4">
                                  <img class="w-40 h-40" src="http://127.0.0.1:8000/storage/${product.product_photo}" alt="${product.title}">
                                    <div class="m-4">
                                        <a href="/product/${product.id}">
                                           <h5 class="font-semibold text-primary-600">${product.title}</h5>
                                        </a>
                                        <p class="card-text">Harga: ${product.price}</p>
                                        <p class="card-text">Deskripsi: ${product.description || 'Tidak ada deskripsi'}</p>
                                        <p class="card-text">Lokasi: ${product.location}</p>
                                    </div>
                                </div>
                            `;
                            productList.appendChild(col);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching products:', error);
                        const errorMessage = document.getElementById('error-message');
                        errorMessage.style.display = 'block';
                        errorMessage.innerText = 'Gagal memuat produk. Silakan coba lagi.';
                    });
            } else {
                console.error('No auth token found'); // Pesan jika token tidak ada
                const errorMessage = document.getElementById('error-message');
                errorMessage.style.display = 'block';
                errorMessage.innerText = 'Anda harus login untuk melihat produk.';
            }
        });

  </script>
</body>
</html>
