<?php 
$condition = array(
    'select'       =>  'contact_title, contact_getintouch, contact_countries, contact_map, contact_social'
    ,'where'        =>  array(
                               'contact_id' => cleanvars($_GET['id'])
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(CONTACT, $condition);
$socialmedia = unserialize(base64_decode($row['contact_social']));
$contact_countries = unserialize(base64_decode($row['contact_countries']));
echo'
    <div class="card mb-5">
        <div class="modal-header bg-info p-3">
            <h5 class="modal-title" id="exampleModalLabel"><i class="ri-edit-circle-line align-bottom me-1"></i>Edit '.moduleName(0).'</h5>
        </div>
        <form action="" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <input type="hidden" name="contact_id" value="'.$_GET['id'].'"/>
            <div class="card-body">
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="contact_title" value="'.$row['contact_title'].'" placeholder="Enter Title" required>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Banner<span class="text-danger"> ( 1600 by 833 ) px</span></label>
                        <input class="form-control" type="file" name="contact_banner" accept=".jpg,.jpeg,.png">
                    </div>
                </div>';
                foreach (contact_countries() as $key => $value) {
                    echo '
                    <div class="row">
                        <input type="hidden" name="contactkey[]" value="'.$key.'">
                        <div class="col-8 mb-2">
                            <label class="form-label">'.$value[0].' Address</label>
                            <input class="form-control" type="text" name="contact_countries[]" value="'.(isset($contact_countries[$key][0])?$contact_countries[$key][0]:'').'" placeholder="Enter Address">
                        </div>
                        <div class="col mb-2">
                            <label class="form-label">Phone </label>
                            <input class="form-control" type="text" name="contact_countrie[]" value="'.(isset($contact_countries[$key][1])?$contact_countries[$key][1]:'').'" placeholder="Enter Phone">
                        </div>
                    </div>';
                }
                echo '
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Map<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="contact_map" value="'.$row['contact_map'].'" placeholder="Enter Map link" required>
                    </div>
                </div>
                <div class="row">';
                    foreach (social_media() as $key => $value) {
                        echo '
                        <div class="col mb-2">
                            <label class="form-label">'.$value[0].' <span class="text-danger">*</span></label>
                            <input type="hidden" name="socialkey[]" value='.$key.'>
                            <input class="form-control" type="text" name="social[]" value="'.$socialmedia[$key].'" placeholder="Enter '.$value[0].'" required>
                        </div>';
                    }
                    echo '
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label mb-0">Get In Touch Description</label>
                        <textarea name="contact_getintouch" id="ckeditor" class="form-control">'.html_entity_decode($row['contact_getintouch']).'</textarea>
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