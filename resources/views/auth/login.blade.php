{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
 --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Kredit Truk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f4f6f9;
            /* Warna lebih soft */
            opacity: 0;
            animation: fadeIn 1s ease-in forwards;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container {
            display: flex;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            width: 800px;
            transition: transform 0.3s ease-in-out;
        }

        .login-container:hover {
            transform: scale(1.02);
        }

        .login-form {
            padding: 40px;
            width: 50%;
            text-align: left;
        }

        .login-form h2 {
            color: #333333;
        }

        .login-form p {
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            position: relative;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.5);
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: #4a90e2;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            color: white;
            transition: background 0.1s;
        }

        .login-btn:hover {
            background: #357abd;
        }

        .info-container {
            background: #1e3c72;
            padding: 20px;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: black;
        }

        .info-container img {
            width: 90%;
            margin-bottom: 20px;
            opacity: 0;
            animation: fadeIn 1.5s ease-in forwards 0.5s;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 70%;
            transform: translateY(-50%);
            cursor: pointer;
            transition: color 0.3s;
        }

        .toggle-password:hover {
            color: #4a90e2;
        }

        .logo {
            width: 100px;
            margin-bottom: 20px;
            background-image: url("asset('images/mweb2.png')");
            height: 150px;
            background-size: contain;
            background-repeat: no-repeat;
        }

        .error-msg {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            display: none;
        }

        .success-msg {
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
            display: none;
        }

        .success-msg,
        .error-msg {
            font-size: 14px;
            display: none;
            padding: 5px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            position: relative;
            padding: 5px;
            background: #fff;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .remember-me input {
            width: 14px;
            height: 14px;
            margin-right: 5px;
        }

        .remember-me label {
            font-size: 15px;
            color: #333;
            cursor: pointer;
        }

        .remember-me input:checked::before {
            content: "\f00c";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            background: #4a90e2;
            color: white;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Login</h2>
            <p id="greeting">👋 Happy Tuesday!</p>
            <p id="success-msg" class="success-msg">✅ Sandi telah disimpan!</p>
            <p id="error-msg" class="error-msg">❌ Username atau password salah!</p>

            <form method="POST" actions="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" id="nik" type="text" name="nik" placeholder="Masukkan Username"
                        required />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan Password" required />
                    <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
                </div>
                {{-- <div class="remember-me">
                    <input type="checkbox" id="remember_me" name="remember" />
                    <label for="remember">Simpan Sandi</label>
                </div> --}}
                <a href="#" style="display: block; margin-bottom: 10px; color: blue">Reset Password</a>
                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
        <div class="info-container">
            <div class="imgcontainer">
                <img src="images/mweb2.png" alt="mweb2" />
            </div>
            <div
                style="
             border: 2px solid #000;
             padding: 15px;
             border-radius: 10px;
             background-color: #f9f9f9;
             width: fit-content;
             margin-top: 20px;
           ">
                <p><strong>Sistem Arsip Data</strong></p>
                <ul
                    style="
               text-align: left;
               padding: 10px;
               font-size: 15px;
               list-style-type: none;
             ">
                    <li>
                        Sistem Arsip Data yang bisa digunakan untuk Sistem Manajemen
                        Dokumen maupun Data Nasabah, dengan tampilan yang modern dan
                        beberapa fitur interaktif.
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Simulasi database user
        const users = [{
                username: "admin",
                password: "admin123",
                role: "admin"
            },
            {
                username: "user",
                password: "user123",
                role: "user"
            },
        ];

        document.addEventListener("DOMContentLoaded", () => {
            const savedUsername = localStorage.getItem("savedUsername");
            const savedPassword = localStorage.getItem("savedPassword");
            if (savedUsername && savedPassword) {
                document.getElementById("username").value = savedUsername;
                document.getElementById("password").value = savedPassword;
                document.getElementById("rememberMe").checked = true;
            }
        });

        document.addEventListener("DOMContentLoaded", () => {
            const days = [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
            ];
            const today = new Date().getDay();
            document.getElementById(
                "greeting"
            ).textContent = `👋 Happy ${days[today]}!`;
        });

        function handleLogin(event) {
            event.preventDefault();
            const username = document.getElementById("username").value.trim();
            const password = document.getElementById("password").value;
            const errorMsg = document.getElementById("error-msg");
            const user = users.find(
                (u) => u.username === username && u.password === password
            );

            if (user) {
                sessionStorage.setItem("role", user.role);
                sessionStorage.setItem("username", user.username);
                if (user.role === "admin") {
                    window.location.href = "admin.html";
                } else {
                    window.location.href = "index.html";
                    setTimeout(() => {
                        alert(
                            "Permintaan peminjaman dokumen telah dikirim. Status: Menunggu Verifikasi"
                        );
                    }, 1000);
                }
            } else {
                errorMsg.style.display = "block";
                setTimeout(() => {
                    errorMsg.style.display = "none";
                }, 3000);
            }
        }

        if (rememberMe) {
            localStorage.setItem("savedUsername", username);
        } else {
            localStorage.removeItem("savedUsername");
        }

        function login() {
            document.body.style.opacity = "0"; // Efek fade-out sebelum pindah halaman
            setTimeout(() => {
                window.location.href = "index.html"; // Ganti dengan halaman dashboard
            }, 500);
        }

        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const icon = document.querySelector(".toggle-password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }

        function handleSubmit(event) {
            event.preventDefault(); // Mencegah form melakukan submit biasa
            document.body.style.opacity = "0"; // Efek fade-out sebelum pindah halaman
            setTimeout(() => {
                window.location.href = "index.html"; // Pindah ke dashboard
            }, 500);
        }

        function logout() {
            // Hapus username dan password yang disimpan di localStorage
            localStorage.removeItem("savedUsername");
            localStorage.removeItem("savedPassword");

            // Kosongkan input username dan password di form login
            document.getElementById("username").value = "";
            document.getElementById("password").value = "";

            // Redirect ke halaman login setelah logout
            setTimeout(() => {
                window.location.href = "login.html";
            }, 500);
        }
    </script>
</body>

</html>
