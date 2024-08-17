@extends('layouts.app')

@section('content')
    <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-black">Your Profile</h2>
    <div class="mt-6">
    <div class="book-container">
    <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
    <div>
    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Name: {{ Auth::user()->name }}</p>
    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Email: {{ Auth::user()->email }}</p>
    </div>
    </div>
    </div>
    </div><div class="mt-6"></div>

    <!-- List of books contributed by the user -->
    <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
    <div>
        <h3 class="mt-6 text-xl font-semibold text-gray-900 dark:text-black">Contributed Books</h3>
        <button id="showContributedBooks" class="show-hide-button my-link">Show Contributed Books</button>
    </div>
    </div>
    <div id="contributedBooks" class="book_list mt-6">
    @foreach (Auth::user()->books as $book)
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
                </div>
            </div>
        </div>
        @endif
        </div>
    @endforeach
    </div><div class="mt-6"></div>

    <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
    <div>
    <h3 class="mt-6 text-xl font-semibold text-gray-900 dark:text-black">Pending Books</h3>
    <button id="showPendingBooks" class="show-hide-button my-link">Show Pending Books</button>
    </div>
    </div>
    <div id="pendingBooks" class="book_list mt-6">
    @foreach (Auth::user()->books as $book)
    <div class="mt-6">
        @if ($book->status === 'requested')
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
                </div>
            </div>
        </div>
        @endif
        </div>
    @endforeach
    </div>
    <h3 class="mt-6 text-xl font-semibold text-gray-900 dark:text-black">Borrowed Books</h3>
    <div class="mt-6">
    @foreach (Auth::user()->borrowedBooks as $borrowedBook)
    <div class="mt-6">
        @if ($borrowedBook->status === 'approved')
        <div class="book-container">
            <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <div class="image-container" style="width: 200px; height: 250px; padding-right: 20px;">
                    <img src="{{ URL('storage/images/'.$borrowedBook->book->cover_image) }}" alt="Not Found">
                </div>
                <div>
                    <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-black">{{ $borrowedBook->book->title }}</h2>

                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Department: {{ $borrowedBook->book->genre }}
                    </p>
                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Condition: {{ $borrowedBook->book->condition }}
                    </p>
                    <p class="mt-4 text dark:text-stroke-red-500 text-sm leading-relaxed">
                        Deadline: {{ $borrowedBook->return_deadline }}
                    </p>
                    <button type="submit" class="borrow-button rounded-lg mt-4"><a href="{{ route('return.book', $borrowedBook->book) }}">Return It</a></button>
                </div>
            </div>
        </div>
        @endif
        </div>
    @endforeach
    </div>

    <h3 class="mt-6 text-xl font-semibold text-gray-900 dark:text-black">Pending Borrow Books</h3>
    <div class="mt-6">
    @foreach (Auth::user()->borrowedBooks as $borrowedBook)
    <div class="mt-6">
        @if ($borrowedBook->status === 'requested')
        <div class="book-container">
            <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <div class="image-container" style="width: 200px; height: 250px; padding-right: 20px;">
                    <img src="{{ URL('storage/images/'.$borrowedBook->book->cover_image) }}" alt="Not Found">
                </div>
                <div>
                    <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-black">{{ $borrowedBook->book->title }}</h2>

                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Department: {{ $borrowedBook->book->genre }}
                    </p>
                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Condition: {{ $borrowedBook->book->condition }}
                    </p>
                    <h3 class="mt-6 text-xl font-semibold text-gray-500 dark:text-black">Pending....</h3>
                </div>
            </div>
        </div>
        @endif
        </div>
    @endforeach
    </div>

    <h3 class="mt-6 text-xl font-semibold text-gray-900 dark:text-black">Declined Requests</h3>
    <div class="mt-6">
    @foreach (Auth::user()->borrowedBooks as $borrowedBook)
    <div class="mt-6">
        @if ($borrowedBook->status === 'declined')
        <div class="book-container">
            <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <div class="image-container" style="width: 200px; height: 250px; padding-right: 20px;">
                    <img src="{{ URL('storage/images/'.$borrowedBook->book->cover_image) }}" alt="Not Found">
                </div>
                <div>
                    <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-black">{{ $borrowedBook->book->title }}</h2>

                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Department: {{ $borrowedBook->book->genre }}
                    </p>
                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Condition: {{ $borrowedBook->book->condition }}
                    </p>
                    <h3 class="mt-6 text-xl font-semibold text dark:text-black">Declined</h3>
                    <form method="POST" action="{{ route('borrowAgain.book', $borrowedBook->book) }}">
                        @csrf
                        <button type="submit">Re-Request</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
        </div>
    @endforeach
    </div>

@endsection
