<!-- Category Filter Buttons -->
<div class="mb-3 text-center">
    <button class="btn btn-primary mx-2" onclick="filterProducts('all')">Show All</button>
    <button class="btn btn-secondary mx-2" onclick="filterProducts('DOG')">DOG</button>
    <button class="btn btn-secondary mx-2" onclick="filterProducts('CAT')">CAT</button>
    <button class="btn btn-secondary mx-2" onclick="filterProducts('HAMSTER')">HAMSTER</button>
</div>

<!-- Table for Products -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">Pet Name</th>
            <th scope="col">Age</th>
            <th scope="col">Category</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody id="productTable">
        <!-- DOG Products -->
@foreach($gpuProducts as $product)
<tr class="product-row" data-category="DOG">
    <td>{{ $product->prod_name }}</td>
    <td>{{ $product->price }}</td>
    <td>DOG</td>
    <td>{{ $product->description }}</td>
    <td>
        <img src="{{ url($product->image) }}" alt="{{ $product->prod_name }}" style="max-height: 100px; object-fit: cover;">
    </td>
    <td>
        <div class="btn-group" role="group">
            <a href="#" class="btn btn-primary mt-auto" data-toggle="modal" data-target="#editModal{{ $product->id }}">Edit</a>
            <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirmDelete()" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </td>
</tr>

<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $product->id }}">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('edit_product', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Ensure this is PUT or PATCH as per your route definition -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="prod_name">Pet Name</label>
                        <input type="text" class="form-control" id="prod_name" name="prod_name" value="{{ $product->prod_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Age</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="DOG" {{ $product->category == 'DOG' ? 'selected' : '' }}>DOG</option>
                            <option value="CAT" {{ $product->category == 'CAT' ? 'selected' : '' }}>CAT</option>
                            <option value="HAMSTER" {{ $product->category == 'HAMSTER' ? 'selected' : '' }}>HAMSTER</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

        

        <!-- CAT Products -->
        @foreach($cpuProducts as $product)
        <tr class="product-row" data-category="CAT">
            <td>{{ $product->prod_name }}</td>
            <td>{{ $product->price }}</td>
            <td>CAT</td>
            <td>{{ $product->description }}</td>
            <td>
                <img src="{{ url($product->image) }}" alt="{{ $product->prod_name }}" style="max-height: 100px; object-fit: cover;">
            </td>
            <td>
            <a href="#" class="btn btn-primary mt-auto" data-toggle="modal" data-target="#editModal{{ $product->id }}">Edit</a>
                <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirmDelete()" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $product->id }}">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('edit_product', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Ensure this is PUT or PATCH as per your route definition -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="prod_name">Product Name</label>
                        <input type="text" class="form-control" id="prod_name" name="prod_name" value="{{ $product->prod_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="DOG" {{ $product->category == 'DOG' ? 'selected' : '' }}>DOG</option>
                            <option value="CAT" {{ $product->category == 'CAT' ? 'selected' : '' }}>CAT</option>
                            <option value="HAMSTER" {{ $product->category == 'HAMSTER' ? 'selected' : '' }}>HAMSTER</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
        @endforeach

        <!-- HAMSTER Products -->
        @foreach($monitorProducts as $product)
        <tr class="product-row" data-category="HAMSTER">
            <td>{{ $product->prod_name }}</td>
            <td>{{ $product->price }}</td>
            <td>HAMSTER</td>
            <td>{{ $product->description }}</td>
            <td>
                <img src="{{ url($product->image) }}" alt="{{ $product->prod_name }}" style="max-height: 100px; object-fit: cover;">
            </td>
            <td>
                <a href="#" class="btn btn-primary mt-auto" data-toggle="modal" data-target="#editModal{{ $product->id }}">Edit</a>
                <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirmDelete()" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $product->id }}">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('edit_product', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Ensure this is PUT or PATCH as per your route definition -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="prod_name">Pet Name</label>
                        <input type="text" class="form-control" id="prod_name" name="prod_name" value="{{ $product->prod_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Age</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="DOG" {{ $product->category == 'DOG' ? 'selected' : '' }}>DOG</option>
                            <option value="CAT" {{ $product->category == 'CAT' ? 'selected' : '' }}>CAT</option>
                            <option value="HAMSTER" {{ $product->category == 'HAMSTER' ? 'selected' : '' }}>HAMSTER</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
        @endforeach
    </tbody>
</table>

<script>
    function filterProducts(category) {
        // Get all rows with class 'product-row'
        let rows = document.querySelectorAll('.product-row');

        // Loop through all rows and toggle their visibility
        rows.forEach(function(row) {
            if (category === 'all') {
                row.style.display = '';  // Show all rows
            } else {
                if (row.getAttribute('data-category') === category) {
                    row.style.display = '';  // Show matching category rows
                } else {
                    row.style.display = 'none';  // Hide non-matching rows
                }
            }
        });
    }
</script>

<a href="{{ url('/export-products') }}" class="btn btn-success">Export Pets</a>
