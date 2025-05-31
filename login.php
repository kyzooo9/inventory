<?php
session_start();
require 'koneksi.php'; // Menggunakan koneksi Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek input kosong
    if (!empty($username) && !empty($password)) {
        // Query ke database
        $query = $koneksi->prepare("SELECT id_peminjam, username_peminjam, password_peminjam, IMAGE_PEMINJAM , role FROM peminjam WHERE username_peminjam = ? AND password_peminjam = ?");
        $query->bind_param("ss", $username, $password);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows === 1) {
            // Ambil data user dan role dari database
            $row = $result->fetch_assoc();
            $role = $row['role'];  // Ambil nilai role
            $image = $row['IMAGE_PEMINJAM'];
            // Set session
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['image'] = $image;// Simpan role peminjam
        
            header("Location: profil.php"); // Redirect ke halaman dashboard
            exit();
        }
         else {
            $error = "Username atau Password salah!";
        }
    } else {
        $error = "Harap isi semua kolom!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SMK ABC Inventory</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Global Styles */
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #2c3e50; /* Dark background for login */
      color: #fff;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    /* Animated Background */
    .background {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #1abc9c, #16a085); /* Soft teal colors */
      background-size: 400% 400%;
      animation: gradientAnimation 6s ease infinite;
      z-index: -1;
    }

    @keyframes gradientAnimation {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }

    /* Login Card */
    .login-card {
      background: rgba(255, 255, 255, 0.15); /* Slightly transparent white */
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(15px); /* Blurred background for modern look */
      max-width: 400px;
      width: 100%;
      animation: fadeInUp 1s ease-out;
    }

    .login-card h3 {
      text-align: center;
      font-size: 2.5rem;
      margin-bottom: 1.5rem;
      color: #fff;
      font-weight: 600;
      animation: fadeInText 1.5s ease-out;
    }

    /* Input Styles */
    .login-card .form-control {
      background: rgba(255, 255, 255, 0.2); /* Slight transparency */
      color: #fff;
      border-radius: 30px;
      border: 1px solid #fff;
      padding: 1rem;
      font-size: 1rem;
      transition: border-color 0.3s ease;
    }

    .login-card .form-control:focus {
      border-color: #1abc9c; /* Teal focus color */
      outline: none;
    }

    /* Button Styles */
    .login-card button {
      width: 100%;
      padding: 1rem;
      border-radius: 30px;
      border: none;
      background: linear-gradient(45deg, #1abc9c, #16a085);
      color: #fff;
      font-size: 1.2rem;
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-card button:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(26, 188, 156, 0.5);
    }

    /* Error Alert Styles */
    .error-alert {
      color: #e74c3c; /* Red for error */
      background-color: rgba(231, 76, 60, 0.2);
      padding: 0.8rem;
      border-radius: 10px;
      margin-bottom: 1rem;
      text-align: center;
      font-size: 1rem;
    }

    /* Animations */
    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(50px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInText {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <!-- Animated Background -->
  <div class="background"></div>

  <!-- Login Card -->
  <div class="login-card">
    <h3>Login Inventory SMK ABC</h3>
    <?php if (!empty($error)): ?>
      <div class="error-alert">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>
    <form method="POST" action="">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username Anda" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Anda" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
