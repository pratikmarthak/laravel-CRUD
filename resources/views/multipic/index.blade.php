<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Multipal Pictures') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="container">
            
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="col-md-8 pt-4">
                    <div class="card-header text-center"><b>All Images</b></div>
                    <div class="card-group">
                        
                        @foreach ($images as $image)
                            <div class="col-md-4 mt-4">
                                <div class="card">
                                    <img src="{{ asset($image->images) }}" class="card-img-top"
                                        style="height: 200px; width: 100%; object-fit: cover;" alt="...">
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>


                <div class="col-md-4 pt-4">
                    <div class="card">
                        <div class="card-header text-center">Add Multipal Images</div>
                        <div class="card-body">
                            <form action="{{ route('multipic.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="images" class="form-label">Upload Images</label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple
                                        required>
                                    @error('images')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                </div>
                                <button type="submit" class="btn btn-primary">Add Images</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
