@extends('dashboard.layouts.app')

@section('title', 'Dashboard - Bhayangkara University Lab Booking')

@section('content')
<div class="container">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col">
            <h2>
                <i class="fas fa-tachometer-alt me-2 text-primary"></i>
                Welcome, System Administrator
            </h2>
            <p class="text-muted mb-0">IT Department</p>
        </div>
    </div>

    <!-- Static Statistics -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-flask fa-2x text-primary mb-2"></i>
                    <h4 class="card-title">4</h4>
                    <p class="card-text">Active Labs</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-calendar-check fa-2x text-success mb-2"></i>
                    <h4 class="card-title">0</h4>
                    <p class="card-text">Total Bookings</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                    <h4 class="card-title">0</h4>
                    <p class="card-text">Pending Approval</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-calendar-day fa-2x text-info mb-2"></i>
                    <h4 class="card-title">0</h4>
                    <p class="card-text">Today's Bookings</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-plus-circle fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">New Booking</h5>
                    <p class="card-text">Reserve a laboratory for your class or research</p>
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Book Now
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-calendar fa-3x text-success mb-3"></i>
                    <h5 class="card-title">View Calendar</h5>
                    <p class="card-text">See laboratory schedules and availability</p>
                    <a href="#" class="btn btn-success">
                        <i class="fas fa-calendar me-2"></i>View Calendar
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-list fa-3x text-info mb-3"></i>
                    <h5 class="card-title">My Bookings</h5>
                    <p class="card-text">Manage your current and past reservations</p>
                    <a href="#" class="btn btn-info">
                        <i class="fas fa-list me-2"></i>View Bookings
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Empty State Message -->
    <div class="row">
        <div class="col text-center">
            <div class="card">
                <div class="card-body py-5">
                    <i class="fas fa-calendar-plus fa-4x text-muted mb-3"></i>
                    <h4>No bookings yet</h4>
                    <p class="text-muted mb-4">Get started by making your first laboratory reservation</p>
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Create Your First Booking
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection