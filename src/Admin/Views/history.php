<?php

if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;

$table = $wpdb->prefix . 'pn_ai_chat_history';

$rows = $wpdb->get_results(

    "SELECT * FROM {$table}
     ORDER BY id DESC
     LIMIT 100"

);
?>

<div class="wrap">

<h1>Chat History</h1>

<table class="widefat striped">

<thead>

<tr>

<th width="80">Role</th>

<th>Message</th>

<th width="180">Date</th>

</tr>

</thead>

<tbody>

<?php if($rows): ?>

<?php foreach($rows as $row): ?>

<tr>

<td>

<strong>

<?php echo esc_html($row->role); ?>

</strong>

</td>

<td>

<?php echo nl2br(
    esc_html($row->message)
); ?>

</td>

<td>

<?php echo esc_html(
    $row->created_at
); ?>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="3">

No conversations yet.

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>