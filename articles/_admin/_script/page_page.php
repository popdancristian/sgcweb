<?php

include_once PATH_CLASS.DIR_SEP.'DbGrid.class.php';

$o_dbgrid = new DbGrid(array('page'=>$page,'name'=>'frmManage','title'=>_l('manage'),'action'=>'','id'=>'pageid'));
$o_dbgrid->SetAttribute($attributes);
$o_dbgrid->SetSqlCount('select count(*) as nr 
                       from '.DB_PREFIX.'page p
                       inner join '.DB_PREFIX.'domain_page dp ON dp.pageid = p.pageid
                       where dp.domainid = '.$_SESSION['domainid']);

$o_dbgrid->SetSql('select *
                   from '.DB_PREFIX.'page p
                   inner join '.DB_PREFIX.'domain_page dp ON dp.pageid = p.pageid
                   where domainid = '.$_SESSION['domainid']);
$o_dbgrid->SetSqlOrderBy(array('field'=>'ordon','type'=>'asc'));
$o_dbgrid->SetSqlLimit(DEFAULT_PAGE_LIMIT);
$o_dbgrid->setColumns
(
   array
   ( 
    array('type'=>'text','field'=>'pageid','caption'=>_l('id'),'th'=>array('align'=>'center','style'=>'width:60px;')),
    array('type'=>'text','field'=>'menu','caption'=>_l('menu'),'ordon'=>'menu','th'=>array('align'=>'center','style'=>'width:40%;')),
    array('type'=>'text','field'=>'name','caption'=>_l('name'),'ordon'=>'name','th'=>array('align'=>'center','style'=>'width:60px;')),
    array('type'=>'text','field'=>'template','caption'=>_l('template'),'ordon'=>'template','th'=>array('align'=>'center','style'=>'width:80px;')),
    array('type'=>'text','field'=>'menus','caption'=>_l('menus'),'ordon'=>'total','th'=>array('align'=>'center','style'=>'width:100px;')),
    array('type'=>'checkbox','field'=>'active','caption'=>_l('active'),'ordon'=>'active','align'=>'center','action'=>'active',
          'th'=>array('align'=>'center'),'td'=>array('align'=>'center')),
    array('type'=>'textbox','field'=>'ordon','caption'=>_l('ordon'),'ordon'=>'ordon','align'=>'center','action'=>'ordon',
          'th'=>array('align'=>'center'),'td'=>array('align'=>'center'),'textbox'=>array('style'=>'width:30px;')),
	array('type'=>'link','name'=>_l('mod'),'action'=>'addmod','align'=>'center',
		  'th'=>array('align'=>'center','style'=>'width:80px;'),'td'=>array('align'=>'center')),
	array(
	      'type'=>'link','name'=>_l('del'),'action'=>'del','align'=>'center',
		  'th'=>array('align'=>'center','style'=>'width:80px;'),'td'=>array('align'=>'center'),
		  'param'=>array('submit'=>1),
		  'onclick'=>"return confirm('"._l('confirmdelete')."');"
		 )
   )
);

$a_grid = $o_dbgrid->Get();

//-- assign grid data
$o_smarty->assign("a_grid",$a_grid);
?>