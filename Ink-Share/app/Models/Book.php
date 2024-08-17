<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'genre', 'condition', 'cover_image', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function borrowedBy()
    {
        return $this->hasMany(BorrowedBook::class);
    }

    public function borrowedBooks() {
        return $this->hasMany(BorrowedBook::class);
    }

    public function isAvailable() {
        if ($this->status === 'approved' && !$this->isBorrowed()) {
            return true;
        }

        return false;
    }

    public function isBorrowed() {
        $this->load('borrowedBooks');

        // Check if any borrowed books are in 'borrowed' or 'requested' state
        $borrowed = $this->borrowedBooks->filter(function ($borrowedBook) {
            return in_array($borrowedBook->status, ['approved', 'requested']);
        })->isNotEmpty();

        // If any book is borrowed or requested, it's not available
        return $borrowed;
    }

    public function isBorrowedOnce(){
        if ($this->isBorrowedOnceRecieved()) {
            return true;
        }

        return false;
    }

    public function isBorrowedOnceRecieved(){
        $this->load('borrowedBooks');

        $borrowed = $this->borrowedBooks->filter(function ($borrowedBook) {
            return in_array($borrowedBook->status, ['declined', 'returned']);
        })->isNotEmpty();

        // If any book is borrowed or requested, it's not available
        return $borrowed;
    }


}
