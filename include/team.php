<?php
$condition = array(
    'select'        =>  'team_name,team_img,team_position,team_social,team_des'
    ,'where'        =>  array(
                                'team_status'   => '1'
                               ,'is_deleted'    => '0'
                            )
   ,'return_type'  =>  'all'
);
$teams     = $dblms->getRows(TEAMS, $condition);
if($teams){
    echo '
    <!-- TEAM -->
    <section class="background-grey">
        <div class="container">
            <div class="heading-text heading-section text-center">
                <h2>MEET OUR TEAM</h2>
            </div>
            <div class="row team-members">';
                foreach ($teams as $team) {
                    $socialmedia = unserialize(base64_decode($team['team_social']));
                    echo '
                    <div class="col-lg-3">
                        <div class="team-member">
                            <div class="team-image">
                                <img src="images/teams/'.$team['team_img'].'">
                            </div>
                            <div class="team-desc">
                                <h3>'.$team['team_name'].'</h3>
                                <span>'.$team['team_position'].'</span>
                                <p>'.html_entity_decode($team['team_des']).'</p>
                                <div class="align-center">';
                                    foreach (social_media() as $key => $value) {
                                        if (isset($socialmedia[$key])) {
                                            echo '
                                            <a class="btn btn-xs btn-slide" target="_blank" href="'.$socialmedia[$key].'">
                                                <i class="fab fa-'.$value[1].'"></i>
                                                <span> '.$value[0].'</span>
                                            </a>';
                                        }
                                    }
                                    echo '
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                echo '
            </div>
        </div>
    </section>
    <!-- end: TEAM -->';
}
?>