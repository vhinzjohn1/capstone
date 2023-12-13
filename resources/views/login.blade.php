<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+2:400,800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <script src="https://kit.fontawesome.com/9a20ced4b7.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        
        <section class="glass">
            <!-- Introduction Section -->
            <div class="left-section">
                <div class="">
                    <dotlottie-player src="./lottie/astro.json" background="transparent" speed="1" direction="2" mode="normal" loop autoplay></dotlottie-player>
                </div>

                <div class="signup-btn"><i class="fa-solid fa-user-plus link" style="color: #24385b;"></i><a href="{{ asset('signup') }}">Create an Account Here</a></div>

            </div>
            <div class="right-section">
                <div class="right-planet">
                    <dotlottie-player src="./lottie/planet.json" background="transparent" speed="0.75" direction="1" mode="normal" loop autoplay></dotlottie-player>
                </div>
                <h1>Login Page</h1>

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="group">      
                        <input type="text" name="username"required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Username</label>
                    </div>

                    <div class="group">
                        <input type="password" name="password" id="passwordInput" required>
                        <i class="fas fa-eye-slash toggle-password" id="togglePassword"></i>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Password</label>
                    </div>

                    <div class="btn1">
                        <button type="submit">Login</button>
                    </div>



                    @if(session('error'))
                        <span class="pastel-red">{{ session('error') }}</span>
                    @endif

                </form>
            </div>
        </section>
        
    </main>

    <script>
        const passwordInput = document.getElementById("passwordInput");
        const togglePassword = document.querySelector(".toggle-password");

        togglePassword.addEventListener("click", () => {
            if (passwordInput.type === "password") {
                passwordInput.type = "text"; // Show password
                togglePassword.classList.remove("fa-eye-slash");
                togglePassword.classList.add("fa-eye");
            } else {
                passwordInput.type = "password"; // Hide password
                togglePassword.classList.remove("fa-eye");
                togglePassword.classList.add("fa-eye-slash");
            }
        });
    </script>



</body>
</html>