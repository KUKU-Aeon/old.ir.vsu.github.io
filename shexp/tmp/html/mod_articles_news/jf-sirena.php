<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="newsflash<?php echo $moduleclass_sfx; ?> jf_sp_newsflash searchpanel">
	<?php foreach ($list as $item) : ?>
		<a class="jf_sp_nf_item" href="<?php echo $item->link; ?>">
		<?php
			$item_heading = $params->get('item_heading', 'h4');
		?>
			<?php
				$images = json_decode($item->images);
				if($images->image_intro && $params->get('image')){
			?>
				<div class="jf_sp_nf_cover">
					<img data-src="<?php echo $images->image_intro; ?>" alt="<?php echo htmlspecialchars($item->title); ?>" />
				</div>
			<?php } ?>
			
			<div class="jf_sp_nf_content">
				<div class="title"><?php echo $item->title; ?></div>
				<div class="intro"><?php echo substr($item->introtext, 0, 200); ?></div>
			</div>
		</a>
		<div class="clear"></div>
	<?php endforeach; ?>
</div>
