<table class="table">
    <thead>
        <tr>
            <th>Recived from</th>
            <th>Subject</th>
            <th>Option</th>
            <!--<th>content</th>-->
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="recivedmail in reciveMails track by $index">
            <td>{{recivedmail.username}}</td>
            <td>{{recivedmail.subject}}</td>
            <td>
                <important></important>
                <span class="glyphicon glyphicon-eye-open" ng-click="viewMail(recivedmail.id)"></span>
                <span class="glyphicon glyphicon-trash" ng-click="deleteMail(recivedmail.id,$index)"></span>
            </td>
            <!--<td>{{sentmail.content}}</td>-->
        </tr>
    </tbody>
</table>
<div ng-show="empty_box" class="error">
Inbox is empty.
</div>
