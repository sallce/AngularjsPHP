<div class="container well">
  <nav class="navbar">
      <ul class="nav navbar-nav" id="messageNav">
        <a ui-sref="message.inbox_view" ui-sref-active="active"><li class="btn btn-info">Inbox</li></a>
        <a ui-sref="message.sendbox_view" ui-sref-active="active"><li class="btn btn-warning">Sent</li></a>
        <a ui-sref="message.newmail_view" ui-sref-active="active"><li class="btn btn-danger">Compose</li></a>
      </ul>
  </nav>

<div id="showmails">
  <ui-view></ui-view>
<!--<ui-view name="sendbox_view"></ui-view>
<ui-view name="newmail_view"></ui-view>-->
    <!--<div ui-view="inbox_view"></div>
    <div ui-view="sendbox_view"></div>
    <div ui-view="newmail_view"></div>-->
</div>

   
</div>
