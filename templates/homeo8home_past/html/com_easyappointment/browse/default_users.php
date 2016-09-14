<?php
/*
 * @component Easyappointment
 * @website : ionutlupu.me
 * @copyright  Ionut Lupu. All rights reserved.
 * @license : http://www.gnu.org/copyleft/gpl.html GNU/GPL , see license.txt
 */
 
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>

<div id="easyapp">
	<h3 class="list-title"> 
		<i class="ico ico-user"></i> <span class="main"><span class="second"><?php echo sprintf(JText::_('COM_EASYAPPOINTMENT_USERS'), $this->category->name);?></span></span>
	</h3>

	<?php foreach ($this->items as $item) { $user_services = $item->getServices(); ?>
	<div class="listing staff">
		<div class="col-md-2 left">
			<div class="staff_image">
				<a class="profilepic" href="<?php echo JRoute::_('index.php?option=com_easyappointment&view=user&id=' . $item->id . '&service=' . $this->category->id);?>">
					<img src="<?php echo JUri::root();?><?php echo $item->picture ? $this->escape($item->picture) : '/components/com_easyappointment/assets/img/default.png';?>" height="" width="" class="img-circle" />
				</a>
			</div>
		</div>
		<div class="col-md-10">
			<div class="row">
			<div class="col-md-8 col-sm-9 col-xs-12">
			<h4>
				<a href="<?php echo JRoute::_('index.php?option=com_easyappointment&view=user&id=' . $item->id . '&service=' . $this->category->id);?>">
					<?php echo $this->escape(ucfirst($item->name));?>
				</a>
			</h4>
			
			<?php if ($user_services) {?>
			<p class="serviceslist"><i class="fa fa-stethoscope fa-fw"></i>&nbsp;<?php foreach ($user_services as $service) {?><a href="<?php echo JRoute::_('index.php?option=com_easyappointment&view=browse&category=' . $service->id);?>"><?php echo $this->escape($service->name);?>, </a><?php } ?></p>
			<?php } ?>
			<p><i class="fa fa-graduation-cap fa-fw"></i> MPTh/MPT, BPTh/BPT</p>
			<p><i class="fa fa-map-marker fa-fw"></i>Ortho Neuro Physiotherapy Clinic<br>
			C-163, Sector -26, Noida,Noida, Uttar Pradesh</p>
			<div class="description">
				<?php echo $item->description;?>
			</div>
				
			</div>
			<div class="col-md-4 col-sm-3 col-xs-12">
			<p><i class="fa fa-suitcase fa-fw" aria-hidden="true"></i> 11 years of experience</p>
			<p><i class="fa fa-money fa-fw" aria-hidden="true"></i> 
			<i class="fa fa-inr" aria-hidden="true"></i> 700 at clinic </p>
			<p><i class="fa fa-credit-card-alt fa-fw" aria-hidden="true"></i>
			<i class="fa fa-inr" aria-hidden="true"></i> 400 online</p>
			</div>
			</div>
		</div>
		<div class="clearfix"></div>
	
			<p>
			<div class="buttons text-center">
				<a href="#" data-toggle="modal" data-target="#login-modal"><div class="col-sm-3 col-xs-6 btn">Call Doctor</div></a>
				<div class="col-sm-3 col-xs-6 btn">
				<a class="" href="<?php echo JRoute::_('index.php?option=com_easyappointment&view=user&id=' . $item->id . '&service=' . $this->category->id);?>"><?php echo JText::_('COM_EASYAPPOINTMENT_BOOK_THIS_USER');?></a>
				</div>
				<div class="col-sm-3 col-xs-6 btn"><a href="#">online chat</a></div>
				<div class="col-sm-3 col-xs-6 btn"><a href="#">vedio chat</a></div>										
			</div>
				
			</p>
	</div>
	<?php } ?>

</div>
