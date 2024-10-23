<?php 
$condition = array(
    'select'       =>  'ss_status, ss_title, ss_titlesupport,  id_service'
    ,'where'        =>  array(
                               'is_deleted'  => 0,
                               'ss_id' => cleanvars($_GET['id'])
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(SUBSERVICES, $condition);

$condition = array(
    'select'       =>  'service_id, service_title'
   ,'where'        =>  array(
                                'service_status'    => 1
                               ,'is_deleted'        => 0
                           )
   ,'order_by'     =>  'service_id ASC'
   ,'return_type'  =>  'all'
);
$services     = $dblms->getRows(SERVICES , $condition);
echo'
    <div class="card mb-5">
        <div class="modal-header bg-info p-3">
            <h5 class="modal-title" id="exampleModalLabel"><i class="ri-edit-circle-line align-bottom me-1"></i>Edit '.moduleName(0).'</h5>
        </div>
        <form action="" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <input type="hidden" name="ss_id" value="'.$_GET['id'].'"/>
            <div class="card-body">
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Services <span class="text-danger">*</span></label>
                        <select class="form-control" data-choices name="id_service" required>';
                            foreach($services as $service):
                                echo'<option value="'.$service['service_id'].'" '.($service['service_id'] == $row['id_service'] ? 'selected' : '').'>'.html_entity_decode($service['service_title']).'</option>';
                            endforeach;
                            echo'
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" data-choices name="ss_status" required>
                            <option value=""> Choose one</option>';
                            foreach(get_status() as $key => $status):
                                echo'<option value="'.$key.'" '.($key == $row['ss_status'] ? 'selected':'').'>'.$status.'</option>';
                            endforeach;
                            echo'
                        </select>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="ss_title" value="'.$row['ss_title'].'" placeholder="Enter Title" required>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Title Support <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="ss_titlesupport" value="'.$row['ss_titlesupport'].'" placeholder="Enter Title Support" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Icon<span class="text-danger"> ( 45 by 45 ) px</span></label>
                        <input class="form-control" type="file" name="ss_icon" accept=".jpg,.jpeg,.png">
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Banner<span class="text-danger"> ( 1600 by 833 ) px</span></label>
                        <input class="form-control" type="file" name="ss_banner" accept=".jpg,.jpeg,.png">
                    </div>
                </div>
                <div id="subservices_content">';
                    $condition = array(
                        'select'        =>  'ssc_title, ssc_des, ssc_image'
                        ,'where'        =>  array(
                                                'id_ss' => cleanvars($_GET['id'])
                                            )
                        ,'return_type'  =>  'all'
                    );
                    $details     = $dblms->getRows(SUBSERVICECONTENT, $condition);
                    if ($details) {
                        foreach ($details as $key => $detail) {
                            echo '       
                            <div class="p-3 mb-1 bg-light align-items-end">
                                <button class="" onclick="remove(this)">X</button>
                                <div class="row">
                                    <div class="col mb-2">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="ssc_title[]" value="'.html_entity_decode($detail['ssc_title']).'" required>
                                    </div>
                                    <div class="col mb-2">
                                        <label class="form-label">Image <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="ssc_image[]">
                                        <input type="hidden" name="ssc_imageold[]" value="'.$detail['ssc_image'].'">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-2">
                                        <label class="form-label mb-0">Details</label>
                                        <textarea name="ssc_des[]" id="ckeditor'.$key.'" class="form-control">'.html_entity_decode($detail['ssc_des']).'</textarea>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                echo '
                </div>
                <button type="button" class="btn btn-primary mb-2" onclick="add_subservices_content()">Add Sub Services Content</button>
                <div id="subservices_detail">';  
                    $condition = array(
                        'select'        =>  'ssd_title, ssd_des'
                        ,'where'        =>  array(
                                                'id_ss' => cleanvars($_GET['id'])
                                            )
                        ,'return_type'  =>  'all'
                    );
                    $details     = $dblms->getRows(SUBSERVICEDETAIL, $condition);
                    if ($details) {
                        foreach ($details as $key => $detail) {
                            echo '                  
                            <div class="p-3 mb-1 bg-light align-items-end">
                                <button class="" onclick="remove(this)">X</button>
                                <div class="row">
                                    <div class="col-4 mb-2">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="ssd_title[]" value="'.html_entity_decode($detail['ssd_title']).'" required>
                                    </div>
                                    <div class="col mb-2">
                                        <label class="form-label">Title Support <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="ssd_des[]" value="'.html_entity_decode($detail['ssd_des']).'" required>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                    echo '
                </div>
                <button type="button" class="btn btn-primary" onclick="add_subservices_detail()">Add Sub Services Detail</button>
    
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