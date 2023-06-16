<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function genFormInputByTable($tableName){    
    $model = get_instance();
    $model->load->model('generator_model');
    $columns=$model->generator_model->getListOfColumnByTable($tableName);
    $columnsDet=$model->generator_model->getListOfDetTableByTable($tableName);
    if(count($columns)>0) return getForm($columns,$columnsDet,array());
    else return getNullForm();
}

function genFormInputByClass($className){    
    $model = get_instance();
    $model->load->model('generator_model');
    $columns=$model->generator_model->getListOfColumnByClass($className);
    $columnsDet=$model->generator_model->getListOfDetTableByClass($className);
    if(count($columns)>0) return getForm($columns,$columnsDet,array());
    else return getNullForm();
}

function genFormInputByClassWithProperty($className,$prop){    
    $model = get_instance();
    $model->load->model('generator_model');
    $columns=$model->generator_model->getListOfColumnByClass($className);
    $columnsDet=$model->generator_model->getListOfDetTableByClass($className);
    if(count($columns)>0) return getForm($columns,$columnsDet,$prop);
    else return getNullForm();
}
function genDetailByClass($className){    
    $model = get_instance();
    $model->load->model('generator_model');
    $columnsDet=$model->generator_model->getListOfDetTableByClass($className);
    if(count($columnsDet)>0) return genDetTable($columnsDet);
    else return '';
}
function genDetailByClassWithProperty($className,$prop){    
    $model = get_instance();
    $model->load->model('generator_model');
    $columnsDet=$model->generator_model->getListOfDetTableByClass($className);
    if(count($columnsDet)>0) return genDetTableTab($columnsDet,$prop);
    else return '';
}
function getDetailColByClass($className){
    $model = get_instance();
    $model->load->model('generator_model');
    $columns=$model->generator_model->getListOfDetTableByClass($className);
    $cols=array();
    foreach($columns->result_array() as $i=>$c){
        $cols[$i]=$c['Column_Name'];    
    }
    return $cols;
}
function getJsIncludeFormByClass($className){
    $model = get_instance();
    $model->load->model('generator_model');
    $columns=$model->generator_model->getListOfColumnByClass($className);
    $res=genIncludeJs($columns);
    
    return $res;
}
function getListColFormAndDetByClass($className){
    $model = get_instance();
    $model->load->model('generator_model');
    $columns=$model->generator_model->getListOfColFormAndDetTableByClass($className);
    
    $cols=array();
    foreach($columns->result_array() as $i=>$c){
        $cols[$i]=$c['Column_Name'];    
    }
    return $cols;
}
function genFormInputByFormId($formId){    
    $model = get_instance();
    $model->load->model('generator_model');
    $columns=$model->generator_model->getListOfColumnByFormId($formId);
    $columnsDet=$model->generator_model->getListOfDetTableByFormId($formId);
    if(count($columns)>0) return getForm($columns,$columnsDet,array());
    else return getNullForm();
}
function getDetailColByFormId($Form_Id){
    $model = get_instance();
    $model->load->model('generator_model');
    $columns=$model->generator_model->getListOfDetTableByFormId($formId);
    $cols=array();
    foreach($columns as $i=>$c){
        $cols[$i]=$c['Column_Name'];    
    }
    return $cols;
}
function getListColFormAndDetByFormId($Form_Id){
    $model = get_instance();
    $model->load->model('generator_model');
    $columns=$model->generator_model->getListOfColFormAndDetTableByFormId($formId);
    $cols=array();
    foreach($columns as $i=>$c){
        $cols[$i]=$c['Column_Name'];    
    }
    return $cols;
}
function getForm($columns,$columnsDet,$prop){
    $col=$columns[0];
    $formId=$col['Form_Id'];
        
    $res['Form_Id']=$formId;
    if(isset($prop['tab']))$res['form']=getFormInputTab($formId,$columns,$prop);
    else $res['form']=getFormInput($formId,$columns,$prop);
    $res['initJs']=genInitComponent($columns);
    $res['setDefaultValue']=genJsDefaultValue($columns);
    $res['jsInclude']=genIncludeJs($columns);
    $res['cssInclude']=genIncludeCss($columns);
    $res['detTable']=genDetTable($columnsDet);
    
    return $res;
}

function getNullForm(){
    $res['Form_Id']=null;
    $res['form']=null;
    $res['initJs']=null;
    $res['setDefaultValue']=null;
    $res['jsInclude']=null;
    $res['detTable']=null;
    
    return $res;
}

function getFormInputTab($formId,$columns,$prop){
    foreach($prop['tab'] as $i=>$t){
        if(isset($t['type']) && $t['type']=='checkbox'){
            $form[$i]='<form action="" class="form-horizontal row-border frm_validation" id="'.$formId.'">
                <div class="form-group">
                <label class="col-sm-3 control-label">'.$t['caption'].'</label>
                <div class="col-sm-6">';
            $form[$i].=genCheckboxInput($formId,array_slice($columns,$t['from'],($t['to']-$t['from']+1)),$t);
            $form[$i].='</div>
                </div></form>';
        }else{
            $form[$i]=getFormInput($formId,array_slice($columns,$t['from'],($t['to']-$t['from']+1)),$prop);   
        }
        
        $form[$i]=str_replace($formId,$formId.' '.$formId.$i,$form[$i]);
        $form[$i]=str_replace('id="'.$formId.' '.$formId.$i,'id="'.$formId.$i,$form[$i]);
    }
    
    return $form;
};

function getFormInput($formId,$columns,$prop){    
    $typeInputText=array('varchar','char','text','select2','password');
    $typeInputNumber=array('int','tinyint','bigint','double','float','decimal');
    $intType=array('int','tinyint','bigint');
    $uploadType=array('fileimage','filedocument');
    $typeList=array('enum');
    
    $result='<form action="" class="form-horizontal row-border frm_validation" id="'.$formId.'">';
    
    foreach($columns as $c){
        if($c['is_Conditional']=='YES') $c['conditional']='style="display:none"';else $c['conditional']=''; 
        if(strtoupper($c['Is_Nullable'])=='NO') $c['required']='required="required"';else $c['required']='';
        if(isset($prop['divSize'])) $c['divSize']=$prop['divSize']; else $c['divSize']=8;
        
        if(in_array(strtolower($c['Data_Type']),$typeInputText)){
            if($c['Referenced_Fill_Dinamic']=='YES'){
                $result.=genInputListDinamic($c);    
            }else
            if($c['Referenced_Table_Schema']!=null && $c['Referenced_Table_Name']!=null && $c['Referenced_Column_Name']!=null){
                $result.=genInputListReferenced($c);    
            }else
            if(strtolower($c['Data_Type'])=='text'){
                $result.=genTextAreaInput($c);    
            }else
            if(strtolower($c['Data_Type'])=='password'){
                $result.=genInputPassword($c);    
            }else
                $result.=genInputText($c);
        }else
        
        if(in_array(strtolower($c['Data_Type']),$typeInputNumber)){
            if(in_array(strtolower($c['Data_Type']),$intType)){
                $c['Event'].=' onkeypress="return isNumberKey(event)"';
            }
            $result.=genInputText($c);
        }
        if(in_array(strtolower($c['Data_Type']),$typeList)){
            $result.=genInputListEnum($c);
        }
        if(strtolower($c['Data_Type'])=='hidden'){
            $result.=genInputHidden($c);
        }
        if(strtolower($c['Data_Type'])=='date'){
            $result.=genDateInput($c);
        }
        if(strtolower($c['Data_Type'])=='time'){
            $result.=genTimeInput($c);
        }
        if(in_array(strtolower($c['Data_Type']),$uploadType)){
            $result.=genDropzoneInput($c);
        }
        if(strtolower($c['Data_Type'])=='spinner'){
            $result.=genSpinnerInput($c);
        }
        if(strtolower($c['Data_Type'])=='readonly'){
            $result.=genReadOnlyInput($c);
        }
        if(strtoupper($c['Data_Type'])=='WYSIWYG'){
            $result.=getWYSIWYG($c);
        }
        if(strtolower($c['Data_Type'])=='static-text'){
            $result.=genStatictext($c);
        }
    }
    
    if(count($columns)>0) $result.=getSaveAsInput($columns);
    $result.='</form>';
    return $result;
}

function getWYSIWYG($column){
    $result='<div class="form-group" id="form-group-'.$column['Column_Name'].'" '.$column['conditional'].'>
            <label class="col-sm-3 control-label">'.$column['Column_Caption'].'</label>
            <div class="col-sm-'.$column['divSize'].'">
                <div name="summernote" class="summernote" id="'.$column['Column_Name'].'"></div>
            </div>
        </div>';
    return $result;
}

function genInputText($column){
    $result='<div class="form-group" id="form-group-'.$column['Column_Name'].'" '.$column['conditional'].'>
            <label class="col-sm-3 control-label">'.$column['Column_Caption'].'</label>
            <div class="col-sm-'.$column['divSize'].'">
                <input class="form-control '.$column['Form_Id'].'" type="text" name="'.$column['Column_Name'].'" id="'.$column['Column_Name'].'" value="'.$column['Default_Value'].'" maxlength="'.$column['Character_Maximum_Lenght'].'" style="'.$column['Column_Style'].'" '.$column['Event'].' '.$column['required'].'/>
            </div>
        </div>';
    return $result;
}

function genInputPassword($column){
    $result='<div class="form-group" id="form-group-'.$column['Column_Name'].'" '.$column['conditional'].'>
            <label class="col-sm-3 control-label">'.$column['Column_Caption'].'</label>
            <div class="col-sm-'.$column['divSize'].'">
                <input class="form-control '.$column['Form_Id'].'" type="password" name="'.$column['Column_Name'].'" id="'.$column['Column_Name'].'" value="'.$column['Default_Value'].'" maxlength="'.$column['Character_Maximum_Lenght'].'" style="'.$column['Column_Style'].'" '.$column['Event'].' '.$column['required'].'/>
            </div>
        </div>';
    return $result;
}
function genStatictext($column){
    $result='<div class="form-group" id="form-group-'.$column['Column_Name'].'" '.$column['conditional'].'>
            <label class="col-sm-3 control-label">'.$column['Column_Caption'].'</label>
            <div class="col-sm-'.$column['divSize'].'">
                <label class="control-label statictext '.$column['Form_Id'].'" id="'.$column['Column_Name'].'" style="'.$column['Column_Style'].'" '.$column['Event'].'>'.$column['Default_Value'].'</label>
            </div>
        </div>';
    return $result;
}

function genInputHidden($column){
    $result='<input class="form-control '.$column['Form_Id'].'" type="hidden" name="'.$column['Column_Name'].'" id="'.$column['Column_Name'].'" maxlength="'.$column['Character_Maximum_Lenght'].'" style="'.$column['Column_Style'].'" '.$column['Event'].'/>';
    return $result;
}

function genInputListReferenced($column){
    $model = get_instance();
    $model->load->model('generator_model');

    $result='<div class="form-group" id="form-group-'.$column['Column_Name'].'" '.$column['conditional'].'>
                <label class="col-sm-3 control-label">'.$column['Column_Caption'].'</label>
                <div class="col-sm-'.$column['divSize'].'">
                    <select name="'.$column['Column_Name'].'" id="'.$column['Column_Name'].'" class="form-control '.$column['Form_Id'].'" '.$column['required'].' '.$column['Event'].'>
                    <option value="">-PILIH-</option>';
                    
    if($column['Referenced_Fill_Dinamic']=='NO' || $column['Referenced_Fill_Dinamic']==null){
        $enumRef=$model->generator_model->getListOfReferecedValue($column['Referenced_Table_Schema'],$column['Referenced_Table_Name'],$column['Referenced_Column_Name'],$column['Referenced_Display_Column_Name']);
        foreach($enumRef->result_array() as $r){
            $result.='<option value="'.$r['val'].'">'.$r['dis'].'</option>';}        
    }
                    $result.='</select>
                </div>
            </div>';
    return $result;
}

function genInputListDinamic($column){
    $result='<div class="form-group" id="form-group-'.$column['Column_Name'].'" '.$column['conditional'].'>
                <label class="col-sm-3 control-label">'.$column['Column_Caption'].'</label>
                <div class="col-sm-'.$column['divSize'].'">
                    <select name="'.$column['Column_Name'].'" id="'.$column['Column_Name'].'" class="form-control '.$column['Form_Id'].'" '.$column['required'].' '.$column['Event'].'>
                    <option value="">-PILIH-</option>
                    </select>
                </div>
            </div>';
    return $result;
}

function genInputListEnum($column){
    $model = get_instance();
    $model->load->model('generator_model');
    if(empty($column['Referenced_Table_Name'])) $refTable=$column['Table_Name']; else $refTable=$column['Referenced_Table_Name'];
    if(empty($column['Referenced_Column_Name'])) $refColumn=$column['Column_Name']; else $refColumn=$column['Referenced_Column_Name'];
    $enumVal=$model->generator_model->getEnumFieldValues($column['Referenced_Table_Schema'],$refTable,$refColumn);
    if(empty($column['Default_Value'])) $defVal='selected'; else $defVal='';
    $result='<div class="form-group" id="form-group-'.$column['Column_Name'].'" '.$column['conditional'].'>
                <label class="col-sm-3 control-label">'.$column['Column_Caption'].'</label>
                <div class="col-sm-'.$column['divSize'].'">
                    <select name="'.$column['Column_Name'].'" id="'.$column['Column_Name'].'" class="form-control '.$column['Form_Id'].'" '.$column['required'].' '.$column['Event'].'>
                    <option value>-PILIH-</option>';
                	foreach(explode("','",substr($enumVal,6,-2)) as $option){
                	   if($option==$column['Default_Value']) $selected='selected="selected"';else $selected="";
                    $result.='<option value="'.$option.'" '.$selected.'>'.$option.'</option>';}
                    $result.='</select>
                </div>
            </div>';
    return $result;
}

function genDateInput($column){
    $result='<div class="form-group" id="form-group-'.$column['Column_Name'].'" '.$column['conditional'].'>
                <label class="col-sm-3 control-label">'.$column['Column_Caption'].'</label>
                <div class="col-sm-'.$column['divSize'].'">
                    <div class="input-group date date-picker" id="datepicker-'.$column['Column_Name'].'">
                        <input type="text" class="form-control '.$column['Form_Id'].'" id="'.$column['Column_Name'].'" name="'.$column['Column_Name'].'" '.$column['required'].' '.$column['Event'].' readonly>
                        <span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
                    </div>
                </div>
            </div>';
    return $result;
}

function genTimeInput($column){
    $result='<div class="form-group" id="form-group-'.$column['Column_Name'].'" '.$column['conditional'].'>
                <label class="col-sm-3 control-label">'.$column['Column_Caption'].'</label>
                <div class="col-sm-'.$column['divSize'].'">
                    <div class="input-icon">
                        <i class="fa fa-clock-o"></i>
                        <input type="text" class="form-control timepicker timepicker-default '.$column['Form_Id'].'" id="'.$column['Column_Name'].'" name="'.$column['Column_Name'].'" '.$column['required'].' '.$column['Event'].'>
                    </div>
                </div>
            </div>';
    return $result;
}
function genSpinnerInput($column){
    $res='<div class="form-group" id="form-group-'.$column['Column_Name'].'" '.$column['conditional'].'>
				<label class="control-label col-md-3">'.$column['Column_Caption'].'</label>
				<div class="col-md-'.$column['divSize'].'">
					<div id="spinner-'.$column['Column_Name'].'" class='.$column['Form_Id'].'>
						<div class="input-group" style="width:150px;">
							<input type="text" class="spinner-input form-control '.$column['Form_Id'].'" id="'.$column['Column_Name'].'" maxlength="'.$column['Character_Maximum_Lenght'].'" name="'.$column['Column_Name'].'" '.$column['required'].' '.$column['Event'].' readonly>
							<div class="spinner-buttons input-group-btn">
								<button type="button" class="btn spinner-up default">
								<i class="fa fa-angle-up"></i>
								</button>
								<button type="button" class="btn spinner-down default">
								<i class="fa fa-angle-down"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>';
   return $res;
}
function genReadOnlyInput($column){
    $result='<div class="form-group" id="form-group-'.$column['Column_Name'].'" '.$column['conditional'].'>
                <label class="col-sm-3 control-label">'.$column['Column_Caption'].'</label>
                <div class="col-sm-'.$column['divSize'].'">
                    <input type="text" class="form-control '.$column['Form_Id'].'" readonly="readonly" id="'.$column['Column_Name'].'" name="'.$column['Column_Name'].'" '.$column['required'].' '.$column['Event'].'">
                </div>
            </div>';
    return $result;
}

function genDropzoneInput($column){
    $res='<div class="form-group" id="form-group-'.$column['Column_Name'].'" '.$column['conditional'].'>
                <label class="col-sm-3 control-label">'.$column['Column_Caption'].'</label>
                <div class="col-sm-'.$column['divSize'].' dropzone '.$column['Form_Id'].'" id="'.$column['Column_Name'].'">
                </div>
            </div>';
    return $res;
}

function genTextAreaInput($column){
    $res='<div class="form-group" id="form-group-'.$column['Column_Name'].'" '.$column['conditional'].'>
                <label class="col-sm-3 control-label">'.$column['Column_Caption'].'</label>
                <div class="col-sm-'.$column['divSize'].'">
                    <textarea class="form-control autosize '.$column['Form_Id'].'" id="'.$column['Column_Name'].'" name="'.$column['Column_Name'].'" '.$column['required'].' '.$column['Event'].'></textarea>
                </div>
            </div>';
    return $res;
}

function genCheckboxInput($formId,$columns,$prop){
    $res='';
    foreach($columns as $col){
        $res.='<div class="checkbox">
                  <label>
                    <input type="checkbox" class="'.$formId.'" id="'.$col['Column_Name'].'" value="'.$prop['checkedAs'].'">'.
                    $col['Column_Caption']
                  .'</label>
                </div>';
    }
    return $res;
}

function genInitComponent($columns){
    $res="";
    $isInitedAutoSizeTextArea=false;
    $isInitedDatePicker=false;
    foreach($columns as $c){
        if(strtolower($c['Data_Type'])=='date'){
            if(!$isInitedDatePicker){
                $res.=("if (jQuery().datepicker) {
                        $('.date-picker').datepicker({
                            rtl: Metronic.isRTL(),
                            orientation: 'left',
                            autoclose: true
                        });
                    }");
                $isInitedDatePicker=true;   
            }
        }       
        if(strtolower($c['Data_Type'])=='time'){
            $res.=('$("#'.$c['Column_Name'].'").timepicker({
                        autoclose: true,
                        minuteStep: 5,
                        showSeconds: false,
                        showMeridian: false
                    });');
            $res.=('$("#btnTime_'.$c['Column_Name'].'").click(function () {
                        if(!$("#'.$c['Column_Name'].'").attr("disabled"))
                        $("#'.$c['Column_Name'].'").timepicker("show");
                    });');
        }
        if(strtolower($c['Data_Type'])=='fileimage'){
            $res.=('Dropzone.autoDiscover = false;
                    Dropzone.options.'.$c['Column_Name'].' = {
                        init: function() {
                            this.on("success", function(file,result) { console.log(result) });
                        },
                        url: "'.base_url().'index.php/file_uploader/doUploadImage",
                        acceptedFiles:"image/*,application/pdf"
                    };
                    $("#'.$c['Column_Name'].'").dropzone();
                    ');
        }
        if(strtolower($c['Data_Type'])=='filedocument'){
            $res.=('Dropzone.autoDiscover = false;
                    $("div#'.$c['Column_Name'].'").dropzone({ url: "'.base_url().'index.php/file_uploader/doUploadDocument" }).on("success", function( file, result ) {
                      console.log(result)
                    });');
        }
        if(strtolower($c['Data_Type'])=='spinner'){
            $res.=("$('.".$c['Form_Id']."#spinner-".$c['Column_Name']."').spinner({value:0, min: 0});");
        }
        if(strtolower($c['Data_Type'])=='text' && !$isInitedAutoSizeTextArea){
            //$res.='$("textarea.autosize").autosize({append: "\n"});';
            //$isInitedAutoSizeTextArea=true;
        }
        if(strtoupper($c['Data_Type'])=='WYSIWYG'){
            $res.=("$('#".$c['Column_Name']."').summernote({onkeyup: function(e) {
                  if (typeof ".$c['Column_Name']."_keyup == 'function') { 
                      ".$c['Column_Name']."_keyup(e); 
                    }
              },height: 300});");
        }
        if(strtolower($c['Data_Type'])=='select2'){
            $res.=("$(\"#".$c['Column_Name']."\").select2();
                    $(\".select2.select2-container\").css('width','100%');");
        }
    }
    return $res;
}

function genJsDefaultValue($columns){
    $res="";
    foreach($columns as $c){
        if(strtolower($c['Data_Type'])=='checkbox'){
            // Not yet decided, so let it do nothing.
        }else
        $res.=("$('.".$c['Form_Id']."#".$c['Column_Name']."').val('".$c['Default_Value']."');");
    }
    return $res;
}

function genIncludeJs($columns){
    $res="";
    if(in_array_r("date",$columns)){
        $res.="
        <script type='text/javascript' src='".base_url()."assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'></script>";
    }
    if(in_array_r("time",$columns)){
        $res.="<script type='text/javascript' src='".base_url()."assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js'></script>";
    }
    if(in_array_r("fileimage",$columns)||in_array_r("filedocument",$columns)){
        $res.="<script src='".base_url()."assets/additional/js/dropzone/dropzone.js'></script>";
    }
//    if(in_array_r("text",$columns)){
//        $res.="<script type='text/javascript' src='".base_url()."assets/avant/plugins/form-autosize/jquery.autosize-min.js'></script>";
//    }
    if(in_array_r("spinner",$columns)){
        $res.="<script type='text/javascript' src='".base_url()."assets/global/plugins/fuelux/js/spinner.min.js'></script>";
    }
    if(in_array_r("WYSIWYG",$columns)){
        $res.="<script src='".base_url()."assets/global/plugins/bootstrap-summernote/summernote.min.js' type='text/javascript'></script>";
    }
    if(in_array_r("select2",$columns)){
        $res.='<script src="'.base_url().'assets/additional/select2/select2.min.js"></script>';
    }
    return $res;
}

function genIncludeCss($columns){
    $res="";
    if(in_array_r("date",$columns)){
        $res.="
        <link rel='stylesheet' type='text/css' href='".base_url()."assets/global/plugins/bootstrap-datepicker/css/datepicker3.css'/>
        ";
    }
    if(in_array_r("date",$columns)){
        $res.="
        <link rel='stylesheet' type='text/css' href='".base_url()."assets/global/plugins/bootstrap-datepicker/css/datepicker3.css'/>
        ";
    }
    if(in_array_r("time",$columns)){
        $res.="<link rel='stylesheet' type='text/css' href='".base_url()."assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'/>";
    }
    if(in_array_r("fileimage",$columns)||in_array_r("filedocument",$columns)){
        $res.="<link rel='stylesheet' type='text/css' href='".base_url()."assets/additional/js/dropzone/dropzone.css'/>";
    }
//    if(in_array_r("text",$columns)){
//        $res.="<script type='text/javascript' src='".base_url()."assets/avant/plugins/form-autosize/jquery.autosize-min.js'></script>";
//    }
//    if(in_array_r("spinner",$columns)){
//        $res.="<script type='text/javascript' src='".base_url()."assets/global/plugins/fuelux/js/spinner.min.js'></script>";
//    }
    if(in_array_r("WYSIWYG",$columns)){
        $res.="<link rel='stylesheet' type='text/css' href='".base_url()."assets/global/plugins/bootstrap-summernote/summernote.css'>";
    }
    if(in_array_r("select2",$columns)){
        $res.='<link href="'.base_url().'assets/additional/select2/select2.min.css" rel="stylesheet" type="text/css"/>';
    }
    return $res;
}

function getSaveAsInput($columns){
    $column=$columns[0];
    
    $res='<input class="'.$column['Form_Id'].'" type="hidden" id="saveas"/>';
    return $res;
}

function in_array_r($needle,$haystack,$strict=false){
    foreach($haystack as $item){
        if(($strict ? $item === $needle : $item==$needle)|| (is_array($item) && in_array_r($needle,$item,$strict))){
            return true;
        }
    }
    return false;
}

function mappingColumn($tableName,$data){
    $CI = get_instance();
    $CI->load->model('generator_model');
    $CI->load->database();
    $dbName=$CI->db->database;
    $cols=$CI->generator_model->getListOfColumnsByTable(array("Table_Schema"=>$dbName,"Table_Name"=>$tableName));
    $cols=$cols->result_array();
    
    $upperCols=$CI->generator_model->getListOfUpperCaseColumnByTable(array("Table_Schema"=>$dbName,"Table_Name"=>$tableName));
    $newData=array();
    foreach($data as $i=>$d){
        if(in_array_r($i,$cols)){
            if(in_array_r($i,$upperCols)){
                $newData[$i]=strtoupper($d);    
            }else $newData[$i]=$d;
        }
    }
    return $newData;
}
function mappingColumnResQuery($target,$src){
    $newData=array();
    foreach($src as $i=>$d){
        if(in_array_r($i,$target)){  
            $newData[$i]=$d;
        }
    }
    return $newData;
}
function filter_column_by_class($classname,$data){
    $model = get_instance();
    $model->load->model('generator_model');
    $columns=$model->generator_model->getListOfColumnByClass($classname);
    return mappingColumnResQuery($columns,$data);
}
function genDetTable($columns){
    $res="";
    foreach($columns->result_array() as $col){
        $res.='<tr>
                    <th style="width: 30%;">'.$col['Column_Caption'].'</th>
                    <td class="'.$col['Form_Id'].'" id="detail_'.$col['Column_Name'].'" ></td>
                </tr>';
    };
    
    return $res;
}
function genDetTableArray($columns){
    $res="";
    foreach($columns as $col){
        $res.='<tr>
                    <th style="width: 30%;">'.$col['Column_Caption'].'</th>
                    <td class="'.$col['Form_Id'].'" id="detail_'.$col['Column_Name'].'" ></td>
                </tr>';
    };
    
    return $res;
}
function genDetTableTab($columns,$prop){
    $arr_col=$columns->result_array();
    foreach($prop['tab'] as $i=>$t){
            $det[$i]=genDetTableArray(array_slice($arr_col,$t['from'],($t['to']-$t['from']+1)),$prop);   
        }
    return $det;
}