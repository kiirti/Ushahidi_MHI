
<div class="bg">
  <h2><?php echo $title; ?> <span>(<?php echo $total_items; ?>)</span></h2>

  <h3><?= $message ?></h3>

  <p />
    Sites Available <br />
      <ul>
      <?
        foreach ($sites as $row) {
        ?><li /><?= ($row->is_approved)? "APPROVED": "UNAPPROVED" ?>:
          <a href="http://<?= $row->subdomain.Kohana::config('settings.hosting_domain')?>" target="new">
          <?= $row->sitename?></a>: <?= $row->tagline ?> | owner = <?= $row->username ?> 
          <? if (!$row->is_approved) { ?>
            | <a href="/admin/instances/approve/<?= $row->id ?>">Approve</a>
          <? } else { ?>
            | <a href="/admin/instances/unapprove/<?= $row->id ?>">Unapprove</a>
          <? } ?>
          
          <?
      }
      ?>
      </ul>
</div>
