<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-globe"></i> 新增活動記錄資料
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-warning" href="<?php echo base_url(); ?>news/records">返回</a>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">新增活動記錄資料</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <!--  enctype="multipart/form-data"記得加 -->
                    <form role="form" action="<?php echo base_url() ?>news/addNewRecords" method="post" id="" role="form" enctype="multipart/form-data">
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
                    setTimeout(function() {
                        $("#alert-error").hide();
                    }, 3000);
                })
            </script>
            <?php
            $this->load->helper('form');
            $check = $this->session->flashdata('check');
            if ($check == '驗證失敗') {
                ?>
                <div id="alert-error" class="alert-absoulte error-width alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('check') . '!<br>請修正以下提示錯誤!'; ?>
                </div>
            <?php } ?>
            <?php
            $success = $this->session->flashdata('success');
            if ($success) {
                ?>
                <div id="alert-success" class="alert-absoulte success-width alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>

            <style>
                .seat input {
                    width: 100px;
                    margin: 0 40px;
                }

                .success-width {
                    width: 150px;
                }

                .error-width {
                    width: 250px;
                }

                .alert-absoulte {
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