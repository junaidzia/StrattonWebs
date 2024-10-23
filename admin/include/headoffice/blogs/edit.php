<?php 
$condition = array(
    'select'       =>  'blog_status, blog_title, blog_title_support, blog_des, blog_img, blog_banner, blog_user, blog_date, blog_tags'
    ,'where'        =>  array(
                               'is_deleted'  => 0,
                               'blog_id' => cleanvars($_GET['id'])
                           )
   ,'return_type'  =>  'single'
);
$row     = $dblms->getRows(BLOGS, $condition);


echo'
    <div class="card mb-5">
        <div class="modal-header bg-info p-3">
            <h5 class="modal-title" id="exampleModalLabel"><i class="ri-edit-circle-line align-bottom me-1"></i>Edit '.moduleName(0).'</h5>
        </div>
        <form action="" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <input type="hidden" name="blog_id" value="'.$_GET['id'].'"/>
            <div class="card-body">
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" data-choices name="blog_status" required>
                            <option value=""> Choose one</option>';
                            foreach(get_status() as $key => $status):
                                echo'<option value="'.$key.'" '.($row['blog_status'] == $key ? 'selected':'').'>'.$status.'</option>';
                            endforeach;
                            echo'
                        </select>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="blog_title" value="'.$row['blog_title'].'" placeholder="Enter Title" required>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Title Support <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="blog_title_support" value="'.$row['blog_title_support'].'" placeholder="Enter Title Support" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Author <span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" name="blog_user" value="'.$row['blog_user'].'" placeholder="Enter Author" required>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Image<span class="text-danger"> ( 355 by 236 ) px</span></label>
                        <input class="form-control" type="file" name="blog_img" accept=".jpg,.jpeg,.png">
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Banner<span class="text-danger"> ( 1600 by 833 ) px</span></label>
                        <input class="form-control" type="file" name="blog_banner" accept=".jpg,.jpeg,.png">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label">Date <span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" name="blog_date" value="'.$row['blog_date'].'" data-provider="flatpickr" placeholder="Enter Date" required>
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Tags <span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" name="blog_tags" value="'.$row['blog_tags'].'" data-choices data-choices-removeItem placeholder="Enter Tags" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label class="form-label mb-0">Detail</label>
                        <textarea name="blog_des" id="ckeditor" class="form-control">'.html_entity_decode($row['blog_des']).'</textarea>
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