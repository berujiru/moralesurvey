<?php
class OICForm extends CFormModel {

        /**
        * According to CFormModel convention all public attributes will be treated as modelled one.
        */
        public $oic;
        //public $location;
        // public $itemsPerPage;
        // public $topMenu; // 1 - will be displayed, 0 - will not
        // public $footer; // 1 - will be displayed, 0 - will not
        
        private static $instance;
        
        public function getInstance(){
                Yii::trace('getInstance() request','org.maziarz.test');
                if (is_null(OICForm::$instance)) {
                        OICForm::$instance = new OICForm;
                        OICForm::$instance->load(); 
                        Yii::trace('New instance has been created', 'org.maziarz.test');
                }
                return OICForm::$instance;
        }
        
        public function rules(){
                return array(
                        array('oic', 'required'),
                        array('oic' , 'CNumberValidator'),
                        //array('location', 'length', 'max'=>200),
                );
        }

        public function attributeLabels(){
                return array(
                        'oic' => 'Today\'s OIC',
                        //'location' => 'Location',
                        // 'footer' => 'Display footer items',
                );
        }
        
        public function load(){
                $ini_array = parse_ini_file(Yii::getPathOfAlias('webroot')."/protected/data/settings.ini");
                $this->setAttributes($ini_array);       
        }
        
        public function save(){
                $configFile = Yii::getPathOfAlias('webroot')."/protected/data/settings.ini";
                file_put_contents($configFile, ";config.ini");
                foreach ($this->getAttributes() as $name=>$value) {
                        file_put_contents($configFile, "\n".$name." = ".$value, FILE_APPEND);
                }
                
        }

}