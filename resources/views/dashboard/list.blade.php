@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content">
        <div class="dashboard-section-title">CHOOSE YOUR AREA OF EXPERTISE</div>
        <div class="dashboard-branch-list">
            <div class="dashboard-branch-item">Development</div>
            <div class="dashboard-branch-item">Testing</div>
            <div class="dashboard-branch-item">Business Analyst</div>
            <div class="dashboard-branch-item">Agile</div>
            <div class="dashboard-branch-item">Project Management</div>
        </div>
        <div class="dashboard-item-list">

        </div>
    </div>
@endsection
