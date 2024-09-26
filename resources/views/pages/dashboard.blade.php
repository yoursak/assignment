@extends('layout.master')
@section('content')
    <style>
        .dashboard-cards {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            flex-wrap: wrap;
            /* Allows wrapping on smaller screens */
        }

        .dash-card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            width: 32%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.3s;
            border: none;
            margin-bottom: 20px;
            /* Space between rows */
        }

        .dash-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-content {
            text-align: left;
        }

        .card-content p {
            margin: 0;
            font-size: 14px;
            color: #4F4F4F;
        }

        .card-content h3 {
            margin: 0;
            font-size: 36px;
            color: #2E2E2E;
        }

        .card-icon {
            font-size: 48px;
        }

        .card-icon .fas {
            color: #18a7a2;
        }

        /* Custom color for different cards */
        .dash-card:nth-child(1) .fas {
            color: #18a7a2;
        }

        .dash-card:nth-child(2) .fas {
            color: #ff5e5e;
        }

        .dash-card:nth-child(3) .fas {
            color: #f39c12;
        }

        /* Adjust margins between cards */
        .dash-card:not(:last-child) {
            margin-right: 20px;
        }

        /* Responsive design */
        @media (max-width: 1024px) {
            .dash-card {
                width: 48%;
                /* Two cards per row on tablets */
            }
        }

        @media (max-width: 768px) {
            .dash-card {
                width: 100%;
                /* One card per row on smaller screens */
                margin-right: 0;
                /* Remove extra margin on small screens */
            }
        }

        @media (max-width: 480px) {
            .card-content h3 {
                font-size: 24px;
                /* Smaller font for small screens */
            }

            .card-content p {
                font-size: 12px;
            }

            .card-icon {
                font-size: 36px;
                /* Adjust icon size */
            }
        }
    </style>


    <div class="dashboard-cards">
        <div class="dash-card">
            <div class="card-content">
                <p>Total Tasks</p>
                <h3>12</h3>
            </div>
            <div class="card-icon">
                <i class="fas fa-chart-bar"></i>
            </div>
        </div>

        <div class="dash-card">
            <div class="card-content">
                <p>Completed</p>
                <h3>06</h3>
            </div>
            <div class="card-icon">
                <i class="fas fa-handshake"></i>
            </div>
        </div>
        @if (Session::get('type') == 1)
            <div class="dash-card">
                <div class="card-content">
                    <p>Total Users</p>
                    <h3>{{ $UserCount ?? 0 }}</h3>
                </div>
                <div class="card-icon">
                    <i class="fas fa-user-friends"></i>
                </div>
            </div>
        @endif
    </div>
@endsection
