<?php 
    echo '
    <div class="p-3 mb-1 bg-light align-items-end">
        <button class="" onclick="remove(this)">X</button>
        <div class="row">
            <div class="col-4 mb-2">
                <label class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="ssd_title[]" required>
            </div>
            <div class="col mb-2">
                <label class="form-label">Title Support <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="ssd_des[]" required>
            </div>
        </div>
    </div>
    '; 
?>