<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          <a class="brand" href="#"><img width="25px" height="25px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logoDOST.png"/><?php echo CHtml::encode(' HRMIS'); ?><small></small></a>
          <?php if(!Yii::app()->user->isGuest) { ?>
         <div class="nav-collapse">
      <?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
          'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'Dashboard', 'url'=>array('/site/index/'),'active'=>$this->id=='site'?true:false),
                       // array('label'=>'Graphs & Charts', 'url'=>array('/site/page', 'view'=>'graphs')),
                        //array('label'=>'Forms', 'url'=>array('/site/page', 'view'=>'forms')),
                       // array('label'=>'Tables', 'url'=>array('/site/page', 'view'=>'tables')),
                        //array('label'=>'Interface', 'url'=>array('/site/page', 'view'=>'interface')),
                        //array('label'=>'Typography', 'url'=>array('/site/page', 'view'=>'typography')),
                        /*array('label'=>'Gii generated', 'url'=>array('customer/index')),*/
                         // array('label'=>'<i class="icon icon-folder"></i>  Attendance', 'url'=>Yii::app()->createUrl("dtr/dtr"),'active'=>$this->id=='dtr'?true:false),
                         // array('label'=>'<i class="icon icon-folder"></i>  Request', 'url'=>Yii::app()->createUrl("request"),'active'=>$this->uniqueid=='request/default'?true:false),
                         // array('label'=>'<i class="icon icon-folder"></i>  Notification', 'url'=>Yii::app()->createUrl("notification"),'visible'=>Yii::app()->user->checkAccess('Notification.Default.Index'),'active'=>$this->uniqueid=='notification/default'?true:false),

                         // array('label'=>'Requests<span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-2"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                         //  'items'=>array(
                              
                         //    array('label'=>'<i class="icon icon-arrow-up"></i>  Send Request', 'url'=>Yii::app()->createUrl("request"),'active'=>$this->uniqueid=='request/default'?true:false),
                         //    //array('label'=>'<i class="icon icon-th-list"></i>  Manage Sent Request', 'url'=>Yii::app()->createUrl("notification"),'visible'=>Yii::app()->user->checkAccess('Notification.Default.Index'),'active'=>$this->uniqueid=='notification/default'?true:false),
                         //  )),
                         
                         array(
                          'label'=>Yii::app()->getModule("user")->user()->profile->firstname.' '.Yii::app()->getModule("user")->user()->profile->lastname.'<span class="caret"></span>', 
                          'url'=>'#',
                          'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),
                          'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                          'items'=>array(
                              //array('label'=>'My Messages <span class="badge badge-warning pull-right">26</span>', 'url'=>'#'),
                              //array('label'=>'My Tasks <span class="badge badge-important pull-right">112</span>', 'url'=>'#'),
                              //array('label'=>'My Invoices <span class="badge badge-info pull-right">12</span>', 'url'=>'#'),
                              //array('label'=>'Separated link', 'url'=>'#'),
                              array('label'=>'<i class="icon icon-user"></i>  My Profile', 'url'=>Yii::app()->createUrl("user/profile")),
                              // array('label'=>'<i class="icon icon-envelope"></i>  201 Profile', 'url'=>Yii::app()->createUrl("employee/profile/view"),'active'=>$this->id=='profile'?true:false),
                              // array('label'=>'<i class="icon icon-user"></i>  Manage employees', 'url'=>Yii::app()->createUrl("user/admin")),
                              array('label'=>'<i class="icon icon-th-list"></i> Manage Library', 'url'=>Yii::app()->createUrl("library"),'visible'=>Yii::app()->user->checkAccess('Notification.Default.Index'),'active'=>$this->uniqueid=='library/default'?true:false),
                              // array('label'=>'<i class="icon icon-th-list"></i> Post Morale Survey', 'url'=>Yii::app()->createUrl("employee/moralesurvey"),'visible'=>Yii::app()->user->checkAccess('Notification.Default.Index'),'active'=>$this->uniqueid=='employee/moralesurvey'?true:false),
                              // array('label'=>'<i class="icon icon-wrench"></i>  Settings', 'url'=>Yii::app()->createUrl("site/settings")),
                             // array('label'=>'Change User ('.Yii::app()->user->name.')', 'url'=>array('/site/login'), 'visible'=>!Yii::app()->user->isGuest),
                              array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                          )),
                        //array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        
                    ),
                )); ?>
      </div>
      <?php }
      else{ ?>


          <div class="nav-collapse">
      <?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
          'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'Dashboard', 'url'=>array('/site/index')),
                       // array('label'=>'Graphs & Charts', 'url'=>array('/site/page', 'view'=>'graphs')),
                        //array('label'=>'Forms', 'url'=>array('/site/page', 'view'=>'forms')),
                       // array('label'=>'Tables', 'url'=>array('/site/page', 'view'=>'tables')),
            //array('label'=>'Interface', 'url'=>array('/site/page', 'view'=>'interface')),
                        //array('label'=>'Typography', 'url'=>array('/site/page', 'view'=>'typography')),
                        /*array('label'=>'Gii generated', 'url'=>array('customer/index')),*/
                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),         
                    ),
                )); ?>
      </div>



        <?php } ?>
    </div>
  </div>
</div>

<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        
          <div class="style-switcher pull-left">
            <strong>Human Resource Management Information System</strong>
                <!--<a href="javascript:chooseStyle('none', 60)" checked="checked"><span class="style" style="background-color:#0088CC;"></span></a>
                <a href="javascript:chooseStyle('style2', 60)"><span class="style" style="background-color:#7c5706;"></span></a>
                <a href="javascript:chooseStyle('style3', 60)"><span class="style" style="background-color:#468847;"></span></a>
                <a href="javascript:chooseStyle('style4', 60)"><span class="style" style="background-color:#4e4e4e;"></span></a>
                <a href="javascript:chooseStyle('style5', 60)"><span class="style" style="background-color:#d85515;"></span></a>
                <a href="javascript:chooseStyle('style6', 60)"><span class="style" style="background-color:#a00a69;"></span></a>
                <a href="javascript:chooseStyle('style7', 60)"><span class="style" style="background-color:#a30c22;"></span></a>-->
          </div>
          <?php if(!Yii::app()->user->isGuest) { ?>
         <form class="navbar-search pull-right" action="">
           
         <input type="text" class="search-query span2" placeholder="Search">
         <?php } ?>
         </form>
      </div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->