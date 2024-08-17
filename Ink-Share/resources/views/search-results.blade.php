@extends('layouts.app')

@section('content')
    <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-black">
        Search Results for "{{ $query }}"
    </h2>
    <div class="mt-6">
        @foreach ($books as $book)
        <div class="mt-6">
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
                                <button type="submit" class="borrow-button rounded-lg mt-4"><a href="{{ route('borrowAgain.book', $book) }}">Borrow</a></button>
                            @else
                                <button type="submit" class="borrow-button rounded-lg mt-4"><a href="{{ route('borrow.book', $book) }}">Borrow</a></button>
                            @endif
                        @else
                            <p class="mt-4 text dark:text-red-400 text-sm leading-relaxed">Not Available</p>
                        @endif
                    </div>
                </div>
            </div>
            </div>
        @endforeach
    </div>
@endsection
