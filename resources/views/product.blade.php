{{-- product detail --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
  <x-navbar></x-navbar>
  <div id="error-message" style="display:none;"></div>

  <div class="w-full p-6 flex justify-center items-center bg-gray-100">
    <div class="container bg-white p-4 rounded-lg shadow-lg">
      <h1 class="font-semibold text-gray-900 text-xl mb-2">Detail Produk</h1>
      <hr class="border">
      <div id="product-detail" class="row mt-2"></div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function(){
        // Ambil ID produk dari URL (contoh: /product/{id})
        const productId = window.location.pathname.split('/').pop(); // Ambil ID produk dari URL
        const apiUrl = `http://127.0.0.1:8000/api/products/${productId}`; //pakai backtick ``
            const token = localStorage.getItem('authToken'); // Ambil token dari localStorage

            if (token) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`; // Set header token

                axios.get(apiUrl).then(response=>{
                  console.log(response.data);
                  const productDetail = document.getElementById ('product-detail');
                  productDetail.innerHTML = ''; //berfungsi untuk menghapus konten lama sebelum menambahkan konten baru.
                  //response.data adalah objek produk tunggal, jadi bukan array
                  const product = response.data.data; // Langsung ambil produk dari respons

                    const col = document.createElement('div');
                    col.className = 'col-md-6';

                    col.innerHTML = `
                    <div class = "flex m-4">
                      <img class="w-40 h-40" src="http://127.0.0.1:8000/storage/${product.product_photo}" alt="${product.title}">
                      <div class="m-4">
                        <p>Diposting oleh: ${product.owner_product_name}</p>
                        <h5 class="font-semibold text-primary-600">${product.title} - ${product.year}</h5>
                        <p class="">Kategori: ${product.category_name}</p>
                        <p class="">Merk-Tipe: ${product.brand_name} - ${product.type_name}</p>
                        <p class="">Harga: ${product.price}</p>
                        <p class="">Deskripsi: ${product.description || 'Tidak ada deskripsi'}</p>
                        <p class="">Lokasi: ${product.location}</p>
                      </div>
                    </div>
                    `;
                    //// Tambahkan elemen 'col' ke dalam elemen 'productDetail'
                    productDetail.appendChild(col);
                })
                .catch(error => {
                        console.error('Error fetching products:', error);
                        const errorMessage = document.getElementById('error-message');
                        errorMessage.style.display = 'block';
                        errorMessage.innerText = 'Gagal memuat produk. Silakan coba lagi.';
                    });
      }else{
        console.error('No auth token found'); // Pesan jika token tidak ada
        const errorMessage = document.getElementById('error-message');
        errorMessage.style.display = 'block';
        errorMessage.innerText = 'Anda harus login untuk melihat detail produk.';
      }
     });
    </script>
  </div>
</body>