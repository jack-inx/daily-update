<?php
/* @var $this NewsSubCategoryController */
/* @var $model NewsSubCategory */

$this->breadcrumbs = array(
    'News Sub Categories' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List NewsSubCategory', 'url' => array('index')),
    array('label' => 'Create NewsSubCategory', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#news-sub-category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage News Sub Categories</h1>
<?php /* ?>
  <p>
  You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
  or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
  </p>

  <?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
  <div class="search-form" style="display:none">
  <?php
  $this->renderPartial('_search', array(
  'model' => $model,
  ));
  ?>
  </div><!-- search-form -->
  <?php */ ?>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'id' => 'news-sub-category-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array(
                'name' => 'NewsSubCategoryIds[]',
                'class' => 'usercheck'
            ),
            'value' => '$data->NewsSubCategoryId',
        ),
        array(
            'name' => 'NewsSubCategoryId',
            'header' => '#',
            'htmlOptions' => array('style' => 'text-align:center;width:10%;'),
        ),
        array(
            'header' => 'News Category',
            'type' => 'raw',
            'value' => 'CHtml::tag("div",  array("style"=>"text-align: center" ) , CHtml::link(NewsCategory::model()->showNewCategory($data->NewsCategoryId))  )',
        //'htmlOptions' => array('width' => '3%;'),            
        ),
        'NewsSubCategoryName',
        'Status',
        array(
            'header' => 'Action',
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
<div class="form-actions">
    <?php
    /* Change status to active of all checked users */
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'button',
        'type' => 'primary',
        'label' => 'Active',
        'loadingText' => 'loading...',
        'htmlOptions' => array('id' => 'buttonChangeStatusActive'),
    ));
    ?>
    &nbsp;
    <?php
    /* Change status to active of all checked users */
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'button',
        'type' => 'primary',
        'label' => 'InActive',
        'loadingText' => 'loading...',
        'htmlOptions' => array('id' => 'buttonChangeStatusInActive'),
    ));
    ?>
    &nbsp;
    <?php
    /* delete all checked users */
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'button',
        'type' => 'primary',
        'label' => 'Delete',
        'loadingText' => 'loading...',
        'htmlOptions' => array('id' => 'buttonDeleteAllData'),
    ));
    ?>
</div>
<script type="text/javascript">
    $('#buttonDeleteAllData').click(function() {
        var btn = $(this);
        btn.button('loading'); // call the loading function
        
        if ($('input:checkbox:checked').length > 0) { 
            bootbox.confirm("Are you sure you want to delete?",function(confirmed){
                if(confirmed == true)
                {
                    var saDataValue = new Array();
                    var snDataCounter = 0;
                    $('input:checkbox:checked').each(function(){
                        saDataValue[snDataCounter] = this.value;                        
                        snDataCounter++;
                    });
                    $.post('<?php echo Yii::app()->createUrl('admin/NewsSubCategory/DeleteMultipleSubCategories'); ?>',{'Data':saDataValue}, function(data) {
                        if(data == 1)
                        {
                            bootbox.alert("News Sub Category/Categories deleted successfully.", function() {
                                //btnParent.remove();
                                btn.button('reset'); // call the reset function
                                window.location.reload();
                            });                  
                        }else{
                            bootbox.alert("News Sub Category/Categories deletion error.", function() {
                                btn.button('reset'); // call the reset function
                                window.location.reload();
                            });            
                        }                        
                    });
                }                
            });                        
        }else{
            bootbox.alert("Please select at least one user to perform this action.", function() {
                btn.button('reset'); // call the reset function
            });            
        }        
    });
    
    $('#buttonChangeStatusActive').click(function() {
        var btn = $(this);
        btn.button('loading'); // call the loading function
        
        if ($('input:checkbox:checked').length > 0) { 
            bootbox.confirm("Are you sure you want to change status to Active?",function(confirmed){
                if(confirmed == true)
                {
                    var saDataValue = new Array();
                    var snDataCounter = 0;
                    $('input:checkbox:checked').each(function(){
                        saDataValue[snDataCounter] = this.value;                        
                        snDataCounter++;
                    });
                    $.post('<?php echo Yii::app()->createUrl('admin/NewsSubCategory/ChangeSubCategoriesStatus'); ?>',{'Data':saDataValue,'Status':'Active'}, function(data) {
                        if(data == 1)
                        {
                            bootbox.alert("News Sub Category/Categories status changed successfully.", function() {
                                //btnParent.remove();
                                btn.button('reset'); // call the reset function
                                window.location.reload();
                            });                  
                        }else{
                            bootbox.alert("News Sub Category/Categories updation error.", function() {
                                btn.button('reset'); // call the reset function
                                window.location.reload();
                            });            
                        }                        
                    });
                }                
            });                        
        }else{
            bootbox.alert("Please select at least one user to perform this action.", function() {
                btn.button('reset'); // call the reset function
            });            
        }        
    });
    
    $('#buttonChangeStatusInActive').click(function() {
        var btn = $(this);
        btn.button('loading'); // call the loading function
        
        if ($('input:checkbox:checked').length > 0) { 
            bootbox.confirm("Are you sure you want to change status to InActive?",function(confirmed){
                if(confirmed == true)
                {
                    var saDataValue = new Array();
                    var snDataCounter = 0;
                    $('input:checkbox:checked').each(function(){
                        saDataValue[snDataCounter] = this.value;                        
                        snDataCounter++;
                    });
                    $.post('<?php echo Yii::app()->createUrl('admin/NewsSubCategory/ChangeSubCategoriesStatus'); ?>',{'Data':saDataValue,'Status':'InActive'}, function(data) {
                        if(data == 1)
                        {
                            bootbox.alert("News Sub Category/Categories status changed successfully.", function() {
                                //btnParent.remove();
                                btn.button('reset'); // call the reset function
                                window.location.reload();
                            });                  
                        }else{
                            bootbox.alert("News Sub Category/Categories updation error.", function() {
                                btn.button('reset'); // call the reset function
                                window.location.reload();
                            });            
                        }                        
                    });
                }                
            });                        
        }else{
            bootbox.alert("Please select at least one user to perform this action.", function() {
                btn.button('reset'); // call the reset function
            });            
        }        
    });
</script>