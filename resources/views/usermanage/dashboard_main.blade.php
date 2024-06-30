<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Main Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap JavaScript Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
        body {
            background: rgb(0, 0, 0);
            background: linear-gradient(90deg, rgba(0, 0, 0, 1) 17%, rgba(198, 174, 53, 1) 75%);
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
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
            color: gold;
            font-size:40px;
            font-weight: 700;
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
            margin-left: 250px; /* Adjusted left margin */
            padding: 20px; /* Added padding */
            transition: all 0.5s ease;
            z-index: 2;
        }

        .home-section .text {
            display: inline-block;
            color: #11101d;
            font-size: 25px;
            font-weight: 500;
            margin: 18px;
        }

        @media (max-width: 420px) {
            .sidebar li .tooltip {
                display: none;
            }
        }

        .title-id {
            color: white;
            margin-top: 15px;
        }

        .row {
            margin-top: 5px;
        }

        .card {
            margin-top: 7px;
            background: rgb(234,233,130);
            background: radial-gradient(circle, rgba(234,233,130,0.8650562275691527) 100%, rgba(176,183,31,0.4785016057204131) 100%);
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
            <a href="{{route('usermanage.dashboardMain')}}">
                <i class='bx bx-user'></i>
                <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
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
            <a href="{{route('usermanage.preliminary_dash')}}">
                <i class='bx bx-edit'></i>
                <span class="links_name">Preliminaries</span>
            </a>
        </li>
        <li>
            <a href="{{route('usermanage.semi_final_dash')}}">
                <i class='bx bx-line-chart'></i>
                <span class="links_name">Semi-Finals</span>
            </a>
            <span class="tooltip">Semi-Finals</span>
        </li>
        <li>
            <a href="{{route('usermanage.final_dash')}}">
                <i class='bx bxs-crown'></i>
                <span class="links_name">Finals</span>
            </a>
            <span class="tooltip">Finals</span>
        </li>
        <li class="profile">
            <a href="{{ route('logout') }}" class="logout-link">
                <i class='bx bx-log-out' id="log_out"></i>
            </a>
        </li>
    </ul>
</div>
<div class="container" style="margin-left: 270px;">
    <h1 class="title-id">Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="background-color: #8B8000;">
                    <h5 class="card-title">Total Judges</h5>
                    <p class="card-text">{{ $judgesCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="background-color: #C2B280;">
                    <h5 class="card-title">Preliminary Judges</h5>
                    <p class="card-text">{{ $preliminaryJudgesCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="background-color: #C4B454;">
                    <h5 class="card-title">Semi-Final Judges</h5>
                    <p class="card-text">{{ $semiFinalJudgesCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="background-color: #FFDEAD;">
                    <h5 class="card-title">Final Judges</h5>
                    <p class="card-text">{{ $finalJudgesCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="background-color: #F8DE7E;">
                    <h5 class="card-title">Total Candidates</h5>
                    <p class="card-text">{{ $candidatesCount }}</p>
                </div>
            </div>
        </div>
        <!-- Chart for candidates joined per year -->
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Candidates Per Year</h5>
                    <div style="height: 400px; width: 100%;">
                        <canvas id="candidatesJoinedChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Assuming you have passed data from the controller to the Blade view
const years = @json($years); // Array of years
const candidatesJoinedPerYear = @json($candidatesJoinedPerYear); // Array of candidate counts corresponding to each year

// Create a bar chart
var ctx = document.getElementById('candidatesJoinedChart').getContext('2d');
var candidatesChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: years,
        datasets: [{
            label: 'Candidates Joined',
            data: candidatesJoinedPerYear,
            backgroundColor: 'rgba(54, 162, 235, 0.6)', // Blue color with transparency
            borderColor: 'rgba(54, 162, 235, 1)', // Solid blue color
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Number of Candidates'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Years'
                }
            }
        }
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>