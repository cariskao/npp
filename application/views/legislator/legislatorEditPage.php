<?php
$yearId = $userInfo->yearid;
$legId = $userInfo->legid;

$img = $userInfo->img;
$name = $userInfo->name;
$education = $userInfo->education;
$experience = $userInfo->experience;
$committee = $userInfo->committee;
$districts  = $userInfo->districts;

$cell_phone = $userInfo->cell_phone;
$office_phone = $userInfo->office_phone;
$fax = $userInfo->fax;
$mail = $userInfo->mail;
$address = $userInfo->address;

$fb = $userInfo->fb;
$line = $userInfo->line;
$ig = $userInfo->ig;
$web = $userInfo->web;
$youtube = $userInfo->youtube;

$issueId1 = $userInfo->issueId1;
$issueId2 = $userInfo->issueId2;
$issueId3 = $userInfo->issueId3;
$issueId4 = $userInfo->issueId4;
$issueId5 = $userInfo->issueId5;
$issueId6 = $userInfo->issueId6;
$issueId7 = $userInfo->issueId7;
$issueId8 = $userInfo->issueId8;
$issueId9 = $userInfo->issueId9;
$issueId10 = $userInfo->issueId10;
?>
<!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> -->
<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user"></i> 編輯 〖<?php echo $yearTitle->title; ?>〗 委員【<?php echo $name; ?>】的資料
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-warning" href="<?php echo base_url(); ?>legislator/legislatorListPage/<?php echo $yearId; ?>">返回</a>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header">
                        <!-- <h3 class="box-title">編輯委員資料</h3> -->
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <!--  enctype="multipart/form-data"記得加 -->
                    <form role="form" action="<?php echo base_url() ?>legislator/legislatorEditSend" method="post" id="legislatorEditPage" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div style="text-align:center"><img class="img_style" src="<?php echo base_url('assets/uploads/legislator_upload/' . $yearTitle->title . '/' . $img); ?>"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">姓名</label>
                                        <input disabled type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                                        <?php echo form_error('name'); ?>
                                        <input type="hidden" value="<?php echo $legId; ?>" name="legId" id="legId" />
                                        <input type="hidden" value="<?php echo $yearId; ?>" name="yearId" id="yearId" />
                                        <input type="hidden" value="<?php echo $yearTitle->title; ?>" name="yearTitle" id="yearTitle" />
                                    </div>
                                </div>
                                <div class="col-md-3 contact">
                                    <div class="bg-color">
                                        <p>聯絡方式</p>
                                        <div class="form-group">
                                            <label for="cell_phone">手機</label>
                                            <input disabled type="text" class="form-control" id="cell_phone" name="cell_phone" value="<?php echo $cell_phone; ?>">
                                            <label for="office_phone">辦公室電話</label>
                                            <input disabled type="text" class="form-control" id="office_phone" name="office_phone" value="<?php echo $office_phone; ?>">
                                            <label for="address">辦公室地址</label>
                                            <input disabled type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
                                            <label for="fax">傳真</label>
                                            <input disabled type="text" class="form-control" id="fax" name="fax" value="<?php echo $fax; ?>">
                                            <label for="mail">Email</label>
                                            <input disabled type="text" class="form-control" id="mail" name="mail" value="<?php echo $mail; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 contact">
                                    <div class="bg-color">
                                        <p>社群媒體</p>
                                        <div class="form-group">
                                            <label for="fb">臉書</label>
                                            <input disabled type="text" class="form-control" id="fb" name="fb" value="<?php echo $fb; ?>">
                                            <label for="line">Line</label>
                                            <input disabled type="text" class="form-control" id="line" name="line" value="<?php echo $line; ?>">
                                            <label for="youtube">Youtube</label>
                                            <input disabled type="text" class="form-control" id="youtube" name="youtube" value="<?php echo $youtube; ?>">
                                            <label for="ig">IG</label>
                                            <input disabled type="text" class="form-control" id="ig" name="ig" value="<?php echo $ig; ?>">
                                            <label for="web">個人網站</label>
                                            <input disabled type="text" class="form-control" id="web" name="web" value="<?php echo $web; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 contact">
                                    <div class="bg-color">
                                        <p>基本資料</p>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="education">學歷</label>
                                                <textarea disabled style="resize: none;width:100%;height:200px" name="education" id="education"><?php echo $education; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="experience">經驗</label>
                                                <textarea disabled style="resize: none;width:100%;height:200px" name="experience" id="experience"><?php echo $experience; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="committee">各會期委員會</label>
                                                <textarea disabled style="resize: none;width:100%;height:200px" name="committee" id="committee"><?php echo $committee; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="districts">分區 / 不分區</label>
                                                <textarea style="resize: none;width:100%;height:200px" name="districts" id="districts"><?php echo $districts; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 contact">
                                    <div class="bg-color">
                                        <p>關注議題</p>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="issueId1">議題1</label>
                                                <select class="form-control" name="issueId1" id="issueId1">
                                                    <option value="0">選擇議題</option>
                                                    <?php if (!empty($issueList)) :
                                                        foreach ($issueList as $list) : ?>
                                                            <option value="<?php echo $list->issueid; ?>" <?php if ($list->issueid == $issueId1) echo "selected=selected"; ?>><?php echo $list->name ?></option>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                                <label for="issueId2">議題2</label>
                                                <select class="form-control" name="issueId2" id="issueId2">
                                                    <option value="0">選擇議題</option>
                                                    <?php if (!empty($issueList)) :
                                                        foreach ($issueList as $list) : ?>
                                                            <option value="<?php echo $list->issueid; ?>" <?php if ($list->issueid == $issueId2) echo "selected=selected"; ?>><?php echo $list->name ?></option>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                                <label for="issueId3">議題3</label>
                                                <select class="form-control" name="issueId3" id="issueId3">
                                                    <option value="0">選擇議題</option>
                                                    <?php if (!empty($issueList)) :
                                                        foreach ($issueList as $list) : ?>
                                                            <option value="<?php echo $list->issueid; ?>" <?php if ($list->issueid == $issueId3) echo "selected=selected"; ?>><?php echo $list->name ?></option>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                                <label for="issueId4">議題4</label>
                                                <select class="form-control" name="issueId4" id="issueId4">
                                                    <option value="0">選擇議題</option>
                                                    <?php if (!empty($issueList)) :
                                                        foreach ($issueList as $list) : ?>
                                                            <option value="<?php echo $list->issueid; ?>" <?php if ($list->issueid == $issueId4) echo "selected=selected"; ?>><?php echo $list->name ?></option>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                                <label for="issueId5">議題5</label>
                                                <select class="form-control" name="issueId5" id="issueId5">
                                                    <option value="0">選擇議題</option>
                                                    <?php if (!empty($issueList)) :
                                                        foreach ($issueList as $list) : ?>
                                                            <option value="<?php echo $list->issueid; ?>" <?php if ($list->issueid == $issueId5) echo "selected=selected"; ?>><?php echo $list->name ?></option>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="issueId6">議題6</label>
                                                <select class="form-control" name="issueId6" id="issueId6">
                                                    <option value="0">選擇議題</option>
                                                    <?php if (!empty($issueList)) :
                                                        foreach ($issueList as $list) : ?>
                                                            <option value="<?php echo $list->issueid; ?>" <?php if ($list->issueid == $issueId6) echo "selected=selected"; ?>><?php echo $list->name ?></option>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                                <label for="issueId7">議題7</label>
                                                <select class="form-control" name="issueId7" id="issueId7">
                                                    <option value="0">選擇議題</option>
                                                    <?php if (!empty($issueList)) :
                                                        foreach ($issueList as $list) : ?>
                                                            <option value="<?php echo $list->issueid; ?>" <?php if ($list->issueid == $issueId7) echo "selected=selected"; ?>><?php echo $list->name ?></option>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                                <label for="issueId8">議題8</label>
                                                <select class="form-control" name="issueId8" id="issueId8">
                                                    <option value="0">選擇議題</option>
                                                    <?php if (!empty($issueList)) :
                                                        foreach ($issueList as $list) : ?>
                                                            <option value="<?php echo $list->issueid; ?>" <?php if ($list->issueid == $issueId8) echo "selected=selected"; ?>><?php echo $list->name ?></option>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                                <label for="issueId9">議題9</label>
                                                <select class="form-control" name="issueId9" id="issueId9">
                                                    <option value="0">選擇議題</option>
                                                    <?php if (!empty($issueList)) :
                                                        foreach ($issueList as $list) : ?>
                                                            <option value="<?php echo $list->issueid; ?>" <?php if ($list->issueid == $issueId9) echo "selected=selected"; ?>><?php echo $list->name ?></option>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                                <label for="issueId10">議題10</label>
                                                <select class="form-control" name="issueId10" id="issueId10">
                                                    <option value="0">選擇議題</option>
                                                    <?php if (!empty($issueList)) :
                                                        foreach ($issueList as $list) : ?>
                                                            <option value="<?php echo $list->issueid; ?>" <?php if ($list->issueid == $issueId10) echo "selected=selected"; ?>><?php echo $list->name ?></option>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
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
            $success = $this->session->flashdata('success');
            $check = $this->session->flashdata('check');
            echo $success; //存儲成功!
            echo $check;
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
                    top: -75px;
                }

                /* @media screen and (max-width: 768px) {
                    .alert-absoulte {
                        left: 0;
                    }
                } */

                .img_style {
                    border: 1px solid #D2D6DE;
                    width: 215px;
                    height: 215px
                }
            </style>
            <!-- <?php echo validation_errors('<div id="alert-error" class="alert-absoulte alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?> -->
        </div>
    </section>
</div>
<!-- <script src="<?php echo base_url(); ?>assets/js/legislatorEditPage.js" type="text/javascript"></script> -->