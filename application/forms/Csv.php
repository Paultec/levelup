<?php

class Application_Form_Csv extends Zend_Form
{
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
                                    $data[24],$data[25], 1, 1
                                    );
            }
            // Ключи, соответствующие именоам колонок в базе
            $keys = array(
                            'timestamp',
                            'numberContract',
                            'dateContract',
                            'lastNameCustomer',
                            'nameCustomer',
                            'patronymicCustomer',
                            'totalSumContractNum',
                            'totalSumContractA',
                            'nameCourse',
                            'durationHours',
                            'numberMonths',
                            'passportCustomer',
                            'INNCustomer',
                            'addressCustomer',
                            'telHouseCustomer',
                            'telMobCustomer',
                            'emailCustomer',
                            'lastNameStudent',
                            'nameStudent',
                            'patronymicStudent',
                            'passportStudent',
                            'INNStudent',
                            'addressStudent',
                            'telHouseStudent',
                            'telMobStudent',
                            'emailStudent',
                            'idStatus',
                            'idGroup'
            );
            if($csv_data[$row] != null){
                $res_array[] = array_combine($keys, $csv_data[$row]);                
            }            
            $row++;
          }

        fclose($handle); 
        // Возвращаемые значения 1 - для вставки в таблиу, 2 - для вставки в базу
        $result = array($res_array, $csv_data);
        return $result;        
        }
    }
}