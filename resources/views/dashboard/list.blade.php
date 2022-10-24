@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content">
        <div class="dashboard-section-title">Welcome, {{ Auth::user()->name }}!</div>
        <div class="dashboard-section-description">You can only have 2 topics in progress in a same time. If you'd like to add a new one, please delete the topic you no longer interested in.</div>
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
