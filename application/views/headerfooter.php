<?php
$fb = $headerfooterInfo->fb;
$mail = $headerfooterInfo->mail;
$phoneSend = $headerfooterInfo->phonesend;
$phoneShow = $headerfooterInfo->phoneshow;
$fax = $headerfooterInfo->fax;
$servicetime = $headerfooterInfo->servicetime;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header content-header_style">
        <h1>
            Header & Footer
            <small>編輯</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header">
                        <!-- <h3 class="box-title">編輯委員資料</h3> -->
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" action="<?php echo base_url() ?>headerfooter/headerfooterEditSend" method="post" id="headerfooter" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12 contact">
                                    <div class="bg-color">
                                        <p>資料編輯</p>
                                        <div class="form-group">
                                            <label for="fb">臉書</label>
                                            <input type="text" class="form-control" id="fb" name="fb" value="<?php echo $fb; ?>">
                                            <?php echo form_error('fb'); ?>
                                            <label for="mail">Email</label>
                                            <input type="text" class="form-control" id="mail" name="mail" value="<?php echo $mail; ?>">
                                            <?php echo form_error('mail'); ?>
                                            <label for="phonesend">電話(撥打)</label>
                                            <input type="text" class="form-control" id="phonesend" name="phonesend" value="<?php echo $phoneSend; ?>">
                                            <?php echo form_error('phonesend'); ?>
                                            <label for="phoneshow">電話(顯示)</label>
                                            <input type="text" class="form-control" id="phoneshow" name="phoneshow" value="<?php echo $phoneShow; ?>">
                                            <?php echo form_error('phoneshow'); ?>
                                            <label for="fax">傳真</label>
                                            <input type="text" class="form-control" id="fax" name="fax" value="<?php echo $fax; ?>">
                                            <?php echo form_error('fax'); ?>
                                            <label for="servicetime">服務時間</label>
                                            <input type="text" class="form-control" id="servicetime" name="servicetime" value="<?php echo $servicetime; ?>">
                                            <?php echo form_error('servicetime'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
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

                .box-body .row>div {
                    margin-bottom: 40px;
                }

                .bg-color {
                    border: 1px solid #D2D6DE;
                    padding: 20px 10px 10px 10px;
                    overflow: hidden;
                }

                .bg-color>p {
                    font-weight: bold;
                    font-size: 20px;
                    color: #3C8DBC;
                    background-color: white;
                    position: absolute;
                    top: -16px;
                }

                .contact div input {
                    margin-bottom: 15px;
                }

                .alert-absoulte {
                    width: 150px;
                    text-align: center;
                    position: absolute;
                    margin: auto;
                    /* left: 230px; */
                    left: 0px;
                    right: 0;
                    top: -61px;
                }

                .content-header.content-header_style h1 {
                    line-height: 40px;
                }
            </style>
            <!-- <?php echo validation_errors('<div id="alert-error" class="alert-absoulte alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?> -->
        </div>
    </section>
</div>