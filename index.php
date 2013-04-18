<?php
  
  $tag="beatasthma";
  $accessToken = "put here your instagra access token";
	
	$url = "https://api.instagram.com/v1/tags/{$tag}/media/recent?access_token={$accessToken}";
	$media = json_decode(file_get_contents($url));
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Asthmagram</title>
  <meta name="Jordan Cauley" content="">
  <!--
    Instagram PHP API class @ Github
    https://github.com/cosenary/Instagram-PHP-API
  -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" media="screen">
  <link rel="stylesheet" href="assets/css/bootstrap-responsive.min.css" type="text/css" media="screen">
  <link rel="stylesheet" href="assets/css/app.css" type="text/css" media="screen">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/app.js"></script>
</head>
<body>
 <header id="banner" class="navbar navbar-static-top " role="banner">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
      <img src="/assets/img/menu.png" alt="Menu"/>
      </a>
      <a class="brand" href="http://www.cauley.co/">
        Asthmagram  
      </a>
    <nav id="nav-main" class="nav-collapse pull-right" role="navigation">
          
              </nav>
    </div>
  </div>
</header>

   <div class="container">
    <div class="row">
	<?php //die(var_dump($media)); ?>
    <?php foreach ($media->data as $data): ?> 
      <div class="span4 box">
        <div class="padding">
        <a href="#<?php echo $data->id; ?>" role="button" data-toggle="modal"><img class="main-img" src="<?php echo $data->images->standard_resolution->url; ?>"></a>
          <div class="meta-profile">
            <a href="http://instagram.com/<?php echo $data->user->username; ?>"><img src="<?php echo $data->user->profile_picture; ?>"></a>
            <span class="instameta pull-right">
              <?php echo date('M d, Y h:i', $data->created_time); ?> 
              <?php echo $data->likes->count; ?> <i class="icon-heart"></i> 
              <?php echo $data->comments->count; ?> <i class="icon-comment"></i>
            </span>
          </div>
          </div>
      </div>

        <!-- Modal -->
        <div id="<?php echo $data->id; ?>" class="modal hide fade bigModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <div class="modal-body">
                  <div class="span5">
                    <a href="<?php echo $data->link; ?>" target="_blank"><img class="main-img" src="<?php echo $data->images->standard_resolution->url; ?>"></a>
                      <?php echo $data->caption->text; ?>
                  </div>

            <div class="span3">
            <div class="modal-profile">
            <a href="http://instagram.com/<?php echo $data->user->username; ?>"><img src="<?php echo $data->user->profile_picture; ?>"></a> <?php echo $data->user->username; ?>
            </div>
            <?php if ($data->tags > 0): ?>
                    <table class="table">
                      <tbody>
                        <tr>
                          <td><i class="icon-tag"></i></td>
                          <td>
              <?php foreach ($data->tags as $t): ?>
                #<?php echo $t; ?>
              <?php endforeach; ?>
                          </td>
                        </tr>
                      </tbody>
                     </table>
            <?php endif; ?>
            <?php if ($data->likes > 0): ?>
                    <table class="table">
                      <tbody>
                        <tr>
                          <td><i class="icon-heart"></i></td>
                          <td><?php echo $data->likes->count; ?> Likes<br>
              <?php foreach ($data->likes->data as $l): ?>
                <?php echo $l->username; ?>
              <?php endforeach; ?>
                          </td>
                        </tr>
                      </tbody>
                     </table>
            <?php endif; ?>

      <?php if ($data->comments->count > 0): ?>
     <i class="icon-comment"></i> <?php echo $data->comments->count; ?> Comments
        <?php foreach ($data->comments->data as $c): ?>
        <div class="row comments">
            <div class="span3">
              <img class="" src="<?php echo $c->from->profile_picture; ?>">
              <?php echo $c->from->username; ?>
              <span class="pull-right"><?php echo date('d M Y h:i:s', $c->created_time); ?></span>
            </div>
            <div class="span3">
                <p class="comment-entry"><?php echo $c->text; ?></p>
              </div>
              </div>
              
            <?php endforeach; ?>
          
        <?php else: ?>
        
            Aww Sad face no one left a comment but you can by visiting this page at <a href="<?php echo $data->link; ?>" target="_blank">Instagram.com</a>
          
          <?php endif; ?>
              </div>
            </div>
        </div>


     <?php endforeach; ?>
  </div>
</div>
 <div class="greedy-btn">
  <div class="btn btn-primary" id="more" data-maxid="<?php echo $media->pagination->next_max_id; ?>" data-tag="<?php echo $tag; ?>">Load more ...</div>
 </div>
 
</body>
</html>