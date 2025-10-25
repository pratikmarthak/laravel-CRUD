<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Categories') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">

            <div class="col-md-8 pt-4">
                <div class="card">
                    <div class="card-header text-center">Add Category</div>
                    <div class="card-body">
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="category_id">ID</label>
                                <input type="text" class="form-control" id="category_id" name="category_id" required>
                                @error('id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="name" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                
    
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </div>
            </div>
        </div>

    </div>




</x-app-layout>
