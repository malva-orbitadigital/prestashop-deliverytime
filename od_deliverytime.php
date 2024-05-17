<?php
if (!defined('_PS_VERSION_'))
   exit;

class DeliveryTime extends Module
{
   public function __construct()
   {
      $this->name = 'deliverytime';
      $this->tab = 'front_office_features'; // pestaña en la que se encuentra en el backoffice.
      $this->version = '1.0.0'; //versión del módulo
      $this->author = 'Malva Pérez'; // autor del módulo
      $this->need_instance = 0; //si no necesita cargar la clase en la página módulos,1 si fuese necesario.
      $this->ps_versions_compliancy = ['min' => '1.6', 'max' => _PS_VERSION_]; //las versiones con las que el módulo es compatible.

      parent::__construct();

      $this->displayName = $this->l('Tiempo de entrega');
      $this->description = $this->l('Calcula el tiempo de entrega de un producto y lo muestra en el FrontOffice.');
   }

   /**
    * This method handles the module's configuration page
    * @return string The page's HTML content 
    */
   public function getContent()
   {
      $output = '';

      if (Tools::isSubmit('submit' . $this->name)) {
         $configValue = (string) Tools::getValue('TESTMODULE_CONFIG');

         if (empty($configValue) || !Validate::isGenericName($configValue)) {
            $output = $this->displayError($this->l('Invalid Configuration value'));
         } else {
            Configuration::updateValue('TESTMODULE_CONFIG', $configValue);
            $output = $this->displayConfirmation($this->l('Settings updated'));
         }
      }

      return $output . $this->displayForm();
   }

   /**
    * Builds the configuration form
    * @return string HTML code
    */
   public function displayForm()
   {
      $form = [
         'form' => [
            'legend' => [
               'title' => $this->l('Settings'),
            ],
            'input' => [
               [
                  'type' => 'text',
                  'label' => $this->l('Configuration value'),
                  'name' => 'TESTMODULE_CONFIG',
                  'size' => 20,
                  'required' => true,
               ],
            ],
            'submit' => [
               'title' => $this->l('Save'),
               'class' => 'btn btn-default pull-right',
            ],
         ],
      ];

      $helper = new HelperForm();

      $helper->table = $this->table;
      $helper->name_controller = $this->name;
      $helper->token = Tools::getAdminTokenLite('AdminModules');
      $helper->currentIndex = AdminController::$currentIndex . '&' . http_build_query(['configure' => $this->name]);
      $helper->submit_action = 'submit' . $this->name;

      $helper->default_form_language = (int) Configuration::get('PS_LANG_DEFAULT');

      $helper->fields_value['TESTMODULE_CONFIG'] = Tools::getValue('TESTMODULE_CONFIG', Configuration::get('TESTMODULE_CONFIG'));

      return $helper->generateForm([$form]);
   }
}
