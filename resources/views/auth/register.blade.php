<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#eef1f5;
}

.register-container{
    height:100vh;
}

.register-card{
    width:420px;
    border:none;
    border-radius:8px;
}

</style>

</head>
<body>

<div class="d-flex justify-content-center align-items-center register-container">

    <div class="card shadow-sm register-card">
        <div class="card-body p-4">

            <h6 class="text-center mb-4">Register</h6>

            <form method="POST" action="/register">
                @csrf

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        placeholder="Masukan Nama Lengkap"
                        required
                    >
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Masukan Email"
                        required
                    >
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukan Password"
                        required
                    >
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label class="form-label">Konfirmasi password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi Password"
                        required
                    >
                </div>

                <!-- Button -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>

            </form>

            <div class="text-center mt-3">
                <small>
                    Sudah punya akun?
                    <a href="/login">Login sekarang</a>
                </small>
            </div>

        </div>
    </div>

</div>

</body>
</html>
