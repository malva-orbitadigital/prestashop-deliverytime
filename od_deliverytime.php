<?php
if (!defined('_PS_VERSION_'))
   exit;

require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/repository/HolidaysRepository.php');
require_once(_PS_MODULE_DIR_ . 'od_deliverytime/src/repository/TimesRepository.php');
class Od_deliverytime extends Module 
{

   private $holidaysRepo;
   private $timesRepo;


   public function __construct()
   {
      $this->name = 'od_deliverytime';
      $this->tab = 'front_office_features';
      $this->version = '1.0.0';
      $this->author = 'Malva Pérez';
      $this->need_instance = 0;
      $this->ps_versions_compliancy = ['min' => '1.6', 'max' => _PS_VERSION_];
      $this->bootstrap = true;

      parent::__construct();

      $this->displayName = $this->l('Tiempo de entrega');
      $this->description = $this->l('Calcula el tiempo de entrega de un producto y lo muestra en el FrontOffice.');

      $this->holidaysRepo = new HolidaysRepository();
      $this->timesRepo = new TimesRepository();
   }

   public function install()
   {
      return $this->createTables()
         && parent::install();
   }

   public function uninstall()
   {
      return $this->deleteTables()
         && parent::uninstall();
   }

   protected function createTables()
   {
      return $this->holidaysRepo->createTable()
         && $this->timesRepo->createTable();
   }

   protected function deleteTables()
   {
      return $this->holidaysRepo->deleteTable()
         && $this->timesRepo->deleteTable();
   }


   protected function getHolidaysFormValues()
   {
      return array(
         'date' => pSQL(Tools::getValue('HOLIDAY_DATE')),
         'name' => pSQL(Tools::getValue('HOLIDAY_NAME'))
      );
   }

   /**
    * This method handles the module's configuration page
    * @return string The page's HTML content 
    */
   public function getContent()
   {
      $output = '';

      $invalid = '';
      if (Tools::isSubmit('submit' . $this->name)) {
         if (!$this->holidaysRepo->insert($this->getHolidaysFormValues())){
            $invalid = 'No se ha podido añadir la festividad';
         }

         if ($invalid === '') {
            $output = $this->displayConfirmation($this->l('Configuración actualizada'));
         } else {
            $output .= $this->displayError($this->l($invalid));
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
               'title' => $this->l('Configuración'),
            ],
            'input' => [
               [
                  'type' => 'date',
                  'label' => $this->l('Fecha'),
                  'name' => 'HOLIDAY_DATE',
                  'tab' => 'holidays',
                  'required' => true,
               ], [
                  'type' => 'text',
                  'label' => $this->l('Festividad'),
                  'name' => 'HOLIDAY_NAME',
                  'tab' => 'holidays',
                  'required' => true,
               ]
            ],
            'submit' => [
               'title' => $this->l('Guardar'),
               'class' => 'btn btn-default pull-right',
               'tab' => 'times',
            ]
         ],
      ];

      $helper = new HelperForm();

      $helper->table = $this->table;
      $helper->name_controller = $this->name;
      $helper->token = Tools::getAdminTokenLite('AdminModules');
      $helper->currentIndex = AdminController::$currentIndex . '&' . http_build_query(['configure' => $this->name]);
      $helper->submit_action = 'submit' . $this->name;

      $helper->default_form_language = (int) Configuration::get('PS_LANG_DEFAULT');

      return $helper->generateForm([$form]);
   }
}
