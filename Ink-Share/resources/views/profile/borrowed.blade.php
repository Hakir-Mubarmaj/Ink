@extends('layouts.app')

@section('content')
    <h2>Borrowed Books</h2>
    @if (count($borrowedBooks) > 0)
        <ul>
            @foreach ($borrowedBooks as $borrowedBook)
                <li>
                    {{ $borrowedBook->book->title }} - Deadline: {{ $borrowedBook->return_deadline }}
                </li>
            @endforeach
        </ul>
    @else
        <p>No books borrowed.</p>
    @endif
@endsection
