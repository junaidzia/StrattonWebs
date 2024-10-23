<script>
    id = ceckid("highlights") ;
    item = document.getElementById("change-value");
    item.id = "highlights-"+id;    
    fors = document.getElementById("change-for");
    fors.id = "highlightsfor-"+id;    
    fors.setAttribute("for", "highlights-"+id);
</script>
<?php 
    echo '
    <script src="assets/js/app.js"></script>
    <div class="p-3 mb-1 bg-light align-items-end">
        <button class="" onclick="remove(this)">X</button>
        <div class="row">
            <div class="col mb-2">
                <label class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="cd_title[]" required>
            </div>
        </div>
        <div class="col mb-2">
            <div class="col mb-2">
                <div class="form-check form-switch">
                    <input class="form-check-input" name="cd_highlight[]" value="1" type="checkbox" role="switch" id="change-value">
                    <label class="form-check-label" id="change-for" for="change-value">Add this in Higlights</label>
                </div>
            </div>
        </div>
    </div>
    '; 
?>