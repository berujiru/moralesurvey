<div class="row-fluid">
    <div class="span12 row">
        <div class="span6">
            <div class="form" style="height:150px;">
                    <?php echo CHtml::beginForm();?>
                    <?php echo  CHtml::radioButtonList('radio_time','radio_time',array('inAM'=>'AM in','outAm'=>'AM out','inPM'=>'PM in','outPM'=>'PM out','inOT'=>'OT in','outOT'=>'OT out'),array('separator'=>' || ', 'labelOptions'=>array('style'=>'display:inline;font-size:15pt'))); ?>
                    
                    <?php echo CHtml::textField('emp_code',"",array('autofocus'=>"autofocus")); ?>
                     <?php $img = CHtml::image(Yii::app()->theme->baseUrl."/img/icons/smashing/30px-41.png", 'DORE'); ?>
                    <?php
                    echo CHtml::ajaxSubmitButton(
                        "Submit",
                        Yii::app()->createUrl('/site/getProfile'),
                        array(
                            'update'=>'#show',
                            'complete'=>'js:function(data){
                                    $("#emp_code").val("");

                   }',
                        ),
                        array(
                            'class'=>'btn btn-default',
                            'id'=>'forattendance',
                        )
                    );
                    ?>
                     <?php echo CHtml::endForm(); ?>
                </div><!-- form -->

                <?php
                        $this->beginWidget('zii.widgets.CPortlet', array(
                            'title'=>"<i class='icon-bell'></i><strong>Please Scan your ID</strong>
                            <strong style='color:yellow;'> (If not you, contact admin)</strong>",
                        ));?>
                 
                    <h1><font family="Broadway">
                        <div id="show" class="text-center">
                        </div>
                    </font></h1>   
                <?php $this->endWidget();?>
        </div>
        <div class="span6">
            <div class="row-fluid">
                 <div class="box">
                    <div class="box-header well" data-original-title>
                        <h2>
                            <i class="icon-list-alt"></i> Philippine Standard Time
                        </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-minimize btn-round"><i
                                class="icon-chevron-up"></i> </a> <a href="#"
                                class="btn btn-close btn-round"><i class="icon-remove"></i> </a>
                        </div>
                         <p class="clearfix">
                            <div id="server-time"></div>
                        </p>
                    </div>
                    <div class="box-content">
                        
                       
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <h3 class="hero-unit">
                    <i><b>Don’t use foul or abusive language. Let everything you say be good and helpful, so that your words will be an encouragement to those who hear them. </b></i>
                    <small>-Ephesians 4:29 NLT</small>
                </h3>
            </div>
        </div>
    </div>
</div>

<script>
    radiobtn = document.getElementById("radio_time_0");
    radiobtn.checked = true;

    var currenttime = '<?php print date("F d, Y H:i:s", time())?>' //PHP method of getting server date
        ///////////Stop editting here/////////////////////////////////
        
        var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
        var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
        var serverdate=new Date(currenttime)
        
        function padlength(what){
        var output=(what.toString().length==1)? "0"+what : what
        return output
        }
        
        function twelvehour(hh){
            var h = hh;
            if (h >= 12) {
                h = hh-12
            }
            if (h == 0) {
                h = 12;
            }
            return padlength(h)
        }
        
        function am_pm(hh){
            var h = hh;
            var dd= 'AM';
            if (h >= 12) {
                dd = "PM";
            }
            return dd;
        }
        
        function displaytime(){
        serverdate.setSeconds(serverdate.getSeconds()+1)
        var datestring=dayNames[serverdate.getDay()]+" "+padlength(serverdate.getDate())+" "+montharray[serverdate.getMonth()]+" "+serverdate.getFullYear()
        var timestring="<li>"+twelvehour(serverdate.getHours())+"</li><li>:</li><li>"+padlength(serverdate.getMinutes())+"</li><li>:</li><li>"+padlength(serverdate.getSeconds())+"</li><span class='dd'>"+am_pm(serverdate.getHours())+"</span>"
        document.getElementById("server-time").innerHTML='<div class="clock"><div id="Date">'+datestring+'</div>'+'<ul>'+timestring+'</ul></div>'
        }
        
setInterval("displaytime()", 1000)      

</script>
