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

                    <div class="dropdown">
                        <button class="dropbtn" onclick="myFunction()">
                            <i class="fa fa-caret-down" style="color: white"></i>
                        </button>
                        <div class="dropdown-content" id="myDropdown">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                    <h2 class="h2-blue">Space</h2>
                    <h2 class="h2-orange">Traveller</h2>
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
                    {{-- <div class="navbar-dashboard">
                        <i class="fa-solid fa-gauge" style="color: #ec9955;"></i>
                        <a href="{{ route('space_game') }}">Space Game</a>
                    </div> --}}
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
                    <h3>STAGE SELECTION</h3>
                </div>

                @php
                    $unlockedStages = count($userProgress);
                @endphp

                <!-- Inside your gameContent section -->
                <div class="card">
                    @php
                        $nextUnlockedStageId = null;
                    @endphp

                    @foreach ($stages as $stage)
                        @php
                            $isCompleted = isset($userProgress[$stage->id]);
                            $isNextUnlocked = isset($userProgress[$stage->id - 1]) || $stage->id == 1; // Check if the stage is unlocked or first one

                            // Additional check to ensure the first stage is always unlocked
                            if ($stage->id == 1) {
                                $isNextUnlocked = true;
                            }

                            if ($isNextUnlocked && is_null($nextUnlockedStageId)) {
                                $nextUnlockedStageId = $stage->id;
                            }

                            // Determine image filename based on stage status
                            $imagePrefix = $isCompleted ? 'a' : ($isNextUnlocked ? 'b' : 'c');
                            $imageName = $imagePrefix . str_pad($stage->id, 2, '0', STR_PAD_LEFT) . '.png';
                            $imageUrl = asset('img/stage/' . $imageName);
                        @endphp

                        <a href="{{ asset('/stages/' . $stage->id) }}"
                            class="stage-link {{ $isCompleted ? 'completed' : ($isNextUnlocked ? 'unlocked' : 'locked') }}"
                            onclick="{{ $isNextUnlocked ? '' : 'showLockedModal(); return false;' }} {{ $isCompleted ? 'showCompletedModal(); return false;' : '' }}"
                            style="background-image: url('{{ $imageUrl }}')">
                        </a>
                    @endforeach
                </div>





            </div>
        </section>

        {{-- Section for Profile Content, View Profile Details --}}
        <section class="main-content content-transition hidden" id="profileContent">
            <div class="user-info">
                <div class="glass">
                    <div class="info-title">
                        <img src="avatar.jpg" class="side-avatar">
                        <p>PROFILE INFORMATION</p>
                    </div>

                    <div class="card-user-detail">

                        <div class="user-detail">
                            <h4 class="user-detail-h4">First Name</h4> {{ auth()->user()->first_name }}
                        </div>
                        <hr>
                        <div class="user-detail">
                            <h4 class="user-detail-h4">Last Name</h4> {{ auth()->user()->last_name }}
                        </div>
                        <hr>
                        <div class="user-detail">
                            <h4 class="user-detail-h4">Email</h4> {{ auth()->user()->email }}
                        </div>
                        <hr>
                        <div class="user-detail">
                            <h4 class="user-detail-h4">Username</h4> {{ auth()->user()->username }}
                        </div>
                        <hr>
                    </div>

                    <div class="edit-user-btn-div">
                        <button class="edit-user-btn">Edit</button>
                    </div>

                </div><!-- End of Glass Content -->

            </div>
        </section>


        {{-- Section for Leaderboards Contents  --}}
        <section class="main-content content-transition hidden" id="leaderboardsContent">
            <div class="leaderboards">
                <div id="header" class="header-leaderboards">
                    <h1>Leaderboards</h1>
                    <h2>Stage Completed</h2>
                </div>
                <div id="leaderboard">
                    <div class="ribbon"></div>
                    <table>
                        <tr>
                            <td class="number">5</td>
                            <td class="name">Johnny Suh</td>
                            <td class="points">258.208</td>
                        </tr>
                    </table>
                </div>
            </div>
            </div>
        </section>

        {{-- Section for Module Content  --}}
        <section class="main-content content-transition hidden" id="moduleContent">
            <input type="checkbox" id="checkbox-cover">
            <input type="checkbox" id="checkbox-page1">
            <input type="checkbox" id="checkbox-page2">
            <input type="checkbox" id="checkbox-page3">
            <input type="checkbox" id="checkbox-page4">
            <div class="book">
                <div class="cover">
                    <label for="checkbox-cover"></label>
                </div>
                <div class="page" id="page1">
                    <div class="front-page">
                        <img src="../img/module/module1.jpg">
                        <label class="next" for="checkbox-page1"><i class="fas fa-chevron-right"></i></label>
                    </div>
                    <div class="back-page">
                        <img src="../img/module/module1.1.jpg">
                        <label class="prev" for="checkbox-page1"><i class="fas fa-chevron-left fa-xl"></i></label>
                    </div>
                </div>
                <div class="page" id="page2">
                    <div class="front-page">
                        <img src="../img/module/module1.2.jpg">
                        {{-- <h2>Page 2</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil magni laudantium beatae quia. Recusandae, fuga quas consectetur perferendis aperiam esse velit veniam ducimus? Quisquam consequatur perferendis quidem quia, recusandae ab!</p> --}}
                        <label class="next" for="checkbox-page2"><i class="fas fa-chevron-right"></i></label>
                    </div>
                    <div class="back-page">
                        <img src="../img/module/module1.3.jpg">
                        <label class="prev" for="checkbox-page2"><i class="fas fa-chevron-left fa-xl"></i></label>
                    </div>
                </div>
                <div class="page" id="page3">
                    <div class="front-page">
                        <img src="../img/module/module1.4.jpg">
                        {{-- <h2>Page 3</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil magni laudantium beatae quia. Recusandae, fuga quas consectetur perferendis aperiam esse velit veniam ducimus? Quisquam consequatur perferendis quidem quia, recusandae ab!</p> --}}
                    </div>
                </div>
                <div class="back-cover"></div>
            </div>
        </section>


    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

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
        $(document).ready(function() {
            function updateLeaderboard() {
                $.getJSON('/leaderboard-data', function(data) {


                    const receivedData = JSON.parse(data);

                    console.log(receivedData)

                    console.log(receivedData[0].username)


                    // Clear existing table rows except the header
                    $('table tbody tr').remove();



                    // Iterate through the first 10 records and append rows to the table
                    for (let i = 0; i < Math.min(receivedData.length, 10); i++) {

                        let user = receivedData[i];


                        let row = `
                    <tr>

                        <td class="number">${i + 1}</td>
                        <td class="name">${user.username}</td>
                        <td class="points">
                            ${user.completed_stages_count}
                        </td>

                    </tr>
                `;
                        $('table tbody').append(row);
                    }
                });
            }

            // Update leaderboard initially
            updateLeaderboard();

            // Update leaderboard periodically (every 30 seconds)
            setInterval(updateLeaderboard, 30000);
        });




        function showLockedModal() {
            // Implement logic to show a modal for locked stages
            alert('This stage is locked. You cannot play it yet.');
        }

        function showCompletedModal() {
            // Show your completed modal here
            alert("Stage is already completed!");
        }
    </script>
</body>

</html>
