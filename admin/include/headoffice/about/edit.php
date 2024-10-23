<?php 
$condition = array(
    'select'       =>  'about_title,about_des'
    ,'where'        =>  array(
                               'about_id' => cleanvars($_GET['id'])
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(ABOUT, $condition);
$condition = array(
    'select'       =>  'al_name, al_per'
    ,'where'        =>  array(
                               'id_about' => cleanvars($_GET['id'])
                           )
   ,'return_type'  =>  'all'
);
$aboutlanguages     = $dblms->getRows(ABOUTLANGUAGE, $condition);

echo'
    <div class="card mb-5">
        <div class="modal-header bg-info p-3">
            <h5 class="modal-title" id="exampleModalLabel"><i class="ri-edit-circle-line align-bottom me-1"></i>Edit '.moduleName(0).'</h5>
        </div>
        <form action="" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <input type="hidden" name="about_id" value="'.$_GET['id'].'"/>
            <div class="card-body">
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="about_title" value="'.$row['about_title'].'" placeholder="Enter Title" required>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Banner<span class="text-danger"> ( 1600 by 833 ) px</span></label>
                        <input class="form-control" type="file" name="about_banner" accept=".jpg,.jpeg,.png">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label mb-0">Detail</label>
                        <textarea name="about_des" id="ckeditor" class="form-control">'.html_entity_decode($row['about_des']).'</textarea>
                    </div>
                </div>
                <div id="about_detail">';
                if($aboutlanguages){
                    foreach ($aboutlanguages as $detail) {
                        echo '
                        <div class="p-3 mb-1 bg-light align-items-end">
                            <button class="" onclick="remove(this)">X</button>
                            <div class="row">
                                <div class="col mb-2">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="al_name[]" value="'.$detail['al_name'].'" required>
                                </div>
                                <div class="col mb-2">
                                    <label class="form-label">Percantage <span class="text-danger">*</span></label>
                                    <input type="number" min="0" max="100" class="form-control" name="al_per[]" value="'.$detail['al_per'].'" required>
                                </div>
                            </div>
                        </div>';
                    }
                }
                echo '
                </div>
                <button type="button" class="btn btn-primary" onclick="add_about_detail()">Add About Language</button>
            </div>
            <div class="card-footer">
                <div class="hstack gap-2 justify-content-end">
                    <a href="'.moduleName().'.php" class="btn btn-danger btn-sm"><i class="ri-close-circle-line align-bottom me-1"></i>Cancel</a>
                    <button type="submit" class="btn btn-info btn-sm" name="submit_edit"><i class="ri-edit-circle-line align-bottom me-1"></i>Edit '.moduleName(0).'</button>
                </div>
            </div>
        </form>
    </div>';
?>