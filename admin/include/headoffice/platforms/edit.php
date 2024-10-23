<?php 
$condition = array(
    'select'       =>  'platform_status, platform_title, platform_title_support,platform_short_des, platform_long_des, platform_img, platform_banner, platform_btn_title'
    ,'where'        =>  array(
                               'is_deleted'  => 0,
                               'platform_id' => cleanvars($_GET['id'])
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(PLATFORMS, $condition);

echo'
    <div class="card mb-5">
        <div class="modal-header bg-info p-3">
            <h5 class="modal-title" id="exampleModalLabel"><i class="ri-edit-circle-line align-bottom me-1"></i>Edit '.moduleName(0).'</h5>
        </div>
        <form action="" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <input type="hidden" name="platform_id" value="'.$_GET['id'].'"/>
            <div class="card-body">
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" data-choices name="platform_status" required>
                            <option value=""> Choose one</option>';
                            foreach(get_status() as $key => $status):
                                echo'<option value="'.$key.'" '.($key == $row['platform_status'] ? 'selected' : '' ).'>'.$status.'</option>';
                            endforeach;
                            echo'
                        </select>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" value="'.$row['platform_title'].'" name="platform_title" placeholder="Enter Title" required>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Title Support <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" value="'.$row['platform_title_support'].'" name="platform_title_support" placeholder="Enter Title Support" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Contact Page Btn Title <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" value="'.$row['platform_btn_title'].'" name="platform_btn_title" placeholder="Enter Btn Title" required>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Image<span class="text-danger"> ( 600 by 400 ) px</span></label>
                        <input class="form-control" type="file" name="platform_img" accept=".jpg,.jpeg,.png" >
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Banner<span class="text-danger"> ( 1600 by 833 ) px</span></label>
                        <input class="form-control" type="file" name="platform_banner" accept=".jpg,.jpeg,.png" >
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Description Image <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" name="platform_desimg">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label mb-0">Short Details</label>
                        <textarea name="platform_short_des" id="ckeditor" class="form-control">'.html_entity_decode($row['platform_short_des']).'</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label mb-0">Details</label>
                        <textarea name="platform_long_des" id="ckeditor" class="form-control">'.html_entity_decode($row['platform_long_des']).'</textarea>
                    </div>
                </div>
                <div id="platforms_detail">';  
                    $condition = array(
                        'select'        =>  'pd_title, pd_des'
                        ,'where'        =>  array(
                                                'id_platform' => cleanvars($_GET['id'])
                                            )
                        ,'return_type'  =>  'all'
                    );
                    $details     = $dblms->getRows(PLATFORMDETAIL, $condition);
                    if ($details) {
                        foreach ($details as $key => $detail) {
                            echo '                  
                            <div class="p-3 mb-1 bg-light align-items-end">
                                <button class="" onclick="remove(this)">X</button>
                                <div class="row">
                                    <div class="col mb-2">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="pd_title[]" value="'.$detail['pd_title'].'" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-2">
                                        <label class="form-label mb-0">Details</label>
                                        <script></script>
                                        <textarea name="pd_des[]" id="ckeditor-'.$key.'" class="form-control">'.html_entity_decode($detail['pd_des']).'</textarea>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                    echo '
                </div>
                <button type="button" class="btn btn-primary" onclick="add_services_detail()">Add Platform Detail</button>
    
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