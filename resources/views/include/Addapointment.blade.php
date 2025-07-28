<h3>Add Appointment</h3>
          <!-- Appointment Form -->
          <form method="post" action="{{ route('appointments.add') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="date">Date:</label>
              <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
              <label for="time">Start Time:</label>
              <input type="time" class="form-control" id="time" name="start_time" required>
            </div>
            <div class="form-group">
              <label for="time">End Time:</label>
              <input type="time" class="form-control" id="time" name="end_time" required>
            </div>
            <div class="form-group">
              <label for="image">Image:</label>
              <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          <!-- End of Appointment Form -->