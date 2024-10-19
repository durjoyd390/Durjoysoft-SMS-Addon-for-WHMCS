<div class="durjoysoft_sms_wrapper">
    <div class="tabbed_section">
        <?php include_once DURJOYSOFT_SMS_PATH . '/partials/nav.php'; ?>
        <div class="tabbed_section_content_wrap">
            <div class="tabbed_section_content tabbed_section_content_active">


                <table width="100%" class="datatable" border="0" cellspacing="1" cellpadding="3" style="margin: 0px; border: 0px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Sender ID</th>
                            <th>Mobile Number</th>
                            <th width="50%">Message</th>
                            <th>Date Time</th>
                            <th>Status</th>
                            <th width="20"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        //delete sms
                        if (isset($_GET['deletesms'])) {

                            try {
                                $id = $_GET['deletesms'];
                                // convert to int
                                $id = (int) $id;

                                $sql = "DELETE FROM `durjoysoft_sms_messages` WHERE `id` = {$id}";

                                mysql_query($sql);

                                showAlert("Deleted Successfully", "success");
                            } catch (\Throwable $th) {
                                showAlert($th->getMessage(), "danger");
                            }
                        }


                        function getStatus($data)
                        {
                            if ($data['status'] == 'success') {
                              $status = $data['status'];
                            }
                            else{
                              $status = $data['error_details'];
                            }

                            return $status;
                        }


                        // Getting pagination values.
                        $page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $limit  = (isset($_GET['limit']) && $_GET['limit'] <= 50) ? (int)$_GET['limit'] : 10;
                        $start  = ($page > 1) ? ($page * $limit) - $limit : 0;
                        $order  = isset($_GET['order']) ? $_GET['order'] : 'DESC';
                        /* Getting messages order by date desc */
                        $sql    = "SELECT `m`.*,`user`.`firstname`,`user`.`lastname`, `user`.`id` as `uid`
                        FROM `durjoysoft_sms_messages` as `m`
                        LEFT JOIN `tblclients` as `user` ON `m`.`client_id` = `user`.`id`
                        ORDER BY `m`.`created` {$order} limit {$start},{$limit}";
                        $result = mysql_query($sql);
                        $i = 0;

                        //Getting total records
                        $total  = "SELECT count(id) as toplam FROM `durjoysoft_sms_messages`";
                        $sonuc  = mysql_query($total);
                        $sonuc  = mysql_fetch_array($sonuc);
                        $toplam = $sonuc['toplam'];

                        //Page calculation
                        $sayfa  = ceil($toplam / $limit);
                        $empty = true;

                        while ($data = mysql_fetch_array($result)) {
                            $empty = false;
                            $i++;
                            $formatedDate = date("M d, Y h:i A", strtotime($data['created']));
                        ?>

                            <tr>
                                <td><?php echo $data['id']; ?></td>
                                <td><a href="clientssummary.php?userid=<?php echo $data['uid']; ?>"><?php echo $data['firstname'] . ' ' . $data['lastname']; ?></a></td>
                                <td><?php echo empty($data['sender_id']) ? "Default" : $data['sender_id']; ?></td>
                                <td><?php echo $data['recipient']; ?></td>
                                <td><?= nl2br($data['message']); ?></td>
                                <td><?php echo $formatedDate; ?></td>
                                <td><?php echo getStatus($data) ?></td>
                                <td><a href="addonmodules.php?module=durjoysoft_sms&tab=sms_logs&deletesms=<?php echo $data['id']; ?>" title="Delete"><img src="images/delete.gif" width="16" height="16" border="0" alt="Delete"></a></td>
                            </tr>


                        <?php

                        }
                        if ($empty) {
                            echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
                        }

                        $list = "";
                        for ($a = 1; $a <= $sayfa; $a++) {
                            $selected = ($page == $a) ? 'selected="selected"' : '';
                            $list .= "<option value='addonmodules.php?module=durjoysoft_sms&tab=sms_logs&page={$a}&limit={$limit}&order={$order}' {$selected}>{$a}</option>";
                        }
                        echo "<select  onchange=\"this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);\">{$list}</select></div>";


                        ?>
                    </tbody>
                </table>



            </div>
        </div>
    </div>
</div>