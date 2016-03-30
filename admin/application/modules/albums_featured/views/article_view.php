<?php 

echo '<h3 class="h3-article-popup">'. $article[0]->title.'</h3>';

echo '<p class="p-h-article-popup">'.  $article[0]->description. '</p>'; ?>
 <img src="<?php echo site_url().'uploads/image_archive/312x224/'.$article[0]->main_image ?>"><br>
<?php if(@$article[0]->published_at != null): ?>
<?php echo '<span class="fon-bo-ba" stylt="margin-top:10px;">نشرت في </span> <span class="fon-rg-ba">'.$article[0]->published_at.'</span> <span class="fon-bo-ba" stylt="margin-top:10px;">نشر بواسطة: </span> <span class="fon-rg-ba">'.$article[0]->published_by
."</span>";
else: ?>
<?php echo '<span class="fon-bo-ba" stylt="margin-top:10px;">نشرت في  </span> <span class="fon-rg-ba">'.$article[0]->published_at.'</span> <span class="fon-bo-ba" stylt="margin-top:10px;">نشر بواسطة: </span> <span class="fon-rg-ba">'.$article[0]->published_by
."</span>";
?>
<?php endif; ?>

