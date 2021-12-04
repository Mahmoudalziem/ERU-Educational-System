<?php

    function fetch_depart($x)
    {
        switch ($x) {
            case '1':return 'Preporatory';break;
            case '2':return 'Telecomunication';break;
            case '3':return 'Mechatronics';break;
            case '4':return 'Construction';break;
        }
    }
    $output = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'Q_change_depart') {
                require_once 'connected.php';

                $q_change_value = convert_string('decrypt', $_POST['q_change_value']);

                if ($q_change_value == 'all') {
                    $query_all = 'select * from question_details where status = "accept" order by Q_ID';

                    $stmt_all = $conn->prepare($query_all);

                    $stmt_all->execute();

                    $fetch_all = $stmt_all->fetchAll();

                    $rowCount = $stmt_all->rowCount();

                    if ($rowCount > 0) {
                        foreach ($fetch_all as $fetch_value) {
                            $output .= '<tr>
                                        <td class="td_q_link">
                                            <a href="view_question.php?q_id='.convert_string('encrypt', $fetch_value['Q_title']).'" class="q_link" title="'.$fetch_value['Q_title'].'">'.$fetch_value['Q_title'].'</a>
                                        </td>
                                        <td class="q_field">'.fetch_depart($fetch_value['Q_field']).'</td>
                                        <td class="q_username">'.$fetch_value['Q_username'].'</td>         
                                    </tr>';
                        }
                    } else {
                        $output .= '<td valign="top" colspan="3" class="dataTables_empty">No record Are found</td>';
                    }
                } else {
                    $query_select = 'select * from question_details where q_field = ? and status = "accept"';

                    $stmt_select = $conn->prepare($query_select);

                    $source = array($q_change_value);

                    $stmt_select->execute($source);

                    $fetch_select = $stmt_select->fetchAll();

                    $rowCount_select = $stmt_select->rowCount();

                    if ($rowCount_select > 0) {
                        foreach ($fetch_select as $value_select) {
                            $output .= '<tr>
                                        <td class="td_q_link">
                                            <a href="view_question.php?q_id='.convert_string('encrypt', $value_select['Q_title']).'" class="q_link" title="'.$value_select['Q_title'].'">'.$value_select['Q_title'].'</a>
                                        </td>
                                        <td class="q_field">'.fetch_depart($value_select['Q_field']).'</td>
                                        <td class="q_username">'.$value_select['Q_username'].'</td>         
                                    </tr>';
                        }
                    } else {
                        $output .= '<tr><td valign="top" colspan="3" class="dataTables_empty">No record Are found</td></tr>';
                    }
                }

                echo $output;
            }
        }
    }
