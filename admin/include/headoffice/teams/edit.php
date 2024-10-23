<?php 
$condition = array(
    'select'       =>  'team_status, team_name, team_img, team_position, team_des, team_social'
    ,'where'        =>  array(
                               'is_deleted'  => 0,
                               'team_id' => cleanvars($_GET['id'])
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(TEAMS, $condition);
$socailmedia = unserialize(base64_decode($row['team_social']));

echo'
    <div class="card mb-5">
        <div class="modal-header bg-info p-3">
            <h5 class="modal-title" id="exampleModalLabel"><i class="ri-edit-circle-line align-bottom me-1"></i>Edit '.moduleName(0).'</h5>
        </div>
        <form action="" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <input type="hidden" name="team_id" value="'.$_GET['id'].'"/>
            <div class="card-body">
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" data-choices name="team_status" required>
                            <option value=""> Choose one</option>';
                            foreach(get_status() as $key => $status):
                                echo'<option value="'.$key.'" '.($row['team_status'] == $key ? 'selected' : '').'>'.$status.'</option>';
                            endforeach;
                            echo'
                        </select>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="team_name" value="'.$row['team_name'].'" placeholder="Enter Name" required>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Position <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="team_position" value="'.$row['team_position'].'" placeholder="Enter Position" required>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Image<span class="text-danger"> ( 355 by 236 ) px</span></label>
                        <input class="form-control" type="file" name="team_img" accept=".jpg,.jpeg,.png">
                    </div>
                </div>
                <div class="row">';
                    foreach (social_media() as $key => $value) {
                        echo '
                        <div class="col mb-2">
                            <label class="form-label">'.$value[0].' <span class="text-danger">*</span></label>
                            <input type="hidden" name="socialkey[]" value='.$key.'>
                            <input class="form-control" type="text" name="social[]" value="'.(isset($socailmedia[$key]) ? $socailmedia[$key] : '').'" placeholder="Enter '.$value[0].'" required>
                        </div>';
                    }
                echo '
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label mb-0">Detail</label>
                        <textarea name="team_des" id="ckeditor" class="form-control">'.html_entity_decode($row['team_des']).'</textarea>
                    </div>
                </div>
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