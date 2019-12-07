<?php
$newsId = $userInfo->newsid;
$img = $userInfo->news_img;
$m_title = $userInfo->news_main_title;
$s_title = $userInfo->news_sub_title;
$date_start = $userInfo->date_start;
$date_update = $userInfo->date_update;
$editor = $userInfo->news_editor;
$fb = $userInfo->news_share_fb;
$line = $userInfo->news_share_line;
$twitter = $userInfo->news_share_twitter;
$mail = $userInfo->news_share_mail;
$tag1 = $userInfo->tag1;
$tag2 = $userInfo->tag2;
$tag3 = $userInfo->tag3;
$tag4 = $userInfo->tag4;
$tag5 = $userInfo->tag5;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-globe"></i> 編輯新聞
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-warning" href="<?php echo base_url(); ?>news">返回</a>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">編輯新聞稿資料</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <!--  enctype="multipart/form-data"記得加 -->
                    <form role="form" action="<?php echo base_url() ?>news/editUser" method="post" id="" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div><img src="<?php echo base_url('assets/uploads/news_upload/news/' . $img); ?>"></div>
                                        <label for="img">更換圖片</label>
                                        <input id="img" type="file" name="file" size="20" />
                                        <?php echo form_error('file'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="m_title">大標</label>
                                        <input type="text" class="form-control" id="m_title" name="m_title" value="<?php echo $m_title; ?>">
                                        <?php echo form_error('m_title'); ?>
                                        <input type="hidden" value="<?php echo $newsId; ?>" name="newsId" id="newsId" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="s_title">次標</label>
                                        <input type="text" class="form-control" id="s_title" name="s_title" value="<?php echo $s_title; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="date_start">建立日期</label>
                                        <input type="date" class="form-control" id="date_start" name="date_start" value="<?php echo $date_start; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="date_update">更新日期</label>
                                        <input type="date" class="form-control" id="date_update" name="date_update" value="<?php echo $date_update; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fb">臉書</label>
                                        <input type="text" class="form-control" id="fb" name="fb" value="<?php echo $fb; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="line">Line</label>
                                        <input type="text" class="form-control" id="line" name="line" value="<?php echo $line; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="twitter">推特</label>
                                        <input type="text" class="form-control" id="twitter" name="twitter" value="<?php echo $twitter; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mail">信箱</label>
                                        <input type="text" class="form-control" id="mail" name="mail" value="<?php echo $mail; ?>">
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
                                            <option value="<?php echo $record->name; ?>" <?php if ($record->name == $tag1) echo "selected=selected"; ?>><?php echo $record->name; ?></option>
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
                                            <option value="<?php echo $record->name; ?>" <?php if ($record->name == $tag2) echo "selected=selected"; ?>><?php echo $record->name; ?></option>
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
                                            <option value="<?php echo $record->name; ?>" <?php if ($record->name == $tag3) echo "selected=selected"; ?>><?php echo $record->name; ?></option>
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
                                            <option value="<?php echo $record->name; ?>" <?php if ($record->name == $tag4) echo "selected=selected"; ?>><?php echo $record->name; ?></option>
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
                                            <option value="<?php echo $record->name; ?>" <?php if ($record->name == $tag5) echo "selected=selected"; ?>><?php echo $record->name; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <textarea name="editor1" id="editor1"><?php echo $editor; ?></textarea>
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
            // echo $success; //存儲成功!
            $check = $this->session->flashdata('check');
            if ($success && $check == '驗證成功') {
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
    </section>
</div>