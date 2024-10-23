<?php 
    echo '
    <script src="assets/js/app.js"></script>
    <div class="p-3 mb-1 bg-light align-items-end">
        <button class="" onclick="remove(this)">X</button>
        <div class="row">
            <div class="col mb-2">
                <label class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="al_name[]" required>
            </div>
            <div class="col mb-2">
                <label class="form-label">Percentage <span class="text-danger">*</span></label>
                <input type="number" min="0" max="100" class="form-control" name="al_per[]" required>
            </div>
        </div>
    </div>
    '; 
?>