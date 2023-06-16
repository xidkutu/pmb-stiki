<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class generator_model extends CI_Model
{
   public function getEnumFieldValues($db,$table,$field){
        if(!(empty($db))) $db=$db.'.'; 
        $text = "SHOW COLUMNS FROM $db$table WHERE FIELD='$field'";
        $res=$this->app_model->manualQuery($text);
        $result=$res->result_array();
        $hasil='';
        if (count($result)!=0){
            $hasil = $result[0]['Type'];   
        }
        return $hasil;
    }
   
   function getListOfTables(){
        $res=$this->db->query('SHOW TABLES');
        return $res;
   }
   
   public function getListOfColumnByTable($id){
        $res=$this->db->query("SELECT
            	*
            FROM
            	tb_app_rf_columns
            WHERE
            	Table_Name = '$id'
            ORDER BY
            	Ordinal_Position");
        return $res->result_array();
    }
    
    public function getListOfColumnByClass($id){
        $res=$this->db->query("SELECT
            	*
            FROM
            	tb_app_rf_columns
            WHERE
            	Class_Name = '$id'
            ORDER BY
            	Ordinal_Position");
        return $res->result_array();
    }
    
    public function getListOfColumnByFormId($id){
        $res=$this->db->query("SELECT
            	*
            FROM
            	tb_app_rf_columns
            WHERE
            	Form_Id = '$id'
            ORDER BY
            	Ordinal_Position");
        return $res->result_array();
    }
   
   public function getListOfDetTableByTable($id){
        $res=$this->db->query("SELECT
            	*
            FROM
            	tb_app_rf_columns_detail
            WHERE
            	Table_Name = '$id'
            ORDER BY
            	Ordinal_Position");
        return $res;
    }
    
    public function getListOfDetTableByClass($id){
        $res=$this->db->query("SELECT
            	*
            FROM
            	tb_app_rf_columns_detail
            WHERE
            	Class_Name = '$id'
            ORDER BY
            	Ordinal_Position");
        return $res;
    }
    
    public function getListOfDetTableByFormId($id){
        $res=$this->db->query("SELECT
            	*
            FROM
            	tb_app_rf_columns_detail
            WHERE
            	Form_Id = '$id'
            ORDER BY
            	Ordinal_Position");
        return $res;
    }
    
    public function getListOfColFormAndDetTableByFormId($id){
        $res=$this->db->query("SELECT DISTINCT(Column_Name) FROM
                ((SELECT
                	Column_Name
                FROM
                	tb_app_rf_columns_detail
                WHERE
                	Form_Id = '$id'
                ORDER BY
                	Ordinal_Position)
                UNION
                (SELECT
                	Column_Name
                FROM
                	tb_app_rf_columns
                WHERE
                	Form_Id = '$id'
                ORDER BY
                	Ordinal_Position)) a");
        return $res;
    }
    
    public function getListOfColFormAndDetTableByClass($id){
        $res=$this->db->query("SELECT DISTINCT(Column_Name) FROM
                ((SELECT
                	Column_Name
                FROM
                	tb_app_rf_columns_detail
                WHERE
                	Class_Name = '$id'
                ORDER BY
                	Ordinal_Position)
                UNION
                (SELECT
                	Column_Name
                FROM
                	tb_app_rf_columns
                WHERE
                	Class_Name = '$id'
                ORDER BY
                	Ordinal_Position)) a");
        return $res;
    }
    
    public function isHasIsActive($tableSchema,$tableName){
        $res=$this->db->query("SELECT
                TABLE_SCHEMA
            FROM
            	information_schema.`COLUMNS`
            WHERE
            	TABLE_SCHEMA = '$tableSchema'
            AND TABLE_NAME = '$tableName'
            AND COLUMN_NAME = 'isAktif'");
        if($res->num_rows()>0) return true; else return false;
    }
    
    public function getListOfReferecedValue($tableSchema,$tableName,$columnName,$displayColumn){
        if($displayColumn=='') $displayColumn=$columnName;
        if($this->isHasIsActive($tableSchema,$tableName)) $isaktif="WHERE isAktif='YES'"; else $isaktif="";
        $res=$this->db->query("SELECT
            	$columnName AS val,
            	$displayColumn AS dis
            FROM
            	$tableSchema.$tableName
            $isaktif
            ORDER BY $displayColumn");
        return $res;
    }
   
   function generateFormInput($param){
        $database=$this->db->database;
        $res=$this->db->query("INSERT INTO `tb_app_rf_columns` (
            	`App_Id`,
            	`Class_Name`,
            	`Form_Id`,
            	`Table_Schema`,
            	`Table_Name`,
            	`Column_Name`,
            	`Column_Caption`,
            	`Ordinal_Position`,
            	`Default_Value`,
            	`Is_Nullable`,
            	`Data_Type`,
            	`Character_Maximum_Lenght`,
            	`Column_Key`,
            	`Referenced_Table_Schema`,
            	`Referenced_Table_Name`,
            	`Referenced_Column_Name`
            ) (
            SELECT
            	'".$param['inForm_app']."',
            	'".$param['inForm_className']."',
            	'".$param['inForm_id']."',
            	col.TABLE_SCHEMA,
            	col.TABLE_NAME,
            	col.COLUMN_NAME,
            	REPLACE(IFNULL(usg.REFERENCED_COLUMN_NAME,col.COLUMN_NAME), '_', ' ') AS Column_Caption,
            	col.ORDINAL_POSITION,
            	col.COLUMN_DEFAULT,
            	col.IS_NULLABLE,
            	col.DATA_TYPE,
            	col.CHARACTER_MAXIMUM_LENGTH,
            	col.COLUMN_KEY,
            	usg.REFERENCED_TABLE_SCHEMA,
            	usg.REFERENCED_TABLE_NAME,
            	usg.REFERENCED_COLUMN_NAME
            FROM
            	information_schema.`COLUMNS` col
            LEFT JOIN (
            	SELECT
            		*
            	FROM
            		information_schema.KEY_COLUMN_USAGE
            	WHERE
            		TABLE_SCHEMA = '$database'
            	AND TABLE_NAME = '".$param['inForm_tableName']."'
            ) usg ON col.TABLE_SCHEMA = usg.TABLE_SCHEMA
            AND col.TABLE_NAME = usg.TABLE_NAME
            AND col.COLUMN_NAME = usg.COLUMN_NAME
            WHERE
            	col.TABLE_SCHEMA = '$database'
            AND col.TABLE_NAME = '".$param['inForm_tableName']."'
            )");
        return $res;
   }
   
   function setViewDetailFormInput($idForm){
        $res=$this->db->query("
            CREATE OR REPLACE VIEW `vshield_appCrt_detailformcolumns_for_".$this->session->userdata('username')."` AS
            SELECT
                ID,
                Form_Id,
            	Column_Name,
            	Column_Caption,
            	Ordinal_Position,
            	Default_Value,
            	Is_Nullable,
            	Data_Type,
            	Character_Maximum_Lenght,
                Referenced_Table_Name,
                Referenced_Column_Name,
            	'action' AS action
            FROM
            	tb_app_rf_columns
            WHERE
            	Form_Id='$idForm'
            ORDER BY Ordinal_Position ASC");
        return $res;
   }
   
   function getDetailOfColumn($param){
        $res=$this->db->query("
           SELECT * FROM tb_app_rf_columns WHERE Column_Name='".$param['columnName']."' AND ID='".$param['ID']."'");
        $res=$res->row_object();
        return $res;
   }
   
   function saveChangeDetailColumn($param){
        if($param['saveas']=='baru'){
            unset($param['saveas']);
            $res=$this->db->insert('tb_app_rf_columns',$param);
        }else{
            unset($param['saveas']);
            $res=$this->db->update('tb_app_rf_columns',$param,array('ID'=>$param['ID']));
        }
        
        return $res;
   }
   
   function getListOfTableByDatabase($database){
        $res=$this->db->query("SELECT TABLE_NAME FROM information_schema.`TABLES` WHERE TABLE_SCHEMA='$database'");
        return $res;
   }
   
   function getListOfColumnsByTable($param){
        $res=$this->db->query("SELECT COLUMN_NAME FROM information_schema.`COLUMNS` WHERE TABLE_SCHEMA='".$param['Table_Schema']."' AND TABLE_NAME='".$param['Table_Name']."'");
        return $res;
   }
   
   function getListOfUpperCaseColumnByTable($param){
        $res=$this->db->query("SELECT Column_Name FROM tb_app_rf_columns WHERE Table_Schema='".$param['Table_Schema']."' AND Table_Name='".$param['Table_Name']."' AND Column_Style LIKE '%uppercase%'");
        return $res->result_array();
   }
   
   function getInfoOfForm($formId){
        $res=$this->db->query("SELECT DISTINCT(App_Id),Class_Name,Form_Id,Table_Schema,Table_Name FROM tb_app_rf_columns WHERE Form_Id='$formId'");
        return $res->row_array();
   }
   
   function getDefaultValueByFormId($formId){
        $res=$this->db->query("SELECT
                	Column_Name,Default_Value
                FROM
                	tb_app_rf_columns
                WHERE
                	Form_Id = 'form_generator'
                AND Default_Value IS NOT NULL
                AND Default_Value <> '$formId'");
        return $res;
   }
   
   function getDefaultValueByTable($param){
        $res=$this->db->query("SELECT
                	Column_Name,Default_Value
                FROM
                	tb_app_rf_columns
                WHERE
                	Table_Name = '$param'
                AND Default_Value IS NOT NULL
                AND Default_Value <> ''");
        return $res;
   }
   
   function getColumnsNameByTableAndType($table,$type){
        $res=$this->db->query("SELECT Column_Name FROM tb_app_rf_columns WHERE Table_Name='$table' AND Data_Type='$type'");
        return $res;
   }
   
   function getDateColumnsByTable($table){
        $res=$this->getColumnsNameByTableAndType($table,'date');
        return $res;
   }
}