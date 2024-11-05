import axios from "axios";
// Atur base URL API backend Anda
axios.defaults.baseURL = "http://127.0.0.1:8000/api"; // Ganti URL ini dengan URL backend API Anda
axios.defaults.withCredentials = true; // Jika menggunakan Laravel Sanctum untuk autentikasi

// Anda juga bisa mengatur header default, jika diperlukan
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// Ekspor Axios agar bisa digunakan di file lain
window.axios = axios;
