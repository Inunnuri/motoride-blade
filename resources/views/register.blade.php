<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <section class="bg-register bg-cover bg-center">
        <div class="flex flex-col items-start justify-center px-6 py-8 mx-auto lg:h-screen">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 mb-2">
                <div class="p-6 space-y-2 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Create an account
                    </h1>
                    <form id="registerForm" onsubmit="event.preventDefault(); submitForm();" class="space-y-4 md:space-y-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your name" required="">
                            <span id="nameError" class="text-red-500"></span>
                        </div>
                    
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                            <span id="emailError" class="text-red-500"></span>
                        </div>
                    
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your username" required="">
                            <span id="usernameError" class="text-red-500"></span>
                        </div>
                    
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="••••••••" required="">
                            <span id="passwordError" class="text-red-500"></span>
                        </div>
                    
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="••••••••" required="">
                            <span id="passwordConfirmationError" class="text-red-500"></span>
                        </div>
                    
                        <!-- Tombol Submit -->
                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Already have an account? <a href="{{url('/login')}}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                        </p>
                      </form>
                </div>
            </div>
        </div>
    </section>

<script>
  // Cek apakah pengguna sudah login dengan memeriksa token di localStorage
  function checkLoginStatus() {
    let authToken = localStorage.getItem('authToken');
    if (authToken) {
        // Jika sudah login, arahkan ke halaman produk
        window.location.href = '/products'; // Ganti dengan URL halaman produk Anda
    }
  }
  // Validasi frontend untuk nama, email, dan konfirmasi password
  function validateForm() {
    let email = document.getElementById('email').value;
    let name = document.getElementById('name').value;
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;
    let passwordConfirmation = document.getElementById('password_confirmation').value;
    let errors = [];

    // Validasi untuk nama dan email
    if (!email || !/^\S+@\S+\.\S+$/.test(email)) {
        errors.push("Email tidak valid.");
    }
    if (!name || name.length < 3) {
        errors.push("Nama harus diisi dan minimal 3 karakter.");
    }
    // Validasi username
    if (!username) {
        errors.push("Username harus diisi.");
    }
    // Validasi password
    if (!password || password.length < 8) {
        errors.push("Password harus diisi dan minimal 8 karakter.");
    }

    // Validasi konfirmasi password
    if (password !== passwordConfirmation) {
        errors.push("Konfirmasi password tidak cocok.");
    }

    if (errors.length > 0) {
        alert(errors.join("\n"));
        return false;  // Menghentikan pengiriman form jika ada error
    }

    return true;  // Lolos validasi frontend
  }

  async function submitForm() {
    if (!validateForm()) {
        return;  // Jika validasi frontend gagal, hentikan proses
    }

    // Ambil semua input lengkap
    let username = document.getElementById('username').value;
    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let passwordConfirmation = document.getElementById('password_confirmation').value;

    try {
        let response = await fetch('http://127.0.0.1:8000/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ username, name, email, password, password_confirmation: passwordConfirmation })
        });

        let data = await response.json();

        if (!response.ok) {
            // Tampilkan pesan error dari API
            if (data.errors) {
                if (data.errors.email) {
                    document.getElementById('emailError').textContent = data.errors.email[0];
                }
                if (data.errors.name) {
                    document.getElementById('nameError').textContent = data.errors.name[0];
                }
                if (data.errors.username) {
                    document.getElementById('usernameError').textContent = data.errors.username[0];
                }
                if (data.errors.password) {
                    document.getElementById('passwordError').textContent = data.errors.password[0];
                }
                if (data.errors.password_confirmation) {
                    document.getElementById('passwordConfirmationError').textContent = data.errors.password_confirmation[0];
                }
            }
        } else if (response.ok) {
           // Registrasi berhasil, simpan token dan redirect
           localStorage.setItem('authToken', data.access_token);  // Simpan token di localStorage
          alert(data.message);  // data.message, redirect, dan access_token dari respon API

            if (data.redirect) {
                window.location.href = data.redirect;
            }
        }
    } catch (error) {
        console.error('Error:', error);
    }
  }
  // Panggil fungsi checkLoginStatus untuk memeriksa login saat halaman registrasi dimuat
  checkLoginStatus();
</script>


</body>