<!-- Floating Action Button -->
<button type="button" id="addPetFab" class="btn btn-primary btn-floating" data-toggle="modal" data-target="#addPetModal">
    <i class="fas fa-plus"></i> <!-- Font Awesome plus icon -->
</button>

<!-- Modal for Adding Pets -->
<div class="modal fade" id="addPetModal" tabindex="-1" role="dialog" aria-labelledby="addPetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPetModalLabel">Add Pet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to add pets -->
                <form action="{{route('addProduct')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="productName">Pet Name:</label>
                        <input type="text" class="form-control" id="productName" name="prod_name" placeholder="Enter Pet name" required>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Pet Age:</label>
                        <input type="number" class="form-control" id="productPrice" name="price" placeholder="Enter Pet age" required>
                    </div>
                    <div class="form-group">
                        <label for="productPicture">Pet Picture:</label>
                        <input type="file" class="form-control-file" id="productPicture" name="image" required>
                    </div>
                    <div class="form-group">
                        <label for="productCategory">Pet Category:</label>
                        <select class="form-control" id="productCategory" name="category" required>
                            <option value="DOG">DOG</option>
                            <option value="CAT">CAT</option>
                            <option value="HAMSTER">HAMSTER</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="productDescription">Pet Description:</label>
                        <textarea class="form-control" id="productDescription" name="description" placeholder="Enter Pet description" required></textarea>
                    </div>
                    <div class="d-flex justify-content-center">
                         <button type="submit" class="btn btn-primary">Add Pet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Floating Button Styles -->
<style>
    #addPetFab {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
</style>

<!-- Include Bootstrap and Font Awesome -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
