<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kembang Lestari Travel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-blue-600 mb-2">Kembang Lestari Travel</h1>
                <p class="text-gray-600">Sistem Informasi Akuntansi Kas</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        value="{{ old('email') }}"
                        required
                        autofocus>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input"
                        required>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input
                        type="checkbox"
                        id="remember"
                        name="remember"
                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border-gray-300">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Ingat saya</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-full mt-6 flex items-center justify-center">
                    Masuk
                </button>
            </form>

        </div>
    </div>
</body>

</html>