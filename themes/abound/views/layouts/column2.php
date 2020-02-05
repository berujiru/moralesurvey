<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

  <div class="row-fluid">
	<div class="span3">
		<div class="sidebar-nav">
        
		  <?php 
          $this->widget('zii.widgets.CMenu', array(
            // 'type'=>'list',
            'encodeLabel'=>false,
            'items'=>array(
               
                // array('label'=>'<i class="icon icon-folder"></i>  Profile', 'url'=>Yii::app()->createUrl("employee/profile/view")),
                // array('label'=>'<i class="icon icon-folder"></i>  Attendance', 'url'=>Yii::app()->createUrl("dtr/dtr")),
                // array('label'=>'<i class="icon icon-folder"></i>  Request', 'url'=>Yii::app()->createUrl("request")),
                // array('label'=>'<i class="icon icon-folder"></i>  Notification', 'url'=>Yii::app()->createUrl("notification"),'visible'=>Yii::app()->user->checkAccess('Notification.Default.Index')),
                // array('label'=>'<i class="icon icon-folder"></i>  Library', 'url'=>Yii::app()->createUrl("library"),'visible'=>Yii::app()->user->checkAccess('Notification.Default.Index')),
                // Include the operations menu
                array('label'=>'OPERATIONS','items'=>$this->menu),
            ),
            ));
            ?>
		</div>
  
		
    </div><!--/span-->
    <div class="span9">
    
    <?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
			'homeLink'=>CHtml::link('Dashboard'),
			'htmlOptions'=>array('class'=>'breadcrumb')
        )); ?><!-- breadcrumbs -->
    <?php endif?>
    
    <!-- Include content pages -->
    <?php echo $content; ?>

	</div><!--/span-->
  </div><!--/row-->


<?php $this->endContent(); ?>