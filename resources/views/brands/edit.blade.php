<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Brand') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-8 pt-4">
                <div class="card">
                    <div class="card-header text-center">Update Brand</div>
                    <div class="card-body">
                        <form action="{{ route('brand.update',$brand->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="old_logo" value="{{ $brand->brand_logo }}">
                            <div class="mb-3">
                                <label for="brand_name">Brand Name</label>
                                <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{ old('brand_name', $brand->brand_name) }}" required>
                                @error('brand_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="brand_logo" class="form-label">Brand Logo</label>
                                <input type="file" class="form-control" id="brand_logo" name="brand_logo" value="{{ old('brand_logo', $brand->brand_logo) }}" required>
                                <img src="{{ asset($brand->brand_logo) }}" alt="{{ $brand->brand_name }}" style="width: 350px; height: 200px;mt-4px">
                                @error('brand_logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                
    
                            </div>
                            <button type="submit" class="btn btn-primary">Update Brand</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


</x-app-layout>
