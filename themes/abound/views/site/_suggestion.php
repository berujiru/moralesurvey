 <?php
 $this->beginWidget('zii.widgets.CPortlet', array(
                        'title'=>"<i class='icon-star'></i><strong>Help improve the HRMIS</strong>",
                    )
                    ,array('class'=>'portletbold'));
                    
?>

<div class="row-fluid">
   
    <div class=''>
         <div class="span2"></div>
          <div class="span8 ">
            <?php
                foreach(Yii::app()->user->getFlashes() as $key => $message) {
                        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
                }
            ?>
            
            <br/>
           
            <?php 
                echo CHtml::link('Drop your suggestion/s here',$this->createUrl('/suggestion/create'),array('class'=>'btn btn-warning btn-xlarge text-center'));
            ?>
        </div>
         <div class="span2"></div>
    </div>
    
</div>
<?php $this->endWidget();?> 