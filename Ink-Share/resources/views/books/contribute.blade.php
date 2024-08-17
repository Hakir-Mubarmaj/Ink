@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Contribute Book') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" name="title" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="genre" class="col-md-4 col-form-label text-md-end">{{ __('Department') }}</label>

                            <div class="col-md-6">
                                <select id="genre" name="genre" required>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre }}">{{ $genre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="condition" class="col-md-4 col-form-label text-md-end">{{ __('Condition') }}</label>

                            <div class="col-md-6">
                                <select id="condition" name="condition" required>
                                    @foreach ($condition as $condition)
                                        <option value="{{ $condition }}">{{ $condition }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cover_image" class="col-md-4 col-form-label text-md-end">{{ __('Cover Image') }}</label>

                            <div class="col-md-6">
                                <input id="cover_image" type="file" name="cover_image">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="my-link">
                                    {{ __('Contribute Book') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
