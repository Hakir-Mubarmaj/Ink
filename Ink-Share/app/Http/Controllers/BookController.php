<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    public function index()
    {
        // Display a list of books on the home page
        $books = Book::where('status', 'approved');
        $books = $books->get();

        $genres = Book::pluck('genre')->unique();

        return view('home', compact('books', 'genres'));
    }

    public function filterByGenre($genre)
    {
        $books = Book::where('genre', $genre)->where('status', 'approved')->get();
        $genres = Book::pluck('genre')->unique();

        return view('home', compact('books', 'genres'));
    }


    public function contribute()
    {
        $genres = ['Computer Science & Engineering', 'Mathematics', 'Chemistry', 'Physics', 'Geology and Mining', 'Statistics', 'Soil and Environmental Sciences', 'Botany', 'Biochemistry', 'Other'];
        $condition = ['Good', 'Medium', 'Poor'];
        return view('books.contribute', compact('genres', 'condition'));
    }


    public function store(Request $request)
    {
        // Validate the book contribution form data
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'condition' => 'required',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create a new book in the database and associate it with the logged-in user
        $user = Auth::user();
        $book = new Book([
            'title' => $request->title,
            'genre' => $request->genre,
            'condition' => $request->condition,
            'cover_image' => $request->cover_image,
        ]);
        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $fileName = $coverImage->hashName(); // Get a unique file name for the image
            $path = $coverImage->storeAs('public/images', $fileName); // Store the image in the 'public/images' directory with the generated unique name

            $book->cover_image = $fileName; // Store only the name in the database
        }



        $user->books()->save($book);

        // Redirect to the home page with a success message
        return redirect('/')->with('success', 'Book contribution added and pending approval');
    }

    public function show(Book $book)
    {
        // Display an individual book's details
        return view('books.book', ['book' => $book]);
    }

    public function create()
    {
        $genres = ['CSE', 'EEE', 'ICE', 'Other'];
        return view('books.contribute', compact('genres'));
    }

    public function reRequestBook(Book $book)
{
    $user = Auth::user();

    // Check if the user previously had a declined request for this book
    $previousRequest = $user->borrowedBooks
        ->where('book_id', $book->id)
        ->where('status', 'declined')
        ->first();

    if (!$previousRequest) {
        return back()->with('error', 'You cannot re-request this book.');
    }

    // Update the status and submit a new request
    $previousRequest->status = 'pending';
    $previousRequest->save();

    return back()->with('success', 'Book re-requested successfully.');
}
public function search(Request $request)
{
    $query = $request->input('query');
    $books = Book::where('title', 'like', '%'.$query.'%')
                 ->where('status', 'approved')
                 ->get();

    return view('search-results', compact('books', 'query'));
}


}
