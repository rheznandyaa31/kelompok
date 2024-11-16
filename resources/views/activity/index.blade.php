@extends('layouts.app')

@section('title', 'Activity')

@section('breadcumbs')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active">Activity</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Activity Page</h1>

            <!-- Example of an Activity List -->
            <div class="card">
                <div class="card-header">
                    <h4>Recent Activities</h4>
                </div>
                <div class="card-body">
                    <!-- Example of Activity List -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Activity Name</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $activity->name }}</td>
                                <td>{{ $activity->description }}</td>
                                <td>{{ $activity->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $activities->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
