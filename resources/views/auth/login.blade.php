<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#eef1f5;
    background-image: url('storage/buku3.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.login-container{
    height:100vh;
}

.login-card{
    width:420px;
    border:none;
    border-radius:8px;
}

</style>

</head>
<body>

<div class="d-flex justify-content-center align-items-center login-container">

    <div class="card shadow-sm login-card">
        <div class="card-body p-4">

           <h6 class="text-center mb-4" style="font-weight: 700; color: #60a5fa; font-size: 18px;">Login</h6>

            <form method="POST" action="/login">
                @csrf

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

                    <div class="input-group">

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukan Password"
                            required
                        >

                    </div>

                </div>

                <!-- Button -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                </div>

            </form>

            <div class="text-center mt-3">
                <small>
                    Belum punya akun?
                    <a href="/register">Register sekarang</a>
                </small>
            </div>

        </div>
    </div>

</div>

</body>
</html>
