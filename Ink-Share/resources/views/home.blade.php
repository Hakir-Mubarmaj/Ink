@extends('layouts.app')

@section('content')
    <div class="book-list">
        <div class="text-right">
        <ul>
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle bg-gray-100 p-2 w-15 rounded-lg" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    All Department
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @foreach ($genres as $genre)
                    <a class="dropdown-item" href="{{ route('books.filterByGenre', $genre) }}">
                        {{ $genre }}
                    </a>
                    @endforeach
                </div>
            </li>
        </ul>
        </div>
        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-black">Library</h2>
        <div class="mt-6">
        @foreach ($books as $book)
        <div class="mt-6">
        @if ($book->status === 'approved')
        <div class="book-container">
            <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <div class="image-container" style="width: 200px; height: 250px; padding-right: 20px;">
                    <img src="{{ URL('storage/images/'.$book->cover_image) }}" alt="Not Found">
                </div>
                <div>
                    <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-black">{{ $book->title }}</h2>

                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Department: {{ $book->genre }}
                    </p>
                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Condition: {{ $book->condition }}
                    </p>
                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Contributor: {{ $book->user->name }}
                    </p>
                    @if ($book->isAvailable())
                        @if ($book->isBorrowedOnce())
                            <button type="submit" class="borrow-button rounded-lg mt-4"><a href="{{ route('borrowAgainHome.book', $book) }}">Borrow</a></button>
                        @else
                            <button type="submit" class="borrow-button rounded-lg mt-4"><a href="{{ route('borrow.book', $book) }}">Borrow</a></button>
                        @endif
                    @else
                        <p class="mt-4 text dark:text-red-400 text-sm leading-relaxed">Not Available</p>
                    @endif
                </div>
            </div>
        </div>
        @endif
        </div>
        @endforeach
        </div>
    </div>
@endsection
