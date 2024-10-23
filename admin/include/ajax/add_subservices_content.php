<script>
    id = ceckid() 
    item = document.getElementById("change-value")
    item.id = "ckeditor-"+id;    
</script>
<?php 
    echo '
    <script src="assets/js/app.js"></script>
    <div class="p-3 mb-1 bg-light align-items-end">
        <button class="" onclick="remove(this)">X</button>
        <div class="row">
            <div class="col mb-2">
                <label class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="ssc_title[]" required>
            </div>
            <div class="col mb-2">
                <label class="form-label">Image <span class="text-danger">*</span></label>
                <input type="file" class="form-control" name="ssc_image[]" required>
                <input type="hidden" name="ssc_imageold[]" value="">
            </div>
        </div>
        <div class="row">
            <div class="col mb-2">
                <label class="form-label mb-0">Details</label>
                <textarea name="ssc_des[]" id="change-value" class="form-control"></textarea>
            </div>
        </div>
    </div>
    '; 
?>