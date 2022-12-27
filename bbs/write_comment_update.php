<?php
ini_set('display_errors', '1');
define('G5_CAPTCHA', true);
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

// ��ūüũ
$comment_token = trim(get_session('ss_comment_token'));
set_session('ss_comment_token', '');
if(empty($_POST['token']) || !$comment_token || $comment_token != $_POST['token'])
    alert('�ùٸ� ������� �̿��� �ֽʽÿ�.');

// 090710
if (substr_count($wr_content, "&#") > 50) {
    alert('���뿡 �ùٸ��� ���� �ڵ尡 �ټ� ���ԵǾ� �ֽ��ϴ�.');
    exit;
}

$w = isset($_POST['w']) ? clean_xss_tags($_POST['w']) : '';
$wr_name  = isset($_POST['wr_name']) ? clean_xss_tags(trim($_POST['wr_name'])) : '';
$wr_secret = isset($_POST['wr_secret']) ? clean_xss_tags($_POST['wr_secret']) : '';
$wr_email = $wr_subject = '';
$reply_array = array();

$wr_1 = isset($_POST['wr_1']) ? $_POST['wr_1'] : '';
$wr_2 = isset($_POST['wr_2']) ? $_POST['wr_2'] : '';
$wr_3 = isset($_POST['wr_3']) ? $_POST['wr_3'] : '';
$wr_4 = isset($_POST['wr_4']) ? $_POST['wr_4'] : '';
$wr_5 = isset($_POST['wr_5']) ? $_POST['wr_5'] : '';
$wr_6 = isset($_POST['wr_6']) ? $_POST['wr_6'] : '';
$wr_7 = isset($_POST['wr_7']) ? $_POST['wr_7'] : '';
$wr_8 = isset($_POST['wr_8']) ? $_POST['wr_8'] : '';
$wr_9 = isset($_POST['wr_9']) ? $_POST['wr_9'] : '';
$wr_10 = isset($_POST['wr_10']) ? $_POST['wr_10'] : '';
$wr_facebook_user = isset($_POST['wr_facebook_user']) ? clean_xss_tags($_POST['wr_facebook_user'], 1, 1) : '';
$wr_twitter_user = isset($_POST['wr_twitter_user']) ? clean_xss_tags($_POST['wr_twitter_user'], 1, 1) : '';
$wr_homepage = isset($_POST['wr_homepage']) ? clean_xss_tags($_POST['wr_homepage'], 1, 1) : '';

if (!empty($_POST['wr_email']))
    $wr_email = get_email_address(trim($_POST['wr_email']));

@include_once($board_skin_path.'/write_comment_update.head.skin.php');

// ��ȸ���� ��� �̸��� �����Ǵ� ��찡 ����
if ($is_guest) {
    if ($wr_name == '')
        alert('�̸��� ���� �Է��ϼž� �մϴ�.');
    if(!chk_captcha())
        alert('�ڵ���Ϲ��� ���ڰ� Ʋ�Ƚ��ϴ�.');
}

if ($w == "c" || $w == "cu") {
    if ($member['mb_level'] < $board['bo_comment_level'])
        alert('����� �� ������ �����ϴ�.');
}
else
    alert('w ���� ����� �Ѿ���� �ʾҽ��ϴ�.');

// ������ �ð� �˻�
// 4.00.15 - ��� ������ ���� �Խù� ��� �޽����� ���� ���� ����
if ($w == 'c' && !$is_admin && isset($_SESSION['ss_datetime']) && $_SESSION['ss_datetime'] >= (G5_SERVER_TIME - $config['cf_delay_sec']))
    alert('�ʹ� ���� �ð����� �Խù��� �����ؼ� �ø� �� �����ϴ�.');

set_session('ss_datetime', G5_SERVER_TIME);

$wr = get_write($write_table, $wr_id);
if (empty($wr['wr_id']))
    alert("���� �������� �ʽ��ϴ�.\\n���� �����Ǿ��ų� �̵��Ͽ��� �� �ֽ��ϴ�.");


// "���ͳݿɼ� > ���� > ��������Ǽ��� > ��ũ���� > Action ��ũ���� > ��� �� ��" �� ����� ���� ó��
// �� �ɼ��� ��� �� ������ ������ ��� � ��ũ��Ʈ�� ���� ���� �ʽ��ϴ�.
//if (!trim($_POST["wr_content"])) die ("������ �Է��Ͽ� �ֽʽÿ�.");

$post_wr_password = '';
if ($is_member)
{
    $mb_id = $member['mb_id'];
    // 4.00.13 - �Ǹ� ����϶� ��ۿ� �г������� �ԷµǴ� ������ ����
    $wr_name = addslashes(clean_xss_tags($board['bo_use_name'] ? $member['mb_name'] : $member['mb_nick']));
    $wr_password = '';
    $wr_email = addslashes($member['mb_email']);
    $wr_homepage = addslashes(clean_xss_tags($member['mb_homepage']));
}
else
{
    $mb_id = '';
    $post_wr_password = $wr_password;
    $wr_password = get_encrypt_string($wr_password);
}

if ($w == 'c') // ��� �Է�
{
    /*
    if ($member[mb_point] + $board[bo_comment_point] < 0 && !$is_admin)
        alert('�����Ͻ� ����Ʈ('.number_format($member[mb_point]).')�� ���ų� ���ڶ� ��۾���('.number_format($board[bo_comment_point]).')�� �Ұ��մϴ�.\\n\\n����Ʈ�� �����Ͻ� �� �ٽ� ����� �� �ֽʽÿ�.');
    */
    // ��۾��� ����Ʈ������ ȸ���� ����Ʈ�� ������ ��� ����� ���� ���ϴ� ���׸� ���� (�����־���)
    $tmp_point = ($member['mb_point'] > 0) ? $member['mb_point'] : 0;
    if ($tmp_point + $board['bo_comment_point'] < 0 && !$is_admin)
        alert('�����Ͻ� ����Ʈ('.number_format($member['mb_point']).')�� ���ų� ���ڶ� ��۾���('.number_format($board['bo_comment_point']).')�� �Ұ��մϴ�.\\n\\n����Ʈ�� �����Ͻ� �� �ٽ� ����� �� �ֽʽÿ�.');

    // ��� �亯
    if ($comment_id)
    {
        $reply_array = get_write($write_table, $comment_id, true);
        if (!$reply_array['wr_id'])
            alert('�亯�� ����� �����ϴ�.\\n\\n�亯�ϴ� ���� ����� �����Ǿ��� �� �ֽ��ϴ�.');

        if($wr['wr_parent'] != $reply_array['wr_parent'])
            alert('����� ����� �� �����ϴ�.');

        $tmp_comment = $reply_array['wr_comment'];

        if (strlen($reply_array['wr_comment_reply']) == 5)
            alert('�� �̻� �亯�Ͻ� �� �����ϴ�.\\n\\n�亯�� 5�ܰ� ������ �����մϴ�.');

        $reply_len = strlen($reply_array['wr_comment_reply']) + 1;
        if ($board['bo_reply_order']) {
            $begin_reply_char = 'A';
            $end_reply_char = 'Z';
            $reply_number = +1;
            $sql = " select MAX(SUBSTRING(wr_comment_reply, $reply_len, 1)) as reply
                        from $write_table
                        where wr_parent = '$wr_id'
                        and wr_comment = '$tmp_comment'
                        and SUBSTRING(wr_comment_reply, $reply_len, 1) <> '' ";
        }
        else
        {
            $begin_reply_char = 'Z';
            $end_reply_char = 'A';
            $reply_number = -1;
            $sql = " select MIN(SUBSTRING(wr_comment_reply, $reply_len, 1)) as reply
                        from $write_table
                        where wr_parent = '$wr_id'
                        and wr_comment = '$tmp_comment'
                        and SUBSTRING(wr_comment_reply, $reply_len, 1) <> '' ";
        }
        if ($reply_array['wr_comment_reply'])
            $sql .= " and wr_comment_reply like '{$reply_array['wr_comment_reply']}%' ";
        $row = sql_fetch($sql);

        if (!$row['reply'])
            $reply_char = $begin_reply_char;
        else if ($row['reply'] == $end_reply_char) // A~Z�� 26 �Դϴ�.
            alert('�� �̻� �亯�Ͻ� �� �����ϴ�.\\n\\n�亯�� 26�� ������ �����մϴ�.');
        else
            $reply_char = chr(ord($row['reply']) + $reply_number);

        $tmp_comment_reply = $reply_array['wr_comment_reply'] . $reply_char;
    }
    else
    {
        $sql = " select max(wr_comment) as max_comment from $write_table
                    where wr_parent = '$wr_id' and wr_is_comment = 1 ";
        $row = sql_fetch($sql);
        //$row[max_comment] -= 1;
        $row['max_comment'] += 1;
        $tmp_comment = $row['max_comment'];
        $tmp_comment_reply = '';
    }

    $wr_subject = get_text(stripslashes($wr['wr_subject']));

    $sql = " insert into $write_table
                set ca_name = '{$wr['ca_name']}',
                     wr_option = '$wr_secret',
                     wr_num = '{$wr['wr_num']}',
                     wr_reply = '',
                     wr_parent = '$wr_id',
                     wr_is_comment = 1,
                     wr_comment = '$tmp_comment',
                     wr_comment_reply = '$tmp_comment_reply',
                     wr_subject = '',
                     wr_content = '$wr_content',
                     mb_id = '$mb_id',
                     wr_password = '$wr_password',
                     wr_name = '$wr_name',
                     wr_email = '$wr_email',
                     wr_homepage = '$wr_homepage',
                     wr_datetime = '".G5_TIME_YMDHIS."',
                     wr_last = '',
                     wr_ip = '{$_SERVER['REMOTE_ADDR']}',
                     wr_1 = '$wr_1',
                     wr_2 = '$wr_2',
                     wr_3 = '$wr_3',
                     wr_4 = '$wr_4',
                     wr_5 = '$wr_5',
                     wr_6 = '$wr_6',
                     wr_7 = '$wr_7',
                     wr_8 = '$wr_8',
                     wr_9 = '$wr_9',
                     wr_10 = '$wr_10' ";
    sql_query($sql);

    $comment_id = sql_insert_id();

    // ���ۿ� ��ۼ� ���� & ������ �ð� �ݿ�
    sql_query(" update $write_table set wr_comment = wr_comment + 1, wr_last = '".G5_TIME_YMDHIS."' where wr_id = '$wr_id' ");

    // ���� INSERT
    sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '$bo_table', '$comment_id', '$wr_id', '".G5_TIME_YMDHIS."', '{$member['mb_id']}' ) ");

    // ��� 1 ����
    sql_query(" update {$g5['board_table']} set bo_count_comment = bo_count_comment + 1 where bo_table = '$bo_table' ");

    // ����Ʈ �ο�
    insert_point($member['mb_id'], $board['bo_comment_point'], "{$board['bo_subject']} {$wr_id}-{$comment_id} ��۾���", $bo_table, $comment_id, '���');

    // ���Ϲ߼� ���
    if ($config['cf_email_use'] && $board['bo_use_email'])
    {
        // �������� ������ ���
        $super_admin = get_admin('super');
        $group_admin = get_admin('group');
        $board_admin = get_admin('board');

        $wr_content = nl2br(get_text(stripslashes("����\n{$wr['wr_subject']}\n\n\n���\n$wr_content")));

        $warr = array( ''=>'�Է�', 'u'=>'����', 'r'=>'�亯', 'c'=>'��� ', 'cu'=>'��� ����' );
        $str = $warr[$w];

        $subject = '['.$config['cf_title'].'] '.$board['bo_subject'].' �Խ��ǿ� '.$str.'���� �ö�Խ��ϴ�.';
        // 4.00.15 - ���Ϸ� ������ ����� �ٷΰ��� ��ũ ����
        $link_url = get_pretty_url($bo_table, $wr_id, $qstr."#c_".$comment_id);

        include_once(G5_LIB_PATH.'/mailer.lib.php');

        ob_start();
        include_once ('./write_update_mail.php');
        $content = ob_get_contents();
        ob_end_clean();

        $array_email = array();
        // �Խ��ǰ����ڿ��� ������ ����
        if ($config['cf_email_wr_board_admin']) $array_email[] = $board_admin['mb_email'];
        // �Խ��Ǳ׷�����ڿ��� ������ ����
        if ($config['cf_email_wr_group_admin']) $array_email[] = $group_admin['mb_email'];
        // �ְ������ڿ��� ������ ����
        if ($config['cf_email_wr_super_admin']) $array_email[] = $super_admin['mb_email'];

        // ���۰Խ��ڿ��� ������ ����
        if ($config['cf_email_wr_write']) $array_email[] = $wr['wr_email'];

        // ��� �� ����̿��� ���� �߼��� �Ǿ� �ִٸ� (�ڽſ��Դ� �߼����� �ʴ´�)
        if ($config['cf_email_wr_comment_all']) {
            $sql = " select distinct wr_email from {$write_table}
                        where wr_email not in ( '{$wr['wr_email']}', '{$member['mb_email']}', '' )
                        and wr_parent = '$wr_id' ";
            $result = sql_query($sql);
            while ($row=sql_fetch_array($result))
                $array_email[] = $row['wr_email'];
        }

        // �ߺ��� ���� �ּҴ� ����
        $unique_email = array_unique($array_email);
        $unique_email = array_values($unique_email);
        for ($i=0; $i<count($unique_email); $i++) {
            mailer($wr_name, $wr_email, $unique_email[$i], $subject, $content, 1);
        }
    }

    // SNS ���
    include_once("./write_comment_update.sns.php");
    if($wr_facebook_user || $wr_twitter_user) {
        $sql = " update $write_table
                    set wr_facebook_user = '$wr_facebook_user',
                        wr_twitter_user  = '$wr_twitter_user'
                    where wr_id = '$comment_id' ";
        sql_query($sql);
    }
}
else if ($w == 'cu') // ��� ����
{
    $sql = " select mb_id, wr_password, wr_comment, wr_comment_reply from $write_table
                where wr_id = '$comment_id' ";
    $comment = $reply_array = sql_fetch($sql);
    $tmp_comment = $reply_array['wr_comment'];

    $len = strlen($reply_array['wr_comment_reply']);
    if ($len < 0) $len = 0;
    $comment_reply = substr($reply_array['wr_comment_reply'], 0, $len);
    //print_r2($GLOBALS); exit;

    if ($is_admin == 'super') // �ְ������� ���
        ;
    else if ($is_admin == 'group') { // �׷������
        $mb = get_member($comment['mb_id']);
        if ($member['mb_id'] === $group['gr_admin']) { // �ڽ��� �����ϴ� �׷��ΰ�?
            if ($member['mb_level'] >= $mb['mb_level']) // �ڽ��� ������ ũ�ų� ���ٸ� ���
                ;
            else
                alert('�׷�������� ���Ѻ��� ���� ȸ���� ����̹Ƿ� ������ �� �����ϴ�.');
        } else
            alert('�ڽ��� �����ϴ� �׷��� �Խ����� �ƴϹǷ� ����� ������ �� �����ϴ�.');
    } else if ($is_admin == 'board') { // �Խ��ǰ������̸�
        $mb = get_member($comment['mb_id']);
        if ($member['mb_id'] === $board['bo_admin']) { // �ڽ��� �����ϴ� �Խ����ΰ�?
            if ($member['mb_level'] >= $mb['mb_level']) // �ڽ��� ������ ũ�ų� ���ٸ� ���
                ;
            else
                alert('�Խ��ǰ������� ���Ѻ��� ���� ȸ���� ����̹Ƿ� ������ �� �����ϴ�.');
        } else
            alert('�ڽ��� �����ϴ� �Խ����� �ƴϹǷ� ����� ������ �� �����ϴ�.');
    } else if ($member['mb_id']) {
        if ($member['mb_id'] !== $comment['mb_id'])
            alert('�ڽ��� ���� �ƴϹǷ� ������ �� �����ϴ�.');
    } else {
        if( !($comment['mb_id'] === '' && $comment['wr_password'] && check_password($post_wr_password, $comment['wr_password'])) )
            alert('����� ������ ������ �����ϴ�.');
    }

    $sql = " select count(*) as cnt from $write_table
                where wr_comment_reply like '$comment_reply%'
                and wr_id <> '$comment_id'
                and wr_parent = '$wr_id'
                and wr_comment = '$tmp_comment'
                and wr_is_comment = 1 ";
    $row = sql_fetch($sql);
    if ($row['cnt'] && !$is_admin)
        alert('�� ��ۿ� ���õ� �亯����� �����ϹǷ� ���� �� �� �����ϴ�.');

    $sql_ip = "";
    if (!$is_admin)
        $sql_ip = " , wr_ip = '{$_SERVER['REMOTE_ADDR']}' ";

    $sql_secret = " , wr_option = '$wr_secret' ";

    $sql = " update $write_table
                set wr_subject = '$wr_subject',
                     wr_content = '$wr_content',
                     wr_1 = '$wr_1',
                     wr_2 = '$wr_2',
                     wr_3 = '$wr_3',
                     wr_4 = '$wr_4',
                     wr_5 = '$wr_5',
                     wr_6 = '$wr_6',
                     wr_7 = '$wr_7',
                     wr_8 = '$wr_8',
                     wr_9 = '$wr_9',
                     wr_10 = '$wr_10'
                     $sql_ip
                     $sql_secret
              where wr_id = '$comment_id' ";

    sql_query($sql);
}

// ����� �ڵ� ����
@include_once($board_skin_path.'/write_comment_update.skin.php');
@include_once($board_skin_path.'/write_comment_update.tail.skin.php');

delete_cache_latest($bo_table);

$redirect_url = G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr['wr_parent'].'&amp;'.$qstr.'&amp;#c_'.$comment_id;

//run_event('comment_update_after', $board, $wr_id, $w, $qstr, $redirect_url, $comment_id, $reply_array);

goto_url($redirect_url);