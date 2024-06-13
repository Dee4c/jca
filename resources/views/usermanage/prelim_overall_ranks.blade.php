<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preliminary Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>

        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
        body{
            background: rgb(0,0,0);
            background: linear-gradient(90deg, rgba(0,0,0,1) 17%, rgba(198,174,53,1) 75%);
            font-family: 'Roboto', sans-serif;
        }
        /* Google Font Link */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
    
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            background: rgb(0, 0, 0);
            background: linear-gradient(90deg, rgba(0, 0, 0, 1) 59%, rgba(198, 174, 53, 1) 99%);
            width: 250px;
            padding: 6px 14px;
            z-index: 99;
            transition: all 0.5s ease;
        }
    
        .sidebar .logo-details {
            height: 60px;
            display: flex;
            align-items: center;
            position: relative;
            padding-right: 50px;
        }
    
        .sidebar .logo-details .icon {
            position: absolute;
            top: 50%;
            right: -25px;
            transform: translateY(-50%);
            font-size: 22px;
            color: #fff;
            transition: all 0.5s ease;
        }
    
        .sidebar .logo-details .icon {
            right: 0;
        }
    
        .sidebar .logo-details .logo_name {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            margin-left: 40px;
            opacity: 1;
            transition: all 0.5s ease;
        }
    
        .sidebar .logo-details #btn {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            font-size: 22px;
            transition: all 0.4s ease;
            font-size: 23px;
            text-align: center;
            cursor: pointer;
            transition: all 0.5s ease;
        }
    
        .sidebar .logo-details #btn {
            text-align: right;
        }
    
        .sidebar i {
            color: #fff;
            height: 60px;
            min-width: 50px;
            font-size: 28px;
            text-align: center;
            line-height: 60px;
        }
    
        .sidebar .nav-list {
            margin-top: 20px;
            height: 100%;
        }
    
        .sidebar li {
            position: relative;
            margin: 8px 0;
            list-style: none;
        }
    
        .sidebar li .tooltip {
            position: absolute;
            top: -20px;
            left: calc(100% + 15px);
            z-index: 3;
            background: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 400;
            opacity: 0;
            white-space: nowrap;
            pointer-events: none;
            transition: 0s;
        }
    
        .sidebar li:hover .tooltip {
            opacity: 1;
            pointer-events: auto;
            transition: all 0.4s ease;
            top: 50%;
            transform: translateY(-50%);
        }
    
        .sidebar li.open .tooltip {
            display: none;
        }
    
        .sidebar input {
            font-size: 15px;
            color: #fff;
            font-weight: 400;
            outline: none;
            height: 50px;
            width: 100%;
            width: 50px;
            border: none;
            border-radius: 12px;
            transition: all 0.5s ease;
            background: #1d1b31;
        }
    
        .sidebar li a {
            display: flex;
            height: 100%;
            width: 100%;
            border-radius: 12px;
            align-items: center;
            text-decoration: none;
            transition: all 0.4s ease;
            background: #11101D;
        }
    
        .sidebar li a:hover {
            background: #FFF;
        }
    
        .sidebar li a .links_name {
            color: #fff;
            font-size: 15px;
            font-weight: 400;
            white-space: nowrap;
            opacity: 1;
            pointer-events: auto;
            transition: 0.4s;
        }
    
        .sidebar li a:hover .links_name,
        .sidebar li a:hover i {
            transition: all 0.5s ease;
            color: #11101D;
        }
    
        .sidebar li i {
            height: 50px;
            line-height: 50px;
            font-size: 18px;
            border-radius: 12px;
        }
    
        .sidebar li.profile {
            position: fixed;
            height: 60px;
            width: 78px;
            left: 0;
            bottom: -8px;
            padding: 10px 14px;
            background: #1d1b31;
            transition: all 0.5s ease;
            overflow: hidden;
        }
    
        .sidebar li.profile .profile-details {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
        }
    
        .sidebar li img {
            height: 45px;
            width: 45px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 10px;
        }
    
        .sidebar li.profile .name,
        .sidebar li.profile .job {
            font-size: 15px;
            font-weight: 400;
            color: #fff;
            white-space: nowrap;
        }
    
        .sidebar li.profile .job {
            font-size: 12px;
        }
    
        .sidebar .profile #log_out {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            background: #1d1b31;
            width: 100%;
            height: 60px;
            line-height: 60px;
            border-radius: 0px;
            transition: all 0.5s ease;
        }
    
        .home-section {
            position: relative;
            background: #E4E9F7;
            min-height: 100vh;
            top: 0;
            left: 250px;
            width: calc(100% - 250px);
            transition: all 0.5s ease;
            z-index: 2;
        }
    
        .home-section .text {
            display: inline-block;
            color: #11101d;
            font-size: 25px;
            font-weight: 500;
            margin: 18px
        }
    
        @media (max-width: 420px) {
            .sidebar li .tooltip {
                display: none;
            }
        }
    
        /* Add custom styles here */
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    
        /* Updated table styles */
        table {
            width: 100%;
            table-layout: fixed;
            background-color: #11101D;
            color: #fff;
        }
    
        .tbl-header {
            background-color: rgba(255, 255, 255, 0.3);
        }
    
        .tbl-content {
            height: auto;
            overflow-x: auto;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    
        th {
            padding: 20px 15px;
            text-align: left;
            font-weight: 500;
            font-size: 12px;
            color: black;
            text-transform: uppercase;
        }
    
        td {
            padding: 15px;
            text-align: left;
            vertical-align: middle;
            font-weight: 300;
            font-size: 12px;
            color: #fff;
            border-bottom: solid 1px rgba(255, 255, 255, 0.1);
        }
    
        .title-id {
            color: white;
            margin: auto;
        }

        .form-select {
            width: 200px; /* Adjust the width as needed */
        }

                /* Dropdown Styles */
        .dropdown {
            padding-left: 20px;
            display: none;
        }

        .dropdown li {
            margin: 8px 0;
            list-style: none;
        }

        .dropdown a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #fff;
            transition: all 0.4s ease;
        }

        .dropdown a:hover {
            background: #FFF;
            color: #11101D;
        }

      /* CSS for hiding the sidebar in printing mode and centering the table */
        @media print {
        .sidebar {
            display: none;
        }

        .print-button {
            display: none;
        }
     }
    
    </style>
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">Miss Q</div>
    </div>
    <ul class="nav-list">
        <li>
            <a href="{{route('usermanage.dashboard')}}">
                <i class='bx bx-user'></i>
                <span class="links_name">User Management</span>
            </a>
            <span class="tooltip">User Management</span>
        </li>
        <li>
            <a href="{{route('usermanage.candidate_dash')}}">
                <i class='bx bxs-user-check'></i>
                <span class="links_name">Candidates</span>
            </a>
            <span class="tooltip">Candidate Management</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-edit'></i>
                <span class="links_name">Preliminaries</span>
                <i class='bx bxs-chevron-down' id="btn"></i>
            </a>
            <span class="tooltip">Preliminaries</span>
            <ul class="dropdown">
                <li><a href="{{route('usermanage.preliminary_dash')}}">Pre-Interview</a></li>
                <li><a href="{{route('usermanage.prelim_swimsuit_dash')}}">Swim-Suit</a></li>
                <li><a href="{{route('usermanage.prelim_gown_dash')}}">Gown</a></li>
                <li><a href="{{route('usermanage.prelim_gown_dash')}}">Overall Rankings</a></li>
            </ul>
        </li>        
        <li>
            <a href="{{route('usermanage.semi_final_dash')}}">
                <i class='bx bx-line-chart'></i>
                <span class="links_name">Semi-Finals</span>
            </a>
            <span class="tooltip">Semi-Finals</span>
        </li>
        <li>
            <a href="{{route('usermanage.semi_final_dash')}}">
                <i class='bx bxs-crown'></i>
                <span class="links_name">Finals</span>
            </a>
            <span class="tooltip">Finals</span>
        </li>
        <li class="profile">
            <div class="profile-details">
                <img src="profile.jpg" alt="profileImg">
                <div class="name_job">
                    <div class="name">Admin</div>
                </div>
            </div>
            <a href="{{ route('logout') }}" class="logout-link">
                <i class='bx bx-log-out' id="log_out"></i>
            </a>
        </li>
    </ul>
</div>
<div class="content">
    <!-- Add print button here -->
    <button onclick="printTable()" style="position: absolute; top: 20px; right: 20px;" class="btn btn-primary">Print</button>

    <div class="container">
        <!-- Table to display candidate ranks -->
        <h2 class="title-id">Overall Rankings</h2>
        <br>
        <div class="tbl-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Candidate Number</th>
                        <th>Pre-Interview Rank</th>
                        <th>Swim Suit Rank</th>
                        <th>Gown Rank</th>
                        <th>Total Score</th>
                        <th>Overall Rank</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($candidates as $candidate)
                    <tr>
                        <td>{{ $candidate->id }}</td>
                        <td>
                            <!-- Display retrieved pre-interview rank -->
                            {{ $preInterviewRanks[$candidate->id] ?? '-' }}
                            <!-- Hidden input field for pre-interview rank -->
                            <input type="hidden" name="preInterview[{{ $candidate->id }}]" value="{{ $preInterviewRanks[$candidate->id] ?? 0 }}">
                        </td>
                        <td>
                            <!-- Display retrieved swim suit rank -->
                            {{ $swimSuitRanks[$candidate->id] ?? '-' }}
                            <!-- Hidden input field for swim suit rank -->
                            <input type="hidden" name="swimSuit[{{ $candidate->id }}]" value="{{ $swimSuitRanks[$candidate->id] ?? 0 }}">
                        </td>
                        <td>
                            <!-- Display retrieved gown rank -->
                            {{ $gownRanks[$candidate->id] ?? '-' }}
                            <!-- Hidden input field for gown rank -->
                            <input type="hidden" name="gown[{{ $candidate->id }}]" value="{{ $gownRanks[$candidate->id] ?? 0 }}">
                        </td>
                        <td id="totalScore_{{ $candidate->id }}"></td> <!-- Updated to include ID for total score -->
                        <td id="overall_rank_{{ $candidate->id }}"></td> <!-- Updated to include ID for overall rank -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Function to calculate and display the total score for each candidate
    function calculateTotalScore() {
        // Loop through each row in the table
        document.querySelectorAll('tbody tr').forEach(function(row) {
            var preInterviewRank = parseFloat(row.cells[1].textContent) || 0;
            var swimSuitRank = parseFloat(row.cells[2].textContent) || 0;
            var gownRank = parseFloat(row.cells[3].textContent) || 0;

            // Sum up the ranks for each candidate
            var totalScore = preInterviewRank + swimSuitRank + gownRank;

            // Display the total score in the appropriate cell
            row.cells[4].textContent = totalScore;

            // Call function to update overall rank
            calculateOverallRank();
        });
    }

    // Function to calculate the overall rank for each candidate
    function calculateOverallRank() {
        var totalScores = [];
        document.querySelectorAll('td[id^="totalScore_"]').forEach(function(scoreElement) {
            var score = parseFloat(scoreElement.textContent);
            totalScores.push(score);
        });

        // Sort the total scores in ascending order
        totalScores.sort(function(a, b) {
            return a - b;
        });

        // Assign overall rank based on the sorted scores
        var rank = 1;
        var prevScore = null;
        totalScores.forEach(function(score) {
            if (score !== prevScore) {
                document.querySelectorAll('td[id^="totalScore_"]').forEach(function(scoreElement) {
                    if (parseFloat(scoreElement.textContent) === score) {
                        var candidateId = scoreElement.id.split("_")[1];
                        var overallRankElement = document.getElementById("overall_rank_" + candidateId);
                        overallRankElement.textContent = rank;
                    }
                });
            }
            prevScore = score;
            rank++;
        });
    }

    // Call calculateTotalScore function
    document.addEventListener('DOMContentLoaded', function() {
        calculateTotalScore();
    });

    // Toggle sidebar dropdown
    document.querySelector('.sidebar li:nth-child(3) a').addEventListener('click', function() {
        var dropdown = document.querySelector('.sidebar li:nth-child(3) .dropdown');
        if (dropdown.style.display === 'block') {
            dropdown.style.display = 'none';
        } else {
            dropdown.style.display = 'block';
        }
    });

    function printTable() {
        window.print();
    }
</script>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
