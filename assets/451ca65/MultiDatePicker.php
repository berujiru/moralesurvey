<?php
 
/**
 * MyCurrentClassName class file.
 * This is description of MyCurrentClassName for developer to use it further !
 * PHP Version 5.1
 * @package  Widget
 * @author   Bergel cutara <Skype: Berujiru>
 * @copyright Copyright &copy; Fazal Burhan 2014-
 */
class MultiDatePicker extends CWidget {
 
    /**
     * @var string the hello  .
     */
    public $hello = 'Hello World';
    public $cssFile;  // it better to have private attribute for security then you have to define getter and setter methods
    public $path;
    public $elementid='';
 
    // initialized all the variable and scripts used
 
    public function init() {
 
        // get & publish assets
        $this->path = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.multidatepicker', -1, false));

        $cs = Yii::app()->clientScript;
        //$cs->registerCssFile($this->path . '/assets/jquery-ui.css');
        $cs->registerCssFile($this->path . '/assets/jquery-ui.structure.css');
        $cs->registerCssFile($this->path . '/assets/jquery-ui.theme.css');
        //$cs->registerCssFile($this->path . '/assets/mdp.css');
        $cs->registerCssFile($this->path . '/assets/pepper-ginder-custom.css');
        $cs->registerCssFile($this->path . '/assets/prettify.css');

        // $cs->registerScriptFile($this->path .'/assets/jquery-1.11.1.js', CClientScript::POS_END);
        // $cs->registerScriptFile($this->path .'/assets/jquery-2.1.1.js', CClientScript::POS_END);
        $cs->registerScriptFile($this->path .'/assets/jquery-ui-1.11.1.js');
        // $cs->registerScriptFile($this->path .'/assets/lang-css.js', CClientScript::POS_END);
        // $cs->registerScriptFile($this->path .'/assets/prettify.js', CClientScript::POS_END);
        $cs->registerScriptFile($this->path .'/jquery-ui.multidatespicker.js');
        $cs->registerScriptFile($this->path .'/assets/loadmdp.js');



    }
 
    /**
     * Run this widget.
     * renders the needed HTML code.
     */
    public function run() {
        // <div id="simpliest-usage" class="box"></div><script>$("#simpliest-usage").multiDatesPicker({});</script>

        //just include in a page and you can use the multidatespicker  using the code above
    }
 
}
?>