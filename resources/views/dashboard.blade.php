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
    {{-- Include the cursor animation --}}
    @include('cursor.cursor-animation')


    <!-- This is my dashboard page -->
    <main>
        <section class="topbar">
            <div class="topbar-container">
                <div class="dashboard-text">
                    <i class="fa-solid fa-arrow-right" style="color: #5531d8;"></i>
                    <h3>DASHBOARD</h3>
                </div>
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                    <input type="text" placeholder="Search Here" class="text">
                </div>

                <div class="avatar">
                    <img src="avatar.jpg" alt="" srcset="">
                    <div class="dropdown">
                    <button class="dropbtn" onclick="myFunction()">
                        <i class="fa fa-caret-down" style="color: white"></i>
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
                    <h3>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>
                    <p>Student of QNHS</p>
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
                        <a href="#leaderboards">LEADERBOARDS</a>
                    </div>
                    <div class="navbar-module">
                        <i class="fa-solid fa-circle-info" style="color: #453ae6;"></i>
                        <a href="#module">MODULE</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section for Main Dasboard Content --}}

        <section class="main-content content-transition" id="dashboardContent">
            <div class="overview">
                <h2>{{ $userScore }}</h2>
                <img src="src/images/achievements/trophy.svg" class="icon">
                <div class="center"></div>
                <h2>{{ count($userProgress) }}</h2>
                <img src="src/images/achievements/game.svg" class="icon">
            </div>


            <div class="trivia">
                <i class="fa-regular fa-circle-play" style="color: #ffffff;"></i>
                <h3>ENTER GAME</h3>
            </div>

            <div class="feature">
                <div class="feature-title">
                    <p>DON'T MISS</p>
                    <h3>OUR GAMES</h3>
                </div>

                <div class="card">
                    <div class="game game1"></div>
                    <div class="game game3"></div>
                    <div class="game game4"></div>
                    <div class="game game1"></div>
                </div>
            </div>

            

        </section>

        {{-- Section for Game Content  --}}

        <section class="main-content content-transition hidden" id="gameContent">
            <div class="feature">
                <div class="feature-title">
                    <p>Welcome</p>
                    <h3>TO OUR STAGE SELECTION</h3>
                </div>

                @php
                    $unlockedStages = count($userProgress);
                @endphp

                <!-- Inside your gameContent section -->
                <div class="card">
                    @foreach($stages as $stage)
                        @php
                            $isCompleted = isset($userProgress[$stage->id]);
                            $isNextUnlocked = isset($userProgress[$stage->id - 1]);
                            $isUnlocked = $isCompleted || $isNextUnlocked || $stage->id == 1; // Check if the stage is the first one

                            // Additional check to ensure the first stage is always unlocked
                            if ($stage->id == 1) {
                                $isNextUnlocked = true;
                            }
                        @endphp

                        <a href="{{ asset('/stages/' . $stage->id) }}" 
                        class="stage-link {{ $isCompleted ? 'completed' : ($isUnlocked ? 'unlocked' : 'locked') }}"
                        onclick="{{ $isUnlocked ? '' : 'showLockedModal(); return false;' }}">
                            <i class="fa-solid {{ $isCompleted ? 'fa-award' : ($isUnlocked ? 'fa-unlock' : 'fa-lock') }}"></i>
                            <h3>{{ $stage->name }}</h3>
                        </a>

                    @endforeach
                </div>



            </div>
        </section>

        {{-- Section for Profile Content, View Profile Details --}}
        <section class="main-content content-transition hidden" id="profileContent">
            <div class="user-info">
                <div class="info-title">
                    <p>PROFILE INFORMATION</p>
                    <h3>User Details</h3>
                </div>

                <div class="card-user-detail">
                    <div class="user-detail">
                        <strong>First Name:</strong> {{ auth()->user()->first_name }}
                    </div>
                    <div class="user-detail">
                        <strong>Last Name:</strong> {{ auth()->user()->last_name }}
                    </div>
                    <div class="user-detail">
                        <strong>Email:</strong> {{ auth()->user()->email }}
                    </div>
                    <div class="user-detail">
                        <strong>Username:</strong> {{ auth()->user()->username }}
                    </div>
                </div>
            </div>
        </section>


        {{-- Section for Leaderboards Contents  --}}
        <section class="main-content content-transition hidden" id="leaderboardsContent">
            <div class="leaderboards">
                <div class="leaderboards-title">
                    <h3>LEADERBOARDS</h3>
                </div>
                <div class="leaderboards-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Score</th>
                                <th>Completed Stages</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaderboardData as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->user_score }}</td>
                                    <td>{{ $user->completed_stages_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- Section for Module Content  --}}
        <section class="main-content content-transition hidden" id="moduleContent">
            <input type="checkbox" id="checkbox-cover">
            <input type="checkbox" id="checkbox-page1">
            <input type="checkbox" id="checkbox-page2">
            <input type="checkbox" id="checkbox-page3">
            <div class="book">
                <div class="cover">
                    <label for="checkbox-cover"></label>
                </div>
                <div class="page" id="page1">
                    <div class="front-page">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil magni laudantium beatae quia. Recusandae, fuga quas consectetur perferendis aperiam esse velit veniam ducimus? Quisquam consequatur perferendis quidem quia, recusandae ab!</p>
                        <label class="next" for="checkbox-page1"><i class="fas fa-chevron-right"></i></label>
                    </div>
                    <div class="back-page">
                        <img src="1.png">
                        <label class="prev" for="checkbox-page1"><i class="fas fa-chevron-left fa-xl"></i></label>
                    </div>
                </div>
                <div class="page" id="page2">
                    <div class="front-page">
                        <h2>Page 2</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil magni laudantium beatae quia. Recusandae, fuga quas consectetur perferendis aperiam esse velit veniam ducimus? Quisquam consequatur perferendis quidem quia, recusandae ab!</p>
                        <label class="next" for="checkbox-page2"><i class="fas fa-chevron-right"></i></label>
                    </div>
                    <div class="back-page">
                        <img src="2.png">
                        <label class="prev" for="checkbox-page2"><i class="fas fa-chevron-left fa-xl"></i></label>
                    </div>
                </div>
                <div class="page" id="page3">
                    <div class="front-page">
                        <h2>Page 3</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil magni laudantium beatae quia. Recusandae, fuga quas consectetur perferendis aperiam esse velit veniam ducimus? Quisquam consequatur perferendis quidem quia, recusandae ab!</p>
                    </div>
                </div>
                <div class="back-cover"></div>
            </div>
        </section>

 
    </main>

    <script>
        const mainContent = document.getElementById('mainContent');
        const gameContent = document.getElementById('gameContent');
        const profileContent = document.getElementById('profileContent');
        const dashboardContent = document.getElementById('dashboardContent');
        const leaderboardsContent = document.getElementById('leaderboardsContent');
        const moduleContent = document.getElementById('moduleContent');
        const navbarGame = document.querySelector('.navbar-game');
        const navbarProfile = document.querySelector('.navbar-profile');
        const navbarDashboard = document.querySelector('.navbar-dashboard');
        const navbarLeaderboards = document.querySelector('.navbar-support');
        const navbarModule = document.querySelector('.navbar-module');

        /// Function to switch to the game content with animation
        function switchToGameContent() {
            dashboardContent.classList.add('hidden');
            gameContent.classList.remove('hidden');
            profileContent.classList.add('hidden');
            leaderboardsContent.classList.add('hidden'); // Hide leaderboards
        }

        function switchToProfileContent() {
            dashboardContent.classList.add('hidden');
            gameContent.classList.add('hidden');
            profileContent.classList.remove('hidden');
            leaderboardsContent.classList.add('hidden'); // Hide leaderboards
        }

        function switchToLeaderboardsContent() {
            dashboardContent.classList.add('hidden');
            gameContent.classList.add('hidden');
            profileContent.classList.add('hidden');
            leaderboardsContent.classList.remove('hidden'); // Show leaderboards
        }
        function switchToModuleContent() {
            dashboardContent.classList.add('hidden');
            gameContent.classList.add('hidden');
            profileContent.classList.add('hidden');
            leaderboardsContent.classList.add('hidden');
            moduleContent.classList.remove('hidden');
        }
        

        // Function to switch back to the default dashboard content with animation
        function switchToDefaultContent() {
            dashboardContent.classList.remove('hidden');
            gameContent.classList.add('hidden');
            profileContent.classList.add('hidden');
            leaderboardsContent.classList.add('hidden');
            moduleContent.classList.add('hidden');
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
        navbarLeaderboards.addEventListener('click', switchToLeaderboardsContent);
        navbarModule.addEventListener('click', switchToModuleContent);


        // Check if the URL contains the #gameContent fragment and switch to game section
        window.addEventListener('load', () => {
            if (window.location.hash === "#gameContent") {
                switchToGameContent();
            }
        });
    </script>


<script>
    function showLockedModal() {
        // Implement logic to show a modal for locked stages
        alert('This stage is locked. You cannot play it yet.');
    }
</script>
</body>
</html>
