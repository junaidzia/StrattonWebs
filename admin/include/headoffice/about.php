<?php 
include_once (moduleName().'/query.php');
echo' 
<title>'.moduleName(0).' - '.TITLE_HEADER.'</title>
<div class="page-content mb-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">'.moduleName(0).'</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">'.moduleName(0).'</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-lg-12">';
            if (isset($_GET['add'])) {
                include_once (moduleName().'/add.php');
            } else if (!empty($_GET['id'])) {
                include_once (moduleName().'/edit.php');
            } else {
                include_once (moduleName().'/list.php');
            }
            echo'
        </div>
        </div>
    </div>
</div>
<script>
function add_about_detail(){
    $.ajax({
        url : "include/ajax/add_about_detail.php",
        type : "POST",
        success : function(response){
            $("#about_detail").append(response);
        }
    })
}
function remove(value){
    $(value).parent().remove()
}
</script>
';
?>