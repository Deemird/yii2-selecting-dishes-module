<?php

use yii\widgets\Pjax;
?>

<h3>Блюда из выбранных ингредиентов</h3>
<br>
<?php if (!empty($dishes)): ?>
    <?php foreach ($dishes as $key => $ingredient): ?>
    	<?php if (!empty($key)): ?>
        	<h4><?= $key ?></h4>
        <?php endif; ?>
        <span style="font-size: 12px; color:#999"><?= $ingredient ?></span>   
    <?php endforeach; ?>
<?php else: ?>
	<span style="font-size: 12px; color:#999">Ничего не найдено</span> 
<?php endif; ?>