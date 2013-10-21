<?php

class Application_Form_Csv extends Zend_Form
{
    /*
     * Обработка данных CSV
     */
    public function parseData($csv_data_to_parse){
        if(($handle = fopen($csv_data_to_parse, "r")) !== false){
          while(($data = fgetcsv($handle, 2000, ",")) !== false){
            /*
             * Убираем первую строку с заголовком ($row > 1)
             */
            if($row >= 0){
                $csv_data[] = array($data[0], $data[1], $data[2], $data[3],
                                    $data[4], $data[5], $data[6], $data[7],
                                    $data[8], $data[9], $data[10],$data[11],
                                    $data[12],$data[13],$data[14],$data[15],
                                    $data[16],$data[17],$data[18],$data[19],
                                    $data[20],$data[21],$data[22],$data[23],
                                    $data[24],$data[25]
                                    );
            }
            $keys = array(
                            'timestamp',
                            'contractNumber',
                            'dateOfContract',
                            'lastNameCustomerTraining',
                            'nameOfTheCustomerTraining',
                            'patronymicOfTheCustomerTraining',
                            'theTotalAmountOfTheContractNumbers',
                            'theTotalContractAmountInWords',
                            'nameOfTheCourse',
                            'durationOfTrainingHours',
                            'numberOfMonths',
                            'passportSeriesNumberOfTheCustomer',
                            'INNClient',
                            'customerAddress',
                            'telHouseCustomer',
                            'telMobCustomer',
                            'emailCustomer',
                            'lastNameListener',
                            'nameListener',
                            'patronymicListener',
                            'passportSeriesNumberListener',
                            'INNListener',
                            'addressListener',
                            'telHouseListener',
                            'telMobListener',
                            'emailListener'
            );
            if($csv_data[$row] != null){
                $res_array = array_combine($keys, $csv_data[$row]);
                /*$student = new Application_Model_DbTable_Students();
                $student->addStudent($csv_data[$row]);*/
            }
            echo "<pre>";
            print_r($res_array);
            echo "</pre>";
            $row++;
          }

        fclose($handle);
        return $csv_data;
        }
    }

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	$this->setMethod('post');
    	$this->setAttrib('enctype', 'multipart/form-data');

        /*
         * Следующий код создает объект для файла ввода с помощью
         * Zend_Form_Element_File.
         */
    	$element = new Zend_Form_Element_File('csv');
    	$element->setLabel('Загрузка *.csv файла:')
                ->setRequired(true);
    	$element->addValidator('Count', false, 1);
    	$element->addValidator('Size', false, 102400);
    	// только *.csv расширение
    	$element->addValidator('Extension', false, 'csv');

    	// добавление элемента к форме
    	$this->addElements(array($element));

        /*
    	 * Submit button
    	 */
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Загрузить'
        ));
    }


}

