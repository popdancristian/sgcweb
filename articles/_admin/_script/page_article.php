<?php
include_once PATH_CLASS.DIR_SEP.'DbGrid.class.php';

$o_dbgrid = new DbGrid(array('page'=>$page,'name'=>'frmManage','title'=>_l('manage'),'action'=>'','id'=>'articleid'));
$o_dbgrid->SetAttribute($attributes);
$o_dbgrid->SetSqlCount('select count(*) as nr 
                       from '.DB_PREFIX.'article a
                       inner join '.DB_PREFIX.'domain_article da ON da.articleid = a.articleid
                       where da.domainid = '.$_SESSION['domainid']);

$o_dbgrid->SetSql('select a.*,
                          da.publish,
                          da.active,
                          da.ordon,
                          da.total,
                          da.totalraty,
                          da.raty,
                          c.title as category
                   from '.DB_PREFIX.'article a
                   inner join '.DB_PREFIX.'domain_article da ON da.articleid = a.articleid
                   left join '.DB_PREFIX.'category c ON c.categoryid = a.categoryid
                   where domainid = '.$_SESSION['domainid']);

$o_dbgrid->SetSqlSearch
(
     array
     (  
      'title'=> "a.title like '%".$o_dbgrid->GetSqlSearchParam('title')."%'",
      'categoryid'=> "a.categoryid = ".intVal($o_dbgrid->GetSqlSearchParam('categoryid')),
	  'publish'=> "da.publish = ".intVal($o_dbgrid->GetSqlSearchParam('publish')),
      'articleid'=> "a.articleid = ".intVal($o_dbgrid->GetSqlSearchParam('articleid'))
     )
);
$o_dbgrid->SetSqlOrderBy(array('field'=>'ordon','type'=>'asc'));
$o_dbgrid->SetSqlLimit(DEFAULT_PAGE_LIMIT);
$o_dbgrid->setColumns
(
   array
   ( 
    array('type'=>'text','field'=>'articleid','caption'=>_l('id'),'ordon'=>'articleid','th'=>array('align'=>'center','style'=>'width:60px;')),
    array('type'=>'text','field'=>'title','caption'=>_l('title'),'ordon'=>'title','th'=>array('align'=>'center','style'=>'width:30%;')),
    array('type'=>'text','field'=>'total','caption'=>_l('total'),'ordon'=>'total','th'=>array('align'=>'center','style'=>'width:70px;')), 
    array('type'=>'text','field'=>'raty','caption'=>_l('raty'),'ordon'=>'raty','th'=>array('align'=>'center','style'=>'width:70px;')), 
    array('type'=>'text','field'=>'category','caption'=>_l('category'),'ordon'=>'category','th'=>array('align'=>'center','style'=>'width:120px;')),
    array('type'=>'checkbox','field'=>'publish','caption'=>_l('publish'),'ordon'=>'publish','align'=>'center','action'=>'publish',
          'th'=>array('align'=>'center'),'td'=>array('align'=>'center')),
    array('type'=>'checkbox','field'=>'active','caption'=>_l('active'),'ordon'=>'active','align'=>'center','action'=>'active',
          'th'=>array('align'=>'center'),'td'=>array('align'=>'center')),
    array('type'=>'textbox','field'=>'ordon','caption'=>_l('ordon'),'ordon'=>'ordon','align'=>'center','action'=>'ordon',
          'th'=>array('align'=>'center'),'td'=>array('align'=>'center'),'textbox'=>array('style'=>'width:50px;')),
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

//-- build some form vars
$a_category = db_get('category',array('orderby'=>'title'));
$a_category_option = array(''=>_l('all'));
foreach ($a_category as $i_key=>$a_value) $a_category_option[$a_value['categoryid']] = $a_value['title'];
$a_publish = array(''=>_l('all'),'0'=>_l('no'),'1'=>_l('yes'));

//-- define and assign search form
$a_form_search = array
(
 'name'=>'frmSearch',
 'title'=>_l('search'),
 'row'=>array(
               'articleid'=>array('caption'=>_l('article').' ID' ,'type'=>'textbox'),
               'title'=>array('caption'=>_l('title'),'type'=>'textbox'),
               'categoryid'=>array('caption'=>_l('category'),'type'=>'select','a_value'=>$a_category_option),
               'publish'=>array('caption'=>_l('publish'),'type'=>'select','a_value'=>$a_publish)
             ),
 'button'=>_l('search')
);

$o_smarty->assign("a_form_search",$a_form_search); 
?>