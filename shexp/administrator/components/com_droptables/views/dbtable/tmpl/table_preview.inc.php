<p><?php  echo JText::_('COM_DROPTABLES_LAYOUT_DBTABLES_PREVIEW_RESULT_TITLE'); ?></p>
<table>
    
    <thead>
        <tr>
        <?php foreach( $headers as $header ){ ?>
            <th><?php echo $header ?></th>
        <?php }?>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach( $result as $i=>$row ){ ?>
        <tr class="<?php if($i%2==0) { echo 'odd';} ?>">
            <?php foreach( $row as $cell ){ ?>
                <td><?php echo $cell ?></td>
            <?php } ?>
        </tr>
        <?php } ?>
    </tbody>
    
</table>