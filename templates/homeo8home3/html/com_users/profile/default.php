<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="col-md-3 profile_image">
<img src="images/User.jpg"/>
<ul class="list-unstyled user_social">
<a href=""> <li class="text-center"><i class="fa fa-envelope fa-fw"></i> Gmail</li></a>
<a href=""> <li class="text-center"><i class="fa fa-twitter fa-fw"></i> Twitter</li></a>
<a href=""> <li class="text-center"><i class="fa fa-facebook-official fa-fw"></i> facebook</li></a>
</ul>
</div>
<div class="col-md-9 profile<?php echo $this->pageclass_sfx?>">
<?php if ($this->params->get('show_page_heading')) : ?>
<div class="page-header">
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
</div>
<?php endif; ?>
<?php if (JFactory::getUser()->id == $this->data->id) : ?>
<ul class="btn-toolbar pull-right">
	<li class="btn-group">
		<a class="btn" id="edit_profile" href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id=' . (int) $this->data->id);?>">
			<span class="icon-pencil "></span> <?php echo JText::_('COM_USERS_EDIT_PROFILE'); ?></a>
	</li>
</ul>
<?php endif; ?>
<?php echo $this->loadTemplate('core'); ?>

<?php echo $this->loadTemplate('params'); ?>

<?php echo $this->loadTemplate('custom'); ?>

</div>
