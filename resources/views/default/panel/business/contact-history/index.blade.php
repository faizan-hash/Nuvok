@extends('default.panel.layout.app')

@section('content')
<div class="container mt-4">
    <h2>Contact History</h2>
  <div class="card mt-3">
    <div class="card-body">
        @if($logs->count())
            <div class="table-responsive"> <!-- 🔄 Added wrapper -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Action</th>
                            <th>Type</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $log->action_type)) }}</td>
                                <td>{{ $log->reference_type }}</td>
                                <td>{{ $log->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $logs->links() }}
        @else
            <p>No contact history found.</p>
        @endif
    </div>
</div>

</div>
@endsection 