<?php if ($this->session->has_userdata('error')) { ?>

    <div class="alert alert-danger alert-dismissable">
        <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> -->
        <?= strip_tags(str_replace('</p>', '', $this->session->flashdata('error'))); ?>
    </div>

<?php } ?>

<?php if ($this->session->has_userdata('sukses')) { ?>

    <div class="alert alert-success alert-dismissable">
        <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> -->
        <?= $this->session->flashdata('sukses') ?>
    </div>

<?php } ?>