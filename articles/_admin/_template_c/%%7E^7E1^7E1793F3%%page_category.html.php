<?php /* Smarty version 2.6.22, created on 2014-03-16 11:07:20
         compiled from f:%5CUSBWebserver+v8.5%5C8.5%5Croot%5Crims.ro/articles/_admin%5C_template/page_category.html */ ?>
<form method="GET" action="index.php" name="">
<input type="hidden" name="page" value="<?php echo $this->_tpl_vars['page']; ?>
">
<fieldset>
<legend><?php echo $this->_tpl_vars['_l']['search']; ?>
</legend>
<table border="0" cellspacing="1" cellpadding="1">
<tr>
 <td><?php echo $this->_tpl_vars['_l']['category']; ?>
ID:</td>
 <td>
  <input name="search[categoryid]" id="categoryid" value="<?php if (( isset ( $this->_tpl_vars['a_search']['categoryid'] ) )): ?><?php echo $this->_tpl_vars['a_search']['categoryid']; ?>
<?php endif; ?>">
 </td>
 <td><?php echo $this->_tpl_vars['_l']['title']; ?>
:</td>
 <td>
  <input name="search[title]" id="title" value="<?php if (( isset ( $this->_tpl_vars['a_search']['title'] ) )): ?><?php echo $this->_tpl_vars['a_search']['title']; ?>
<?php endif; ?>">
 </td>
 <td><?php echo $this->_tpl_vars['_l']['active']; ?>
:</td>
 <td>
  <select name="search[active]" id="active">
   <option value="" <?php if (( ! isset ( $this->_tpl_vars['a_search']['active'] ) )): ?> selected="selected"<?php endif; ?>>All</option>
   <option value="0" <?php if (( isset ( $this->_tpl_vars['a_search']['active'] ) && ( 0 == $this->_tpl_vars['a_search']['active'] ) )): ?> selected="selected"<?php endif; ?>>No</option>
   <option value="1" <?php if (( isset ( $this->_tpl_vars['a_search']['active'] ) && ( 1 == $this->_tpl_vars['a_search']['active'] ) )): ?> selected="selected"<?php endif; ?>>Yes</option>
  </select>
 </td>
 <td><button type="submit"><?php echo $this->_tpl_vars['_l']['search']; ?>
</button></td>
</tr>
</table>
</fieldset>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "grid.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br/><a href="index.php?page=<?php echo $this->_tpl_vars['page']; ?>
&action=addmod" class="action">Add</a>