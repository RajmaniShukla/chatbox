<?php
@session_start();

$_SESSION['user_id'] = isset($_GET['user_id']) ? (int) $_GET['user_id'] : 0;

if ($_SESSION['user_id'] === 0) {
  echo '<h1>
Provide your user id</h1>
';
  exit;
}

// Load the messages initially
require_once __DIR__ . '/../FbChatMock.php';
$chat = new FbChatMock();


$messages = $chat->getMessages();
?>
<div class="container" style="border: 1px solid lightgray;">
  <div class="msg-wgt-header">
    <a href="#">John</a>
  </div>
  <div class="msg-wgt-body">
    <table>
      <?php
      if (!empty($messages)) {
        foreach ($messages as $message) {
          $msg = htmlentities($message['message'], ENT_NOQUOTES);
          $user_name = ucfirst($message['username']);
          $sent = date('F j, Y, g:i a', $message['sent_on']);
          echo <<<MSG
          <tr class="msg-row-container">
            <td>
              <div class="msg-row">
                <div class="avatar"></div>
                <div class="message">
                  <span class="user-label"><a href="#" style="color: #6D84B4;">{$user_name}</a> <span class="msg-time">{$sent}</span></span><br/>{$msg}
                </div>
              </div>
            </td>
          </tr>
MSG;
        }
      } else {
        echo '<span style="margin-left: 25px;">No chat messages available!</span>';
      }
      ?>
    </table>
  </div>
  <div class="msg-wgt-footer">
    <textarea id="chatMsg" placeholder="Type your message. Press Shift + Enter for newline"></textarea>
  </div>
</div>