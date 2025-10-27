<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Brands') }}
        </h2>
    </x-slot>

    {{-- @session('success')
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Success</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ $message }}
            </div>
        </div>
    @endsession  --}}
   

    <div class="container">
        <div class="row">
            <div class="col-md-8 pt-4">
                <div class="card">
                    <div class="card-header text-center">All Brands</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Logo</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <th scope="row">{{ $brand->id }}</th>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td><img src="{{ asset($brand->brand_logo) }}" alt="{{ $brand->brand_name }}"
                                                style="width: 70px; height: 50px;"></td>
                                        <td>
                                            <a href="{{ route('categories.edit', $brand->id) }}"
                                                class="btn btn-info">Edit</a>
                                            <form action="{{ route('categories.destroy', $brand->id) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>

            <div class="col-md-4 pt-4">
                <div class="card">
                    <div class="card-header text-center">Add Brand</div>
                    <div class="card-body">
                        <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="brand_id">Brand Name</label>
                                <input type="text" class="form-control" id="brand_id" name="brand_name" required>
                                @error('brand_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="brand_logo" class="form-label">Brand Logo</label>
                                <input type="file" class="form-control" id="brand_logo" name="brand_logo" required>
                                @error('brand_logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                            </div>
                            <button type="submit" class="btn btn-primary">Add Brand</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
