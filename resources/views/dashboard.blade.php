<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="https://kit.fontawesome.com/9a20ced4b7.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Baloo+2:400,800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
</head>
<body>
    <!-- This is my dashboard page -->
    <main>
        <section class="topbar">
            <div class="topbar-container">
                <div class="dashboard-text">
                    <i class="fa-solid fa-arrow-right" style="color: #5531d8;"></i>
                    <h3>DASHBOARD</h3>
                </div>
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass" style="color: rgb(151, 149, 149);"></i>
                    <input type="text" placeholder="Search Here" class="text">
                </div>
                
                <div class="avatar">
                    <img src="avatar.jpg" alt="" srcset="">
                    <div class="dropdown">
                    <button class="dropbtn" onclick="myFunction()">
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content" id="myDropdown">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    
                    </div>
                </div>
                
                
            </div>
        </section>


        <section class="sidebar">
            <div class="sidebar-container">
                <div class="logo">
                    <h2 class="h2-blue">Space</h2><h2 class="h2-orange">Traveller</h2>
                </div>
                <div class="upperside">
                    <img src="avatar.jpg" class="side-avatar">
                    <h3>Vhinz Balinas</h3>
                    <p>Student at CMU</p>
                    <div class="icons">
                        <img src="src/images/achievements/medal.svg" class="icon">
                        <img src="src/images/achievements/trophy.svg" class="icon">
                        <img src="src/images/achievements/game.svg" class="icon">
                    </div>
                </div>

                <!-- Add a horizontal line here -->
                <hr class="separator">
                

                <div class="navbar">
                    <div class="navbar-dashboard">
                        <i class="fa-solid fa-gauge" style="color: #ec9955;"></i>
                        <a href="#">DASHBOARD</a>
                    </div>
                    <div class="navbar-game">
                        <i class="fa-solid fa-gamepad" style="color: #e93c3c;"></i>
                        <a href="#gameContent">GAME</a>
                    </div>
                    <div class="navbar-profile">
                        <i class="fa-solid fa-address-card" style="color: #1f68e5;"></i>
                        <a href="#profile">PROFILE</a>
                    </div>
                    <div class="navbar-support">
                        <i class="fa-solid fa-circle-info" style="color: #20cf23;"></i>
                        <a href="#leaderboards">Leaderboards</a>
                    </div>
                </div>
            </div>
        </section>


        <section class="main-content content-transition" id="dashboardContent">
            <div class="overview">
                <h2>134</h2>
                <img src="src/images/achievements/trophy.svg" class="icon">
                <div class="center"></div>
                <h2>44</h2>
                <img src="src/images/achievements/game.svg" class="icon">
            </div>

            <div class="trivia">
                <i class="fa-regular fa-circle-play" style="color: #ffffff;"></i>
                <h3>ENTER TRIVIA</h3>
            </div>

            <div class="feature">
                <div class="feature-title">
                    <p>DON'T MISS</p>
                    <h3>OUR FEATURED GAMES</h3>
                </div>

                <div class="card">
                    <div class="game1"></div>
                    <div class="game1"></div>
                    <div class="game1"></div>
                    <div class="game1"></div>
                </div>
            </div>

            <div class="feature">
                <div class="feature-title">
                    <p>THIS WEEK</p>
                    <h3>MOST PLAYED GAMES</h3>
                </div>

                <div class="card">
                    <div class="game2"></div>
                    <div class="game2"></div>
                    <div class="game2"></div>
                    <div class="game2"></div>
                </div>
            </div>

        </section>

        <section class="main-content content-transition hidden" id="gameContent">
            <div class="feature">
                <div class="feature-title">
                    <p>Welcome</p>
                    <h3>TO OUR STAGE SELECTION</h3>
                </div>

                <!-- Inside your gameContent section -->
                <div class="card">
                    @foreach($stages as $stage)
                        @if(isset($userProgress[$stage->id]) && $userProgress[$stage->id] && $userProgress[$stage->id]->completion_status == 1)
                            <a href="{{ asset($stage->url) }}" class="stage-link unlocked">
                                <i class="fa-solid fa-lock"></i><h3>{{ $stage->name }}</h3>
                            </a>
                        @else
                            <a href="{{ asset($stage->url) }}" class="stage-link locked">
                                <i class="fa-solid fa-lock"></i><h3>{{ $stage->name }}</h3>
                            </a>
                        @endif
                    @endforeach
                </div>

            </div>
        </section>

        <section class="main-content content-transition hidden" id="profileContent">
            <div class="feature">
                <div class="feature-title">
                    <p>Welcome</p>
                    <h3>TO OUR STAGE SELECTION</h3>
                </div>

                <div class="card">
                    <div class="stage"></div>
                    <div class="stage"></div>
                    <div class="stage"></div>
                    
                </div>
            </div>
        </section>
    </main>
    
    <script>
        const mainContent = document.getElementById('mainContent');
        const gameContent = document.getElementById('gameContent');
        const profileContent = document.getElementById('profileContent');
        const dashboardContent = document.getElementById('dashboardContent');
        const navbarGame = document.querySelector('.navbar-game');
        const navbarProfile = document.querySelector('.navbar-profile');
        const navbarDashboard = document.querySelector('.navbar-dashboard');

        // Function to switch to the game content with animation
        function switchToGameContent() {
            dashboardContent.classList.add('hidden');
            gameContent.classList.remove('hidden');
            profileContent.classList.add('hidden');
        }

        function switchToProfileContent() {
            dashboardContent.classList.add('hidden');
            gameContent.classList.add('hidden');
            profileContent.classList.remove('hidden');
        }

        // Function to switch back to the default dashboard content with animation
        function switchToDefaultContent() {
            dashboardContent.classList.remove('hidden');
            gameContent.classList.add('hidden');
            profileContent.classList.add('hidden');
        }

        // Get the dropdown button and content
        const dropdownButton = document.querySelector('.dropbtn');
        const dropdownContent = document.getElementById("myDropdown");

        function toggleDropdown() {
            dropdownContent.classList.toggle("show");
        }

        document.addEventListener('click', function(e) {
            if (!e.target.matches('.dropbtn') && !e.target.matches('.fa-caret-down')) {
                dropdownContent.classList.remove('show');
            } else if (e.target.matches('.dropbtn') || e.target.matches('.fa-caret-down')) {
                toggleDropdown();
            }
        });



        navbarGame.addEventListener('click', switchToGameContent);
        navbarProfile.addEventListener('click', switchToProfileContent);
        navbarDashboard.addEventListener('click', switchToDefaultContent);


        // Check if the URL contains the #gameContent fragment and switch to game section
        window.addEventListener('load', () => {
            if (window.location.hash === "#gameContent") {
                switchToGameContent();
            }
        });
    </script>
</body>
</html>