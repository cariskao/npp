<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-globe"></i> 新增公告
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-warning" href="<?php echo base_url(); ?>news/message">返回</a>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">新增公告資料</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <!-- <form role="form" action="<?php echo base_url() ?>news/addNewMessage" method="post" id="" role="form"> -->
                    <form role="form" action="" method="post" id="" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="img">新增圖片</label>
                                        <input type="file" name="file" />
                                        <?php echo form_error('file'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="m_title">大標</label>
                                        <input type="text" class="form-control" id="m_title" name="m_title" value="">
                                        <?php echo form_error('m_title'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="s_title">次標</label>
                                        <input type="text" class="form-control" id="s_title" name="s_title" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="date">建立日期</label>
                                        <input type="date" class="form-control" id="date_start" name="date_start" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fb">臉書</label>
                                        <input type="text" class="form-control" id="fb" name="fb" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="line">Line</label>
                                        <input type="text" class="form-control" id="line" name="line" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="twitter">推特</label>
                                        <input type="text" class="form-control" id="twitter" name="twitter" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mail">信箱</label>
                                        <input type="text" class="form-control" id="mail" name="mail" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tag1">標籤1</label>
                                        <select name="tag1" id="tag1" class="form-control">
                                            <option value="0">不選擇</option>
                                            <?php
                                            if (!empty($tagsInfo)) {
                                                foreach ($tagsInfo as $record) {
                                                    ?>
                                            <option value="<?php echo $record->name; ?>"><?php echo $record->name; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tag2">標籤2</label>
                                        <select name="tag2" id="tag2" class="form-control">
                                            <option value="0">不選擇</option>
                                            <?php
                                            if (!empty($tagsInfo)) {
                                                foreach ($tagsInfo as $record) {
                                                    ?>
                                            <option value="<?php echo $record->name; ?>"><?php echo $record->name; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tag3">標籤3</label>
                                        <select name="tag3" id="tag3" class="form-control">
                                            <option value="0">不選擇</option>
                                            <?php
                                            if (!empty($tagsInfo)) {
                                                foreach ($tagsInfo as $record) {
                                                    ?>
                                            <option value="<?php echo $record->name; ?>"><?php echo $record->name; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tag4">標籤4</label>
                                        <select name="tag4" id="tag4" class="form-control">
                                            <option value="0">不選擇</option>
                                            <?php
                                            if (!empty($tagsInfo)) {
                                                foreach ($tagsInfo as $record) {
                                                    ?>
                                            <option value="<?php echo $record->name; ?>"><?php echo $record->name; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tag5">標籤5</label>
                                        <select name="tag5" id="tag5" class="form-control">
                                            <option value="0">不選擇</option>
                                            <?php
                                            if (!empty($tagsInfo)) {
                                                foreach ($tagsInfo as $record) {
                                                    ?>
                                            <option value="<?php echo $record->name; ?>"><?php echo $record->name; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <textarea name="editor1" id="editor1"></textarea>
                                    <script>
                                        CKEDITOR.replace("editor1", {
                                            filebrowserBrowseUrl: '<?php echo base_url(); ?>assets/plugins/ckeditor4/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                                            filebrowserUploadUrl: '<?php echo base_url(); ?>assets/plugins/ckeditor4/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                                            filebrowserImageBrowseUrl: '<?php echo base_url(); ?>assets/plugins/ckeditor4/filemanager/dialog.php?type=1&editor=ckeditor&fldr=',
                                            // width: 1000,
                                            height: 800,
                                            // language: '',
                                            toolbarCanCollapse: true, // ui可縮起來
                                        });
                                    </script>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer seat" style="text-align:center">
                            <input type="submit" class="btn btn-primary" value="儲存" />
                            <input type="reset" class="btn btn-default" value="重置" />
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="col-md-12"> -->

            <script language='javascript' type='text/javascript'>
                $(function() {
                    setTimeout(function() {
                        $("#alert-success").hide();
                    }, 3000);
                })
            </script>
            <?php
            $this->load->helper('form');
            $error = $this->session->flashdata('error');
            if ($error) {
                ?>
            <div id="alert-error" class="alert-absoulte alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php } ?>
            <?php
            $success = $this->session->flashdata('success');
            if ($success) {
                ?>
            <div id="alert-success" class="alert-absoulte alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>

            <style>
                .seat input {
                    width: 100px;
                    margin: 0 40px;
                }

                .alert-absoulte {
                    width: 150px;
                    text-align: center;
                    position: absolute;
                    margin: auto;
                    left: 230px;
                    right: 0;
                    top: 80px;
                }

                @media screen and (max-width: 768px) {
                    .alert-absoulte {
                        left: 0;
                    }
                }
            </style>
            <!-- <?php echo validation_errors('<div id="alert-error" class="alert-absoulte alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?> -->
        </div>
</div>
</section>
</div>