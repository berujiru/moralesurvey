<div class="row-fluid">
		<h1>Manage Libraries</h1>
		<div id="sidebar">
			<div class="portlet" id="yw2">
					<div class="portlet-decoration">
						<div class="portlet-title">
							Libraries
						</div>
					</div>
					<div class="portlet-content">
						<ul class="operations" id="yw3">
						<li><?php echo CHtml::link('Morale Survey',Yii::app()->createUrl("library/Moralesurvey/admin")); ?></li>
							<li><?php echo CHtml::link('Morale Questions',Yii::app()->createUrl("library/Moralequestions/admin")); ?></li>
							<li><?php echo CHtml::link('Morale Config',Yii::app()->createUrl("library/Moraleconfig")); ?></li>
		                    <li><?php echo CHtml::link('Divisions',Yii::app()->createUrl("library/ReferDivision/admin")); ?></li>
							
						</ul>
					</div>
			</div>
		</div>
</div>