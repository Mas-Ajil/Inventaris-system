@extends('layouts.main')

@section('container')

<div class="container">
    <h1>Activity Log</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Log Name</th>
                <th>Description</th>
                <th>Causer</th>
                <th>properties</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->log_name }}</td>
                    <td>{{ $activity->description }}</td>
                    <td>{{ $activity->causer ? $activity->causer->name : '-' }}</td>
                    <td>
                        <ul class="list-unstyled">
<<<<<<< HEAD
                            @if ($activity->properties->isNotEmpty())
                                <ul>
                                    @foreach ($activity->properties as $key => $value)
                                        <li>
                                            <strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong>
                                            @if(is_array($value))
                                                {{ implode(', ', $value) }}
                                            @else
                                                {{ htmlspecialchars($value, ENT_QUOTES, 'UTF-8') }}
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

=======
                            @foreach ($activity->properties->toArray() as $key => $value)
                                <li><strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong> {{ $value }} </li>
                            @endforeach
>>>>>>> 5fc181a3762210176b11be846d6f86c7d68c92c7
                        </ul>
                    </td>
                    <td>{{ $activity->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $activities->links('pagination::bootstrap-4') }}
    </div>
</div>


@endsection
