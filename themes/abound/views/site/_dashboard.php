<div class="row-fluid">
    <div class="span12">
            
           
            <div class="span6">
                <div class="stat-block">
                    <?php $this->renderPartial('_dashboard2'); ?>  
                </div>
                
            </div>
            
            <div class="span3">
              <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h3>Morale Survey</h3>
                <?php echo CHtml::link('Submit one now',$this->createUrl('/library/moraleanswer'),array('class'=>'btn btn-success btn-medium'));?> 
              </div>

              
            </div>

             <div class="span3">
               <?php
               $learngrowthperspective = $this->renderPartial('learngrowthperspective',"",true);
               $customerperspective = $this->renderPartial('_customerperspective',"",true);

                $this->widget('zii.widgets.jui.CJuiAccordion', array(
                    'panels'=>array(
                        'Learning and Growth Perspective'=>$learngrowthperspective,
                        'Customer Perspective'=>$customerperspective,
                        'Next Upgrade'=>"Next Upgrade",
                       
                    ),
                    // additional javascript options for the accordion plugin
                    'options'=>array(
                        'class'=>'btn btn-success',
                        'animated'=>'bounceslide',
                        'heightStyle'=>"content",
                    ),
                ));
                ?>
            </div> 

    </div>
</div>